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
    $a = array(
        'message_id' => 310,
        'from' =>
            array(
                'id' => 5755546557,
                'is_bot' => true,
                'first_name' => '小不点_👽',
                'username' => 'Meteor2022_bot',
            ),
        'chat' =>
            array(
                'id' => 690564235,
                'first_name' => 'liu',
                'last_name' => 'xing',
                'username' => 'lkddi',
                'type' => 'private',
            ),
        'date' => 1669619091,
        'text' => '[测试群-禁菠菜，博彩，棋牌，推广，网赚，bc, qp,wz, 等的广告]:ع新用户进群2022-11-28 15:04:50',
    );
    return \App\Services\ResponseService::add($a,50);
});
