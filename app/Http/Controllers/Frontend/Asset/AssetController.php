<?php

namespace App\Http\Controllers\Frontend\Asset;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Asset;
use App\Repositories\Frontend\Asset\AssetContract;
use App\Repositories\Frontend\Location\LocationContract;
use App\Repositories\Frontend\Mfr\MfrContract;
use Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Intervention\Image\Facades\Image;
use Redirect;

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

    public function index() {
        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->get();

        $assets->load('activeCheckout.dealer', 'activeCheckout.dealer.dealership');
        $assets->load('location');

        return view('frontend.assets.samples', compact('assets'));
    }

    public function search(Request $request) {
//        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();
        $term = $request->q;

        $mfrList = $this->mfrs->findByNameAll($term);
        $mfrIn = array();
        foreach ($mfrList as $mfr){
            $mfrIn[] = $mfr->id;
        }

        $assets = Asset::where('id', 'LIKE', '%'.$term.'%')
            ->orWhere('part', 'LIKE', '%'.$term.'%')
            ->orWhere('description', 'LIKE', '%'.$term.'%')
            ->orWhere('ack', 'LIKE', '%'.$term.'%')
            ->orWhereIn('mfr_id', $mfrIn)
            ->get();

        $assets->load('Mfr', 'Location');

        $assets->load('activeCheckout.dealer', 'activeCheckout.dealer.dealership');

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

        if (!is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->orientate()->resize(300, 200)->save(public_path() . '/uploads/' . $imageName);
            $request->merge(['imageName' => $imageName] );
        }
        else
            $request->merge(['imageName' => 'asset-placeholder.png'] );

        $mfr = $this->mfrs->findOrCreate($request->mfr['name']);

        $asset = new Asset;
        $asset->part = $request->part;
        $asset->ack = $request->ack;
        $asset->mfr_id = $mfr->id;
        $asset->description = $request->description;
        $asset->msrp = $request->msrp;
        $asset->image = $request->imageName;

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
        $mfr = $this->mfrs->findOrCreate($request->mfr['name']);

        if (!is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->orientate()->resize(300, 200)->save(public_path() . '/uploads/' . $imageName);

            $request->merge(['imageName' => $imageName] );
            $asset->image = $request->imageName;
        }

        $asset->part = $request->part;
        $asset->mfr_id = $mfr->id;
        $asset->description = $request->description;
        $asset->msrp = $request->msrp;
        $asset->ack = $request->ack;

        Event::fire('audit.asset.edit', [$asset]);

        $asset->save();

//        return Redirect::route('frontend.assets.edit', array('asset' => $asset->id));
        return redirect()->action('Frontend\Asset\AssetController@show', [$asset->id]);
    }

    public function getMfrIdAttribute($value)
    {
        return 'wow - ' . $value;
    }
}
