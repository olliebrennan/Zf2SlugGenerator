<?php
namespace Zf2SlugGeneratorTest\Service;

class SlugTest extends \PHPUnit_Framework_TestCase
{
    protected $resultObj;
    
    /**
     * Setup class
     */
    public function setUp()
    {
        $this->resultObj = $this->getMockBuilder('Zf2SlugGenerator\Service\Slug')
            ->disableOriginalConstructor()
            ->setMethods(null) // NULL allows actual code contained to be ran!
            ->getMock();
    }
    
    public function testBasicCreateSlugWithoutDatasource()
    {
        $this->assertEquals(
            'my-slug-is-awesome',
            $this->resultObj->create('My slug IS AweSome', false)
        );
    }
    
    public function testSpecialCharsCreateSlugWithoutDatasource()
    {
        $this->assertEquals(
            'my-slug-is-awesome',
            $this->resultObj->create('My€Š-_slug IS Aw�@eSome', false)
        );
    }
    
    public function testHiphensLikeForLikeBasicSlugWithoutDatasource()
    {
        $this->assertEquals(
            'my-slug-is-awesome',
            $this->resultObj->create('my-slug-is-awesome', false)
        );
    }
}
