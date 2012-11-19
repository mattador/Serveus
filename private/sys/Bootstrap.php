<?php
namespace Sys;
use Sys\Common\BootstrapAbstract;
use Sys\Loader;
require_once (SYS . DS . 'Common' . DS . 'BootstrapAbstract.php');

/**
 * Point of entry
 * Auto load methods begin with _prep followed by loading order
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
final class Bootstrap extends BootstrapAbstract
{

    protected $_activeModule = null;

    protected function _prep00_AutoLoader ()
    {
        require_once (SYS . DS . 'Loader' . DS . 'ClassMap.php');
        $autoLoader = new Loader\ClassMap();
        $autoLoader->attachLoader();
    }

    protected function _prep01_Modules ()
    {
        $moduleLoader = new Loader\ModuleMap();
        $moduleLoader->attachLoader();
    }

    protected function _prep02_Router ()
    {
        $router = new Common\HttpRouter();
        $this->_activeModule = $router->routeModule();
        var_dump($this->_activeModule);
        exit();
    }
}