<?php

namespace Sys;

use Sys\Loader;

/**
 * Front controller facade pattern
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
final class Bootstrap {

    protected $_activeModule = null;

    /**
     * Auto run methods begin with "_prep" followed by a 2 digit order sequence
     */
    public function __construct() {
        $methods = get_class_methods($this);
        sort($methods);
        foreach ($methods as $method) {
            if ((substr($method, 0, 5)) == '_prep') {
                $this->$method();
            }
        }
    }

    /**
     * Attaches class autoloader and registers modules
     */
    protected function _prep00_autoLoad() {
        require_once (SYS . DS . 'Loader' . DS . 'ClassMap.php');
        $autoLoader = new Loader\ClassMap();
        $autoLoader->attachLoader();
        $moduleLoader = new Loader\ModuleMap();
        $moduleLoader->attachLoader();
    }

    /**
     * Routes request to a module
     */
    protected function _prep02_router() {
        $router = new Common\HttpRouter();
        $this->_activeModule = $router->routeModule();
    }

    /**
     * Initiates a response
     */
    protected function _prep03_responseDispatcher() {
        $response = new Common\Module();
        $response->dispatchController($this->_activeModule);
    }

}