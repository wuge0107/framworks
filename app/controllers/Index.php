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
        $ar = array('1' => 1);
        dump($_GET);
    }

    public function start()
    {
        for ($i = 0; $i < 250; $i += 25) {
            //豆瓣电影Top250的页面
            $url      = "https://movie.douban.com/top250?start=$i&filter=";
            $contents = file_get_contents($url);
            //调用封装在函数里的正则匹配
            $msg = $this->_B($contents);

            foreach ($msg as $key => $value) {
                //遍历写入文件
                file_put_contents("movie.txt", $value . PHP_EOL, FILE_APPEND);
            }
        }
    }
    //字符串筛选
    public function _B($str)
    {
        $pattern = '/<li>(.*)<\/li>/s';
        preg_match_all($pattern, $str, $arr);
        dump($arr);die;
    }

}
