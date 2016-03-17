<?php

namespace App\Http\Controllers\Frontend\Dealer;

use App\Http\Controllers\Frontend\Api\ApiController;
use App\Models\Dealer;
use App\Repositories\Frontend\Dealer\DealerContract;
use App\Repositories\Frontend\Dealership\DealershipContract;
use Response;
use Illuminate\Http\Request;

class DealerApiController extends ApiController
{
    /**
     * The asset repository instance.
     *
     * @var DealershipContract
     */
    protected $dealers;
    /**
     * @var DealershipContract
     */
    private $dealership;

    /**
     * Create a new controller instance.
     *
     * @param DealerContract     $dealers
     * @param DealershipContract $dealership
     */
    public function __construct(DealerContract $dealers, DealershipContract $dealership)
    {
        $this->middleware('auth');
        $this->dealers = $dealers;
        $this->dealership = $dealership;
    }

    public function search(Request $request)
    {
        $term = $request->q;
        $results = [];

        $dealershipList = $this->dealership->findByNameAll($term);
        $dealershipIn = [];
        foreach ($dealershipList as $dealership) {
            $dealershipIn[] = $dealership->id;
        }

        $queries = Dealer::where('name', 'LIKE', '%'.$term.'%')->orWhereIn('dealership_id', $dealershipIn)->with('user')->with('dealership')->get();

        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];
        foreach ($queries as $query) {
            $results['items'][] = [
                'id' => $query->id,
                'text' => $query->name.' @ '.$query->dealership->name,
                'user_id' => $query->user_id,
                'user_name' => $query->user->name,
            ];
        }

        return Response::json($results);
    }
}
