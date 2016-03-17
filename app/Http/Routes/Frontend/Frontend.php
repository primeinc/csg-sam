<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('macros', 'FrontendController@macros')->name('frontend.macros');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('search', 'Asset\AssetController@search')->name('frontend.search');
    Route::group(['namespace' => 'Api'], function() {
        Route::get('api/{model}/all', 'ApiController@getAll')->name('api.get.all');
    });
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
    Route::group(['namespace' => 'Asset'], function() {
        Route::get('samples/{asset}/edit/location', 'AssetController@locationModal')->name('samples.edit.location');
        Route::patch('samples/{asset}/edit/location', 'AssetController@updateLocation')->name('samples.edit.location');
        Route::get('samples/recent', 'AssetController@index')->name('samples.recent');
        Route::get('samples/out', 'AssetController@out')->name('samples.out');
        Route::resource('samples', 'AssetController');
    });
    Route::group(['namespace' => 'Dealership'], function() {
        Route::resource('dealerships/list', 'DataTablesController');
        Route::resource('dealerships', 'DealershipController');
    });
    Route::group(['namespace' => 'Dealer'], function() {
        Route::get('api/dealers/search', 'DealerApiController@search')->name('api.dealers.search');
        Route::resource('dealers/list', 'DataTablesController');
        Route::resource('dealers', 'DealerController');
    });
    Route::group(['namespace' => 'Mfr'], function() {
        Route::get('api/mfrs/search', 'MfrApiController@search')->name('api.mfrs.search');
        Route::resource('mfrs/list', 'DataTablesController');
        Route::resource('mfrs', 'MfrController');
    });
    Route::group(['namespace' => 'Checkout'], function() {
        Route::get('samples/checkout/{asset}', 'CheckoutController@checkoutModal')->name('checkout.create');
        Route::post('samples/checkout/{asset}', 'CheckoutController@store')->name('checkout.store');
        Route::get('samples/checkin/{asset}', 'CheckoutController@checkinModal')->name('checkout.checkin');
        Route::post('samples/checkin/{asset}', 'CheckoutController@returnAsset')->name('checkout.return');
    });
    Route::group(['namespace' => 'Location'], function() {
        //
    });
});
