<?php
/**
 * 打印字符串或者数组
 * @param $var
 */
function p($var)
{
    if (is_bool($var)) {
        var_dump($var);
    } else if (is_null($var)) {
        var_dump(null);
    } else {
        echo "<pre style='position: relative;z-index: 1000;padding: 10px;border-radius: 5px;background: #F%F%F%;border: 1px solid #aaa;font-size: 14px;line-height: 18px;opacity: 0.9;'>" . print_r($var, true) . "</pre>";
    }
}

/**
 * @param1 $name 对应的键
 * @param2 $default 默认值
 * @param3 $fitt 过滤方法 int string
 * return string|$default
 */
function post($name = '', $default = false, $fitt = false)
{
    if ($name == '') {
        $arr = [];
        foreach ($_POST as $key => $value) {
            $arr[$key] = htmlspecialchars(strip_tags(addcslashes($value, true)));
        }
        return $arr;
    }
    $data = isset($_POST[$name]) ? $_POST[$name] : $default;

    if (isset($data)) {
        if ($fitt) {
            switch ($fitt) {
                case 'int':
                    if (is_numeric($data)) {
                        return preg_replace("'<script(.*?)<\/script>'is", "", $data);
                    } else {
                        return $default;
                    }
                    break;
                case 'string':
                    if (is_string($data)) {
                        return preg_replace("'<script(.*?)<\/script>'is", "", $data);
                    } else {
                        return $default;
                    }
                    break;
                default:;
            }
        } else {
            return preg_replace("'<script(.*?)<\/script>'is", "", $data);
        }
    } else {
        return $default;
    }
}

/**
 * @param string $name
 * @param bool $default
 * @param bool $fitt
 * @return array|bool|string
 */
function get($name = '', $default = false, $fitt = false)
{
    if ($name === '') {
        $arr = [];
        foreach ($_GET as $key => $a) {
            $arr[$key] = htmlspecialchars($a);
        }
        return $arr;
    }
    $data = isset($_GET[$name]) ? $_GET[$name] : '';
    if (!preg_match("/^[A-Za-z0-9]+$/", $data)) {
        //包含特殊符号
        return $default;
    }
    if (isset($data)) {
        if ($fitt) {
            switch ($fitt) {
                case 'int':
                    if (is_numeric($data)) {
                        return htmlspecialchars(addcslashes($data, true));
                    } else {
                        return $default;
                    }
                    break;
                case 'string':
                    if (is_string($name)) {
                        return htmlspecialchars(addcslashes($data, true));
                    } else {
                        return $default;
                    }
                default:;
            }
        } else {
            return htmlspecialchars(addcslashes($data, false));
        }
    } else {
        return $default;
    }
}

/**
 * 网页的跳转
 * @param1 string $url 地址
 * @param2 int $time 等待的时间 s 如果为false直接跳转 不等待
 * @param3 string $message 显示的提示信息
 */
function redirect($url = false, $time = 3, $message = '系统发生错误..')
{
    //如果地址为空则返回上一页
    if (!$url) {
        echo "<script>window.history.back(-1);</script>";
    }
    //如果参数$time为false 或者为空 又或者等于0 都会进行直接跳转
    if (!$time || $time == '' || $time == 0) {
        header('Location:' . $url);exit();
    }
    //加载跳转视图文件
    include_once VIEWS_PATH . '/redirect/' . 'redirect.html';exit;
}

/**
 * 截取中文字符不乱码 需要开启substr扩展
 * @param $str 需要截取的中文字符
 * @param int $start 开始位置 默认为0
 * @param int $length 结束位置 没有被设置则 截取到最后
 * @param string $charset 字符集 默认utf-8
 * @return string
 */
function msubstr($str, $start = 0, $length = false, $charset = "utf-8")
{
    if (!$length) {
        $length = mb_strlen($str, $charset);
    }
    if (mb_strlen($str, $charset) >= $length) {
        if (function_exists("mb_substr")) {
            return mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            return iconv_substr($str, $start, $length, $charset);
        }
        $re['utf-8']  = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
        return $slice;
    } else {
        return $str;
    }
}

/**
 * @param1 $str string 需要去除的js代码的字符串
 * @return 处理好的字符串
 */
function removeJsStr($str)
{
    return preg_replace("'<script(.*?)<\/script>'is", "", $str);
}

/**
 * @param1 string $path 上传的路径 必须要的参数
 * @param2 array|string $file 文件资源
 * @param3 int $max 如许上传的文件最大限度 单位 m
 * @param4 string $fileName  文件名
 * @param5 array $type      可以上传的类型
 * @return bool|string      失败或者成功的路径
 */
function fileUpload($path, $max = 2, $file = '', $fileName = '', $type = [])
{
    if (!is_array($file)) {
        $file = array_keys($_FILES);
        $file = $_FILES[$file[0]];
    }
    $maxlength = $max * 1048576;
    if ($maxlength < $file['size']) {
        return '上传的附件太大了';
    }
    //文件名
    $name = $file['name'];
    //得到文件类型，并且都转化成小写
    $typeName = strtolower(substr($name, strrpos($name, '.') + 1));
    //定义被允许文件后缀名
    if (!$type) {
        $type = ['jpg', 'jpeg', 'png', 'gif'];
    }
    if (!in_array($typeName, $type)) {
        //如果不被允许，则直接停止程序运行
        return false;
    }
    //重新定义文件名
    if (!$fileName) {
        //如果用户没有定义文件名的格式 则使用默认的格式
        $file['name'] = time() . substr(uniqid(), 6) . '.' . $typeName;
    } else {
        //如果有则使用用户定义的文件名格式
        $file['name'] = $fileName . $typeName;
    }
    //判断用户自定义的文件夹是否存在 不存则创建
    if (!file_exists($path)) {
        mkdir($path, 0777);
    }
    //开始移动文件到相应的文件夹
    if (move_uploaded_file($file['tmp_name'], $path . $file['name'])) {
        //返回上传好的路径
        return $path . $file['name'];
    } else {
        return false;
    }
}

/**
 * @param $xml xml数据
 * @return array $arr
 */
function xmlToArray($xml)
{
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA); //这个时候出来的是对象形式
    $arr       = json_decode(json_encode($xmlstring), true); //先把对象转换成json，然后再解析成数组
    return $arr;
}

/**
 * @param string $fun 函数名
 * @param string|array $arr 参数
 * @return string|result
 */
function loader($fun, $arr = false)
{
    if (is_string($fun)) {
        $file = APP_PATH . 'common/function.php';
        if (is_file($file)) {
            require_once $file;
        } else {
            if (APP_DEBUG) {
                return APP_PATH . 'common/function.php' . '这个文件不存在..';
            } else {
                include_once VIEWS_PATH . '/error/' . '503.html';exit;
            }
        }
        if (function_exists($fun)) {
            if ($arr != '') {
                return $fun($arr);
            } else {
                return $fun('');
            }
        } else {
            return '这个函数不存在...';
        }
    } else {
        return '参数有误...';
    }
}

function env($name = '')
{
    $arr = include APP_PATH . '/config/app.php';
    return isset($arr[$name]) ? $arr[$name] : false;
}
