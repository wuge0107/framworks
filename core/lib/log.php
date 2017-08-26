<?php

namespace core\lib;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class log
 * @package core\lib
 */
class log
{
    /**
     * @var
     */
    static $class;

    /**
     * 1、确定日志存储方式
     * 2、写日志
     */
    public static function init()
    {
        //确定存储方式
        $drive       = conf::get('log', 'DRIVE');
        $class       = DRIVECONTROLLER_PATH . $drive;
        self::$class = new $class;
    }

    /**
     * @param $name
     * @param string $file
     */
    public static function log($name, $file = 'log')
    {
        self::$class->writeLog($name, $file);
    }
}
