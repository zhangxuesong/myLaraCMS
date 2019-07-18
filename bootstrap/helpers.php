<?php
/**
 * Created by PhpStorm.
 * User: zhangxuesong
 * Date: 2019/7/17
 * Time: 3:44 PM
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

if( !function_exists('storage_url') ){
    /**
     * 获取文章完整的 URL
     */
    function storage_url($path){
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}

if( !function_exists('storage_image_url') ){
    /**
     * 获取图片完整 URL
     */
    function storage_image_url($path){
        return !empty($path) ? storage_url($path) : config('app.url') . '/images/pic-none.png';
    }
}