<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(AccessTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        factory(App\Models\Access\User\User::class, 5)->create();
        factory(App\Models\Asset::class, 5)->create();
        factory(App\Models\Dealer::class, 20)->create();
        factory(App\Models\Checkout::class, 20)->create();
        factory(App\Models\Asset::class, 5)->create();

        Model::reguard();
    }
}
