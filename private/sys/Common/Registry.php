<?php
namespace sys\common;
use \ArrayObject;

class Registry extends ArrayObject
{

    private static $_registry = null;

    public function __construct ($array, $flags)
    {
        parent::__construct($array, $flags);
    }

    public static function getInstance ()
    {
        if (null == self::$_registry) {
            $class = __CLASS__;
            self::$_registry = new $class(array(), parent::ARRAY_AS_PROPS);
        }
        return self::$_registry;
    }

    public static function set ($key, $value)
    {
        $class = self::getInstance();
        $class->offsetSet($key, $value);
    }

    public static function get ($key)
    {
        $class = self::getInstance();
        if ($class->offsetExists($key)) {
            return $class->offsetGet($key);
        }
        return false;
    }
}