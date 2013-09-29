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
     * Checks if a slug exists in the DB already
     *
     * @param string $slug
     * @return boolean
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
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @param string $colName
     */
    public function setColName($colName)
    {
        $this->colName = $colName;
    }
}
