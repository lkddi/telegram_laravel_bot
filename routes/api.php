<?php

use App\Http\Controllers\Api\V1\TelegramController;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TelegramController::class)->prefix('v1')->group(function () {
    Route::any('/telegram/webhook', 'webhook');
});
//Route::post('/telegram/webhook',[TelegramController::class,'webhook']);

//设置接口
Route::get('/t', function () {

});
