<?php
namespace Zf2SlugGeneratorTest\Mapper;

use Zf2SlugGenerator\Mapper\DbTable;
class DbTableTest extends \PHPUnit_Framework_TestCase
{
    protected $resultObj;
    
    /**
     * Setup class
     */
    public function setUp()
    {
        $this->resultObj = $this->getMockBuilder('Zf2SlugGenerator\Mapper\DbTable')
            ->disableOriginalConstructor()
            ->setMethods(null) // NULL allows actual code contained to be ran!
            ->getMock();
    }
    
    public function testSetTableNameProtectedParam()
    {
        $this->resultObj->setTableName('randomTableName');
        
        $this->assertAttributeEquals(
            'randomTableName',
            'tableName',
            $this->resultObj
        );
    }

    public function testSetColNameProtectedParam()
    {
        $this->resultObj->setColName('randomColName');
    
        $this->assertAttributeEquals(
            'randomColName',
            'colName',
            $this->resultObj
        );
    }

    public function testSetExclusionStringProtectedParam()
    {
        $this->resultObj->setExclusionString('randomExclusionString');
    
        $this->assertAttributeEquals(
            'randomExclusionString',
            'exclusionString',
            $this->resultObj
        );
    }
    
    public function testSetTableNameReturnType()
    {
        $this->assertTrue($this->resultObj->setTableName('randomTableName')
            instanceof DbTable);
    }
    
    public function testSetColNameReturnType()
    {
        $this->assertTrue($this->resultObj->setColName('randomColName')
            instanceof DbTable);
    }
    
    public function testSetExclusionStringReturnType()
    {
        $this->assertTrue($this->resultObj->setExclusionString('randomExclusionString')
            instanceof DbTable);
    }
    
    public function testEmptyGetColName()
    {
        $this->assertEquals(
            null,
            $this->resultObj->getColName()
        );
    }
    
    public function testEmptyGetTableName()
    {
        $this->assertEquals(
            null,
            $this->resultObj->getTableName()
        );
    }
    
    public function testEmptyGetExclusionString()
    {
        $this->assertEquals(
            null,
            $this->resultObj->getExclusionString()
        );
    }
    
    public function testGetColName()
    {
        $this->resultObj->setColName('randomColName');
        $this->assertEquals(
            'randomColName',
            $this->resultObj->getColName()
        );
    }
    
    public function testGetTableName()
    {
        $this->resultObj->setTableName('randomTableName');
        $this->assertEquals(
            'randomTableName',
            $this->resultObj->getTableName()
        );
    }
    
    public function testGetExclusionString()
    {
        $this->resultObj->setExclusionString('randomExclusionString');
        $this->assertEquals(
            'randomExclusionString',
            $this->resultObj->getExclusionString()
        );
    }
    
    public function testSlugExistsFailsOnEmptyTableName()
    {
        $this->setExpectedException(
            'Zf2SlugGenerator\Mapper\Exception\DbTableException', 'Missing DBTable validation data'
        );
        
        $this->resultObj->setColName('someColName');
        $this->resultObj->slugExists('sluggy');
    }
    
    public function testSlugExistsFailsOnEmptyColName()
    {
        $this->setExpectedException(
            'Zf2SlugGenerator\Mapper\Exception\DbTableException', 'Missing DBTable validation data'
        );
        
        $this->resultObj->setTableName('someTableName');
        $this->resultObj->slugExists('sluggy');
    }
    
    public function testSlugExistsFailsOnEmptyColNameAndEmptyTableName()
    {
        $this->setExpectedException(
            'Zf2SlugGenerator\Mapper\Exception\DbTableException', 'Missing DBTable validation data'
        );
        
        $this->resultObj->slugExists('sluggy');
    }
}
