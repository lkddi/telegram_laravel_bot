<?php

namespace App\Services;

use App\Jobs\SendTelegramJob;
use App\Models\Response;
use App\Models\User;
use \Curl\Curl;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $api;

    public function __construct($token = '')
    {
        $this->api = 'https://api.telegram.org/bot' . config('telegram.bots.mybot.token', $token) . '/';

    }

    /**
     * 发送文本消息
     * @param int $chatId 发给谁
     * @param string $text 内容
     * @param string $parseMode markdown
     * @param array $reply_markup ['text' => '测试按钮','callback_data' => 'aylc'],['text' => '测试按钮1','url' => 'http://ay.lc']
     * @return void
     */
    public function sendMessage(int $chatId, string $text, string $parseMode = 'markdown', array $reply_markup = [])
    {
        if ($parseMode === 'markdown') {
            $text = str_replace('_', '\_', $text);
        }
        return $this->request('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => true,
            'reply_markup' => json_encode(['inline_keyboard' => array($reply_markup)], true),
        ]);
    }

    /**
     *  修改已经发送的文本消息
     * @param int $chatId 发给谁
     * @param string $text 内容
     * @param string $parseMode markdown
     * @param array $reply_markup ['text' => '测试按钮','callback_data' => 'aylc'],['text' => '测试按钮1','url' => 'http://ay.lc']
     * @return void
     */
    public function editMessageText(int $chatId, $messageiId, string $text, string $parseMode = 'markdown', array $reply_markup = [])
    {
        if ($parseMode === 'markdown') {
            $text = str_replace('_', '\_', $text);
        }
        return $this->request('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageiId,
            'text' => $text,
            'disable_web_page_preview' => false,
            'parse_mode' => $parseMode,
            'reply_markup' => json_encode(['inline_keyboard' => array($reply_markup)], true),
        ]);
    }

    /**
     * 删除消息
     * @param string $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param string $messageId 消息id
     * @return void
     */
    public function deleteMessage(string $chatId, string $messageId)
    {
        return $this->request('deleteMessage', [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ]);
//        if ($response->ok && $response->result) {
//            $r = Response::where('message_id', $messageId)->first();
//            if ($r) {
//                $r->delete();
//            }
//        }
    }

    /**
     * 发送图片
     * @param string $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param int $messageId 选填
     * @param string $photo 图片地址
     * @param string|null $caption 图片标题 选填
     * @return void
     */
    public function sendPhoto(string $chatId, int $messageId, string $photo, string $caption = null)
    {
        return $this->request('deleteMessage', [
            'chat_id' => $chatId,
            'message_thread_id' => $messageId,
            'photo' => $photo,
            'caption' => $caption,
        ]);
    }

    /**
     * 发送音频
     * @param string $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param int $messageId 选填
     * @param string $audio 地址
     * @param string|null $caption 标题 选填
     * @return void
     */
    public function sendAudio(string $chatId, int $messageId, string $audio, string $caption = null)
    {
        return $this->request('deleteMessage', [
            'chat_id' => $chatId,
            'message_thread_id' => $messageId,
            'audio' => $audio,
            'caption' => $caption,
        ]);
    }

    /**
     * 批准聊天加入请求
     * @param int $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param int $userId 目标用户的唯一标识符
     * @return void
     */
    public function approveChatJoinRequest(int $chatId, int $userId)
    {
        return $this->request('approveChatJoinRequest', [
            'chat_id' => $chatId,
            'user_id' => $userId
        ]);
    }

    /**
     * 拒绝聊天加入请求
     * @param int $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param int $userId 目标用户的唯一标识符
     * @return void
     */
    public function declineChatJoinRequest(int $chatId, int $userId)
    {
        return $this->request('declineChatJoinRequest', [
            'chat_id' => $chatId,
            'user_id' => $userId
        ]);
    }

    /**
     * 封禁用户
     * @param int $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param int $userId 目标用户的唯一标识符
     * @return void
     */
    public function banChatSenderChat(int $chatId, int $userId)
    {
        return $this->request('banChatSenderChat', [
            'chat_id' => $chatId,
            'sender_chat_id' => $userId
        ]);
    }

    /**
     * 解除封禁用户
     * @param int $chatId 目标聊天的唯一标识符或目标频道的用户名（格式为@channelusername)
     * @param int $userId 目标用户的唯一标识符
     * @return void
     */
    public function unbanChatSenderChat(int $chatId, int $userId)
    {
        return $this->request('unbanChatSenderChat', [
            'chat_id' => $chatId,
            'sender_chat_id' => $userId
        ]);
    }

    /**
     * 用户禁言
     * @param int $chatId
     * @param int $userId
     * @return void
     */
    public function restrictChatMember(int $chatId, int $userId)
    {
        return $this->request('restrictChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
            "can_send_messages" => false,
            "can_send_media_messages" => false,
            "can_send_other_messages" => false,
            "can_add_web_page_previews" => false,
        ]);
    }

    /**
     * 设置我的命令
     * @param array $commands
     * @return void
     */
    public function setMyCommands(array $commands)
    {
//        [["command" => "help", "description" => "帮助"], ["command" => "sync", "description" => "同步数据"]]
        return $this->request('setMyCommands', [
            'commands' => json_encode($commands),
        ]);
    }

    /**
     * 添加聊天内按钮
     * @param array $commands
     * @return void
     */
    public function InlineKeyboardButton(array $commands)
    {
//        [["command" => "help", "description" => "帮助"], ["command" => "sync", "description" => "同步数据"]]
        return $this->request('InlineKeyboardButton', [
            'commands' => json_encode($commands),
        ]);
    }

    /**
     * 获取群管理员信息，不包含其他机器人信息
     * @param int $chatId 群id
     * @return void
     */
    public function getChatAdministrators(int $chatId)
    {
        return $this->request('getChatAdministrators', [
            'chat_id' => $chatId,
        ]);
    }

    /**
     * 获取群内指定成员信息
     * @param int $chatId 群id
     * @param int $userId 用户id
     * @return void
     */
    public function getChatMember(int $chatId, int $userId)
    {
        return $this->request('getChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ]);
    }

    public function getWebhookInfo()
    {
        return $this->request('getWebhookInfo');
    }

    public function getMe()
    {
        return $this->request('getMe');
    }

    /**
     * 获取 群 好友信息
     * @return mixed|null
     */
    public function getChat()
    {
        return $this->request('getChat');
    }


    /**
     * 设置api 返回接口地址
     * @param string $url
     * @return mixed|null
     */
    public function setWebhook(string $url)
    {
        return $this->request('setWebhook', [
            'url' => $url
        ]);
    }

    private function request(string $method, array $params = [])
    {
        $curl = new Curl();
        $curl->post($this->api . $method, $params);
        $response = $curl->response;
        $curl->close();
        return $response;
    }

    public function sendMessageWithAdmin($message, $isStaff = false)
    {
        if (!config('v2board.telegram_bot_enable', 0)) return;
        $users = User::where(function ($query) use ($isStaff) {
            $query->where('is_admin', 1);
            if ($isStaff) {
                $query->orWhere('is_staff', 1);
            }
        })
            ->where('telegram_id', '!=', NULL)
            ->get();
        foreach ($users as $user) {
            SendTelegramJob::dispatch($user->telegram_id, $message);
        }
    }
}
