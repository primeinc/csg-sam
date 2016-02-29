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
    });
    Route::group(['namespace' => 'Asset'], function() {
        Route::get('samples', 'AssetController@index')->name('frontend.assets');
        Route::get('samples/add', 'AssetController@add')->name('frontend.assets.add');
        Route::post('samples/add', 'AssetController@store')->name('frontend.assets.add');
        Route::delete('samples/{asset}', 'AssetController@destroy')->name('frontend.assets');
        Route::get('samples/search', 'AssetController@index')->name('frontend.assets');
    });
});
