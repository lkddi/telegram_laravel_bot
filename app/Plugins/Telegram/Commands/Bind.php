<?php

namespace App\Plugins\Telegram\Commands;

use App\Models\User;
use App\Plugins\Telegram\Telegram;

class Bind extends Telegram {
    public $command = '/bind';
    public $description = '将Telegram账号绑定到网站';

    public function handle($message, $match = []) {
        $telegramService = $this->telegramService;
        if (!$message->is_private) return;
        if (!isset($message->args[0])) {
            $telegramService->sendMessage($message->chat_id, '参数有误，请携带订阅地址发送');
            return;
        }
        $subscribeUrl = $message->args[0];
        $subscribeUrl = parse_url($subscribeUrl);
        parse_str($subscribeUrl['query'], $query);
        $token = $query['token'];
        if (!$token) {
            $telegramService->sendMessage($message->chat_id, '订阅地址无效');
            return;
        }
        $user = User::where('token', $token)->first();
        if (!$user) {
            $telegramService->sendMessage($message->chat_id, '用户不存在');
            return;
        }
        if ($user->telegram_id) {
            $telegramService->sendMessage($message->chat_id, '该账号已经绑定了Telegram账号');
            return;
        }
        $user->telegram_id = $message->chat_id;
        if (!$user->save()) {
            $telegramService->sendMessage($message->chat_id, '设置失败');
            return;
        }

        $telegramService->sendMessage($message->chat_id, '绑定成功');
    }
}
