<?php
return [
    'APP_DEBUG'           => true, //是否开启debug
    'APP_LOG'             => false, //是否开启日志

    'CONTROLLER_DEFAULT'  => 'Index', //默认控制器
    'ACTION_DEFAULT'      => 'index', //默认方法
    'DEFAULT_TIMEZONE'    => 'PRC', //默认时区
    'CONTROLLER_PATH'     => APP_PATH . 'controllers', //控制器存放目录
    'VIEWS_PATH'          => APP_PATH . 'views', //视图存放目录

    'IMG_PATH'            => APP_ROOT_PATH . '/static/img',
    'TEMPLATE_CACHE_PATH' => CORE_PATH . 'cache/', //模版缓存路径
];
