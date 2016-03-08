<?php

namespace App\Http\Controllers\Frontend\Dealer;

use App\DataTables\DealersDataTable;
use App\Models\Access\User\User;
use App\Models\Dealer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Dealer\DealerContract;
use App\Repositories\Frontend\User\UserContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Response;

class DealerController extends Controller
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

    public function add(Request $request)
    {
        return view('frontend.dealers.add');
    }

    /**
     * Create a new asset.
     *
     * @param UserContract $user
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserContract $user, Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|max:100',
            'employee_name' => 'required|max:255',
            'user_id' => 'numeric',
        ]);

        $dealer = new Dealer();

        $dealer->company_name = $request->company_name;
        $dealer->employee_name = $request->employee_name;
        $dealer->user_id = $user->find($request->user_id)->id;

        $dealer->save();

        return redirect('/dealers');
    }

    public function index(DealersDataTable $dataTable)
    {
        return $dataTable->render('frontend.dealers.index');
    }

    public function search(Request $request)
    {
        $term = $request->q;

        $results = array();

        $queries = Dealer::where('employee_name', 'LIKE', '%'.$term.'%')
            ->orWhere('company_name', 'LIKE', '%'.$term.'%')
            ->with('user')
            ->get();

        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];

        foreach ($queries as $query)
        {
            $results['items'][] = [ 'id' => $query->id,
                'text' => $query->company_name . ' - ' . $query->employee_name,
                'user_id' => $query->user_id,
                'user_name' => $query->user->name
            ];
        }
        return Response::json($results);
    }
}