<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Group;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class GroupController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Group(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('chat_id');
            $grid->column('title')->substr(0, 10);
            $grid->column('username');
            $grid->column('type')->using(['supergroup' => '超级群', 'group' => '普通群', 'private'=>'私密群']);
//            $grid->column('status')->using(['administrator' => '未处理', 2 => '已处理']);
            $grid->column('open')->bool();
            $grid->column('passedconut');
//            $grid->column('created_at');
            $grid->column('updated_at')->sortable()->datetime();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('chat_id');
                $filter->equal('title');
                $filter->equal('username');

            });

            $grid->quickSearch(['title', 'chat_id', 'username','type']);

        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Group(), function (Show $show) {
            $show->field('id');
            $show->field('chat_id');
            $show->field('title');
            $show->field('username');
            $show->field('type');
            $show->field('status');
            $show->field('open');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Group(), function (Form $form) {
            $form->display('id');
            $form->text('chat_id');
            $form->text('title');
            $form->text('username');
            $form->text('type');
            $form->text('status');
            $form->text('open');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
