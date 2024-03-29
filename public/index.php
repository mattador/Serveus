<?php

// Environment
defined('ENV') || define('ENV', getenv('APPLICATION_ENV') ? : 'live');

// Paths
define('DS', DIRECTORY_SEPARATOR);
define('BASE', realpath(realpath(dirname(__FILE__)) . DS . '..' . DS . 'private'));
define('SYS', BASE . DS . 'sys');
define('APP', BASE . DS . 'app');

// run
require SYS . DS . 'Bootstrap.php';
new Sys\Bootstrap();