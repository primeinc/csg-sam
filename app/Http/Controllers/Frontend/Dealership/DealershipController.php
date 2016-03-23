<?php

namespace App\Http\Controllers\Frontend\Dealership;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Dealership;
use App\Repositories\Frontend\Dealership\DealershipContract;
use DB;

class DealershipController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var DealershipContract
     */
    protected $dealerships;

    /**
     * Create a new controller instance.
     *
     * @param  DealershipContract $dealerships
     */
    public function __construct(DealershipContract $dealerships)
    {
        $this->middleware('auth');
        $this->dealerships = $dealerships;
    }

    public function add()
    {
        return view('frontend.dealerships.add');
    }

    public function edit($id)
    {
        $dealership = $this->dealerships->find($id);

        return view('frontend.dealerships.edit', compact('dealership'));
    }

    public function update($id, Request $request)
    {
        try {
            $dealership = $this->dealerships->find($id);
            $dealershipReq = Dealership::find($request->name);
        } catch (Exception $e) {
            \Log::error('An unknown error occured, E-001-Database DealershipController@update');
            return redirect('/dealerships/list')->withFlashDanger('An unknown error occured, E-001-Database DealershipController@update');
        }
        if ($dealershipReq) {
            $change = DB::table('dealers')
                ->where('dealership_id', $id)
                ->update(['dealership_id' => $dealershipReq->id]);
            if($change)
                $dealership->delete();
            else {
                \Log::error('An unknown error occured, E-002-Database DealershipController@update');
                return redirect('/dealerships/list')->withFlashDanger('An unknown error occured, E-002-Database DealershipController@update');
            }

            return redirect('/dealerships/list')->withFlashSuccess('Dealership successfully merged');
        }

        $dealership->name = $request->name;
        $dealership->save();

        return redirect('/dealerships/list')->withFlashSuccess('Dealership successfully edited');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->dealerships->destroy($id);

        return redirect()->back()->withFlashSuccess('Dealership was successfully deleted.');
    }
}
