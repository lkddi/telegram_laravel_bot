<?php

namespace App\Services;

use App\Models\Group;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\This;
use Telegram\Bot\Laravel\Facades\Telegram;

class GroupService
{


    public function new(array $data)
    {
        $data['open'] = config('telegram.bots.mybot.open');
        $chat = Group::updateOrCreate(['chat_id' => $data['chat_id']], $data);
    }

    public function delGroup(array $data)
    {
        $group = Group::where('chat_id', $data['chat_id'])->delete();
    }

}
