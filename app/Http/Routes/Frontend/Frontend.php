<?php

/**
 * Frontend Controllers.
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('macros', 'FrontendController@macros')->name('frontend.macros');

/*
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('search', 'Asset\AssetController@search')->name('frontend.search');
    Route::group(['namespace' => 'Api'], function () {
        Route::get('api/{model}/all', 'ApiController@getAll')->name('api.get.all');
    });
    Route::group(['namespace' => 'User'], function () {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
    Route::group(['namespace' => 'Asset'], function () {
        Route::get('samples/{asset}/edit/location', 'AssetController@locationModal')->name('samples.edit.location');
        Route::patch('samples/{asset}/edit/location', 'AssetController@updateLocation')->name('samples.edit.location');
        Route::get('samples/recent', 'AssetController@index')->name('samples.recent');
        Route::get('samples/out', 'AssetController@out')->name('samples.out');
        Route::get('samples/out/rep-{rep}', 'AssetController@getByRep')->name('samples.out.rep');
        Route::get('samples/out/dsr-{dsr}', 'AssetController@getByDsr')->name('samples.out.dsr');
        Route::get('samples/out/loc-{loc}', 'AssetController@getByLoc')->name('samples.out.loc');
        Route::get('samples/out/ds-{ds}', 'AssetController@getByDs')->name('samples.out.ds');
        Route::get('samples/out/mfr-{mfr}', 'AssetController@getByMfr')->name('samples.out.mfr');
        Route::get('samples/deleted', 'AssetController@deleted')->name('samples.deleted');
        Route::resource('samples', 'AssetController');
    });
    Route::group(['namespace' => 'Dealership'], function () {
        Route::resource('dealerships/list', 'DataTablesController');
        Route::resource('dealerships', 'DealershipController');
    });
    Route::group(['namespace' => 'Dealer'], function () {
        Route::get('api/dealers/search', 'DealerApiController@search')->name('api.dealers.search');
        Route::resource('dealers/list', 'DataTablesController');
        Route::resource('dealers', 'DealerController');
    });
    Route::group(['namespace' => 'Mfr'], function () {
        Route::get('api/mfrs/search', 'MfrApiController@search')->name('api.mfrs.search');
        Route::resource('mfrs/list', 'DataTablesController');
        Route::resource('mfrs', 'MfrController');
    });
    Route::group(['namespace' => 'Checkout'], function () {
        Route::get('samples/checkout/{asset}', 'CheckoutController@checkoutModal')->name('checkout.create');
        Route::post('samples/checkout/{asset}', 'CheckoutController@store')->name('checkout.store');
        Route::get('samples/checkin/{asset}', 'CheckoutController@checkinModal')->name('checkout.checkin');
        Route::post('samples/checkin/{asset}', 'CheckoutController@returnAsset')->name('checkout.return');
        Route::get('samples/checkin/{asset}/remind', 'CheckoutController@sendReminder')->name('checkout.remind');
        Route::get('/checkouts/{id}/edit', 'CheckoutController@edit')->name('checkout.edit');
        Route::patch('/checkouts/{id}', 'CheckoutController@update')->name('checkout.update');
        Route::get('/checkouts/{id}/logs', 'CheckoutController@logsModal')->name('checkout.logs');
        Route::resource('samples/out/list', 'DataTablesController');
    });
    Route::group(['namespace' => 'Location'], function () {
        //
    });
    Route::group(['namespace' => 'AssetLogs'], function () {
        //
    });
});
