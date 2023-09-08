<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\TUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TUserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new TUser(['group']), function (Grid $grid) {
            // 设置初始排序条件
            $grid->model()->orderBy('id', 'desc');

            $grid->column('id')->sortable();
            $grid->column('group.title')->substr(0, 10);
            $grid->column('user_id');
            $grid->column('first_name');
            $grid->column('last_name');
            $grid->column('username');
            $grid->column('state');
//            $grid->column('created_at');
            $grid->column('updated_at')->sortable()->datetime();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('group.title');
                $filter->equal('user_id');
                $filter->equal('first_name');
                $filter->equal('last_name');
                $filter->equal('username');
                $filter->equal('state');

            });
            $grid->quickSearch(['group.title', 'user_id', 'username','first_name']);

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
        return Show::make($id, new TUser(), function (Show $show) {
            $show->field('id');
            $show->field('group_id');
            $show->field('user_id');
            $show->field('first_name');
            $show->field('last_name');
            $show->field('username');
            $show->field('state');
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
        return Form::make(new TUser(), function (Form $form) {
            $form->display('id');
            $form->text('group_id');
            $form->text('user_id');
            $form->text('first_name');
            $form->text('last_name');
            $form->text('username');
            $form->text('state');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
