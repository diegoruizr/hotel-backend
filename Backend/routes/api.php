<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rutas API
|--------------------------------------------------------------------------
|
| Registro de rutas API. RouteServiceProvider carga estas rutas ro de
| un grupo al que se le asigna el grupo de middleware "api".
*/


    /**
     * Rutas inicio, registro y cierre de sesion.
     */

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
    });


    /**
     * Rutas Permisos.
     */
    Route::group([
        'middleware' => 'api',
        'prefix' => 'permission',
        'middleware' => 'auth:api'],  function () {
            Route::post('get-permissions','PermissionController@getPermissions');
        });

    /**
     * Rutas Hoteles.
     */
    Route::group([
        'middleware' => 'api',
        'prefix' => 'hotel',
        'middleware' => 'auth:api'],  function () {
            Route::post('list','HotelController@index');
            Route::post('create','HotelController@create');
            Route::post('update','HotelController@update');
            Route::post('show','HotelController@show');
            Route::post('detail/type','HotelController@getRoomTypes');
            Route::post('detail/accommodation','HotelController@getAccommodations');
            Route::get('detail/city','HotelController@getCities');
            Route::post('unique/nit','HotelController@uniqueNit');
            Route::post('update/state','HotelController@state');
            Route::post('assing','HotelController@assing');
            Route::post('detail/assing','HotelController@getAssing');
        });

