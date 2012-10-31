<?php
namespace sys\router;
use sys\common\Object, sys\common\Registry;

abstract class Request extends Object
{

    protected $_uri;

    protected $_method;

    protected $_params;

    public function __construct ()
    {
        $this->_uri = $_SERVER['REQUEST_URI'];
        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_params = $this->_sanitizeRequest(
                array(
                        'get' => $_GET,
                        'post' => $_POST
                ));
    }

    protected abstract function _setActiveModule ();

    protected abstract function _sanitizeRequest ();
}