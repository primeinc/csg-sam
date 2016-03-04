<?php

namespace App\Http\Controllers\Frontend\Dealer;

use App\Models\Dealer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Dealer\DealerContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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


    public function index() {
//        $dealers = Dealer::orderBy('created_at', 'desc')->with('Mfr')->with('Checkouts')->get();
//        $dealers = Dealer::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();
        $dealers = Dealer::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();

        return view('frontend.dealers.samples', compact('dealers'));
    }

    public function add(Request $request)
    {
        return view('frontend.dealers.add');
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


        Dealer::create([
            'part' => $request->part,
            'mfr_id' => 2,
            'description' => $request->description,
            'msrp' => $request->msrp,
            'image' => $request->imageName,
        ]);

        return redirect('/samples');
    }
}
