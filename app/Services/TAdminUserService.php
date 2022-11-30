<?php

namespace App\Services;

use App\Models\Group;
use App\Models\TAdminUser;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\This;
use Telegram\Bot\Laravel\Facades\Telegram;

class TAdminUserService
{
    public function updateAdmin(string $chatId)
    {
        $admins = Telegram::getChatAdministrators([
            'chat_id' => $chatId
        ]);
        //先删除所有管理员信息
        $groups = Group::where('chat_id', $chatId)->first()->admin()->delete();
        $user = [];
        foreach ($admins as $key => $admin) {
            $admin = json_decode(json_encode($admin), true);
            if (!$admin['user']['is_bot']) {
                $user = $admin['user'];
                $user['user_id'] = $admin['user']['id'];
                $user['status'] = $admin['status'];
                $user['group_id'] = $chatId;
                unset($user['id']);
                unset($user['is_bot']);
                unset($user['language_code']);
                $this->update($user);
            }
        }
    }

    public function update(array $data)
    {
        $group = Group::where('chat_id', $data['group_id'])->first();
        if ($group) {
            unset($data['group_id']);
            $chat = $group->admin()->updateOrCreate(['user_id' => $data['user_id']], $data);
        }
        return true;
    }

}
