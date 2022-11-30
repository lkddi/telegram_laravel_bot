<?php

namespace App\Plugins\Telegram\Commands;

use App\Models\User;
use App\Plugins\Telegram\Telegram;

class GetLatestUrl extends Telegram {
    public $command = '/getlatesturl';
    public $description = '获取网站最新地址';

    public function handle($message, $match = []) {
        $telegramService = $this->telegramService;
        $text = sprintf(
            "%s的最新网址是：%s",
            config('app.name', 'V2Board'),
            config('app.url')
        );
        $telegramService->sendMessage($message->chat_id, $text, 'markdown');
    }
}
