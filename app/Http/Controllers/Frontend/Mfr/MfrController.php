<?php

namespace App\Http\Controllers\Frontend\Mfr;

use App\DataTables\MfrsDataTable;
use App\Exceptions\GeneralException;
use App\Models\Mfr;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Mfr\MfrContract;
use DB;
use Doctrine\DBAL\Query\QueryBuilder;
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

    public function edit($id)
    {
        $mfr = $this->mfrs->find($id);

        return view('frontend.mfrs.edit', compact('mfr'));
    }

    public function update($id, Request $request)
    {
        $mfr = $this->mfrs->find($id);
        $mfrReq = Mfr::find($request->name);
        if($mfrReq){
            DB::table('assets')
                ->where('mfr_id', $id)
                ->update(['mfr_id' => $mfrReq->id]);
            $mfr->delete();
            return redirect('/mfrs/list')->withFlashSuccess('Manufacturer successfully merged');
        }

        $mfr->name = $request->name;
        $mfr->save();

        return redirect('/mfrs/list')->withFlashSuccess('Manufacturer successfully edited');
    }

}
