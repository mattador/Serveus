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

    protected abstract function _prepLoader ();

    protected abstract function _prepRegistry ();

    protected abstract function _prepModules ();

    protected abstract function _prepRouter ();

    protected abstract function _prepRenderer ();

    public function __invoke ()
    {
        foreach (get_class_methods(__CLASS__) as $method) {
            if ((substr($method, 0, 5)) == '_prep') {
                $this->$method();
            }
        }
    }
}
