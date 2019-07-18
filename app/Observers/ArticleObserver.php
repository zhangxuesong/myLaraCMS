<?php
/**
 * Created by PhpStorm.
 * User: zhangxuesong
 * Date: 2019/7/17
 * Time: 8:31 PM
 */
namespace App\Observers;

use App\Models\Article;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function saving(Article $article)
    {
        // XSS 过滤
        $article->body = clean($article->body, 'article_body');

        // 生成话题摘录
        $article->excerpt = make_excerpt($article->body);
    }

    public function saved(Article $article)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $article->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($article));
        }
    }
}