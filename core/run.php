<?php

define('DS', DIRECTORY_SEPARATOR); //目录分隔符 为兼容liunx系统
define('CORE_PATH', APP_ROOT_PATH . '/core' . DS); //核心目录
define('APP_PATH', APP_ROOT_PATH . '/app' . DS); //项目
define('CONFIG_PATH', APP_ROOT_PATH . '/app/config' . DS); //配置文件
define('DRIVECONTROLLER_PATH', '\\' . 'core\lib\drive\log\\'); //日志类命名空间

include CORE_PATH . '/common/function.php'; //公共函数库

define('TEMPLATE_CACHE_PATH', env('TEMPLATE_CACHE_PATH')); //模版缓存文件存放目录
define('VIEWS_PATH', env('VIEWS_PATH')); //视图文件存放目录
define('APP_DEBUG', env('APP_DEBUG')); //debug模式
define('APP_LOG', env('APP_LOG')); //日志
define('CONTROLLER_PATH', env('CONTROLLER_PATH')); //控制器路径
define('NEWCONTROLLER_PATH', str_replace('/', '\\', '\\' . substr(env('CONTROLLER_PATH'), strlen(APP_ROOT_PATH . '\\')))); //控制器命名空间

date_default_timezone_set(env('DEFAULT_TIMEZONE')); //设置时区

include APP_ROOT_PATH . "/vendor/autoload.php";

//注册错误信息的处理
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

APP_DEBUG ? ini_set('display_error', 'On') : ini_set('display_error', 'Off');

include CORE_PATH . 'Start.php'; //引入初始化类
spl_autoload_register('\core\Start::load'); //注册__autoload()函数
return new \core\Start();
