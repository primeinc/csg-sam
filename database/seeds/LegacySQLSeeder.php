<?php
use App\Classes\AuditLogHandler;
use App\Models\Asset;
use App\Models\AssetLogs;
use App\Models\Checkout;
use App\Repositories\Backend\Role\EloquentRoleRepository;
use App\Repositories\Frontend\Dealer\EloquentDealerRepository;
use App\Repositories\Frontend\Dealership\EloquentDealershipRepository;
use App\Repositories\Frontend\Mfr\EloquentMfrRepository;
use App\Repositories\Frontend\User\EloquentUserRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegacySQLSeeder extends Seeder
{
    public function run() {

        $log = new AuditLogHandler;

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
        }
        catch (Exception $e) {
        }

        DB::unprepared(file_get_contents(storage_path('app/thecsg_assets_old.sql')));

        $oldAssets = DB::table('assets_old')->get();

        foreach ($oldAssets as $oldAsset){
            if($oldAsset->status == 'Available')
                $oldAsset->status = 1;
            elseif($oldAsset->status == "Checked Out")
                $oldAsset->status = 2;
            if($oldAsset->filename == 'placeholder.png')
                $imageName = 'asset-placeholder.png';
            else {
                $imageName = uniqid() . '.jpg';
                try {
                    $img = Image::make('http://samples.csgreps.com/pics/' . $oldAsset->filename);
                    $img->orientate()->fit(450, 600);
                    $img->save(public_path() . '/uploads/' . $imageName);
                } catch (Exception $e) {
                    $imageName = 'asset-placeholder.png';
                }
            }
            $oldAsset->ack = "";
            preg_match("/(.*)\s([SOso]+#)\s?(.*)/i", $oldAsset->company, $cleanCompany);
            if(is_array($cleanCompany) && !empty($cleanCompany)) {
                $oldAsset->company = $cleanCompany[1];
                $oldAsset->ack = $cleanCompany[3];
            }

            $mfrs = new EloquentMfrRepository;
            $mfr = $mfrs->findOrCreate($oldAsset->company);

            $assets = [
                    'id'                => $oldAsset->csgid,
                    'mfr_id'            => $mfr->id,
                    'part'              => $oldAsset->part,
                    'description'       => $oldAsset->description,
                    'ack'               => $oldAsset->ack,
                    'msrp'              => $oldAsset->msrp,
                    'image'             => $imageName,
//                    'status'            => $oldAsset->status,
                    'status'            => 1,
                    'notes'             => $oldAsset->location,
                    'created_at'        => $oldAsset->created,
                    'updated_at'        => $oldAsset->created,
                ];

            DB::table('assets')->insert($assets);

            $log->onAssetCreate(Asset::find($oldAsset->csgid));
        }

        $locations = [
            [
                'id'                => 1,
                'name'              => 'Undetermined/Default',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => 2,
                'name'              => 'Missing/Lost',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => 3,
                'name'              => 'West Side Storage',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => 4,
                'name'              => 'East Side Storage',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => 5,
                'name'              => 'Redi Installations Inc',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('locations')->insert($locations);

        $dealerships = [
            'id'                => 1,
            'name'              => 'Unknown Dealership',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        DB::table('dealerships')->insert($dealerships);

        $dealers = [
                'id'                => 1,
                'user_id'           => 1,
                'dealership_id'     => 1,
                'name'     => 'Unknown DSR',
                'email'             => 'unknown@csgreps.com',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];

        DB::table('dealers')->insert($dealers);

        $oldDealers = DB::table('users_old')
            ->where('email', 'NOT LIKE' , '%csgreps.com%')
            ->where('company', 'NOT LIKE' , '%google%')
            ->where('company', 'NOT LIKE' , '%Yaho%')
            ->where('company', 'NOT LIKE' , '%Lovecats%')
            ->where('company', 'NOT LIKE' , '%rZNEIKcXFtCrPJFmyqe%')
            ->where('company', 'NOT LIKE' , '%TPmOizpvnk%')
            ->get();

        foreach ($oldDealers as $oldDealer){
            //TODO change username

            $dealerships = new EloquentDealershipRepository;
            $dealership = $dealerships->findOrCreate($oldDealer->company);

            $dealers = [
                    'user_id'           => 1,
                    'dealership_id'     => $dealership->id,
                    'name'     => $oldDealer->fullname,
                    'email'             => $oldDealer->username,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ];

            DB::table('dealers')->insert($dealers);
        }

        $oldUsers = DB::table('users_old')
            ->where('email', 'LIKE' , '%@csgreps.com%')
            ->get();

        foreach ($oldUsers as $oldUser){
            //TODO change username
            $users = [
                'name'              => $oldUser->fullname,
                'email'             => $oldUser->username,
                'status'            => 1,
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
            $insertID  = DB::table(config('access.users_table'))->insertGetId($users);
            $user_model = config('auth.providers.users.model');
            $user_model = new $user_model;
            $user_model::find($insertID)->attachRole(2);
        }

        echo 'starting old checkins';

        DB::statement('DELETE t1 FROM checkin_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NULL');
        DB::statement('SELECT t1.* FROM checkin_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NOT NULL ORDER BY id ASC');

        $oldCheckins = DB::table('checkin_old')->get();

        foreach ($oldCheckins as $oldCheckin){
            $userID = 1;
            $dealers = new EloquentDealerRepository();
            $dealer = $dealers->findByEmail($oldCheckin->username);
            $asset = Asset::find($oldCheckin->csgid);
            if(!$dealer){
                $dealer = $dealers->findByEmail('unknown@csgreps.com');

                $user_model = new EloquentUserRepository(new EloquentRoleRepository());
                $user = $user_model->findByEmail($oldCheckin->username);
                if($user) {
                    $userID = $user->id;
                    if($oldCheckin->username == 'info@csgreps.com') {
                        // West Side Storage
                        $asset->location_id = 3;
                        // log storage change
                        $manualLog = new AssetLogs;
                        $manualLog->asset_id = $asset->id;
                        $manualLog->user_id = 1;
                        $manualLog->event = 'audit.asset.location.change';
                        $manualLog->context = $log->getChanges($asset);
                        $manualLog->created_at = $oldCheckin->date;
                        $manualLog->updated_at = $oldCheckin->date;
                        $manualLog->save();
                        // log storage change
                        continue;
                    }
                    elseif($oldCheckin->username == 'jack@csgreps.com') {
                        // East Side Storage
                        $asset->location_id = 4;
                        // log storage change
                        $manualLog = new AssetLogs;
                        $manualLog->asset_id = $asset->id;
                        $manualLog->user_id = 1;
                        $manualLog->event = 'audit.asset.location.change';
                        $manualLog->context = $log->getChanges($asset);
                        $manualLog->created_at = $oldCheckin->date;
                        $manualLog->updated_at = $oldCheckin->date;
                        $manualLog->save();
                        // log storage change
                        continue;
                    }
                    elseif($oldCheckin->username == 'voicemail@csgreps.com') {
                        // Missing / Lost
                        $asset->location_id = 2;
                        // log storage change
                        $manualLog = new AssetLogs;
                        $manualLog->asset_id = $asset->id;
                        $manualLog->user_id = 1;
                        $manualLog->event = 'audit.asset.location.change';
                        $manualLog->context = $log->getChanges($asset);
                        $manualLog->created_at = $oldCheckin->date;
                        $manualLog->updated_at = $oldCheckin->date;
                        $manualLog->save();
                        // log storage change
                        continue;
                    }
                }
            }

            $asset->location_id = 1;
            $asset->save();

            $checkins = [
                    'asset_id'               => $oldCheckin->csgid,
                    'user_id'                => $userID,
                    'dealer_id'              => $dealer->id,
                    'notes'                  => $oldCheckin->location,
                    'expected_return_date'   => $oldCheckin->returndate,
                    'returned_date'          => $oldCheckin->returndate,
                    'created_at'             => $oldCheckin->date,
                    'updated_at'             => $oldCheckin->date,
                ];

            $insertID  = DB::table('checkouts')->insertGetId($checkins);

            $log->onAssetCheckout(Asset::find($oldCheckin->csgid), Checkout::find($insertID));

            $manualLog = new AssetLogs;

            $manualLog->asset_id = $oldCheckin->csgid;
            $manualLog->user_id = $userID;
            $manualLog->checkout_id = $insertID;
            $manualLog->event = 'audit.asset.checkin';
            $manualLog->context = '{}';
            $manualLog->created_at = $oldCheckin->returndate;
            $manualLog->updated_at = $oldCheckin->returndate;

            $manualLog->save();
        }

        echo 'starting curent signouts';

        DB::statement('DELETE t1 FROM signout_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NULL');
        DB::statement('SELECT t1.* FROM signout_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NOT NULL ORDER BY id ASC');

        $oldSignouts = DB::table('signout_old')->get();

        foreach ($oldSignouts as $oldSignout){
            $userID = 1;
            $dealers = new EloquentDealerRepository();
            $dealer = $dealers->findByEmail($oldSignout->username);
            $asset = Asset::find($oldSignout->csgid);
            if(!$dealer){
                $dealer = $dealers->findByEmail('unknown@csgreps.com');

                $user_model = new EloquentUserRepository(new EloquentRoleRepository());
                $user = $user_model->findByEmail($oldSignout->username);
                if($user) {
                    $userID = $user->id;
                    if($oldSignout->username == 'info@csgreps.com') {
                        // West Side Storage
                        $asset->location_id = 3;
                        // log storage change
                        $manualLog = new AssetLogs;
                        $manualLog->asset_id = $asset->id;
                        $manualLog->user_id = 1;
                        $manualLog->event = 'audit.asset.location.change';
                        $manualLog->context = $log->getChanges($asset);
                        $manualLog->created_at = $oldSignout->date;
                        $manualLog->updated_at = $oldSignout->date;
                        $manualLog->save();
                        // log storage change
                        $asset->save();
                        continue;
                        // add logging
                    }
                    elseif($oldSignout->username == 'jack@csgreps.com') {
                        // East Side Storage
                        $asset->location_id = 4;
                        // log storage change
                        $manualLog = new AssetLogs;
                        $manualLog->asset_id = $asset->id;
                        $manualLog->user_id = 1;
                        $manualLog->event = 'audit.asset.location.change';
                        $manualLog->context = $log->getChanges($asset);
                        $manualLog->created_at = $oldSignout->date;
                        $manualLog->updated_at = $oldSignout->date;
                        $manualLog->save();
                        // log storage change
                        $asset->save();
                        continue;
                    }
                    elseif($oldSignout->username == 'voicemail@csgreps.com') {
                        // Missing / Lost
                        $asset->location_id = 2;
                        // log storage change
                        $manualLog = new AssetLogs;
                        $manualLog->asset_id = $asset->id;
                        $manualLog->user_id = 1;
                        $manualLog->event = 'audit.asset.location.change';
                        $manualLog->context = $log->getChanges($asset);
                        $manualLog->created_at = $oldSignout->date;
                        $manualLog->updated_at = $oldSignout->date;
                        $manualLog->save();
                        // log storage change
                        $asset->save();
                        continue;
                    }
                }
            }

            $checkins = [
                'asset_id'               => $oldSignout->csgid,
                'user_id'                => $userID,
                'dealer_id'              => $dealer->id,
                'notes'                  => $oldSignout->location,
                'expected_return_date'   => $oldSignout->returndate,
                'returned_date'          => null,
                'created_at'             => $oldSignout->date,
                'updated_at'             => $oldSignout->date,
            ];

            $insertID  = DB::table('checkouts')->insertGetId($checkins);

            $asset->status = 2; // checked-out
            $asset->save();

            $log->onAssetCheckout(Asset::find($oldSignout->csgid), Checkout::find($insertID));
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
