<?php
/**
 * @author yangsior@163.com
 */
if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    die('require PHP > 5.5.0 !');
}

define('BASEPATH', 'SYSTEM'); //定义首页常量 其它目录会检测这个常量是否定义

define('APP_ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

$app = require APP_ROOT_PATH . '/core/run.php';

$app->run(); //框架初始化
