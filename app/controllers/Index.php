<?php

namespace app\controllers;

defined('BASEPATH') OR exit('No direct script access allowed');

use app\model\Test;

use core\lib\controller;

/**
 * Class IndexController
 * @package app\controller
 */
class Index extends controller
{
    public function index()
    {
        $this->view('index');
    }

    public function test()
    {
        $testModel =new Test();
        $data = '测试数据';
        echo $testModel->test($data);
    }
}