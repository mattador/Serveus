<?php

require_once 'private/sys/Bootstrap.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Bootstrap test case.
 */
class TestBootstrap extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Bootstrap
     */
    private $Bootstrap;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        // TODO Auto-generated TestBootstrap::setUp()
        
        $this->Bootstrap = new Bootstrap(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated TestBootstrap::tearDown()
        $this->Bootstrap = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }
}

