<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\TAdminUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TAdminUserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new TAdminUser(['group']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('group.title');
            $grid->column('user_id');
            $grid->column('first_name');
            $grid->column('last_name');
            $grid->column('username');
            $grid->column('status');
//            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new TAdminUser(), function (Show $show) {
            $show->field('id');
            $show->field('group_id');
            $show->field('user_id');
            $show->field('first_name');
            $show->field('last_name');
            $show->field('username');
            $show->field('status');
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
        return Form::make(new TAdminUser(), function (Form $form) {
            $form->display('id');
            $form->text('group_id');
            $form->text('user_id');
            $form->text('first_name');
            $form->text('last_name');
            $form->text('username');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
