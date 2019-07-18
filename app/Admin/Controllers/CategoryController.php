<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('post_count', __('Post count'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // 不在页面显示 `新建` 按钮，因为我们不需要在后台新建用户
        // $grid->disableCreateButton();

        $grid->disableFilter();
        $grid->disableExport();

//        $grid->actions(function ($actions) {
//            // 不在每一行后面展示查看按钮
//            $actions->disableView();
//            // 不在每一行后面展示删除按钮
//            // $actions->disableDelete();
//            // 不在每一行后面展示编辑按钮
//            // $actions->disableEdit();
//        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('post_count', __('Post count'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));

        $form->saving(function (Form $form) {
            $user = Auth::guard('admin')->user();
            $form->model()->created_op = $user->id;
        });

        return $form;
    }
}
