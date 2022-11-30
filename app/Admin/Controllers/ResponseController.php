<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Response;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ResponseController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Response(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('message_id');
            $grid->column('from');
            $grid->column('chat');
            $grid->column('data');
            $grid->column('text');
            $grid->column('deltime');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
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
        return Show::make($id, new Response(), function (Show $show) {
            $show->field('id');
            $show->field('message_id');
            $show->field('from');
            $show->field('chat');
            $show->field('data');
            $show->field('text');
            $show->field('deltime');
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
        return Form::make(new Response(), function (Form $form) {
            $form->display('id');
            $form->text('message_id');
            $form->text('from');
            $form->text('chat');
            $form->text('data');
            $form->text('text');
            $form->text('deltime');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
