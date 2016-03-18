<?php

namespace App\Http\Controllers\Frontend\Asset;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Checkout;
use App\Repositories\Frontend\Asset\AssetContract;
use App\Repositories\Frontend\Location\LocationContract;
use App\Repositories\Frontend\Mfr\MfrContract;
use Event;
use Illuminate\Http\Request;
use Image;

class AssetController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var AssetContract
     */
    protected $assets;
    /**
     * The asset repository instance.
     *
     * @var MfrContract
     */
    protected $mfrs;

    protected $locations;

    /**
     * Create a new controller instance.
     *
     * @param  AssetContract $assets
     * @param MfrContract $mfrs
     * @param LocationContract $locations
     */
    public function __construct(AssetContract $assets, MfrContract $mfrs, LocationContract $locations)
    {
        $this->middleware('auth');

        $this->assets = $assets;
        $this->mfrs = $mfrs;
        $this->locations = $locations;
    }

    public function index()
    {
        $assets = Asset::orderBy('updated_at', 'desc')->take(60)->get();

        $assets->load('mfr', 'location', 'activeCheckout.dealer', 'activeCheckout.dealer.dealership');

        return view('frontend.assets.samples', compact('assets'));
    }

    public function out()
    {
        $assets = Asset::where('status', '=', 2)->get();

        $assets->load('mfr', 'location', 'activeCheckout.dealer', 'activeCheckout.dealer.dealership');

//        $assets->sortByDesc('activeCheckout.expected_return_date');

        $assets = $assets->sortBy(function ($asset) {
            return $asset->activeCheckout->expected_return_date;
        });

        return view('frontend.assets.samples', compact('assets'));
    }

    public function search(Request $request)
    {
        //        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();
        $term = $request->q;

        $mfrList = $this->mfrs->findByNameAll($term);
        $mfrIn = [];
        foreach ($mfrList as $mfr) {
            $mfrIn[] = $mfr->id;
        }

        $assets = Asset::where('id', 'LIKE', '%'.$term.'%')
            ->orWhere('part', 'LIKE', '%'.$term.'%')
            ->orWhere('description', 'LIKE', '%'.$term.'%')
            ->orWhere('ack', 'LIKE', '%'.$term.'%')
            ->orWhereIn('mfr_id', $mfrIn)
            ->get();

        $assets->load('mfr', 'location', 'activeCheckout.dealer', 'activeCheckout.dealer.dealership');

        return view('frontend.assets.samples', compact('assets'));
    }

    public function create()
    {
        return view('frontend.assets.add');
    }

    /**
     * Create a new asset.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'part' => 'required|max:100',
            'mfr' => 'required|max:255',
            'ack' => 'max:255',
            'description' => 'required|max:255',
            'msrp' => 'numeric',
        ]);

        $asset = new Asset;

        if (! is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid().'.jpg';
            $img = Image::make($request->file('image'));
            $img->orientate();
            $img->save(public_path().'/uploads/original/'.$imageName);
            $img->fit(450, 600);
            $img->save(public_path().'/uploads/'.$imageName);

            $request->merge(['imageName' => $imageName]);
            $asset->image = $request->imageName;
        } else {
            $asset->image = 'asset-placeholder.png';
        }

        $asset->mfr_id = $this->mfrs->findOrCreate($request->mfr['name'])->id;

        $asset->part = $request->part;
        $asset->ack = $request->ack;
        $asset->description = $request->description;
        $asset->msrp = $request->msrp;

        $asset->save();

        Event::fire('audit.asset.create', [$asset]);

        return redirect()->action('Frontend\Asset\AssetController@show', [$asset->id]);
    }

    public function show($id)
    {
        $asset = $this->assets->find($id);

        $asset->assetLogs->load('user', 'checkout', 'checkout.dealer', 'checkout.dealer.dealership');

        return view('frontend.assets.show', compact('asset'));
    }

    public function locationModal($id)
    {
        $asset = $this->assets->find($id);

        return view('frontend.location.formModal', compact('asset'));
    }

    public function updateLocation($id, Request $request)
    {
        $location = $this->locations->findOrCreate($request->location['name']);

        $asset = $this->assets->find($id);

        $asset->location_id = $location->id;

        Event::fire('audit.asset.location.change', [$asset]);

        $asset->save();

        return redirect()->action('Frontend\Asset\AssetController@show', [$asset->id]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric',
            'part' => 'required|max:100',
            'mfr' => 'required|max:255',
            'description' => 'required|max:255',
            'ack' => 'max:255',
            'msrp' => 'numeric',
        ]);

        $asset = $this->assets->find($id);

        $asset->mfr_id = $this->mfrs->findOrCreate($request->mfr['name'])->id;

        if (! is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid().'.jpg';
            $img = Image::make($request->file('image'));
            $img->orientate();
            $img->save(public_path().'/uploads/original/'.$imageName);
            $img->fit(450, 600);
            $img->save(public_path().'/uploads/'.$imageName);

            $request->merge(['imageName' => $imageName]);
            $asset->image = $request->imageName;
        }

        $asset->part = $request->part;
        $asset->description = $request->description;
        $asset->msrp = $request->msrp;
        $asset->ack = $request->ack;

        Event::fire('audit.asset.edit', [$asset]);

        $asset->save();

//        return Redirect::route('frontend.assets.edit', array('asset' => $asset->id));
        return redirect()->action('Frontend\Asset\AssetController@show', [$asset->id]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getByRep($id)
    {
        $checkouts = Checkout::where('user_id', '=', $id)->where('returned_date', '=', null)->get();
        $assetsIn = [];
        foreach ($checkouts as $checkout) {
            $assetsIn[] = $checkout->asset_id;
        }

        $assets = Asset::whereIn('id', $assetsIn)->get();

        $assets->load('mfr', 'location', 'activeCheckout.dealer', 'activeCheckout.dealer.dealership');

        //        return view('frontend.user.dashboard');
        //            ->withUser(access()->user());

        return view('frontend.assets.samples', compact('assets'));
    }

    public function getMfrIdAttribute($value)
    {
        return 'wow - '.$value;
    }
}
