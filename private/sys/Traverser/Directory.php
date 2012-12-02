<?php

namespace Sys\Traverser;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;

/**
 * Recursive directory iterator
 *
 * @author Matthew Cooper <mattador82@gmail.com>
 */
class Directory {

    protected $_iterator;

    /**
     *
     * @param string $path            
     * @return \RecursiveIteratorIterator
     */
    public function __construct($path) {
        $iterator = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($path,
                                FilesystemIterator::SKIP_DOTS));
        $this->_iterator = $iterator;
    }

    public function getIterator() {
        return $this->_iterator;
    }

}

