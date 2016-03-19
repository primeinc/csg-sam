<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\DataTables\CheckoutsDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Checkout\CheckoutContract;

class DataTablesController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var CheckoutContract
     */
    protected $checkouts;

    /**
     * Create a new controller instance.
     *
     * @param  CheckoutContract $checkouts
     */
    public function __construct(CheckoutContract $checkouts)
    {
        $this->middleware('auth');
        $this->checkouts = $checkouts;
    }

    public function index(CheckoutsDataTable $dataTable)
    {
        return $dataTable->render('frontend.checkout.dtList');
    }
}
