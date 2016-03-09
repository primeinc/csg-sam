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
use Event;
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

        return view('frontend.checkout.index', compact('asset'));
    }

    public function checkoutModal(Request $request) {
        $asset = $this->asset->find($request->asset);

        return view('frontend.checkout.checkoutModal', compact('asset'));
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
        // TODO: validate asset is not already checked out

        $this->validate($request, [
            'daterange' => 'required|max:10',
            'dealer' => 'required|numeric',
            'rep' => 'required|numeric',
            'notes' => 'max:255',
        ]);

        $dt = \Carbon\Carbon::createFromFormat('m/d/Y',$request->daterange)->toDateString();

        $checkout = new Checkout;

        $checkout->expected_return_date = $dt;
        $checkout->asset_id = $request->asset;
        $checkout->dealer_id = $request->dealer;
        $checkout->user_id = $request->rep;
        $checkout->notes = $request->notes;
        $checkout->save();

        // TODO: move this to an event
        $asset = $this->asset->find($request->asset);
        $asset->update([
            'status' => '2'
        ]);

        Event::fire('audit.asset.checkout', [$asset, $checkout]);

        return Redirect::route('frontend.assets.edit', array('asset' => $request->asset));
    }

    public function checkinModal(Request $request) {
        $asset = $this->asset->find($request->asset);

        return view('frontend.checkout.checkinModal', compact('asset'));
    }

    public function returnAsset(Request $request) {

        $this->validate($request, [
            'notes' => 'max:255',
        ]);

        $checkout = Checkout::where('asset_id', '=', $request->asset)->where('returned_date', '=', null)->first();

        $checkout->returned_date = Carbon::now()->toDateString();
        $checkout->notes = $checkout->notes . '\n' . $request->notes;

        $checkout->save();

        // TODO: move this to an event
        $asset = $this->asset->find($request->asset);
        $asset->update([
            'status' => '1'
        ]);

        Event::fire('audit.asset.checkin', [$asset, $checkout]);

        return Redirect::route('frontend.assets.edit', array('asset' => $request->asset));
    }
}
