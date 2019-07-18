##安装说明：
更新代码
`git clone https://github.com/zhangxuesong/jkzgcyw.git`
配置虚拟环境
修改本地配置
`cp .env.example .env`
安装依赖包
`composer install`
生成应用 key
`php artisan key:generate`
创建数据库并执行迁移
`php artisan migrate`
如果出现 ` ReflectionException  : Class AdminTablesSeeder does not exist` 报错
执行 `composer dump-autoload` 后再执行  `php artisan db:seed` 
创建管理员账户
`php artisan admin:create-user`
