<?php

namespace App\Http\Controllers\Frontend\Mfr;

use App\Http\Controllers\Frontend\Api\ApiController;
use App\Models\Mfr;
use App\Repositories\Frontend\Mfr\MfrContract;
use Illuminate\Http\Request;
use Response;

class MfrApiController extends ApiController
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

    public function search(Request $request)
    {
        $term = $request->q;
        $results = [];
        $queries = Mfr::where('name', 'LIKE', '%'.$term.'%')->get();
        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];
        foreach ($queries as $query) {
            $results['items'][] = ['id' => $query->id, 'text' => $query->name];
        }

        return Response::json($results);
    }
}
