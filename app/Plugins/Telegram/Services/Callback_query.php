<?php

namespace App\Plugins\Telegram\Services;

use App\Models\Group;
use App\Models\TUser;
use App\Services\ResponseService;
use App\Services\TelegramService;
use App\Services\TUserService;
use Telegram\Bot\Laravel\Facades\Telegram;

class Callback_query
{

    protected $chatid;
    protected $userid;
    protected $callback_query_id;
    protected $check_userid;
    protected $message_id;
    protected $fullname;

    public function handle($data)
    {
        $this->chatid = $data['callback_query']['message']['chat']['id'];
        $this->userid = $data['callback_query']['message']['entities'][0]['user']['id'];
        $this->check_userid = $data['callback_query']['from']['id'];
        $this->callback_query_id = $data['callback_query']['id'];
        $chatId = $data['callback_query']['message']['chat']['id'];
        $this->message_id = $data['callback_query']['message']['message_id'];
        $this->fullname = $this->fullname($data);

        $text = '欢迎你的加入。 次消息将在10秒后删除！';//$data['callback_query']['message']['message_id'];

        // 点击验证操作
        if (str_contains($data['callback_query']['data'], 'verification')) {
            return $this->verification();
        }

//        Telegram::sendMessage(['chat_id' => $this->chatid, 'text' => $text]);
        return true;
    }

    /**
     * 执行验证检查
     * @return bool|void|null
     */
    public function verification()
    {
        if (checkAdmin($this->chatid, $this->check_userid)) {
            $text = '✅你已成功操作用户入群！';
            $Tuser = new TUserService();
            $Tuser->restrictChatMember($this->chatid, $this->userid, 1);
            return $this->joninGroup($text);
        } else {
            if ($this->check_userid != $this->userid) return true;
        }

        \Log::info('到这里了');
        $group = Group::where('chat_id', $this->chatid)->first();
        if (!$group || !$group->open) {
            return false;
        }
        $user = $group->user()->where('user_id', $this->userid)->first();
        if ($user) {
            $text = '✅恭喜你验证通过，你现在可以在群组内发言了！';
            $Tuser = new TUserService();
            $Tuser->restrictChatMember($this->chatid, $this->userid, 1);
            return $this->joninGroup($text);
        }
    }

    /**
     * 用户 全名处理 如果 fist_name 和 last_name 都不存在，则使用 id。
     * @return mixed|string
     */
    public function fullname($data)
    {
        $user = $data['callback_query']['message']['entities'][0]['user'];
        $fullname = $user['id'];
        if (isset($user['first_name'])) {
            $fullname = $user['first_name'];
        }
        if (isset($user['last_name'])) {
            $fullname .= $user['last_name'];
        }
        return $fullname;
    }

    /**
     *
     * @param $text
     * @return void
     */
    public function joninGroup($text)
    {
        try {
            $params = [
                'chat_id' => $this->chatid,  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
                'message_id' => $this->message_id,  // string     - Required. Text of the message to be sent
                'text' => '欢迎新用戶 ' . getMarkDownUserUrl(escapeMarkDown($this->fullname), $this->userid) . ' ，加入本群。',  // string     - Required. Text of the message to be sent
                'parse_mode' => 'Markdown',  // string     - (Optional). Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
            ];
            Telegram::answerCallbackQuery(['callback_query_id' => $this->callback_query_id, 'text' => $text, 'show_alert' => true]);
            Telegram::editMessageText($params);
        } catch (\Exception $e) {

        }
        $group = Group::where('chat_id',$this->chatid)->first();
        if ($group) {
            $group->increment('passedconut');
            $group->save();
        }
        return true;
    }
}
