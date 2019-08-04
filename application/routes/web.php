<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// INDEX

Route::get('/', 'FrontendController@index')->name('home');


// MIDDLEWARE

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin_panel', 'FrontendController@admin_panel')->name('admin_panel');

    // KORISNICI

    Route::get('/users/{id?}', 'KorisnikController@show');
    Route::post('/users/store', 'KorisnikController@storeWithChosenRole');
    Route::post('/users/update/{id}','KorisnikController@update');
    Route::get('/users/destroy/{id}','KorisnikController@destroy');

    // GALERIJA

    Route::get('/galls/{id?}', 'GalerijaController@show');
    Route::post('/galls/store', 'GalerijaController@store');
    Route::post('/galls/update/{id}','GalerijaController@update');
    Route::get('/galls/destroy/{id}','GalerijaController@destroy');

    // GITARE

    Route::get('/guits/{id?}', 'GuitsController@show');
    Route::post('/guits/store', 'GuitsController@store');
    Route::post('/guits/update/{id}','GuitsController@update');
    Route::get('/guits/destroy/{id}','GuitsController@destroy');

    // MENI

        Route::get('/menus/{id?}', 'MeniController@show');
        Route::post('/menus/store', 'MeniController@store');
        Route::post('/menus/update/{id}','MeniController@update');
        Route::get('/menus/destroy/{id}','MeniController@destroy');

        // NARUDZBINA

        Route::get('/orders/{id?}', 'OrderController@show');
        Route::post('/orders/store', 'OrderController@store');
        Route::post('/orders/update/{id}','OrderController@update');
        Route::get('/orders/destroy/{id}','OrderController@destroy');
    /*      */
        // ULOGE

        Route::get('/roles', 'RoleController@show');


});


// LOGIN I LOGOUT I REGISTRACIJA SVI POD MIDLVEROM

Route::get('/logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'login'], function(){

    Route::get('/login_page', 'FrontendController@login_page')->name('login_page');

    Route::post('/login', 'LoginController@login')->name('login');

    Route::get('/reg_page', 'FrontendController@reg_page')->name('reg_page');

    Route::post('/reg', 'KorisnikController@store')->name('reg');

});


// GUITS

Route::get('/guitars', 'GuitsController@guitars')->name('guitars');

Route::get('/guitarsType/{type}', 'GuitsController@guitarsByType');

Route::get('/guitarsMnfctr/{mnfctr}', 'GuitsController@guitarsByMnfctr');

Route::get('/guits_show/{id}', 'GuitsController@guitar_specific');

Route::get('/guit_order/{id}', 'OrderController@guit_order');


// OAUTORU

Route::get('/autor', 'FrontendController@autor')->name('autor');


// GALERIJA

Route::get('/gallery', 'GalerijaController@gallery')->name('gallery');


// DOKUMENTACIJA

Route::get('/doc', 'FrontendController@doc')->name('doc');


