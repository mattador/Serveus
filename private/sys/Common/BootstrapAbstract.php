<?php
namespace Sys\Common;
require_once (SYS . DS . 'Loader' . DS . 'ClassMap.php');

abstract class BootstrapAbstract
{

    public function __construct ()
    {
        session_start();
        $this();
    }

    protected abstract function _prep00_AutoLoader ();

    protected abstract function _prep01_Modules ();

    protected abstract function _prep02_Router ();


    public function __invoke ()
    {
        $methods = get_class_methods(__CLASS__);
        sort($methods);
        foreach ($methods as $method) {
            if ((substr($method, 0, 5)) == '_prep') {
                $this->$method();
            }
        }
    }
}
