<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Access\User\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Mfr::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(App\Models\Asset::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'mfr_id' => factory(App\Models\Mfr::class)->create()->id,
        'part' => $faker->isbn13,
        'description' => $faker->catchPhrase,
        'ack' => '',
        'msrp' => $faker->randomFloat(2),
        'image' => $faker->image(public_path() . '/uploads', 200, 149, null, false),
        'status' => $faker->numberBetween(1,3),
        'notes' => $faker->sentence,
    ];
});

$factory->define(App\Models\Checkout::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'asset_id' => factory(App\Models\Asset::class)->create()->id,
        'user_id' => factory(App\Models\Access\User\User::class)->create()->id,
        'dealer_id' => factory(App\Models\Dealer::class)->create()->id,
        'notes' => $faker->sentence,
        'expected_return_date' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(App\Models\Dealer::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'user_id' => factory(App\Models\Access\User\User::class)->create()->id,
        'company_name' => $faker->company,
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\AssetLogs::class, function (Faker\Generator $faker) use ($factory) {
    // TODO: update this
    return [
        'asset_id' => factory(App\Models\Asset::class)->create()->id,
        'user_id' => factory(App\Models\Access\User\User::class)->create()->id,
        'checkout_id' => factory(App\Models\Checkout::class)->create()->id,
        'action' => 'audit.asset.checkin',
    ];
});
