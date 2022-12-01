<?php

namespace App\Http\Controllers\Api\V1;

use App\Plugins\Telegram\Services\Callback_query;
use App\Plugins\Telegram\Services\Chat_member;
use App\Plugins\Telegram\Services\My_chat_member;
use App\Plugins\Telegram\Services\New_chat_member;
use App\Services\ResponseService;
use App\Services\TelegramService;
use App\Services\WebhookService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Response;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    protected $msg;
    protected $commands = [];
    protected $telegramService;
    protected $webhookService;

    public function __construct(Request $request)
    {
        if ($request->input('access_token') !== md5(config('telegram.bots.mybot.token'))) {
            abort(401);
        }
        $this->telegramService = new TelegramService();
        $this->webhookService = new WebhookService();
    }

    public function webhook(Request $request)
    {
        if (isset($request->message)) return true;
        if (isset($request->edited_message)) return true;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/webhook.log'),
        ])->info(json_decode(json_encode($request->input()), true));

//        Telegram::commandsHandler(true);//开启关键字回复
//        $this->webhookService->add(json_decode(json_encode($request->input())));

        $this->formCallback($request->input());

//        $this->formatMessage($request->input());
//        $this->formatChatJoinRequest($request->input());
//        $this->handle();
        return true;
    }


    //按钮消息返回处理
    private function formCallback(array $data)
    {
        //加机器人进群处理
        if (isset($data['my_chat_member']['new_chat_member'])) {
            $calls = new My_chat_member();
            $calls->handle($data);
        }
        //普通用户 进群处理
        if (isset($data['chat_member']['new_chat_member'])) {
            $calls = new Chat_member();
            $calls->handle($data);
        }

        if (isset($data['callback_query'])) {
            $calls = new Callback_query();
            $calls->handle($data);
        }
        if (isset($data['message']) && isset($data['message']['text'])) {
            $keyWord = Str::contains($data['message']['text'], config('keywords.data'));
            if ($keyWord) {
                $s = new \StdClass();
                $s->message_id = $data['message']['message_id'];
                $s->chat_id = $data['message']['chat']['id'];
                $s->text = $data['message']['text'];
//                ResponseService::create($s, 60);
            }
        }
        if (isset($data['edited_message']) && isset($data['edited_message']['text'])) {
            $keyWord = Str::contains($data['edited_message']['text'], config('keywords.data'));
            if ($keyWord) {
                $s = new \StdClass();
                $s->message_id = $data['edited_message']['message_id'];
                $s->chat_id = $data['edited_message']['chat']['id'];
                $s->text = $data['edited_message']['text'];
//                ResponseService::add($s, 60);
            }
        }

    }
}
