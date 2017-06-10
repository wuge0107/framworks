<?php
    return [
        'APP_DEBUG'         => true,                                //是否开启debug
        'APP_LOG'           => false,                                //是否开启日志

        'CONTROLLER_DEFAULT'=> 'Index',                             //默认控制器
        'ACTION_DEFAULT'    => 'index',                             //默认方法
        'DEFAULT_TIMEZONE'  => 'PRC',                               //默认时区
        'CONTROLLER_PATH'   => APP_PATH.'controllers' ,             //控制器存放目录
        'VIEWS_PATH'        => APP_PATH.'views',                    //视图存放目录
        'CSS_PATH'          => __ROOT__.'/app/public/css/',         //css文件存放目录
        'JS_PATH'           => __ROOT__.'/app/public/js/',          //js存放目录
        'IMG_PATH'          => __ROOT__.'/app/public/img/',         //图片资源存放目录

        'TEMPLATE_CACHE_PATH' => CORE_PATH.'cache/',                //模版缓存路径
    ];
