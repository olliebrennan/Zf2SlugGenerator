<?php
namespace Zf2SlugGenerator\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zf2SlugGenerator\Mapper\Exception\DbTableException;

class DbTable extends AbstractDbMapper
{
    /**
     * @var $tableName
     */
    protected $tableName;

    /**
     * @var $colName
     */
    protected $colName;
    
    /**
     * @var $exclusionString
     */
    protected $exclusionString;

	/**
     * Checks if a slug exists in the DB already
     *
     * @param string $slug
     * @return boolean
     * @throws Zf2SlugGenerator\Exception\DbTableException
     */
    public function slugExists($slug)
    {
        $table = $this->getTableName();
        $column = $this->getColName();

        if (empty($table) || empty($column)) {
            throw new DbTableException('Missing DBTable validation data');
        }

        $select = $this->getSelect($table);
        $select
            ->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')))
            ->where(array($column => (string) $slug));

        $entity = $this->select($select)->current();
        return (boolean)$entity->getCount();
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getColName()
    {
        return $this->colName;
    }

    /**
     * @param string $tableName
     * @return Zf2SlugGenerator\Mapper\DbTable
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    /**
     * @param string $colName
     * @return Zf2SlugGenerator\Mapper\DbTable
     */
    public function setColName($colName)
    {
        $this->colName = $colName;
        return $this;
    }

    /**
     * @return string $exclusionString
     */
    public function getExclusionString()
    {
        return $this->exclusionString;
    }

	/**
     * @param \Zf2SlugGenerator\Mapper\unknown $exclusionString
     */
    public function setExclusionString($exclusionString)
    {
        $this->exclusionString = $exclusionString;
        return $this;
    }
}
