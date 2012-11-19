<?php
namespace Sys\Controller;
use Sys\Common\Registry as Registry;
use Sys\Common\Object as Object;

// after routing we need to call beforeAction()
// after rendering we need to call afterAction()
class BaseController extends Object
{

    private $_uri;

    private $_method;

    private $_queryString;

    public function getUri ()
    {
        if (is_null($this->_uri)) {
            $this->_uri = $_SERVER['REQUEST_URI'];
        }
        return $this->_uri;
    }

    public function getMethod ()
    {
        if (is_null($this->_method)) {
            $this->_method = $_SERVER['REQUEST_METHOD'];
        }
        return $this->_method;
    }

    public function getQueryString ()
    {
        if (is_null($this->_queryString)) {
            $this->_queryString = $_SERVER['QUERY_STRING'];
        }
        return $this->_queryString;
    }

    public function getParams ()
    {
        foreach ($_GET as $k => $v) {
            $_GET[$k] = $v = strtolower(
                    trim(preg_replace(self::CLEAN_FULL, '-', $v), '-'));
        }
        return $_GET;
    }

    public function redirect ($url)
    {
       header('Location: ' . $url);
    }

    public function beforeAction ()
    {}

    public function afterAction ()
    {}
}