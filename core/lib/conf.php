<?php
namespace core\lib;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class conf
 * @package core\lib
 */
class conf
{
    /**
     * @var array
     */
    public static $conf = array();

    /**
     * @param $name
     * @param null $key
     * @return bool
     */
    public static function get($name, $key = null)
    {
        if (!isset(self::$conf[$name])) {
            $path = CONFIG_PATH . '/' . $name . '.php';
            if (!is_file($path)) {
                return false;
            }
            self::$conf[$name] = require $path;
        }
        $config = self::$conf[$name];
        if (is_null($key)) {
            return $config;
        }
        return isset($config[$key]) ? $config[$key] : false;
    }
}
