<?php
namespace Sys\Router;

class Request extends Parser
{

    public function routeRequest ()
    {
        $type = $this->resolveRequestType($this->_uri);
        var_dump($type);
        exit();
        Registry::set('active_module', $instance->_activeModule);
        var_dump($type);
        exit();
        $module = $this->resolveModule($type, $request);
        $this->route = $module;
    }

    public function cleanRequest ($params)
    {
        return $params;
    }

    /**
     * Uses Regex to determine request type
     *
     * @return array $type
     */
    public function resolveRequestType ($request)
    {
        $_patterns = array(
                'empty' => '',
                'standard' => '^(\/[a-z]{3,})+$',
                'seo' => '^\/([\w_-]){2,}(\.[\w]{2,5})?$'
        );
        var_dump($request); exit;
        $reqString = explode('?', strtolower($request));
        
        $uri = rtrim($reqString[0], '/');
        $type = array();
        foreach ($_patterns as $t => $p) {
            if (preg_match("/$p/", $uri)) {
                $type[] = $t;
                continue;
            }
        }
        if (empty($type)) {
            $type[] = '404';
        }
        return $type;
    }

    public function resolveModule ($type, $request)
    {
        $module = null;
        $c = 0;
        while ($c < count($type)) {
            switch ($type[$c]) {
                case 'default':
                    $module = array(
                            'module' => Registry::get('_modules')->default,
                            'controller' => 'index',
                            'action' => 'index'
                    );
                case 'seo':
                    // remove leading diagonal from request object
                    $request = substr($request, 1);
                    // load registered path, eventually this will be managed at
                    // DB level to avoid overhead loading 1000's of seo paths
                    $seo = Registry::get('_seo');
                    if ($i = array_search($request, $seo)) {
                        $module = array_combine(
                                array(
                                        'module',
                                        'controller',
                                        'action'
                                ), explode('-', $i));
                    }
                    break;
                case 'standard':
                    $req = array_values(
                            array_filter(explode('/', $request), 'strlen'));
                    $module = $this->getModuleMatch($req);
                    break;
                default:
                    break;
            }
            if (! is_null($module)) {
                break;
            }
            $c ++;
        }
        if (! $module) {
            $module = array(
                    'module' => Registry::get('_modules')->error,
                    'controller' => 'index',
                    'action' => 'index'
            );
        }
        return $module;
    }

    public function getModuleMatch ($request)
    {
        $module = false;
        $modules = Registry::get('_loadedModules')->getIterator();
        while ($modules->valid()) {
            if ($modules->current()->path == $request[0]) {
                $module = array(
                        'module' => $request[0],
                        'controller' => isset($request[1]) ? $request[1] : 'index',
                        'action' => isset($request[2]) ? $request[2] : 'index'
                );
                break;
            }
            $modules->next();
        }
        return $module;
    }
}