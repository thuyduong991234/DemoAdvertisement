<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::middleware('auth:admin,account')->group(function () {
    Route::apiResource('contents', 'API\ContentController');
    Route::apiResource('slots', 'API\SlotController');
    Route::apiResource('playlists', 'API\PlaylistController');
    Route::apiResource('devices', 'API\DeviceController');
//});
Route::get('playlist-size/{playlist}', 'API\PlaylistController@totalSize')->name('playlist.size');
Route::post('admin/login', 'API\AuthController@login')->name('admin.login');
Route::post('admin/logout', 'API\AuthController@logout')->name('admin.logout');
Route::post('account/login', 'API\AuthController@login')->name('account.login');
Route::post('account/logout', 'API\AuthController@logout')->name('account.logout');
