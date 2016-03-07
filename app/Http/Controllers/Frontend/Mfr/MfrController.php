<?php

namespace App\Http\Controllers\Frontend\Mfr;

use App\DataTables\MfrsDataTable;
use App\Models\Mfr;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Mfr\MfrContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Response;

class MfrController extends Controller
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
     * @param  MfrContract $mfrs
     */
    public function __construct(MfrContract $mfrs)
    {
        $this->middleware('auth');

        $this->mfrs = $mfrs;
    }

    public function add(Request $request)
    {
        return view('frontend.mfrs.add');
    }

    /**
     * Create a new asset.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'part' => 'required|max:100',
            'description' => 'required|max:255',
            'msrp' => 'numeric',
        ]);

        if (!is_null($request->file('image')) && $request->file('image')->isValid()) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(300, 200)->save(public_path() . '/uploads/' . $imageName);
            $request->merge(['imageName' => $imageName] );
        }
        else
            $request->merge(['imageName' => 'asset-placeholder.png'] );


        Mfr::create([
            'part' => $request->part,
            'mfr_id' => 2,
            'description' => $request->description,
            'msrp' => $request->msrp,
            'image' => $request->imageName,
        ]);

        return redirect('/samples');
    }

    public function search(Request $request)
    {
        $term = $request->q;

        $results = array();

        $queries = Mfr::where('name', 'LIKE', '%'.$term.'%')->get();

        $results['total_count'] = $queries->count();
        $results['incomplete_results'] = false;
        $results['items'] = [];

        foreach ($queries as $query)
        {
//            $results['items'][] = [ 'id' => $query->id, 'text' => $query->name ];
            $results['items'][] = [ 'id' => $query->name, 'text' => $query->name ];
        }
        return Response::json($results);
    }

    public function index(MfrsDataTable $dataTable)
    {
        return $dataTable->render('frontend.mfrs.index');
    }
}
