<?php

namespace core\lib\drive\log;

use core\lib\conf;

class file
{
    public $path;
    public function __construct()
    {
        $path       = conf::get('log', 'OPTION');
        $this->path = $path['PATH'];
    }

    public function writeLog($message, $file = 'log')
    {
        /**
         * 1.确定文件存储的位置是否存在 不存在新建目录
         * 2.写入日志
         */
        $dateHour = date('Ymd');
        if (!is_dir($this->path . $dateHour)) {
            mkdir($this->path . $dateHour, 0777, true);
        }
        return file_put_contents($this->path . $dateHour . '/' . $file . '.txt', date('Y-m-d H:i:s') . json_encode($message) . PHP_EOL, FILE_APPEND);
    }
}
