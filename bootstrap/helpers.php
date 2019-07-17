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