<?php
namespace Sys\Loader;

class ClassMap
{

    const NS = '\\';

    public function attachLoader()
    {
        spl_autoload_register(
                array(
                        __CLASS__,
                        'loadFactory'
                ));
    }

    public function loadFactory ($class)
    {
        $segmented = array_slice(explode(self::NS, $class), 1);
        require_once (SYS . DS . implode(DS, array_map('ucfirst', $segmented)) . '.php');
    }
}