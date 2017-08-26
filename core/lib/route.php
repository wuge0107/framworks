<?php

namespace core\lib;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class route
 * @package core\lib
 */
class route
{
    public $ctrl; // controller
    public $action; // action

    /**
     * route constructor.
     */
    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            //得到用户自定义的文件夹名
            $str = implode('', array_slice(explode('/', $_SERVER['SCRIPT_FILENAME']), -2, 1));
            //url参数转换成数组
            $patharr = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
            $key     = array_search("index.php", $patharr);
            if ($key !== false) {
                unset($patharr[$key]);
                $patharr = array_merge($patharr);
            }
            //如果用户自定义的文件夹存在 则认为没有配置虚拟环境
            if ($str == $patharr[0]) {
                //删除这个元素
                unset($patharr[0]);
                //删除数组其中的一个元素后 数组进行重新排序 array_merge()
                $patharr = array_merge($patharr);
            }
            if (isset($patharr[0]) && $patharr[0] !== '') {
                $this->ctrl = $patharr[0];
            } else {
                $this->ctrl = conf::get('app', 'CONTROLLER_DEFAULT');
            }
            unset($patharr[0]);
            if (!empty($patharr[1])) {
                $this->action = $patharr[1];
                unset($patharr[1]);
            } else {
                $this->action = conf::get('app', 'ACTION_DEFAULT');
            }
            $count = count($patharr) + 2;
            $i     = 2;
            while ($i < $count) {
                if (isset($patharr[$i + 1])) {
                    $_GET[$patharr[$i]] = $patharr[$i + 1];
                }
                $i = $i + 2;
            }
        } else {
            $this->ctrl   = conf::get('app', 'CONTROLLER_DEFAULT');
            $this->action = conf::get('app', 'ACTION_DEFAULT');
        }
    }
}
