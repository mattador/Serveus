<?php

namespace Sys\Loader;

use Sys\Common\Registry;
use Sys\Common\Object;

/**
 * Maps modules into registry
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
class ModuleMap extends Object implements LoaderInterface {

    /**
     * Parse module config files into registry
     */
    public function attachLoader() {
        if (Registry::exists('modules_collection')) {
            return;
        }
        $modules = array();
        $fileIterator = self::getObject('Traverser/Directory', APP . DS . 'Modules');
        $it = $fileIterator->getIterator();
        while ($it->valid()) {
            if ($it->isFile() && $it->current()->getExtension() == 'xml') {
                $xml = simplexml_load_file($it->current()->__toString());
                $modules[(string) $xml->name] = array(
                    'name' => ucfirst($xml->name),
                    'html' => array(
                        'layout' => (string) $xml->html->layout,
                        'title' => (string) $xml->html->title
                    ),
                    'location' => realpath($it->current()->getPath())
                );
            }
            $it->next();
        }
        Registry::set('modules_collection', $modules);
    }

}