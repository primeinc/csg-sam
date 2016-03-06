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
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
        Route::get('user/search', 'SearchController@search')->name('frontend.user.search');
    });
    Route::group(['namespace' => 'Asset'], function() {
        Route::get('samples', 'AssetController@index')->name('frontend.assets');
        Route::get('samples/add', 'AssetController@add')->name('frontend.assets.add');
        Route::post('samples/add', 'AssetController@store')->name('frontend.assets.add');
        Route::get('samples/edit/{asset}', 'AssetController@edit')->name('frontend.assets.edit');
        Route::post('samples/update/{asset}', 'AssetController@update')->name('frontend.assets.update');
        Route::delete('samples/{asset}', 'AssetController@destroy')->name('frontend.assets');
        Route::get('samples/search', 'AssetController@index')->name('frontend.assets');
    });
    Route::group(['namespace' => 'Dealer'], function() {
//        Route::get('dealers', 'DealerController@index')->name('frontend.dealers');
        Route::get('dealers/add', 'DealerController@add')->name('frontend.dealers.add');
        Route::post('dealers/add', 'DealerController@store')->name('frontend.dealers.add');
        Route::delete('dealers/{dealer}', 'DealerController@destroy')->name('frontend.dealers');
        Route::get('dealers/search', 'DealerController@index')->name('frontend.dealers');
        Route::resource('dealers', 'DealerController');
    });
    Route::group(['namespace' => 'Mfr'], function() {
        Route::get('mfrs', 'MfrController@index')->name('frontend.mfrs');
        Route::get('mfrs/add', 'MfrController@add')->name('frontend.mfrs.add');
        Route::post('mfrs/add', 'MfrController@store')->name('frontend.mfrs.add');
        Route::delete('mfrs/{mfr}', 'MfrController@destroy')->name('frontend.mfrs');
        Route::get('mfrs/search', 'MfrController@search')->name('frontend.mfrs.search');
    });
    Route::group(['namespace' => 'Checkout'], function() {
        Route::get('checkout', 'CheckoutController@index')->name('frontend.checkout');
        Route::get('checkout/add', 'CheckoutController@add')->name('frontend.checkout.add');
        Route::post('checkout/add', 'CheckoutController@store')->name('frontend.checkout.add');
        Route::delete('checkout/{checkout}', 'CheckoutController@destroy')->name('frontend.checkout');
        Route::get('checkout/search', 'CheckoutController@index')->name('frontend.checkout');
    });
});
