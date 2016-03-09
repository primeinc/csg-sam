<?php
use App\Classes\AuditLogHandler;
use App\Models\Asset;
use App\Models\Checkout;
use App\Repositories\Frontend\Dealer\EloquentDealerRepository;
use App\Repositories\Frontend\Mfr\EloquentMfrRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegacySQLSeeder extends Seeder
{
    public function run() {

        $log = new AuditLogHandler;

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
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
                $imageName = uniqid() . '.png';
                try {
                    $img = Image::make('http://samples.csgreps.com/pics/' . $oldAsset->filename);
                    $img->resize(300, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    });
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
                    'status'            => $oldAsset->status,
                    'notes'             => $oldAsset->location,
                    'created_at'        => Carbon\Carbon::now(),
                    'updated_at'        => Carbon\Carbon::now(),
                ];

            DB::table('assets')->insert($assets);

            $log->onAssetCreate(Asset::find($oldAsset->csgid));
        }


        $dealers = [
                'user_id'           => 1,
                'company_name'      => 'Internal Dealer',
                'employee_name'     => 'Unknown Placeholder',
                'email'             => 'info@csgreps.com',
                'created_at'        => Carbon\Carbon::now(),
                'updated_at'        => Carbon\Carbon::now(),
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
            $dealers = [
                    'user_id'           => 1,
                    'company_name'      => $oldDealer->company,
                    'employee_name'     => $oldDealer->fullname,
                    'email'             => $oldDealer->username,
                    'created_at'        => Carbon\Carbon::now(),
                    'updated_at'        => Carbon\Carbon::now(),
                ];

            DB::table('dealers')->insert($dealers);
        }

        echo 'starting old checkins';

        DB::statement('SELECT t1.* FROM checkin_old t1 LEFT JOIN assets t2 ON t2.id = t1.csgid WHERE t2.id IS NOT NULL ORDER BY id ASC');

        $oldCheckins = DB::table('checkin_old')->get();

        foreach ($oldCheckins as $oldCheckin){
            //TODO change username
            $dealers = new EloquentDealerRepository();
            $dealer = $dealers->findByEmail($oldCheckin->username);
            if(!$dealer){
                $dealer = $dealers->findByEmail('info@csgreps.com');
            }

            $checkins = [
                    'asset_id'               => $oldCheckin->csgid,
                    'user_id'                => '1',
                    'dealer_id'              => $dealer->id,
                    'notes'                  => $oldCheckin->location,
                    'expected_return_date'   => $oldCheckin->returndate,
                    'returned_date'          => $oldCheckin->returndate,
                    'created_at'             => $oldCheckin->date,
                    'updated_at'             => $oldCheckin->date,
                ];

            $insertID  = DB::table('checkouts')->insertGetId($checkins);

            $log->onAssetCheckout(Asset::find($oldCheckin->csgid), Checkout::find($insertID));
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
