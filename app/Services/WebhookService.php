<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Webhook;

class WebhookService
{
    protected $data;
    public function add($data)
    {
        $this->data = $data;
        if(!isset($data->update_id)) return;
        $webhook = new Webhook();
        $webhook->update_id = $data->update_id;
        if (isset($data->message)) {
            $webhook->type = 'message';
            $webhook->content = $data->message;
            $webhook->chat_id = $data->message->chat->id;
            $webhook->chat = $data->message->chat;
            $webhook->from_id = $data->message->from->id;
            $webhook->from = $data->message->from;
            return true;
        } elseif (isset($data->edited_message)) {
            $webhook->type = 'edited_message';
            $webhook->content = $data->edited_message;
            $webhook->chat_id = $data->edited_message->chat->id;
            $webhook->chat = $data->edited_message->chat;
            $webhook->from_id = $data->edited_message->from->id;
            $webhook->from = $data->edited_message->from;
            return true;
        } elseif (isset($data->my_chat_member)) {
            $webhook->type = 'my_chat_member';
            $webhook->content = $data->my_chat_member;
            $webhook->chat_id = $data->my_chat_member->chat->id;
            $webhook->chat = $data->my_chat_member->chat;
            $webhook->from_id = $data->my_chat_member->from->id;
            $webhook->from = $data->my_chat_member->from;
        } elseif (isset($data->callback_query)) {
            $webhook->type = 'callback_query';
            $webhook->content = $data->callback_query;
            $webhook->chat_id = $data->callback_query->chat->id;
            $webhook->chat = $data->callback_query->chat;
            $webhook->from_id = $data->callback_query->from->id;
            $webhook->from = $data->callback_query->from;
            return true;
        } elseif (isset($data->chat_member)) {
            $webhook->type = 'chat_member';
            $webhook->content = $data->chat_member;
            $webhook->chat_id = $data->chat_member->chat->id;
            $webhook->chat = $data->chat_member->chat;
            $webhook->from_id = $data->chat_member->from->id;
            $webhook->from = $data->chat_member->from;
        } elseif (isset($data->chat_join_request)) {
            $webhook->type = 'chat_join_request';
            $webhook->content = $data->chat_join_request;
            $webhook->chat_id = $data->chat_join_request->chat->id;
            $webhook->chat = $data->chat_join_request->chat;
            $webhook->from_id = $data->chat_join_request->from->id;
            $webhook->from = $data->chat_join_request->from;
        } else {
            $webhook->type = '';
            $webhook->content = $data;
        }

        $web = Webhook::where('update_id', $data->update_id)->first();
        if (!$web) {
            $webhook->save();
        }else{
            \Log::info(json_decode(json_encode($data), true));
        }

//        Webhook::updateOrCreate();
        if ($webhook->chat_id != $webhook->from_id){
            GroupService::new($webhook->chat);
        }
        return true;
    }
}
