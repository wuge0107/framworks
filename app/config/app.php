<?php
    return array(
        'APP_DEBUG'         => true,                                //是否开启debug
        'APP_LOG'           => true,                                //是否开启日志

        'CONTROLLER_DEFAULT'=> 'Index',                             //默认控制器
        'ACTION_DEFAULT'    => 'index',                             //默认方法

        'CONTROLLER_PATH'   => APP_PATH.'controllers' ,             //控制器存放目录
        'VIEWS_PATH'        => APP_PATH.'views',                    //视图存放目录
        'CSS_PATH'          => APP_PATH.'public/css/',              //css文件存放目录
        'JS_PATH'           => APP_PATH.'public/js/',               //js存放目录
        'IMG_PATH'          => APP_PATH.'public/images/',           //图片资源存放目录
    );