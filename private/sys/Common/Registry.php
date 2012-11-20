<?php

namespace Sys\Common;

use \ArrayObject;
use \Exception;

/**
 * Simple Registry pattern
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
class Registry extends ArrayObject {

    private static $_registry = null;

    public function __construct($array, $flags) {
        parent::__construct($array, $flags);
        $this->offsetSet('singleton_collection', array());
    }

    public static function getInstance() {
        if (null == self::$_registry) {
            $class = __CLASS__;
            self::$_registry = new $class(array(), parent::ARRAY_AS_PROPS);
        }
        return self::$_registry;
    }

    public static function set($key, $value) {
        self::getInstance()->offsetSet($key, $value);
    }

    public static function get($key) {
        if (self::getInstance()->offsetExists($key)) {
            return self::getInstance()->offsetGet($key);
        }
        throw new Exception('Key "' . $key . '" does not exist in registry');
    }

    public static function exists($key) {
        return self::getInstance()->offsetExists($key);
    }

}