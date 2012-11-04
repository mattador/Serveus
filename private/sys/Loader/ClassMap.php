<?php
namespace Sys\Loader;
use \Exception as Exception;
require_once ('LoaderInterface.php');

class ClassMap implements LoaderInterface
{

    const NS = '\\';

    public function attachLoader ()
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
        if (empty($segmented)) {
            return false;
        }
        $file = SYS . DS . implode(DS, array_map('ucfirst', $segmented)) . '.php';
        if (! is_file($file)) {
            throw new Exception('File "' . $file . '" does not exist');
        }
        require_once ($file);
    }
}