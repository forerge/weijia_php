<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


//定义项目目录，域名下为空，如果项目名为mywj,则：define('FORJECT_PATH', '/mywj');
define('PROJECT_PATH', '');
define('SERVER_WEIJIA','http://192.168.2.212:80/www_weijia/public/uploads/');

// [ 应用入口文件 ]
// 定义应用目录
// define('APP_PATH', __DIR__ . '/../application/');
define('APP_PATH', __DIR__ . '/app/');
// 加载框架引导文件
//require __DIR__ . '/../thinkphp/start.php';
require __DIR__ . '/thinkphp/start.php';
