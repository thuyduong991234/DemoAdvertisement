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
Route::middleware('auth:admin,account')->group(function () {
    Route::apiResource('contents', 'API\ContentController');
    Route::apiResource('slots', 'API\SlotController');
});

Route::post('admin/login', 'Admin\AuthController@login')->name('admin.login');
Route::post('admin/logout', 'Admin\AuthController@logout')->name('admin.logout');
Route::post('account/login', 'Account\AuthController@login')->name('account.login');
Route::post('account/logout', 'Account\AuthController@logout')->name('account.logout');
