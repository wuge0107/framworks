<?php

	if(version_compare(PHP_VERSION,'5.5.0','<'))die('require PHP > 5.5.0 !');//检测php版本

	define('BASEPATH','SYSTEM'.rand(1,99999));//定义首页常量 其它目录会检测这个常量是否定义

	define('APP_ROOT_PATH',dirname( __FILE__ ));//项目根目录

	$app = require(APP_ROOT_PATH.'/core/run.php'); 

	$app->run(); //框架初始化
