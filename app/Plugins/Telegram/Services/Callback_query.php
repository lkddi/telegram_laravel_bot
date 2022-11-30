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

    public function handle($data)
    {
        $this->chatid = $data['callback_query']['message']['chat']['id'];
        $this->userid = $data['callback_query']['message']['entities'][0]['user']['id'];
        $this->check_userid = $data['callback_query']['from']['id'];
        $this->callback_query_id = $data['callback_query']['id'];
        $chatId = $data['callback_query']['message']['chat']['id'];
        $messageiId = $data['callback_query']['message']['message_id'];

        $text = '欢迎你的加入。 次消息将在10秒后删除！';//$data['callback_query']['message']['message_id'];
//        $telegramService = new TelegramService();
//        $telegramService->editMessageText($chatId,  $messageiId , $text);
        if (str_contains($data['callback_query']['data'], 'verification')) {
//            $data['Title'] = str_replace('新增 ', '', $data['Content']);


            return $this->verification();
        }

        Telegram::sendMessage(['chat_id' => $this->chatid, 'text' => $text]);
        return true;
    }

    public function verification()
    {
        if (checkAdmin($this->chatid,$this->check_userid)){
            $text = '✅你已成功操作用户入群！';
            $Tuser = new TUserService();
            $Tuser->restrictChatMember($this->chatid,$this->userid,1);
            try {
                Telegram::answerCallbackQuery(['callback_query_id' => $this->callback_query_id, 'text' => $text,'show_alert'=>true]);
            } catch (\Exception $e) {

            }
        }else{
            if ($this->check_userid != $this->userid) return true;
        }


        $group = Group::where('chat_id', $this->chatid)->first();
        if (!$group || !$group->open) {
            return false;
        }
        $user = $group->user()->where('user_id', $this->userid)->first();
        if ($user) {
            $text = '✅恭喜你验证通过，你现在可以在群组内发言了！';
            $Tuser = new TUserService();
            $Tuser->restrictChatMember($this->chatid,$this->userid,1);
            try {
                Telegram::answerCallbackQuery(['callback_query_id' => $this->callback_query_id, 'text' => $text,'show_alert'=>true]);
            } catch (\Exception $e) {

            }
        }
//        else {
//            $text = '您没有该目标群组的待验证记录。';
//            $req = Telegram::sendMessage(['chat_id' => $this->chatid, 'text' => $text]);
//            if ($req) {
//                ResponseService::create($req, 30);
//            }
//        }
        return true;
    }
}
