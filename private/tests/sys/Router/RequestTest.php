<?php

require_once 'PHPUnit/Framework/TestCase.php';

class RequestTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Request
     */
    private $Request;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        // TODO Auto-generated RequestTest::setUp()
        
        $this->Request = new Request(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated RequestTest::tearDown()
        $this->Request = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Request->routeRequest()
     */
    public function testRouteRequest ()
    {
        // TODO Auto-generated RequestTest->testRouteRequest()
        $this->markTestIncomplete("routeRequest test not implemented");
        
        $this->Request->routeRequest(/* parameters */);
    }

    /**
     * Tests Request->cleanRequest()
     */
    public function testCleanRequest ()
    {
        // TODO Auto-generated RequestTest->testCleanRequest()
        $this->markTestIncomplete("cleanRequest test not implemented");
        
        $this->Request->cleanRequest(/* parameters */);
    }

    /**
     * Tests Request->resolveRequestType()
     */
    public function testResolveRequestType ()
    {
        // TODO Auto-generated RequestTest->testResolveRequestType()
        $this->markTestIncomplete("resolveRequestType test not implemented");
        
        $this->Request->resolveRequestType(/* parameters */);
    }

    /**
     * Tests Request->resolveModule()
     */
    public function testResolveModule ()
    {
        // TODO Auto-generated RequestTest->testResolveModule()
        $this->markTestIncomplete("resolveModule test not implemented");
        
        $this->Request->resolveModule(/* parameters */);
    }

    /**
     * Tests Request->getModuleMatch()
     */
    public function testGetModuleMatch ()
    {
        // TODO Auto-generated RequestTest->testGetModuleMatch()
        $this->markTestIncomplete("getModuleMatch test not implemented");
        
        $this->Request->getModuleMatch(/* parameters */);
    }
}

