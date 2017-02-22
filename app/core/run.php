<?php

define('DS' , DIRECTORY_SEPARATOR );
define('CORE_PATH', APP_ROOT_PATH.'/core'.DS);
define('APP_PATH', APP_ROOT_PATH.'/app'.DS);
define('CONFIG_PATH',APP_ROOT_PATH.'/app/config'.DS);
define('DRIVECONTROLLER_PATH','\\'.'core\lib\drive\log\\');

include CORE_PATH.'/common/function.php';

define('VIEWS_PATH',env('VIEWS_PATH'));
define('APP_DEBUG',env('APP_DEBUG'));
define('APP_LOG', env('APP_LOG'));
define('CONTROLLER_PATH', env('CONTROLLER_PATH'));
define('NEWCONTROLLER_PATH',str_replace('/','\\','\\'.substr(env('CONTROLLER_PATH'),strlen(APP_ROOT_PATH.'\\'))));
define('CSS_PATH', env('CSS_PATH'));
define('JS_PATH' , env('JS_PATH'));
define('IMG_PATH', env('IMG_PATH'));

include APP_ROOT_PATH."/vendor/autoload.php";
//注册错误处理
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

require (CORE_PATH.'Start.php');

spl_autoload_register('\core\Start::load');

if( APP_DEBUG ){
    ini_set('display_error','On');
}else{
    ini_set('display_error','Off');
}

return new \core\Start();
