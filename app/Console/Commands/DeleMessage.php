<?php

namespace App\Console\Commands;

use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use function PHPUnit\Framework\isEmpty;

class DeleMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时消息删除';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->workPerSec(function () {
            $messages = Response::where('state', 0)->get();
            foreach ($messages as $message) {
                $f = Carbon::now();
                $d = Carbon::parse($message->created_at)->addSecond($message->deltime);
                if ($f->gt($d)) {
                    try {
                        Telegram::deleteMessage(['chat_id' => $message->chat_id, 'message_id' => $message->message_id]);
                    }catch (\Exception $e) {

                    }
                    $message->state = 1;
                    $message->save();
                }
            }
        });

    }

    function workPerSec($callback)
    {
        $startTime = microtime(true) * 1e6;
        while (true) {
            $callback();
            $startTime += 1e6;
            usleep(max($startTime - microtime(true) * 1e6, 0));
        }
    }
}
