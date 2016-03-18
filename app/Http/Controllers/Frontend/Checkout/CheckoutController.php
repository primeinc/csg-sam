<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Models\Checkout;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Asset\AssetContract;
use App\Repositories\Frontend\Checkout\CheckoutContract;
use Carbon\Carbon;
use Event;
use Illuminate\Http\Request;
use Redirect;
use Snowfire\Beautymail\Beautymail;

class CheckoutController extends Controller
{
    /**
     * The checkout repository instance.
     *
     * @var CheckoutContract
     */
    protected $checkout;

    /**
     * The asset repository instance.
     *
     * @var AssetContract
     */
    protected $asset;

    /**
     * Create a new controller instance.
     *
     * @param CheckoutContract $checkout
     * @param AssetContract $asset
     * @internal param CheckoutContract $checkouts
     */
    public function __construct(CheckoutContract $checkout, AssetContract $asset)
    {
        $this->middleware('auth');

        $this->checkout = $checkout;
        $this->asset = $asset;
    }

    public function index(Request $request)
    {
        $asset = $this->asset->find($request->asset);

        return view('frontend.checkout.index', compact('asset'));
    }

    public function checkoutModal(Request $request)
    {
        $asset = $this->asset->find($request->asset);

        return view('frontend.checkout.checkoutModal', compact('asset'));
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
        // TODO: validate asset is not already checked out

        $this->validate($request, [
            'daterange' => 'required|max:10',
            'dealer_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'project' => 'max:255',
        ]);

        $dt = \Carbon\Carbon::createFromFormat('m/d/Y', $request->daterange)->toDateString();

        // TODO: move this to an event
        $asset = $this->asset->find($request->asset);
        $asset->update([
            'status' => '2',
            'location_id' => '1',
        ]);

        $checkout = new Checkout;

        $checkout->expected_return_date = $dt;
        $checkout->asset_id = $request->asset;
        $checkout->dealer_id = $request->dealer_id;
        $checkout->user_id = $request->user_id;
        $checkout->project = $request->project;

        if ($request->permanent == 'on') {
            $checkout->permanent = 1;
        }

        $checkout->save();
        $asset->save();

        Event::fire('audit.asset.checkout', [$asset, $checkout]);

        return Redirect::route('samples.show', ['id' => $asset->id]);
    }

    public function checkinModal(Request $request)
    {
        $asset = $this->asset->find($request->asset);

        return view('frontend.checkout.checkinModal', compact('asset'));
    }

    public function returnAsset(Request $request)
    {
        $this->validate($request, [
            'notes' => 'max:255',
        ]);

        // TODO: move this to an event
        $asset = $this->asset->find($request->asset);
        $asset->update([
            'status' => '1',
            'location_id' => '1',
        ]);

        $checkout = Checkout::where('asset_id', '=', $request->asset)->where('returned_date', '=', null)->first();

        $checkout->returned_date = Carbon::now()->toDateString();
        $checkout->notes = $request->notes;

        Event::fire('audit.asset.checkin', [$asset, $checkout]);

        $checkout->save();
        $asset->save();

        return Redirect::route('samples.show', ['id' => $asset->id]);
    }

    public function sendReminder($id)
    {
        $checkout = Checkout::find($id);

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.reminder', compact('checkout'), function ($message) use ($checkout) {
            $message
                ->from(auth()->user()->email, auth()->user()->name)
                ->to($checkout->dealer->email, $checkout->dealer->name) // TODO add a debug version
                ->cc(auth()->user()->email, auth()->user()->name)
                ->subject('Sample #' . $checkout->asset->id . ' Overdue');
        });

        Event::fire('audit.asset.checkout.reminder', $checkout);

        return redirect()->back()->withFlashSuccess('The reminder was successfully sent.');
    }
}
