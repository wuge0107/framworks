<?php

if(version_compare(PHP_VERSION,'5.5.0','<'))die('require PHP > 5.5.0 !');

define('BASEPATH','SYSTEM'.rand(1,99999));

define('APP_ROOT_PATH',dirname( __FILE__ ));

$app = require_once( APP_ROOT_PATH.'/core/run.php');
//框架初始化
$app::run();

