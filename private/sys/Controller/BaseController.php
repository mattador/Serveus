<?php

namespace Sys\Controller;

use Sys\View\PartialRender;
use Sys\Common\Registry;
use Sys\Common\Object;
use Sys\Common\Session;
Use Sys\View\Render;
use \Exception;

/**
 * Provides basic functionality for all controllers
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
class BaseController extends Object {

    public $view = array();
    private $_module;
    private $_uri;
    private $_method;
    private $_queryString;

    public function __construct($module) {
        $this->_module = $module;
    }

    public function getUri() {
        if (is_null($this->_uri)) {
            $this->_uri = $_SERVER['REQUEST_URI'];
        }
        return $this->_uri;
    }

    public function getMethod() {
        if (is_null($this->_method)) {
            $this->_method = $_SERVER['REQUEST_METHOD'];
        }
        return $this->_method;
    }

    public function getQueryString() {
        if (is_null($this->_queryString)) {
            $this->_queryString = $_SERVER['QUERY_STRING'];
        }
        return $this->_queryString;
    }

    public function getParams() {
        return array_merge($_GET);
    }

    /**
     * Returns session class
     *
     * @return Sys\Common\Session
     */
    public function getSession() {
        return Session::getSession();
    }

    public function redirect($url) {
        header('Location: ' . $url);
    }

    public function render($template = false) {
        $trace = debug_backtrace();
        $caller = substr($trace[1]['function'], 0, - 6);
        $loc = $this->_module['location'] . '/Views/';
        if (!$template) {
            $template = $this->_module['controller'] . '/' . $caller . '.phtml';
        }
        $template = $loc . $template;
        if (!is_file($template)) {
            throw new Exception('Template ' . $template . ' could not be found');
        }
        $view = new Render();
        $view->setLayout($this->_module['html'])->load($template, $this->view);
    }

    public function beforeCall() {
        
    }

    public function afterCall() {
        
    }

}