<?php
namespace App\Http\Controllers\Frontend\Dealership;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\Frontend\Dealership\DealershipContract;

class DealershipController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var DealershipContract
     */
    protected $dealerships;

    /**
     * Create a new controller instance.
     *
     * @param  DealershipContract $dealerships
     */
    public function __construct(DealershipContract $dealerships)
    {
        $this->middleware('auth');
        $this->dealerships = $dealerships;
    }

    public function add()
    {
        return view('frontend.dealerships.add');
    }
}
