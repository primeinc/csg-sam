<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Repositories\Frontend\User\UserContract;
use Illuminate\Http\Request;
use Response;

class SearchController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var UserContract
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param  UserContract $user
     */
    public function __construct(UserContract $user)
    {
        $this->middleware('auth');

        $this->user = $user;
    }

    public function search(Request $request)
    {
        $term = $request->q;

        $results = array();

        $queries = User::where('name', 'LIKE', '%'.$term.'%')->get();

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

    public function searchAll(Request $request)
    {
        $term = $request->q;

        $results = array();

        $queries = User::get();

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
}
