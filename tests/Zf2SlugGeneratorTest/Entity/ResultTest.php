<?php
namespace Zf2SlugGeneratorTest\Entity;

use Zf2SlugGenerator\Entity\Result;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    protected $resultObj;
    
    public function setUp()
    {
        $this->resultObj = new Result();
    }
    
    /**
     * Tests setting the counter
     */
    public function testSetCount()
    {
        $this->resultObj->setCount(10);
    }
}

