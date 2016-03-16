<?php
namespace App\Http\Controllers\Frontend\Dealership;

use App\DataTables\DealershipsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\Frontend\Dealership\DealershipContract;

class DataTablesController extends Controller
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

    public function index(DealershipsDataTable $dataTable)
    {
        return $dataTable->render('frontend.dealerships.dtList');
    }
}
