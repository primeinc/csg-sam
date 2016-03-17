<?php

namespace App\Http\Controllers\Frontend\Mfr;

use App\DataTables\MfrsDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Mfr\MfrContract;

class DataTablesController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var MfrContract
     */
    protected $mfrs;

    /**
     * Create a new controller instance.
     *
     * @param MfrContract $mfrs
     */
    public function __construct(MfrContract $mfrs)
    {
        $this->middleware('auth');
        $this->mfrs = $mfrs;
    }

    public function index(MfrsDataTable $dataTable)
    {
        return $dataTable->render('frontend.mfrs.dtList');
    }
}
