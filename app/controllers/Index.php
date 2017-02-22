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
    //添加数据展示页面
    public function index()
    {
        dump(get());
    }
}