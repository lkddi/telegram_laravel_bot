第一次写项目：就命名为小不点机器人（Telegram bot php）

一个Telegram 机器人项目，后台使用php语言最优秀的框架Laravel 9

由于是业余编程，在很多地方还有不足尽情指点。

沟通群 https://t.me/xiaobudian_group

#### 目前实现功能：

1. 加群验证
2. 机器人消息自动删除
3. 群内成员登记与统计
4. 群聊天内容记录


按照步骤：
##### 下载源码
##### 安装依赖包

```php
composer install
```

接下来是通用的 Laravel 项目初始化动作：

###### 1.复制环境文件：

```php
$ cp .env.example .env
```

以下注意修改

```
APP_ENV=production  #线上模式
APP_URL=https   #你的https 网址

```

######  2.生成秘钥：

```php
$ php artisan key:generate
$ php artisan jwt:secret
```

###### 3.初始化数据库：

```php
  php artisan admin:install
  php artisan db:seed --class=AdminMenu
```

###### 4.登录后台进行Bot设置

