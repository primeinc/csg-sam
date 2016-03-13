<?php

namespace App\Http\Controllers\Frontend\Dealership;

use App\DataTables\DealershipsDataTable;
use App\Models\Dealership;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Dealership\DealershipContract;
use Illuminate\Http\Request;
use Response;

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

    public function add(Request $request)
    {
        return view('frontend.dealerships.add');
    }

    public function search(Request $request)
    {
        $term = $request->q;

        $results = array();

//        $queries = Dealership::where('name', 'LIKE', '%'.$term.'%')->get();
        $queries = $this->dealerships->findByNameAll($term);

        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];

        foreach ($queries as $query)
        {
            $results['items'][] = [ 'id' => $query->id, 'text' => $query->name ];
        }
        return Response::json($results);
    }

    public function searchAll(Request $request)
    {
        $term = $request->q;

        $results = array();

        $queries = Dealership::get();

        //        $queries = $this->user->findByName($term);

        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];

        foreach ($queries as $query)
        {
            $results['items'][] = [ 'id' => $query->id, 'text' => $query->name ];
        }

        return Response::json($results);
    }

    public function index(DealershipsDataTable $dataTable)
    {
        return $dataTable->render('frontend.dealerships.index');
    }
}
