<?php
//文件存储
namespace core\lib\drive\log;

use core\lib\config;

class file
{
    public $path;
    public function __construct()
    {
        $path = config::get('log','OPTION');
        $this->path = $path['PATH'];
    }

    public function log($message,$file='log')
    {
        /**
         * 1.确定文件存储的位置是否存在
         * 不存在新建目录
         * 2.写入日志
         */

        if(!is_dir($this->path.date('YmdH'))){
            mkdir($this->path.date('YmdH'),0777,true);
        }
        return file_put_contents($this->path.date('YmdH').'/'.$file.'.php',date('Y-m-d H:i:s').json_encode($message).PHP_EOL,FILE_APPEND);
    }
}