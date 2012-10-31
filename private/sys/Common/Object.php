<?php
namespace sys\common;

class Object
{

    public function __call ($name, $arguments)
    {
        switch ($name) {
            case 'getInstance':
                $class = "\\sys\\" . str_replace('/', "\\", $arguments[0]);
                return new $class(isset($arguments[1]) ? $arguments[1] : null);
                break;
            case 'getSingleton':
                //SplObjectStorage
                var_dump('fuck'); exit;
                break;
        }
        var_dump(func_get_args()); exit;
        var_dump('callll ;D');
        exit();
    }

    public static function __callStatic ($name, $arguments)
    {
        switch ($name) {
            case 'getObject':
                $class = "\\sys\\" . str_replace('/', "\\", $arguments[0]);
                return new $class(isset($arguments[1]) ? $arguments[1] : null);
                break;
        }
        // Note: value of $name is case sensitive.
        //echo "Calling static method '$name' " . implode(', ', $arguments) . "\n";
    }

    public function __get ($key)
    {
        var_dump($key); exit;
        var_dump('__get');
        exit();
    }

    public function __set ($key, $value)
    {
        var_dump('__set');
        exit();
    }
}