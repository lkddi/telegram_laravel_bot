<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Widgets\Tab;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\VarDumper;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetBotController extends Controller
{
//    use PreviewCode;
    public function index(Content $content)
    {
        if (request()->getMethod() == 'POST') {
            $content->row(Box::make('POST', $this->dump(request()->all()))->style('default'));
        }
        $content->row(function (Row $row) {
            $type = request('_t', 1);
            $tab = new Tab();
            $tab->add('基础设置', $this->form1());

            $row->column(12, $tab->withCard());
        });
        return $content
            ->header('Bot设置');
    }

    protected function form1()
    {
        if (config('telegram.bots.mybot.webhook_url') !== "") {
            $url = config('telegram.bots.mybot.webhook_url');
        } else {
            $url = $webhook_url = config('app.url') . 'api/v1/telegram/webhook?access_token=' . md5(config('telegram.bots.mybot.token'));
        }

        $form = new Form();
        $form->action(request()->fullUrl());
        $form->text('form1.APP_NAME', '网站名称')->default(config('app.name'));
        $form->text('form1.APP_URL', '网站url')->default(config('app.url'));
        $form->text('form1.APP_ENV', '站点状态')->default(config('app.env','production'));
        $form->switch('form1.APP_DEBUG', '调试模式')->default(config('app.debug',false));
//        $form->text('form1.APP_URL', 'Telegram bot Token')->default(config('app.url'));
        $form->text('form1.TELEGRAM_BOT_TOKEN', 'Telegram bot Token')->default(config('telegram.bots.mybot.token'));
        $form->text('form1.TELEGRAM_ADMIN_ID', '你的userid')->default(config('telegram.bots.mybot.admin'));
        $form->text('form1.TELEGRAM_WEBHOOK_URL', '你的userid')->default($url);
        $form->switch('form1.TELEGRAM_GROUP_NOTICE', '入群通知你')->default(config('telegram.bots.mybot.notice'));
        $form->number('form1.TELEGRAM_DELTIME', '消息删除时间')->default(config('telegram.bots.mybot.deltime'));
        $form->switch('form1.TELEGRAM_GROUP_OPEN', '新群开启接管')->default(config('telegram.bots.mybot.open'));
        return "<div style='padding:10px 8px'>{$form->render()}</div>";
    }

    protected function dump($content)
    {
        VarDumper::setHandler(function ($data) {
            $cloner = new VarCloner();
            $dumper = new HtmlDumper();
            $dumper->dump($cloner->cloneVar($data));
        });
        ob_start();
        VarDumper::dump($content);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    // 处理表单提交请求
    public function store()
    {
//        $this->dump(request()->get('form1'));
//        Log::info(request()->get('form1'));
        $form =request()->get('form1');
        aseditEnv(request()->get('form1'));
        $data = [
            'status' => true,
            'data' => [
                'message' => '保存成功',
                'type' => 'success'
            ]
        ];
        $params=[
            'url'=>$form['TELEGRAM_WEBHOOK_URL'],
            'max_connections'=>50,
            'allowed_updates'=>["message", "edited_message","channel_post","edited_channel_post", "inline_query","chosen_inline_result","callback_query","shipping_query","pre_checkout_query","poll","poll_answer","my_chat_member","chat_member","chat_join_request"]
        ];
        $req = Telegram::setWebhook($params);
        if (!$req){
            $data['status'] =false;
            $data['data']['message'] ='接口设置失败';
            $data['data']['type'] ='fail';
        }
        return response($data);
//        return response('1');
//        return response()->success('Processed successfully.')->refresh();
    }

}
