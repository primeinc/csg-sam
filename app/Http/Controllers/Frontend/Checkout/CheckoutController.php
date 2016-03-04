<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Models\Checkout;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Checkout\CheckoutContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CheckoutController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var CheckoutContract
     */
    protected $checkouts;

    /**
     * Create a new controller instance.
     *
     * @param  CheckoutContract $checkouts
     */
    public function __construct(CheckoutContract $checkouts)
    {
        $this->middleware('auth');

        $this->checkouts = $checkouts;
    }


    public function index() {
//        $checkouts = Checkout::orderBy('created_at', 'desc')->with('Mfr')->with('Checkouts')->get();
//        $checkouts = Checkout::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();
        $checkouts = Checkout::orderBy('created_at', 'desc')->with('Mfr')->with('activeCheckout')->get();

        return view('frontend.checkouts.samples', compact('checkouts'));
    }

    public function add(Request $request)
    {
        return view('frontend.checkouts.add');
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


        Checkout::create([
            'part' => $request->part,
            'mfr_id' => 2,
            'description' => $request->description,
            'msrp' => $request->msrp,
            'image' => $request->imageName,
        ]);

        return redirect('/samples');
    }
}
