<?php
namespace core;

use core\lib\log;

defined('BASEPATH') OR exit('No direct script access allowed');

class Start
{
    /**
     * @var array
     */
    public static $classMap=array();

    /**
     * Start constructor.
     */
    public function __construct()
    {
        if(DEBUG) {
            $whoops = new \Whoops\Run;
            $errorTitle = "框架出现错误了";
            $option = new \Whoops\Handler\PrettyPageHandler();
            $option->setPageTitle($errorTitle);
            $whoops->pushHandler($option);
            $whoops->register();
            ini_set('display_error', 'On');
        }else{
            ini_set('display_error', 'Off');
        }
    }

    /**
     * 框架启动类
     * @throws \Exception
     */
    static public function run()
    {
        //日志初始化
        LOG ? log::init():false;
        $route = new \core\lib\route();
        $ctrlClass = $route::$ctrl;
        $action = $route::$action;
        //文件
        $ctrlfile  = CONTROLLER.'/'.ucfirst($ctrlClass).'.php';
        //类名
        $ctrlClass = NEWCONTROLLER.$ctrlClass;
        //文件是否存在
        if(is_file($ctrlfile)){
            include $ctrlfile;
            //判断类是否存在
            if(class_exists($ctrlClass)) {
                $ctrl = new $ctrlClass();
            }else{
                if(DEBUG){
                    throw new \Exception('在这个控制器中找不到这个'.$ctrlClass.'类');
                }else{
                    include VIEWS.'/error/error.html';
                }
            }
            //类中的方法是否存在
            if(method_exists($ctrl,$action)){
                $ctrl->$action(); exit();
            }elseif(DEBUG==false){
                include VIEWS.'/error/error.html';
            }else{
                $arr = explode('\\',$ctrlClass);
                throw new \Exception('在这个'.end($arr).'控制器中找不到这个'.$action.'方法');
            }
            //写入配置文件中
            LOG ? log::log('controller:'.$ctrlClass.'    '.'action:'.$action) : false;
        }else{
            if(DEBUG==false){
                $arr = explode('\\',$ctrlClass);
                throw new \Exception('找不到控制器'.end($arr));
            }else{
                include VIEWS.'/error/error.html';
            }
        }
    }

    /**
     * 自动加载类
     * @param $class
     * @return bool
     */
    static public function load($class)
    {
        if(isset($classMap[$class])){
            return true;
        }else{
            $class = str_replace('\\','/',$class);
            $file = BLOG.'/'.$class.'.php';
            if(is_file($file)){
                include $file;
                self::$classMap[$class]=$class;
            }else{
                return false;
            }
        }
    }

}