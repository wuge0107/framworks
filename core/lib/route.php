<?php

namespace core\lib;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class route
 * @package core\lib
 */
class route
{
    static $ctrl;   // controller
    static $action; // action

    /**
     * route constructor.
     */
    public function __construct()
    {
        // 隐藏index.php
        // 获取url的参数部分
        // 返回对应的控制器和方法
        if(isset( $_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !='/'){
            // /index/index
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path,'/'));
            if(isset($patharr[0])){
                self::$ctrl = $patharr[0];
            }
            unset($patharr[0]);
            if(isset($patharr[1])){
                self::$action = $patharr[1];
                unset($patharr[1]);
            }else{
                self::$action = conf::get('route','ACTION');
            }
            //url多余的参数 转换成get参数
            // id/1/str/2
            $count = count($patharr)+2;
            $i=2;
            while($i<$count){
                if(isset($patharr[$i+1])){
                    $_GET[$patharr[$i]] = $patharr[$i+1];
                }
                $i=$i+2;
            }
        }else{
            self::$ctrl = conf::get('route','CONTROLLER');
            self::$action = conf::get('route','ACTION');
        }
    }

}