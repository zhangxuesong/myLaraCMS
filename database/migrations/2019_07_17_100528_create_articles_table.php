<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('标题');
            $table->text('body')->comment('内容');
            $table->integer('user_id')->unsigned()->index()->comment('创建者ID');
            $table->integer('category_id')->unsigned()->index()->comment('分类ID');
            $table->integer('view_count')->unsigned()->default(0)->comment('查看总数');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
            $table->text('excerpt')->nullable()->comment('文章摘要，SEO 优化时使用');
            $table->string('slug')->nullable()->comment('SEO 友好的 URI');
            $table->string('image')->nullable()->comment('封面');
            $table->boolean('top')->default(false)->comment('置顶');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
