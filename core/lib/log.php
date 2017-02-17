<?php

namespace core\lib;

defined('BASEPATH') OR exit('No direct script access allowed');

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
    static public function init()
    {
        //确定存储方式
        $drive = conf::get('log','DRIVE');
        $class = DRIVECONTROLLER.$drive;
        self::$class = new $class;
    }

    /**
     * @param $name
     * @param string $file
     */
    static public function log($name,$file='log')
    {
        self::$class->log($name,$file);
    }
}