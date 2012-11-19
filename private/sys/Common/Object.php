<?php
namespace Sys\Common;
use \Exception as Exception;

class Object
{

    public function __get ($key)
    {
        return isset($this->$key) ? $this->$key : null;
    }

    public function __set ($key, $value)
    {
        $this->$key = $value;
    }

    public function __call ($name, $arguments)
    {
        switch ($name) {
            case 'getObject':
                if (empty($arguments)) {
                    throw new Exception('Missing class name');
                }
                $class = "\\sys\\" . str_replace('/', "\\", $arguments[0]);
                return new $class(isset($arguments[1]) ? $arguments[1] : null);
                break;
            case 'getSingleton':
                if (empty($arguments)) {
                    throw new Exception('Missing singleton class name');
                }
                $objects = Registry::get('singleton_collection');
                if (! isset($objects[$arguments[0]])) {
                    $class = "\\sys\\" . str_replace('/', "\\", $arguments[0]);
                    $objects[$arguments[0]] = new $class(
                            isset($arguments[1]) ? $arguments[1] : null);
                }
                return $objects[$arguments[0]];
                break;
            default:
                throw new Exception('Method "' . $name . '" does not exist');
        }
    }

    public static function __callStatic ($name, $arguments)
    {
        throw new Exception('__callStatic() magic method not implemented');
    }
}