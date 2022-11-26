<?php

use App\Clients\DokkanClient;
use App\Http\Controllers\DokkanApi\CardController;
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

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::prefix('dokkan-api')->group(function () {
    Route::get('/cards', [CardController::class, 'index']);
});

Route::prefix('dokkan-bot')->group(function () {

    Route::get('/ping', function () {
        try {
            app(DokkanClient::class)->ping();
            return response()->json(['status' => 'ok']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

});