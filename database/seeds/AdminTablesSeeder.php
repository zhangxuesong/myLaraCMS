<?php

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Encore\Admin\Auth\Database\Menu::truncate();
        Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "created_at" => NULL,
                    "icon" => "fa-bar-chart",
                    "id" => 1,
                    "order" => 1,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "首页",
                    "updated_at" => "2019-07-17 08:53:40",
                    "uri" => "/"
                ],
                [
                    "created_at" => NULL,
                    "icon" => "fa-tasks",
                    "id" => 2,
                    "order" => 7,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "系统设置",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => NULL
                ],
                [
                    "created_at" => NULL,
                    "icon" => "fa-users",
                    "id" => 3,
                    "order" => 8,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "用户管理",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => "auth/users"
                ],
                [
                    "created_at" => NULL,
                    "icon" => "fa-user",
                    "id" => 4,
                    "order" => 9,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "角色管理",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => "auth/roles"
                ],
                [
                    "created_at" => NULL,
                    "icon" => "fa-ban",
                    "id" => 5,
                    "order" => 10,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "权限管理",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => "auth/permissions"
                ],
                [
                    "created_at" => NULL,
                    "icon" => "fa-bars",
                    "id" => 6,
                    "order" => 11,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "菜单管理",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => "auth/menu"
                ],
                [
                    "created_at" => NULL,
                    "icon" => "fa-history",
                    "id" => 7,
                    "order" => 12,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "操作日志",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => "auth/logs"
                ],
                [
                    "created_at" => "2019-07-17 08:54:32",
                    "icon" => "fa-folder-open",
                    "id" => 8,
                    "order" => 2,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "文章管理",
                    "updated_at" => "2019-07-17 09:05:46",
                    "uri" => NULL
                ],
                [
                    "created_at" => "2019-07-17 08:59:18",
                    "icon" => "fa-files-o",
                    "id" => 9,
                    "order" => 3,
                    "parent_id" => 8,
                    "permission" => NULL,
                    "title" => "文章分类",
                    "updated_at" => "2019-07-17 10:37:05",
                    "uri" => "categories"
                ],
                [
                    "created_at" => "2019-07-17 09:04:55",
                    "icon" => "fa-video-camera",
                    "id" => 10,
                    "order" => 4,
                    "parent_id" => 8,
                    "permission" => NULL,
                    "title" => "文章列表",
                    "updated_at" => "2019-07-17 11:20:47",
                    "uri" => "articles"
                ],
            ]
        );

        Encore\Admin\Auth\Database\Permission::truncate();
        Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "created_at" => NULL,
                    "http_method" => "",
                    "http_path" => "*",
                    "id" => 1,
                    "name" => "All permission",
                    "slug" => "*",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => NULL,
                    "http_method" => "GET",
                    "http_path" => "/",
                    "id" => 2,
                    "name" => "Dashboard",
                    "slug" => "dashboard",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => NULL,
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout",
                    "id" => 3,
                    "name" => "Login",
                    "slug" => "auth.login",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => NULL,
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting",
                    "id" => 4,
                    "name" => "User setting",
                    "slug" => "auth.setting",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => NULL,
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
                    "id" => 5,
                    "name" => "Auth management",
                    "slug" => "auth.management",
                    "updated_at" => NULL
                ]
            ]
        );

        Encore\Admin\Auth\Database\Role::truncate();
        Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "created_at" => "2019-07-17 07:34:59",
                    "id" => 1,
                    "name" => "Administrator",
                    "slug" => "administrator",
                    "updated_at" => "2019-07-17 07:34:59"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "created_at" => NULL,
                    "menu_id" => 2,
                    "role_id" => 1,
                    "updated_at" => NULL
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "created_at" => NULL,
                    "permission_id" => 1,
                    "role_id" => 1,
                    "updated_at" => NULL
                ]
            ]
        );

        // finish
    }
}
