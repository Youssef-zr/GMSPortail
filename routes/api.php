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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Sync Routes Omage
Route::group(["middleware" => ['api'], 'namespace' => 'Api'], function () {
    Route::get('/get_sync_clients_list', "SyncWithOmagController@clientsLocalSync");
    Route::get('/set_sites_clients_omag/{clients}', "SyncWithOmagController@setClientsOmagSites");
});
