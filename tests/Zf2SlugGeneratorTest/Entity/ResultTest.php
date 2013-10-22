<?php
namespace Zf2SlugGeneratorTest\Entity;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    protected $resultObj;
    
    /**
     * Setup class
     */
    public function setUp()
    {
        $this->resultObj = $this->getMockBuilder('Zf2SlugGenerator\Entity\Result')
            ->disableOriginalConstructor()
            ->setMethods(null) // NULL allows actual code contained to be ran!
            ->getMock();
    }
    
    /**
     * Tests setting the counter and protected property contains correct value
     */
    public function testSetCountMethodAndProectedProperty()
    {
        $this->resultObj->setCount(10);
        
        $this->assertAttributeEquals(
            10,
            'count',
            $this->resultObj
        );
    }
    
    /**
     * Tests setting the counter and get count returns correct value
     */
    public function testSetAndGetCount()
    {
        $this->resultObj->setCount(10);
        
        $this->assertEquals(
            10,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests getCounter
     */
    public function testGetCount()
    {
        $this->assertEquals(
            null,
            $this->resultObj->getCount()
        );
    }
    

    /**
     * Tests negatives
     */
    public function testNegativeCounts()
    {
        $this->resultObj->setCount(-10);
        
        $this->assertEquals(
            -10,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests string is 0
     */
    public function testStringIsZero()
    {
        $this->resultObj->setCount('hello world');
        
        $this->assertEquals(
            0,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests float is 1
     */
    public function testFloatIsOne()
    {
        $this->resultObj->setCount(1.005);
        
        $this->assertEquals(
            1,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests rounding up
     */
    public function testRoundingUpDoesNotHappen()
    {
        $this->resultObj->setCount(1.9999);
        
        $this->assertEquals(
            1,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests string conversion
     */
    public function testStringNumberConverts()
    {
        $this->resultObj->setCount('100');
        
        $this->assertEquals(
            100,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests numeric+string conversion
     */
    public function testNumberPlusStringConverts()
    {
        $this->resultObj->setCount('100test');
        
        $this->assertEquals(
            100,
            $this->resultObj->getCount()
        );
    }
    
    /**
     * Tests null does not fail
     */
    public function testNull()
    {
        $this->resultObj->setCount(null);
        
        $this->assertEquals(
            0,
            $this->resultObj->getCount()
        );
    }
}

