<?php

namespace App\Http\Controllers\Frontend\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Checkout;
use App\Models\Dealer;
use App\Repositories\Frontend\Dealer\DealerContract;
use App\Repositories\Frontend\Dealership\DealershipContract;
use App\Repositories\Frontend\User\UserContract;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * The asset repository instance.
     *
     * @var DealerContract
     */
    protected $dealers;
    protected $dealership;

    /**
     * Create a new controller instance.
     *
     * @param  DealerContract    $dealers
     * @param DealershipContract $dealership
     */
    public function __construct(DealerContract $dealers, DealershipContract $dealership)
    {
        $this->middleware('auth');
        $this->dealers = $dealers;
        $this->dealership = $dealership;
    }

    public function show($id)
    {
        $checkouts = Checkout::where('dealer_id', '=', $id)->where('returned_date', '=', null)->get();
        $assetsIn = [];
        foreach ($checkouts as $checkout) {
            $assetsIn[] = $checkout->asset_id;
        }

        $assets = Asset::whereIn('id', $assetsIn)->get();

        return view('frontend.assets.samples', compact('assets'));
    }

    public function create()
    {
        return view('frontend.dealers.create');
    }

    public function edit($id)
    {
        $dealer = $this->dealers->find($id);

        return view('frontend.dealers.edit', compact('dealer'));
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->dealers->destroy($id);

        return redirect()->back()->withFlashSuccess('The DSR was successfully deleted.');
    }

    /**
     * Create a new asset.
     *
     * @param UserContract $user
     * @param  Request     $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserContract $user, Request $request)
    {
        $this->validate($request, [
            'dealership.*.name' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'user.*.id' => 'numeric',
        ]);
        $dealer = new Dealer();
        $dealer->dealership_id = $this->dealership->findOrCreate($request->dealership['name'])->id;
        $dealer->name = $request->name;
        $dealer->email = $request->email;
        $dealer->user_id = $user->find($request->user['id'])->id;
        $dealer->save();

        return redirect('/dealers/list')->withFlashSuccess('DSR successfully created');
    }

    public function update($id, UserContract $user, Request $request)
    {
        $this->validate($request, [
            'dealership.*.name' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'user.*.id' => 'numeric',
        ]);
        $dealer = $this->dealers->find($id);
        $dealer->dealership_id = $this->dealership->findOrCreate($request->dealership['name'])->id;
        $dealer->name = $request->name;
        $dealer->email = $request->email;
        $dealer->user_id = $user->find($request->user['id'])->id;
        $dealer->save();

        return redirect('/dealers/list')->withFlashSuccess('DSR successfully edited');
    }
}
