<?php
namespace App\Http\Controllers\Frontend\Location;

use App\DataTables\DealersDataTable;
use App\Models\Access\User\User;
use App\Models\Location;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Location\LocationContract;
use App\Repositories\Frontend\Dealership\DealershipContract;
use App\Repositories\Frontend\User\UserContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
        $results = array();
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
