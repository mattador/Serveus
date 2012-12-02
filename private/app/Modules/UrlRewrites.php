<?php

namespace App\Modules;

/**
 * Very basic custom url mapping to target modules.
 *
 * @author Matthew Cooper <mattador82@gmail.com>
 */
class UrlRewrites {

    /**
     * The uri's map to an array where:
     * [0] = module
     * [1] = controller
     * [2] = action
     * 
     * @var array 
     */
    public static $urlMap = array(
        '/frontpage.do' => array('index', 'index', 'index')
    );

}