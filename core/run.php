<?php

define('DS' , DIRECTORY_SEPARATOR );
define('CORE_PATH', APP_ROOT_PATH.'/core'.DS);
define('APP_PATH', APP_ROOT_PATH.'/app'.DS);
define('CONFIG_PATH',APP_ROOT_PATH.'/app/config'.DS);
define('DRIVECONTROLLER_PATH','\\'.'core\lib\drive\log\\');

include APP_ROOT_PATH."/vendor/autoload.php";
include CORE_PATH.'/common/function.php';

//注册错误处理
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

require (CORE_PATH.'Start.php');

spl_autoload_register('\core\Start::load');

$conf = new \core\lib\conf();

define('VIEWS_PATH',$conf->get('app','VIEWS_PATH'));
define('APP_DEBUG' ,$conf->get('app','APP_DEBUG'));
define('APP_LOG', $conf->get('app','APP_LOG'));
define('CONTROLLER_PATH', $conf->get('app','CONTROLLER_PATH'));
define('NEWCONTROLLER_PATH',str_replace('/','\\','\\'.substr($conf->get('app','CONTROLLER_PATH'),strlen(APP_ROOT_PATH.'\\'))));
define('CSS_PATH', $conf->get('app','CSS_PATH'));
define('JS_PATH' , $conf->get('app','JS_PATH'));
define('IMG_PATH', $conf->get('app','IMG_PATH'));

if( APP_DEBUG ){
    ini_set('display_error','On');
}else{
    ini_set('display_error','Off');
}

return new \core\Start();
