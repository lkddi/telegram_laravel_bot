<?php

namespace App\Plugins\Telegram\Services;

use App\Services\ResponseService;
use App\Services\TAdminUserService;
use App\Services\TUserService;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class Chat_member
{
    protected $user;
    protected $group;

    //新进群处理
    public function handle($data)
    {

        $deltime = 30;
        $Tadmin = new TAdminUserService();
        $this->formatMessage($data);
        $user = $this->user;
        $group = $this->group;
        $Tuser = new TUserService();
        // - restricted 受限的 - member 普通成员 - left 非本群成员
        $text = "[" . $group['title'] . "]:" . $this->fullname();
        if ($user['old_status'] == 'left' && $user['new_status'] == 'member') {
//            $text .= '新用户进群';
            $Tuser->create($data);
            //非管理员邀请入群需要验证
            $checkadmin = checkAdmin($group['chat_id'], $group['form_id']);
            if (!$checkadmin) {
                $Tuser->restrictChatMember($group['chat_id'], $user['id'], 0);
                $c = [
                    [
                        'text' => '点我进行验证',
                        'callback_data' => 'verification'
                    ]
                ];
                $a = ['inline_keyboard' => array($c)];
                $params = [
                    'chat_id' => $group['chat_id'],  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
                    'text' => '欢迎新用戶 ' . getMarkDownUserUrl(escapeMarkDown($this->fullname()),$user['id']) . ' ，请点下方按钮进行入群验证，有效时间300秒。',  // string     - Required. Text of the message to be sent
                    'parse_mode' => 'Markdown',  // string     - (Optional). Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
                    'reply_markup' => json_encode($a, true),  // object     - (Optional). One of either InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
                ];
                $req = Telegram::sendMessage($params);
                if ($req) {
                    ResponseService::create($req, config('telegram.bots.mybot.deltime'));
                }
                $Tuser->restrictChatMember($group['chat_id'], $user['id'], 0);
            }
            return true;
//        } elseif ($user['old_status'] == 'member' && $user['new_status'] == 'restricted') {
//            $text .= $this->fullname() . '被禁言';
//        } elseif ($user['old_status'] == 'restricted' && $user['new_status'] == 'member') {
//            $text = $this->fullname() . '恢复禁言操作';
        } elseif ($user['old_status'] == 'member' && $user['new_status'] == 'left') {
            $text .= $this->fullname() . ':成员离开了';
            (new TUserService())->delete($data);
        } elseif ($user['old_status'] == 'member' && $user['new_status'] == 'kicked') {
            $text .= $this->fullname() . ':成员被删除';
            (new TUserService())->delete($data);
        } elseif ($user['old_status'] == 'member' && $user['new_status'] == 'administrator') {//administrator
            $text .= $this->fullname() . ':加入管理员队伍';
            $Tadmin->updateAdmin($group['chat_id']);
        } elseif ($user['old_status'] == 'administrator' && $user['new_status'] == 'member') {//administrator
            $text .= $this->fullname() . ':离开了管理员队伍';
            $Tadmin->updateAdmin($group['chat_id']);
        } else {
            $text .= $this->fullname() . ':被执行操作：从' . $user['old_status'] . '到' . $user['new_status'];
        }
        $text .= date("Y-m-d H:i:s", $group['date']);

        if (config('telegram.bots.mybot.notice')){
            $req = Telegram::sendMessage(['chat_id' => '690564235', 'text' => $text]);
            if ($req) {
                ResponseService::create($req, $deltime);
            }
        }

        return true;
    }

    public function formatMessage(array $data)
    {
        $group = [];
        $group['type'] = $data['chat_member']['chat']['type'];
        $group['title'] = $data['chat_member']['chat']['title'];
        if (isset($data['chat_member']['chat']['username'])) $group['username'] = $data['chat_member']['chat']['username'];
        $group['chat_id'] = $data['chat_member']['chat']['id'];
        $group['date'] = $data['chat_member']['date'];
        $group['form_id'] = $data['chat_member']['from']['id'];
        $this->group = $group;

        $user = [];
        $user['id'] = $data['chat_member']['new_chat_member']['user']['id'];
        $user['is_bot'] = $data['chat_member']['new_chat_member']['user']['is_bot'];
        if (isset($data['chat_member']['new_chat_member']['user']['first_name'])) $user['first_name'] = $data['chat_member']['new_chat_member']['user']['first_name'];
        if (isset($data['chat_member']['new_chat_member']['user']['last_name'])) $user['last_name'] = $data['chat_member']['new_chat_member']['user']['last_name'];
        if (isset($data['chat_member']['new_chat_member']['user']['username'])) $user['username'] = $data['chat_member']['new_chat_member']['user']['username'];
        $user['old_status'] = $data['chat_member']['old_chat_member']['status'];
        $user['new_status'] = $data['chat_member']['new_chat_member']['status'];

        $this->user = $user;
    }

    /**
     * 用户 全名处理 如果 fist_name 和 last_name 都不存在，则使用 id。
     * @return mixed|string
     */
    public function fullname()
    {
        $user = $this->user;
        $fullname = $user['id'];
        if (isset($user['first_name'])) {
            $fullname = $user['first_name'];
        }
        if (isset($user['last_name'])) {
            $fullname .= $user['last_name'];
        }
        return $fullname;
    }

}
