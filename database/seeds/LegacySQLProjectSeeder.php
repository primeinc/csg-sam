<?php
use App\Models\AssetLogs;
use App\Models\Checkout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegacySQLProjectSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        try {
            Schema::drop('assets_old');
            Schema::drop('checkin_old');
            Schema::drop('emailtemplates_old');
            Schema::drop('reserved_old');
            Schema::drop('signout_old');
            Schema::drop('users_old');
        } catch (Exception $e) {
        }
        DB::unprepared(file_get_contents(storage_path('app/thecsg_assets_old.sql')));
        DB::statement('DELETE t1 FROM signout_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NULL');
        DB::statement('SELECT t1.* FROM signout_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NOT NULL ORDER BY id ASC');
        $oldSignouts = DB::table('signout_old')->get();
        foreach ($oldSignouts as $oldSignout) {
            $checkout = Checkout::where('asset_id', '=', $oldSignout->csgid)->where('returned_date', '=', null)->get();
            if ($checkout = $checkout->first()) {
                $oldAssets         = DB::table('assets_old')->where('csgid', '=', $oldSignout->csgid)->get();
                $checkout->project = $oldAssets[0]->location;
                $assetLog          = AssetLogs::where('asset_id', '=', $oldSignout->csgid)->where('event', '=',
                    'audit.asset.checkout')->orderBy('id', 'desc')->limit(1)->get()->first();
                $context           = $assetLog->context;
                $context->project  = $oldAssets[0]->location;
                $assetLog->context = json_encode($context);
                $checkout->save();
                $assetLog->save();
                unset($assetLog);
                unset($oldAssets);
            }
        }
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        try {
            Schema::drop('assets_old');
            Schema::drop('checkin_old');
            Schema::drop('emailtemplates_old');
            Schema::drop('reserved_old');
            Schema::drop('signout_old');
            Schema::drop('users_old');
        } catch (Exception $e) {
        }
    }
}
