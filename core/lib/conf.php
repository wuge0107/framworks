<?php
namespace core\lib;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class conf
 * @package core\lib
 */
class conf
{
    /**
     * @var array
     */
    static public $conf=array();

    /**
     * @param $name
     * @param null $key
     * @return bool
     */
    static public function get($name,$key=null)
    {
        if(!isset(self::$conf[$name])){
            $path = CONFIG .'/'.$name.'.php';
            if(!is_file($path)){
                return false;
            }
            self::$conf[$name] = include $path;
        }
        $config = self::$conf[$name];
        if(is_null($key)){
            return $config;
        }
        return isset($config[$key]) ? $config[$key] : false;
    }
}