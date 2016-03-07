<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Models\Checkout;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Repositories\Frontend\Asset\AssetContract;
use App\Repositories\Frontend\Checkout\CheckoutContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        dd($request);
        $this->validate($request, [
            'daterange' => 'required|max:10',
            'dealer' => 'numeric',
            'rep' => 'numeric',
        ]);

        Checkout::create([
            'daterange' => $request->daterange,
            'dealer' => $request->dealer,
            'rep' => $request->rep
        ]);

        return redirect('/samples');
    }
}
