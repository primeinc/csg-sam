<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Models\Asset;
use App\Models\Checkout;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Repositories\Frontend\Asset\AssetContract;
use App\Repositories\Frontend\Checkout\CheckoutContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Redirect;

class CheckoutController extends Controller
{
    /**
     * The checkout repository instance.
     *
     * @var CheckoutContract
     */
    protected $checkout;

    /**
     * The asset repository instance.
     *
     * @var AssetContract
     */
    protected $asset;

    /**
     * Create a new controller instance.
     *
     * @param CheckoutContract $checkout
     * @param AssetContract $asset
     * @internal param CheckoutContract $checkouts
     */
    public function __construct(CheckoutContract $checkout, AssetContract $asset)
    {
        $this->middleware('auth');

        $this->checkout = $checkout;
        $this->asset = $asset;
    }


    public function index(Request $request) {
        $asset = $this->asset->find($request->asset);
//        $dealer = Dealer::select('id', 'employee_name')->get();

        return view('frontend.checkout.index', compact('asset'));
    }

    public function add(Request $request)
    {
        return view('frontend.checkouts.add');
    }

    /**
     * Create a new asset.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'daterange' => 'required|max:10',
            'dealer' => 'required|numeric',
            'rep' => 'required|numeric',
            'notes' => 'max:255',
        ]);

        $dt = \Carbon\Carbon::createFromFormat('m/d/Y',$request->daterange)->toDateString();

        Checkout::create([
            'expected_return_date' => $dt,
            'asset_id' => $request->asset,
            'dealer_id' => $request->dealer,
            'user_id' => $request->rep,
            'notes' => $request->notes
        ]);

        // TODO: move this to an event
        Asset::find($request->asset)->update([
           'status' => '2'
        ]);

        return Redirect::route('frontend.assets.edit', array('asset' => $request->asset));
    }
}
