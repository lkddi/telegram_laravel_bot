<?php

namespace App\Plugins\Telegram\Services;

//use App\Plugins\Telegram\Telegram;

use App\Services\GroupService;
use App\Services\TAdminUserService;
use App\Services\TelegramService;
use Telegram\Bot\Laravel\Facades\Telegram;

class My_chat_member
{
    //机器人 进群处理

    protected $TAdmin;
    protected $GroupService;

    public function handle(array $data, $match = [])
    {
        $TAdmin = new TAdminUserService();
        $GroupService = new GroupService();

        $group = $this->formatMessage($data);
        if ($group['type'] != 'supergroup') {//非超级群，不进行工作
            $text = $group['title'] . ':普通群，不工作';
            Telegram::sendMessage(['chat_id' => config('telegram.bots.mybot.admin'), 'text' => $text]);
            return true;
        }

        if ($group['status'] == 'left') {//机器人被T了
            $text = $group['title'] . ':我被T了，马上删除数据库';
            $GroupService->delGroup($group);
            Telegram::sendMessage(['chat_id' => config('telegram.bots.mybot.admin'), 'text' => $text]);
            return true;
        } elseif ($group['status'] == 'member') {//机器人权限为 普通用户
            $text = $group['title'] . ':机器人为普通用户，不工作';
            if ($data['my_chat_member']['old_chat_member']['status'] == 'administrator') {
                $GroupService->delGroup($group);
                $text = $group['title'] . ':机器人权限被收回，删除数据，退群';
            }
            Telegram::sendMessage(['chat_id' => config('telegram.bots.mybot.admin'), 'text' => $text]);
            return true;
        } elseif ($group['status'] == 'administrator') {//机器人权限为管理员
            $text = $group['title'] . ':机器人为管理员，同步群信息';
            $GroupService->new($group);
            $TAdmin->updateAdmin($group['chat']['id']);
            Telegram::sendMessage(['chat_id' => config('telegram.bots.mybot.admin'), 'text' => $text]);
            return true;
        }

//        检测到用户 T W 的管理权限变化，已自动同步至后台权限中。
//
//提示：由于此特性的加入，在管理员权限变化的场景下将不再需要手动调用 /sync 命令。

//        $obj = new \StdClass();
//        $text = explode(' ', $data['message']['text']);
//        $obj->command = $text[0];
//        $obj->args = array_slice($text, 1);
//        $group['chat_id'] = $data['my_chat_member']['chat']['id'];
//        $obj->message_id = $data['update_id'];
//        $obj->status = $data['my_chat_member']['new_chat_member']['status'];
//        $obj->type = $data['my_chat_member']['chat']['type'];
//        $obj->title = $data['my_chat_member']['chat']['title'];
//        $obj->username = $data['my_chat_member']['chat']['username'];
//        $obj->first_name = $data['my_chat_member']['new_chat_member']['user']['first_name'];
//        $obj->text = $data['message']['text'];
//        $obj->is_private = $data['message']['chat']['type'] === 'private';
//        if (isset($data['message']['reply_to_message']['text'])) {
//            $obj->message_type = 'reply_message';
//            $obj->reply_text = $data['message']['reply_to_message']['text'];
//        }
//        if ($data['my_chat_member']['new_chat_member']['user']['username'] == 'Meteor2022_bot') {
        //检测非管理员退出
//        if ($group['status'] == 'member') {
//            $text = '已成功登记本群信息，所有管理员皆可登入后台。
//
//功能启用流程：
//1. 将本机器人提升为管理员。
//2. 使用操作一完成后自动提供的功能启用按钮，或进入后台操作。
//
//功能关闭方法（标准流程）：
//- 进入后台操作。
//
//功能自动关闭（非标准流程）：
//- 将机器人的管理员身份撤销。
//- 将机器人的任一必要管理权限关闭。
//
//以下非正常操作会导致机器人自动退出：
//- 关闭机器人的发消息权限。
//
//撤销机器人的管理员或必要管理权限并不会导致机器人退群，也是被认可的取消接管方式。将机器人禁言毫无意义，机器人只能选择退出。
//
//为了避免误解，附加一些有关用户自行测试的说明：当退群重进的用户身份是群主时是不会产生验证的，请使用小号或拜托其他人测试。';
//            $text = '我加入了（普通用户）：' . $obj->title;
//        } elseif ($group['status'] == 'administrator') {
//            $text = '已成功登记本群信息，所有管理员皆可登入后台。
//
//功能启用流程：
//1. 将本机器人提升为管理员。
//2. 使用操作一完成后自动提供的功能启用按钮，或进入后台操作。
//
//功能关闭方法（标准流程）：
//- 进入后台操作。
//
//功能自动关闭（非标准流程）：
//- 将机器人的管理员身份撤销。
//- 将机器人的任一必要管理权限关闭。
//
//以下非正常操作会导致机器人自动退出：
//- 关闭机器人的发消息权限。
//
//撤销机器人的管理员或必要管理权限并不会导致机器人退群，也是被认可的取消接管方式。将机器人禁言毫无意义，机器人只能选择退出。
//
//为了避免误解，附加一些有关用户自行测试的说明：当退群重进的用户身份是群主时是不会产生验证的，请使用小号或拜托其他人测试。';
//            $text = '我加入了（超级群）：' . $obj->title;
//        } elseif ($group['status'] == 'left') {
//            $text = $obj->first_name . '一路走好！';
//            $text = '我离开了：' . $obj->title;
//        } elseif ($group['type'] == 'supergroup') {
//            $text = '请在超级群中使用本机器人。如果您不清楚普通群、超级群这些概念，请尝试为本群创建公开链接。
//提示：创建公开链接后再转私有的群仍然是超级群。
//在您将本群提升为超级群以后，可再次添加本机器人。如果您正在实施测试，请在测试完成后将本机器人移出群组。';
//            $text = '我加入了（超管）：' . $obj->title;
//        } elseif ($group['status'] == 'kicked') {
//            $text = '机器人被T了';
//        }
////        $telegramService->sendMessage($data['my_chat_member']['chat']['id'], $text, 'markdown');
//        Telegram::sendMessage(['chat_id' => '690564235', 'text' => $text]);
        return true;
    }

    public function formatMessage(array $data)
    {
        $group = [];
        $group['type'] = $data['my_chat_member']['chat']['type'];
        $group['title'] = $data['my_chat_member']['chat']['title'];
        if (isset($data['my_chat_member']['chat']['username'])) $group['username'] = $data['my_chat_member']['chat']['username'];
        $group['chat_id'] = $data['my_chat_member']['chat']['id'];
        $group['status'] = $data['my_chat_member']['new_chat_member']['status'];
        if (isset($data['my_chat_member']['new_chat_member']['can_be_edited'])) $group['can_be_edited'] = $data['my_chat_member']['new_chat_member']['can_be_edited'];
        if (isset($data['my_chat_member']['new_chat_member']['can_be_edited'])) $group['can_manage_chat'] = $data['my_chat_member']['new_chat_member']['can_manage_chat'];
        if (isset($data['my_chat_member']['new_chat_member']['can_change_info'])) $group['can_change_info'] = $data['my_chat_member']['new_chat_member']['can_change_info'];
        if (isset($data['my_chat_member']['new_chat_member']['can_delete_messages'])) $group['can_delete_messages'] = $data['my_chat_member']['new_chat_member']['can_delete_messages'];
        if (isset($data['my_chat_member']['new_chat_member']['can_invite_users'])) $group['can_invite_users'] = $data['my_chat_member']['new_chat_member']['can_invite_users'];
        if (isset($data['my_chat_member']['new_chat_member']['can_restrict_members'])) $group['can_restrict_members'] = $data['my_chat_member']['new_chat_member']['can_restrict_members'];
        if (isset($data['my_chat_member']['new_chat_member']['can_pin_messages'])) $group['can_pin_messages'] = $data['my_chat_member']['new_chat_member']['can_pin_messages'];
        if (isset($data['my_chat_member']['new_chat_member']['can_manage_topics'])) $group['can_manage_topics'] = $data['my_chat_member']['new_chat_member']['can_manage_topics'];
        if (isset($data['my_chat_member']['new_chat_member']['can_promote_members'])) $group['can_promote_members'] = $data['my_chat_member']['new_chat_member']['can_promote_members'];
        if (isset($data['my_chat_member']['new_chat_member']['can_manage_video_chats'])) $group['can_manage_video_chats'] = $data['my_chat_member']['new_chat_member']['can_manage_video_chats'];
        if (isset($data['my_chat_member']['new_chat_member']['is_anonymous'])) $group['is_anonymous'] = $data['my_chat_member']['new_chat_member']['is_anonymous'];
        if (isset($data['my_chat_member']['new_chat_member']['can_manage_voice_chats'])) $group['can_manage_voice_chats'] = $data['my_chat_member']['new_chat_member']['can_manage_voice_chats'];
//        $this->group = $group;
        return $group;
    }

}
