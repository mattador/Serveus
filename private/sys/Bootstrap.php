<?php
namespace Sys;
use Sys\Common\BootstrapAbstract;
use Sys\Loader;
require_once (SYS . DS . 'Common' . DS . 'BootstrapAbstract.php');

final class Bootstrap extends BootstrapAbstract
{

    protected function _prepAutoLoader ()
    {
        require_once (SYS . DS . 'Loader' . DS . 'ClassMap.php');
        $autoLoader = new Loader\ClassMap();
        $autoLoader->attachLoader();
    }

    protected function _prepModules ()
    {
        $moduleLoader = new Loader\ModuleMap();
        $moduleLoader->attachLoader();
    }

    protected function _prepRouter ()
    {
        $request = new Router\Request();
        $request->routeRequest();
    }

    protected function _prepRenderer ()
    {}

    protected function _prepAcl ()
    {}
}