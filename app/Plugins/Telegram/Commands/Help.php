<?php

namespace App\Plugins\Telegram\Commands;

use App\Plugins\Telegram\Telegram;

class Help extends Telegram
{
    public $command = '/help';
    public $description = '获取帮助信息';

    public function handle($message, $match = [])
    {
        $telegramService = $this->telegramService;
        if (!$message->is_private) return;
        $a = [
            [
                'text' => '测试按钮',
                'callback_data' => 'aylc'
            ],
            [
                'text' => '测试按钮1',
                'callback_data' => 'aylc1'
            ]
        ];
        $text = "🚥使用菜单\n———————————————\n绑定账户： /bing 你的订阅地址 \n查询流量： /traffic \n解除绑定：/unbind \n最新网址：/getlatesturl";
        $telegramService->sendMessage($message->chat_id, $text, 'markdown', $a);
    }
}
