<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\SanctumController;
use App\Http\Controllers\Api\OrderController;
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

Route::post('/auth/token', [SanctumController::class, 'create']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/auth/token', [SanctumController::class, 'index']);
    Route::delete('/auth/revoke/{tokenId?}', [SanctumController::class, 'revoke']);

    Route::resource('/order', OrderController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
