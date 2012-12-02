<?php

namespace Sys\Common;

/**
 * Initiates module response
 *
 * @author Matthew Cooper <mattador82@gmail.com>
 */
class Module extends Object {

    protected $_module;

    public function dispatchController($module) {
        $this->_module = $module;
        $controller = 'App\Modules\\' . ucfirst($module['name']) .
                '\Controllers\\' . $module['controller'];
        $controller = new $controller($module);
        $action = $module['action'];
        $controller->beforeCall();
        $controller->$action();
        $controller->afterCall();
        $controller = null;
    }

}