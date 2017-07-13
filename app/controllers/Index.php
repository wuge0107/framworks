<?php

namespace app\controllers;

defined('BASEPATH') OR exit('No direct script access allowed');

use core\lib\controller;

/**
 * Class IndexController
 * @package app\controller
 */
class Index extends controller
{
    public function index()
    {
    	$arr = array(array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),array('name'=>'hznn','age'=>1),);
    	dump($arr);die;
        $this->display('index');
    }

    public function test()
    {
    	var_dump($_GET);
    }
}