<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Checkout;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $checkouts = Checkout::where('user_id', '=', auth()->user()->id)->where('returned_date', '=', null)->get();
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
}
