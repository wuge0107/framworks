<?php

namespace app\controllers;

defined('BASEPATH') or exit('No direct script access allowed');

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
        var_dump($_GET);
    }
}
