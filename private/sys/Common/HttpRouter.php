<?php

namespace Sys\Common;

use \Exception;

/**
 * SEO friendly routing
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
class HttpRouter extends Object {

    const URL_SAFE = '/[^A-Za-z0-9\/_-]+/';
    const MODULE = 'index';
    const CONTROLLER = 'index';
    const ACTION = 'index';
    const NOT_FOUND = 'notfound';
    const ERROR = 'error';

    /**
     * Routes requests to user module using the /m/c/a/p1/v1 format
     *
     * @return array $moduleStruct
     */
    public function routeModule() {
        $module = $this->factory();
        $moduleStruct = $this->getModule($module);
        return $moduleStruct;
    }

    /**
     * Deciphers request and merges "SEO'ed" url params into $_GET
     *
     * @return mixed $mod
     */
    public function factory() {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        // bad request
        if (count($uri) > 2) {
            $mod = array(
                self::ERROR
            );
            return $mod;
        }
        $uri = preg_replace(self::URL_SAFE, '', $uri[0]);
        $uri = array_filter(explode('/', $uri), 'strlen');
        // empty request
        if (empty($uri)) {
            $mod = array(
                self::MODULE
            );
            return $mod;
        }
        // good request
        $mod = array_slice($uri, 0, 3);
        $raw = array_slice($uri, 3);
        $params = array();
        for ($i = 0; $i < count($raw); $i++) {
            if ($i % 2 == 0) {
                $params[$raw[$i]] = isset($raw[$i + 1]) ? $raw[$i + 1] : '';
            }
        }
        // merge params wth get
        $_GET = array_merge($_GET, $params);
        return $mod;
    }

    /**
     * Attempts to locate requested module
     *
     * @param array $mod            
     * @throws Exception
     * @return Sys\Common\Module $modInstance
     */
    public function getModule($mod) {
        $modules = Registry::get('modules_collection');

        if (!isset($modules[$mod[0]])) {
            $this->notFound('Module "' . ucfirst($mod[0]) . '" not found.');
        }
        $module = $modules[$mod[0]];
        $controller = ucfirst(isset($mod[1]) ? $mod[1] : self::CONTROLLER);
        $action = (isset($mod[2]) ? $mod[2] : self::ACTION) . 'Action';
        $controllerFile = $module['location'] . DS . 'Controllers' . DS .
                $controller . '.php';
        if (!is_file($controllerFile)) {
            $this->notFound(
                    "Controller '{$module['name']}/$controller' not found.");
        }
        if (!preg_match('/' . $action . '/', file_get_contents($controllerFile))) {
            $this->notFound(
                    "Controller action '{$module['name']}/$controller/$action' not found.");
        }
        $module['controller'] = $controller;
        $module['action'] = $action;
        return $module;
    }

    public function notFound($message) {
        Session::getSession()->setVar('_404', 'message', $message);
        header('Location: /' . self::NOT_FOUND);
        exit;
    }

}