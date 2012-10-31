<?php
namespace Sys;
use Sys\Common\BootstrapAbstract;
use Sys\Loader;
require_once (SYS . DS . 'Common' . DS . 'BootstrapAbstract.php');

final class Bootstrap extends BootstrapAbstract
{

    protected function _prepLoader ()
    {
        require_once (SYS . DS . 'Loader' . DS . 'ClassMap.php');
        $autoLoader = new Loader\ClassMap();
        $autoLoader->attachLoader();
        $moduleLoader = new Loader\ModuleMap();
        $moduleLoader->attachLoader();
    }

    protected function _prepRegistry ()
    {}

    protected function _prepModules ()
    {}

    protected function _prepRouter ()
    {
        $request = new router\Parse();
        $request->_setModule();
    }

    protected function _prepRenderer ()
    {}
}