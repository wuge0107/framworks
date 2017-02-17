<?php

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.5.0','<'))  die('require PHP > 5.5.0 !');

define('BASEPATH','system');  //入口文件常量
define('BLOG',str_replace('\\','/',dirname(realpath(__FILE__))));
define('CORE', BLOG.'/core');
define('APP', BLOG.'/app');
define('CONFIG',CORE.'/config');
define('VIEWS',APP.'/views');
define('CONTROLLER',APP.'/controller');
define('NEWCONTROLLER','\\'.'app'.'\controller\\');
define('DRIVECONTROLLER','\\'.'core\lib\drive\log\\');

define('DEBUG', true);// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('LOG',false); //是否开启日志

include "vendor/autoload.php";
include CORE.'/common/function.php';

include CORE.'/Start.php';
//注册类
spl_autoload_register('\core\Start::load');

//框架初始化
\core\Start::run();
# ------->>>>>> 已经发车了 后面写代码没用了 <<<<<<----------