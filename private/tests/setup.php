<?php

// sets up basic autoloader for unit testing
define('DS', DIRECTORY_SEPARATOR);
define('BASE', realpath(dirname(__FILE__)) . DS . '..');
define('SYS', BASE . DS . 'sys');
define('APP', BASE . DS . 'app');

spl_autoload_register('loadFactory');

function loadFactory ($class)
{
    $segmented = array_slice(explode('\\', $class), 1);
    if (empty($segmented)) {
        return false;
    }
    $file = SYS . DS . implode(DS, array_map('ucfirst', $segmented)) . '.php';
    if (! is_file($file)) {
        throw new Exception('File "' . $file . '" does not exist');
    }
    require_once ($file);
}