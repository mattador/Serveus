<?php
namespace Sys\Loader;
use Sys\Common\Registry;
use Sys\Common\Object;
use SimpleXMLIterator;

class ModuleMap extends Object implements LoaderInterface
{

    /**
     * Parse module config files into registry
     */
    public function attachLoader ()
    {
        if (Registry::exists('modules')) {
            return;
        }
        $modules = array();
        $fileIterator = self::getObject('Traverser/Directory', 
                APP . DS . 'Modules');
        $it = $fileIterator->getIterator();
        while ($it->valid()) {
            if ($it->isFile() && $it->current()->getExtension() == 'xml') {
                $xml = simplexml_load_file($it->current()->__toString());
                $modules[(string) $xml->module] = array(
                        'url' => (string) $xml->url,
                        'html' => array(
                                'layout' => (string) $xml->html->layout,
                                'title' => (string) $xml->html->title
                        )
                );
            }
            $it->next();
        }
        Registry::set('modules_collection', $modules);
    }
}