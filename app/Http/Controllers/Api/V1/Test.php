<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Response;
use App\Plugins\Telegram\Services\Callback_query;
use App\Services\TelegramService;
use App\Services\TUserService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class Test
{

    public function index()
    {








        /**
         * Send text messages.
         *
         * <code>
         * $params = [
         *       'chat_id'                     => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
         *       'text'                        => '',  // string     - Required. Text of the message to be sent
         *       'parse_mode'                  => '',  // string     - (Optional). Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
         *       'entities'                    => '',  // array      - (Optional). List of special entities that appear in the caption, which can be specified instead of parse_mode
         *       'disable_web_page_preview'    => '',  // bool       - (Optional). Disables link previews for links in this message
         *       'protect_content'             => '',  // bool       - (Optional). Protects the contents of the sent message from forwarding and saving
         *       'disable_notification'        => '',  // bool       - (Optional). Sends the message silently. iOS users will not receive a notification, Android users will receive a notification with no sound.
         *       'reply_to_message_id'         => '',  // int        - (Optional). If the message is a reply, ID of the original message
         *       'allow_sending_without_reply' => '',  // bool       - (Optional). Pass True, if the message should be sent even if the specified replied-to message is not found
         *       'reply_markup'                => '',  // object     - (Optional). One of either InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
         * ]
         * </code>
         */
        $c = [
            [
                'text' => 'Try me',
                'url' => 'https://t.me/Meteor2022_bot?start=verification_v1_-1001244922484'
            ],
            [
                'text' => '点我返回进行验证',
                'callback_data' => 'verification'
            ],
            [
                'text' => '2323',
                'callback_data' => '221323'
            ]
        ];

        $a = ['inline_keyboard' => array($c)];
        $markup = json_encode($a, true);
        $params = [
            'chat_id' => '-1001351283013',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
            'text' => '[lkddi](tg://user?id=690564235) cfdfdfdfdfd',  // string     - Required. Text of the message to be sent
            'parse_mode' => 'Markdown',  // string     - (Optional). Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
            'entities' => '',  // array      - (Optional). List of special entities that appear in the caption, which can be specified instead of parse_mode
            'disable_web_page_preview' => '',  // bool       - (Optional). Disables link previews for links in this message
            'protect_content' => '',  // bool       - (Optional). Protects the contents of the sent message from forwarding and saving
            'disable_notification' => '',  // bool       - (Optional). Sends the message silently. iOS users will not receive a notification, Android users will receive a notification with no sound.
            'reply_to_message_id' => '',  // int        - (Optional). If the message is a reply, ID of the original message
            'allow_sending_without_reply' => '',  // bool       - (Optional). Pass True, if the message should be sent even if the specified replied-to message is not found
            'reply_markup' => json_encode($a, true),  // object     - (Optional). One of either InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
        ];
//        https://t.me/policr_mini_bot?start=verification_v1_-1001244922484
//https://t.me/kelecloud3/524039
//        https://t.me/kelecloud3/524062
//        https://t.me/nonoad/3891042 https://t.me/nonoad/3891042
//        https://t.me/NIeai_me/330
//        https://t.me/Meteor2022_bot?start=verification_v1_-1001244922484
//        return Telegram::sendMessage($params);
$a =array (
    'update_id' => 379527237,
    'chat_member' =>
        array (
            'chat' =>
                array (
                    'id' => -1001220014630,
                    'title' => '测试群-禁菠菜，博彩，棋牌，推广，网赚，bc, qp,wz, 等的广告',
                    'username' => 'nonoad',
                    'type' => 'supergroup',
                ),
            'from' =>
                array (
                    'id' => 5935938345,
                    'is_bot' => false,
                    'first_name' => 'Brandon',
                    'last_name' => 'Romani',
                    'username' => 'lambs_1819',
                ),
            'date' => 1669734853,
            'old_chat_member' =>
                array (
                    'user' =>
                        array (
                            'id' => 5935938345,
                            'is_bot' => false,
                            'first_name' => 'Brandon',
                            'last_name' => 'Romani',
                            'username' => 'lambs_1819',
                        ),
                    'status' => 'left',
                ),
            'new_chat_member' =>
                array (
                    'user' =>
                        array (
                            'id' => 5935938345,
                            'is_bot' => false,
                            'first_name' => 'Brandon',
                            'last_name' => 'Romani',
                            'username' => 'lambs_1819',
                        ),
                    'status' => 'member',
                ),
        ),
    'access_token' => 'c35459f962a5fa4c5c04a3f6ae920025',
);
$a=array (
    'update_id' => 379527923,
    'callback_query' =>
        array (
            'id' => '2965950806588214605',
            'from' =>
                array (
                    'id' => 690564235,
                    'is_bot' => false,
                    'first_name' => 'liu',
                    'last_name' => 'xing',
                    'username' => 'lkddi',
                    'language_code' => 'zh-hans',
                ),
            'message' =>
                array (
                    'message_id' => 3891042,
                    'from' =>
                        array (
                            'id' => 5755546557,
                            'is_bot' => true,
                            'first_name' => '小不点_👽',
                            'username' => 'Meteor2022_bot',
                        ),
                    'chat' =>
                        array (
                            'id' => -1001220014630,
                            'title' => '测试群-禁菠菜，博彩，棋牌，推广，网赚，bc, qp,wz, 等的广告',
                            'username' => 'nonoad',
                            'type' => 'supergroup',
                        ),
                    'date' => 1669742241,
                    'text' => '欢迎新用戶 Пегасий ，请点下方按钮进行入群验证，有效时间300秒。',
                    'entities' =>
                        array (
                            0 =>
                                array (
                                    'offset' => 6,
                                    'length' => 7,
                                    'type' => 'text_mention',
                                    'user' =>
                                        array (
                                            'id' => 5824834292,
                                            'is_bot' => false,
                                            'first_name' => 'Пегасий',
                                            'username' => 'Pegasij6',
                                        ),
                                ),
                        ),
                    'reply_markup' =>
                        array (
                            'inline_keyboard' =>
                                array (
                                    0 =>
                                        array (
                                            0 =>
                                                array (
                                                    'text' => '点我进行验证',
                                                    'callback_data' => 'verification',
                                                ),
                                        ),
                                ),
                        ),
                ),
            'chat_instance' => '5280838355082671676',
            'data' => 'verification',
        ),
    'access_token' => 'c35459f962a5fa4c5c04a3f6ae920025',
);

//$c= new Callback_query();
//$c->handle($a);
//dd($a);

//return checkAdmin('-1001351283013','690564235');

        $Tuser = new TUserService();
//        return $Tuser->restrictChatMember('-1001220014630','5814176022',1);
//        return $Tuser->restrictChatMember('-1001351283013','1778698478',false);


$a = 'Tacos are great!1.nidf=dfdfdf- dfdfe3+';
        $string = Str::of($a)
            ->swap([
                '.' => '\\.',
                '+' => '\\+',
                '-' => '\\-',
                '=' => '\\=',
                '[' => '\\[',
                '`' => '\\`',
            ]);
dd($string);
// Burritos are fantastic!
    }

}
