<?php
namespace App\Http\Controllers\Frontend\Api;

use App;
use App\Http\Controllers\Controller;
use Response;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAll($model)
    {
        $model     = ucfirst(rtrim($model, "s"));
        $classPath = "App\\Models\\";
        if ($model == 'User') {
            $classPath .=  "Access\\User\\";
        }
        $newModel                      = App::make($classPath . $model);
        $results                       = [];
        $queries                       = $newModel::get();
        $results['total_count']        = $queries->count();
        $results['incomplete_results'] = false;
        $results['items']              = [];
        foreach ($queries as $query) {
            $results['items'][] = ['id' => $query->id, 'text' => $query->name];
        }

        return Response::json($results);
    }


}
