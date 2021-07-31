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
Route::group(['middleware' => ['auth'], 'prefix' => 'manage'], function() {
    Route::group(['as' => 'manage', 'prefix' => 'permission'], function() {
        Route::get('/', 'PermissionController@index')->name('-permission');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('-permission.edit');
        Route::get('/view/{id}', 'PermissionController@view')->name('-permission.view');
        Route::get('/delete/{id}', 'PermissionController@delete')->name('-permission.delete');
    });
});
