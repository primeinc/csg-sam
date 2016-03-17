<?php

namespace App\Http\Controllers\Frontend\Dealer;

use App\DataTables\DealersDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Dealer\DealerContract;

class DataTablesController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var DealerContract
     */
    protected $dealers;

    /**
     * Create a new controller instance.
     *
     * @param  DealerContract $dealers
     */
    public function __construct(DealerContract $dealers)
    {
        $this->middleware('auth');
        $this->dealers = $dealers;
    }

    public function index(DealersDataTable $dataTable)
    {
        return $dataTable->render('frontend.dealers.dtList');
    }
}
