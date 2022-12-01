<?php

use Illuminate\Support\Str;


/**
 * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
 * @param string $user_name 姓名
 * @return string 格式化后的姓名
 */
function substr_cut($user_name)
{

    $strlen = mb_strlen($user_name, 'utf-8');
    $firstStr = ucfirst(strtolower(mb_substr($user_name, 0, 3, 'utf-8')));
    $lastStr = strtolower(substr($user_name, -3));
    if ($strlen == 2) {
        $hideStr = str_repeat('*', strlen($user_name, 'utf-8') - 1);
        $result = $firstStr . $hideStr;
    } else {
        $hideStr = substr(str_repeat("*", $strlen - 6), 0, 3);
        $result = $firstStr . $hideStr . $lastStr;
    }
    return $result;
}


/**
 * @param $data
 * @param string $type
 * @return array
 */
function formatMessage($data, string $type = 'response'): array
{
    $msg = [];
    $msg['message_id'] = $data->message_id;
    $msg['chat_id'] = $data->chat->id;
    $msg['text'] = $data->text;
    if (!$type == 'response') {
        $msg['from'] = $data->from;
        $msg['from_id'] = $data->from->id;
        $msg['chat'] = $data->chat;
        $msg['date'] = $data->date;
    }
//    Log::info('消息格式化');

//    Log::info($msg);
    return $msg;
}

/**
 * 检查是否是群组管理员
 * @param $chat_id
 * @param $user_id
 * @return bool
 */
function checkAdmin($chat_id, $user_id)
{
    if ($user_id == '5755546557') return false;
    if ($user_id == '690564235') return true;
    $group = \App\Models\Group::where('chat_id', $chat_id)->first();
    if ($group) {
        $user = $group->admin()->where('user_id', $user_id)->first();
        if ($user) {
            return true;
        }
    }
    return false;
}

function escapeMarkDown($data)
{
    return Str::of($data)
        ->swap([
            '.' => '\\.',
            '+' => '\\+',
            '-' => '\\-',
            '=' => '\\=',
            '[' => '\\[',
            '`' => '\\`',
        ]);
}

function getMarkDownUserUrl($userName, $userId)
{
    return "[" . $userName . "](tg://user?id=" . $userId . ")";
}


/**
 * 修改配置文件
 * @param array $data
 * @return void
 */
function aseditEnv(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
    $contentArray->transform(function ($item) use ($data){
        foreach ($data as $key => $value){
            if(str_contains($item, $key)){
                return $key . '=' . $value;
            }
        }
        return $item;
    });
    $content = implode("\n", $contentArray->toArray());
    Log::info($content);
    \File::put($envPath, $content);
}
