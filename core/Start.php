<?php
namespace core;

use core\lib\log;
use core\lib\route;

defined('BASEPATH') or exit('No direct script access allowed');

class Start
{
    /**
     * @var array
     */
    public static $classMap = array();

    /**
     * Start constructor.
     */
    public function __construct()
    {
        //定义header头
        header("Content-Type:text/html;charset=utf-8");
        if (APP_LOG) {
            //日志初始化
            log::init();
        }
    }

    /**
     * 框架启动类
     * @throws \Exception
     */
    public static function run()
    {
        $route     = new route();
        $ctrlClass = $route->ctrl;
        $action    = $route->action;

        define('CONTROLLER_NAME', $ctrlClass);
        define('ACTION_NAME', $ctrlClass);
        //文件
        $ctrlfile = CONTROLLER_PATH . '/' . ucfirst($ctrlClass) . '.php';
        //类名
        $ctrlClass = NEWCONTROLLER_PATH . '\\' . $ctrlClass;
        //文件是否存在
        if (is_file($ctrlfile)) {
            include $ctrlfile;
            //判断类是否存在
            if (class_exists($ctrlClass)) {
                $ctrl = new $ctrlClass();
            } else {

                if (APP_DEBUG) {
                    throw new \Exception($ctrlClass . '类不存在..');
                } else {
                    include VIEWS_PATH . '/error/error.html';
                }
            }
            //类中的方法是否存在
            if (method_exists($ctrl, $action)) {
                $ctrl->$action();
            } elseif (APP_DEBUG) {
                $arr = explode('\\', $ctrlClass);
                if (APP_LOG) {
                    log::log('  ' . end($arr) . ' Methods ' . $action . ' in the controller is undefined ');
                }
                throw new \Exception('在这个' . end($arr) . '控制器中找不到这个' . $action . '方法');
            } else {
                include VIEWS_PATH . '/error/error.html';
            }
            if (APP_LOG) {
                log::log(' this controller is:' . $ctrlClass . ' ' . ' this action is:' . $action);
            }
        } else {
            if (APP_DEBUG) {
                $ctrlName = explode('\\', $ctrlClass);
                if (APP_LOG) {
                    log::log(' ' . $ctrlClass . ' is undefined');
                }
                throw new \Exception('找不到控制器' . end($ctrlName));
            } else {
                include VIEWS_PATH . '/error/error.html';
            }
        }
    }

    /**
     * 自动加载类
     * @param $class
     * @return bool
     */
    public static function load($class)
    {
        if (isset($classMap[$class])) {
            return true;
        } else {
            $class = str_replace('\\', '/', $class);
            $file  = APP_ROOT_PATH . '/' . $class . '.php';
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }
}
