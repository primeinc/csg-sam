<?php
namespace App\Classes;

use App\Models\AssetLogs;
use Auth;
use DB;

class AuditLogHandler
{

    public function handle($data)
    {
        dd($data);
    }

    public function onAssetCheckout($asset, $checkout)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user() ? Auth::user()->id : $checkout->user_id;
        $log->checkout_id = $checkout->id;
        $log->event = 'audit.asset.checkout';
        $log->context = $checkout->toJson();
        $log->created_at = $checkout->created_at;
        $log->updated_at = $checkout->updated_at;

        $log->save();
    }

    public function onAssetCheckin($asset, $checkout)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user() ? Auth::user()->id : $checkout->user_id;
        $log->checkout_id = $checkout->id;
        $log->event = 'audit.asset.checkin';
        $log->context = $this->getChanges($checkout);

        $log->save();
    }

    public function onAssetCreate($asset)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user() ? Auth::user()->id : 1;
        $log->event = 'audit.asset.create';
        $log->context = $asset->toJson();
        $log->created_at = $asset->created_at;

        $log->save();
    }

    public function onAssetEdit($asset)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user() ? Auth::user()->id : 1;
        $log->event = 'audit.asset.edit';
        $log->context = $this->getChanges($asset);

        $log->save();
    }

    public function onAssetLocationChange($asset)
    {
        $log = new AssetLogs;

        $log->asset_id = $asset->id;
        $log->user_id = Auth::user() ? Auth::user()->id : 1;
        $log->event = 'audit.asset.location.change';
        $log->context = $this->getChanges($asset);

        $log->save();
    }

    public function getChanges($model)
    {
        $changes = array();
        foreach($model->getDirty() as $key => $value){
            $original = $model->getOriginal($key);
            $changes[$key] = [
                'old' => $original,
                'new' => $value,
            ];
        }

        return json_encode($changes);
    }
}
