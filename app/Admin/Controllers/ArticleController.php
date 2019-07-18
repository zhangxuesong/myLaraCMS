<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Handlers\SlugTranslateHandler;
use Illuminate\Support\Facades\Auth;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);

        $grid->column('id', __('Id'));
        $grid->column('category_id', __('Category id'))->display(function($value){
            return Category::find($value)->name;
        });;
        $grid->column('title', __('Title'));
        $grid->column('excerpt', __('Excerpt'));
        $grid->column('slug', __('Slug'));
//        $grid->column('body', __('Body'));
        $grid->column('view_count', __('View count'));
//        $grid->column('order', __('Order'));

//        $grid->column('image', __('Image'));
        $grid->column('top', __('Top'))->display(function ($value) {
            return $value ? '是' : '否';
        });;
        $grid->column('user_id', __('User id'))->display(function($value){
            $userModel = config('admin.database.users_model');
            return $userModel::find($value)->name;
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function($filter){
            $filter->expand();
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->column(1/2, function ($filter) {
                // 在这里添加字段过滤器
                if(!request()->category_id){
                    $filter->equal('category_id', __('Category id'))->select(Category::all()->pluck('name', 'id'));
                }

                $filter->like('excerpt', __('Excerpt'));
            });
            $filter->column(1/2, function ($filter) {
                // 在这里添加字段过滤器
                $filter->like('title', __('Title'));
                $userModel = config('admin.database.users_model');
                $filter->equal('user_id', __('User id'))->select($userModel::all()->pluck('name', 'id'));
            });

        });
        $grid->disableExport();

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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'))->as(function($value){
            return Category::find($value)->name;
        });
        $show->field('title', __('Title'));
        $show->field('excerpt', __('Excerpt'));
        $show->field('slug', __('Slug'));
        $show->field('image', __('Image'))->image();
        $show->field('body', __('Body'))->unescape();
        $show->field('user_id', __('User id'))->as(function($value){
            $userModel = config('admin.database.users_model');
            return $userModel::find($value)->name;
        });
        $show->field('view_count', __('View count'));
//        $show->field('order', __('Order'));
        $show->field('top', __('Top'))->using(['1' => '是', '0'=> '否']);
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
        $form = new Form(new Article);

        $form->select('category_id', __('Category id'))->options(Category::all()->pluck('name', 'id'))->rules('required');
        $form->text('title', __('Title'))->rules('required');
        $form->image('image', __('Image'))->rules('image');
        $form->UEditor('body', __('Body'))->rules('required');
//        $form->number('user_id', __('User id'));
//        $form->number('view_count', __('View count'));
//        $form->number('order', __('Order'));
//        $form->textarea('excerpt', __('Excerpt'));
//        $form->text('slug', __('Slug'));
        $form->switch('top', __('Top'))->options(['1' => '是', '0'=> '否'])->default('0');;
        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $user = Auth::guard('admin')->user();
            $form->model()->user_id = $user->id;
            // XSS 过滤
            $form->model()->body = clean($form->body, 'article_body');

            // 生成话题摘录
            $form->model()->excerpt = make_excerpt($form->body);
            // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
            if ( ! $form->slug) {
                $form->model()->slug = app(SlugTranslateHandler::class)->translate($form->title);
            }
        });

        return $form;
    }
}
