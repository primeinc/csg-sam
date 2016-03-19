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
    private $page;

    public function __construct()
    {
        $this->page = app()->make('App\Classes\PageDisplayOptions');
    }

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

        $this->page->title = trans('menus.frontend.samples.mine');
        $this->page->breadcrumb = trans('menus.frontend.samples.mine');

        return view('frontend.assets.samples', compact('assets'))->with('page', $this->page);
    }
}
