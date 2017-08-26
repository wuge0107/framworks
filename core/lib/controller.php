<?php
namespace core\lib;

/**
 * Class controller
 * @package core\lib
 */
class controller
{
    /**
     * @var array
     */
    protected $temple = [];
    protected $rendered;
    public $blade;

    /**
     * controller constructor.
     */
    public function __construct()
    {
        $this->blade = new \duncan3dc\Laravel\BladeInstance(APP_PATH . "views/", TEMPLATE_CACHE_PATH . ucfirst(CONTROLLER_NAME));
    }

    /**
     * @param string $view 定义存放模版文件名的路径
     * @param string $key  在模版文件中输出的key
     * @param string $value 模版中key对应的值
     * @throws \Exception
     */
    public function view($view = "", $key = '', $value = '')
    {
        if ($key !== '' && $value !== '') {
            $this->temple[$key] = $value;
        }
        $view = str_replace('.', '/', $view);
        if (!is_file(APP_PATH . "views/" . $view . '.blade.php')) {
            if (!APP_DEBUG) {
                include VIEWS_PATH . '/error/error.html';
            }
            throw new \Exception('此' . APP_PATH . "views/" . $view . '.blade.php' . '模版文件不存在');
        }
        echo $this->blade->render($view, $this->temple);
    }

    /**
     * @param $file
     * @param array $data
     * @throws \Exception
     */
    protected function display($file, $data = array())
    {
        $str = explode('.', $file);
        if (count($str) > 1) {
            $file = '';
            foreach ($str as $k => $v) {
                $file .= $v . '.';
            }
        }
        $file = VIEWS_PATH . '/' . rtrim($file, '.') . '.php';
        if (is_file($file)) {
            if (is_array($data)) {
                extract($data);
            }
            include_once $file;
        } else {
            if (APP_DEBUG) {
                throw new \Exception('找不到这个文件' . $file);
            } else {
                include VIEWS_PATH . '/error/error.html';
            }
        }
    }
    /**
     * @param string $key session名
     * @param bool $value session值
     * @param bool $time 生存时间
     * @return int|string
     */
    protected function session($key = '', $value = false, $time = false)
    {
        //判断session是否开启 没有开启就开启
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($key) && $key != null) {
            return empty($_SESSION) ? '没有设置任何session哦!' : $_SESSION;
        } elseif (!empty($key) && $value === false) {
            return empty($_SESSION[$key]) ? '没有设置' . $key . '这个session记录o.' : $_SESSION[$key];
        } elseif (isset($key) && isset($value) && $time === false) {
            $_SESSION[$key] = removeJsStr($value);exit();
        } elseif (isset($key) && isset($value) && $time != false) {
            if ($time == 0) {
                $time = ini_get('session.gc_maxlifetime');
            } else {
                ini_set('session.gc_maxlifetime', $time);
            }
            if (empty($_COOKIE['PHPSESSID'])) {
                session_set_cookie_params($time);
            } else {
                setcookie('PHPSESSID', session_id(), time() + $time);
            }
            $_SESSION[$key] = removeJsStr($value);
            exit();
        }
        if (is_null($key)) {
            session_destroy();exit();
        }
        if (!empty($key) && $key != null && $value == null) {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
                return '删除成功了';
            } else {
                return '此' . $key . '记录不存在..';
            }
        }
    }

    /**
     * @param string $key cookie名
     * @param string $value cookie值
     * @param string $time 生存时间
     * @return string
     */
    protected function cookie($key = '', $value = '', $time = '')
    {
        if ($key === '') {
            return $_COOKIE;
        }
        if ($key !== '' && $value !== '' && $time === '') {
            setcookie($key, $value);
        } elseif ($key !== '' && $key !== null && $value === '') {
            return empty($_COOKIE[$key]) ? '没有设置这个名为' . $key . '的cookie' : $_COOKIE[$key];
        } elseif ($key !== '' && $value !== '' && $time !== '') {
            setcookie($key, $value, time() + (int) $time);
        }
        if ($key !== '' && $value === null) {
            if (!empty($_COOKIE[$key])) {
                setcookie($key, null);
            }
        } elseif ($key === null) {
            foreach ($_COOKIE as $key => $val) {
                setcookie($key, "", time() - 100);
            }
        }
    }
}
