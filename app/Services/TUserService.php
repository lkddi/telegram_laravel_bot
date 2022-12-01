<?php

namespace App\Services;

use App\Models\Group;
use Telegram\Bot\Laravel\Facades\Telegram;

class TUserService
{
    public function create($datas)
    {
        $data = $datas['chat_member']['new_chat_member']['user'];
        $user = [];
        $user['first_name'] = $data['first_name'] ?? '';
        $user['last_name'] = $data['last_name'] ?? '';
        $user['username'] = $data['username'] ?? '';
        $user['state'] = 0;

        $group = Group::where('chat_id', $datas['chat_member']['chat']['id'])->first();

        if ($group) {
//            $group->increment()
            return $chat = $group->user()->updateOrCreate(['user_id' => $data['id']], $user);
        }

        return true;

    }

    public function delete($data)
    {
        $chatid = $data['chat_member']['chat']['id'];
        $userid = $data['chat_member']['new_chat_member']['user']['id'];//$data->chat_member->new_chat_member->user->id
        $groups = Group::where('chat_id', $chatid)->first()->admin()->where('user_id', $userid)->delete();
        return true;
    }

    /**
     * 封禁 成员
     * @param $chat_id
     * @param $sender_chat_id
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function banChatSenderChat($chat_id, $sender_chat_id)
    {
        Telegram::banChatSenderChat(['chat_id' => $chat_id, 'sender_chat_id' => $sender_chat_id]);
    }

    /**
     * 解除 封禁
     * @param $chat_id
     * @param $sender_chat_id
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function unbanChatSenderChat($chat_id, $sender_chat_id)
    {
        Telegram::unbanChatSenderChat(['chat_id' => $chat_id, 'sender_chat_id' => $sender_chat_id]);
    }

    public function banChatMember($chat_id, $user_id)
    {
        return Telegram::banChatMember(['chat_id' => $chat_id, 'user_id' => $user_id]);
    }

    public function unbanChatMember($chat_id, $user_id)
    {
        return Telegram::unbanChatMember(['chat_id' => $chat_id, 'user_id' => $user_id]);

    }

    public function setChatPermissions($chat_id, $user_id, $type = true)
    {
        $params = [];
        $params['chat_id'] = $chat_id;
        $params['user_id'] = $user_id;
        $params['can_send_messages'] = $type;
        $params['can_send_media_messages'] = $type;
        $params['can_send_polls'] = $type;
        $params['can_send_other_messages'] = $type;
        $params['can_change_info'] = $type;
        $params['can_invite_users'] = $type;
        $params['can_pin_messages'] = $type;
        $params['can_manage_topics'] = $type;
        Telegram::setChatPermissions($params);
    }

    public function restrictChatMember($chat_id, $user_id, bool $type = true)
    {
        $params = [];
        $params['chat_id'] = $chat_id;
        $params['user_id'] = $user_id;
        $params['can_send_messages'] = $type;
        $params['can_send_media_messages'] = $type;
        $params['can_send_polls'] = $type;
        $params['can_send_other_messages'] = $type;
        $params['can_change_info'] = $type;
        $params['can_invite_users'] = $type;
        $params['can_pin_messages'] = $type;
        $params['can_manage_topics'] = $type;
        Telegram::restrictChatMember($params);
    }
}
