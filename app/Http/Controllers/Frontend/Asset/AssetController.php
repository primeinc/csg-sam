<?php

namespace App\Http\Controllers\Frontend\Asset;

use App\Models\Asset;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Asset\AssetContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AssetController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var AssetContract
     */
    protected $assets;

    /**
     * Create a new controller instance.
     *
     * @param  AssetContract $assets
     */
    public function __construct(AssetContract $assets)
    {
        $this->middleware('auth');

        $this->assets = $assets;
    }


    public function index() {
//        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->with('Checkouts')->get();
//        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();
        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();

        return view('frontend.assets.samples', compact('assets'));
    }

    public function add(Request $request)
    {
        return view('frontend.assets.add');
    }

    /**
     * Create a new asset.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'part' => 'required|max:100',
            'description' => 'required|max:255',
            'msrp' => 'numeric',
        ]);

        if (!is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(300, 200)->save(public_path() . '/uploads/' . $imageName);
            $request->merge(['imageName' => $imageName] );
        }
        else
            $request->merge(['imageName' => 'asset-placeholder.png'] );


        Asset::create([
            'part' => $request->part,
            'mfr_id' => 2,
            'description' => $request->description,
            'msrp' => $request->msrp,
            'image' => $request->imageName,
        ]);

        return redirect('/samples');
    }
}
