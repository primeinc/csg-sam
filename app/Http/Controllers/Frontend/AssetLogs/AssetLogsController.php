<?php

namespace App\Http\Controllers\Frontend\AssetLogs;

use App\Models\AssetLogs;
use App\Http\Controllers\Controller;
use App\Models\Mfr;
use App\Repositories\Frontend\AssetLogs\AssetLogsContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AssetLogsController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var AssetLogsContract
     */
    protected $assetLogs;

    /**
     * Create a new controller instance.
     *
     * @param  AssetLogsContract $assetLogs
     */
    public function __construct(AssetLogsContract $assetLogs)
    {
        $this->middleware('auth');

        $this->assetLogs = $assetLogs;
    }

    public function index()
    {
        //        $assetLogs = AssetLogs::orderBy('created_at', 'desc')->with('Mfr')->with('Checkouts')->get();
//        $assetLogs = AssetLogs::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();
        $assetLogs = AssetLogs::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();

        return view('frontend.assetLogs.samples', compact('assetLogs'));
    }

    public function add(Request $request)
    {
        return view('frontend.assetLogs.add');
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

        if (! is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid().'.'.$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(300, 200)->save(public_path().'/uploads/'.$imageName);
            $request->merge(['imageName' => $imageName]);
        } else {
            $request->merge(['imageName' => 'asset-placeholder.png']);
        }

        $mfr = Mfr::findOrCreate($request->mfr);

        AssetLogs::create([
            'part' => $request->part,
            'mfr_id' => $mfr->id,
            'description' => $request->description,
            'msrp' => $request->msrp,
            'image' => $request->imageName,
        ]);

        return redirect('/samples');
    }
}
