<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GunBrokerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/gunbroker/getAccessToken', [GunBrokerController::class, 'getAccessToken']);

Route::post('/gunbroker/item/{itemId}', [GunBrokerController::class, 'getItem']);

Route::post('/gunbroker/getItemsEnding', [GunBrokerController::class, 'getItemsEnding']);

