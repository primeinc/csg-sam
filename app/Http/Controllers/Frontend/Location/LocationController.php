<?php

namespace App\Http\Controllers\Frontend\Location;

use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Location\LocationContract;
use Response;

class LocationController extends Controller
{
    protected $locations;

    public function __construct(LocationContract $locations)
    {
        $this->middleware('auth');
        $this->locations = $locations;
    }

    public function searchAll()
    {
        $results = [];
        $queries = Location::get();

        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];

        foreach ($queries as $query) {
            $results['items'][] = ['id' => $query->name, 'text' => $query->name];
        }

        return Response::json($results);
    }
}
