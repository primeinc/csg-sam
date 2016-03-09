<?php
namespace App\Classes;

use App\Models\AssetLogs;
use Auth;
use DB;

class AuditLogHandler
{
    public function onUserLogout($user)
    {
        //thepsion5's ten second super-effective audit logging function
        $log = [
            'event'     => 'user.logout',
            'actor_id'  => $user->id,
            'actee_id'  => $user->id,
            'context'   => $user->toJson(),
        ];
        DB::table('log')->insert($log);
    }

//    /**
//     * Create a new AssetLogs instance.
//     *
//     * @param AssetLogs $log
//     */
//    public function __construct(AssetLogs $log)
//    {
//        $this->log = $log;
//    }

    public function handle($data)
    {
        dd($data);
    }

    public function onAssetCheckout($asset, $checkout)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user()->id;
        $log->checkout_id = $checkout->id;
        $log->event = 'audit.asset.checkout';

        $log->save();
    }

    public function onAssetCheckin($asset, $checkout)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user()->id;
        $log->checkout_id = $checkout->id;
        $log->event = 'audit.asset.checkin';

        $log->save();
    }
}
