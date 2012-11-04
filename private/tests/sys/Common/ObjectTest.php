<?php

use sys\common\Registry;

class ObjectTest extends PHPUnit_Framework_TestCase
{

    private $Object;

    protected function setUp ()
    {
        parent::setUp();
        $this->Object = new \sys\common\Object();
    }

    protected function tearDown ()
    {
        $this->Object = null;
        parent::tearDown();
    }

    public function test__call ()
    {
        $this->assertInstanceOf('sys\traverser\directory', 
                $this->Object->__call('getObject', 
                        array(
                                'Traverser/Directory',
                                __DIR__
                        )));
        $this->assertEquals(
                $this->Object->__call('getSingleton', 
                        array(
                                'Traverser\Directory',
                                __DIR__
                        )), 
                $this->Object->__call('getSingleton', 
                        array(
                                'Traverser\Directory',
                                __DIR__
                        )));
        $message = null;
        try {
            $this->Object->__call('asdfasdf', array());
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        $this->assertContains('does not exist', $message);
    }

    /**
     * Tests Object::__callStatic()
     */
    public function test__callStatic ()
    {
        // TODO Auto-generated ObjectTest::test__callStatic()
        $this->markTestIncomplete("__callStatic test not implemented");
        
        Object::__callStatic(/* parameters */);
    }

    /**
     * Tests Object->__get()
     */
    public function test__get ()
    {
        // TODO Auto-generated ObjectTest->test__get()
        $this->markTestIncomplete("__get test not implemented");
        
        $this->Object->__get(/* parameters */);
    }

    /**
     * Tests Object->__set()
     */
    public function test__set ()
    {
        // TODO Auto-generated ObjectTest->test__set()
        $this->markTestIncomplete("__set test not implemented");
        
        $this->Object->__set(/* parameters */);
    }
}

