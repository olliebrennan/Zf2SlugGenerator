<?php
namespace Zf2SlugGenerator\Mapper;

use Zf2SlugGenerator\Mapper\Exception\SlugDbException as SlugDbException;
use Zend\Db\Sql\Sql;

class DbTable
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
     * @var $dbAdapter
     */
    protected $dbAdapter;

	/**
     * Checks if a slug exists in the DB already
     *
     * @param string $slug
     * @return boolean
     */
    public function slugExists($slug)
    {
        $table = $this->getTableName();
        $column = $this->getColName();
        $adapter = $this->getDbAdapter();

        $sql = new Sql($adapter);
        $select = $sql->select()
            ->from($table)
            ->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')));
        $select->where(array($column => (string) $slug));

        if ($this->getExclusionString()) {
            $select->where($column . ' != ?', (string) $this->getExclusionString());
        }

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();

        return (boolean) $result['count'];
    }

    /**
     * @throws SlugDbException
     * @return string
     */
    public function getTableName()
    {
        if (empty($this->tableName)) {
            throw new SlugDbException('Missing DBTable validation data');
        }

        return $this->tableName;
    }

    /**
     * @throws SlugDbException
     * @return string
     */
    public function getColName()
    {
        if (empty($this->colName)) {
            throw new SlugDbException('Missing DBTable validation data');
        }

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
     * @param string $exclusionString
     * @return $this
     */
    public function setExclusionString($exclusionString)
    {
        $this->exclusionString = $exclusionString;
        return $this;
    }

    /**
     * @param \Zend\Db\Adapter\Adapter $dbAdapter
     */
    public function setDbAdapter(\Zend\Db\Adapter\Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @throws Exception\SlugDbException
     * @return \Zend\Db\Adapter
     */
    public function getDbAdapter()
    {
        if (! $this->dbAdapter) {
            throw new SlugDbException('No db adapter present');
        }

        return $this->dbAdapter;
    }
}
