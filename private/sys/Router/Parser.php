<?php
namespace Sys\Router;
use Sys\Common\Registry;
use Sys\Common\Object;

abstract class Parser extends Object
{

    protected $_uri;

    protected $_method;

    protected $_params;

    public function __construct ()
    {
        $this->_uri = $_SERVER['REQUEST_URI'];
        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_params = $this->cleanRequest(
                array(
                        'get' => $_GET,
                        'post' => $_POST
                ));
    }

    public abstract function routeRequest ();

    public abstract function cleanRequest ($params);
}
