<?php

namespace Zf2SlugGenerator\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use \Zf2SlugGenerator\Exception\SlugException as SlugException;

class Slug implements ServiceManagerAwareInterface
{
    /**
     * @var $mapper
     */
    protected $mapper;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Create slug from string
     *
     * @param string $string
     * @param bool $useDataSource [$useDataSource] - Check data-source or keep it simple
     * @throws \Zf2SlugGenerator\Exception\SlugException
     * @return string
     */
    public function create($string, $useDataSource = true)
    {
        if (! $useDataSource) {
            return $this->slugify($string);
        }
        
        $origString = $string;
        $count = 0;

        while ($this->getMapper()->slugExists($slug = $this->slugify($string))) {
            if ($count > 100) {
                throw new SlugException('Iteration loop reached. Unable to continue');
            }
            $string = $origString . ' ' . $count++;
        }

        return $slug;
    }

    protected function slugify($string)
    {
        $slug = trim($string); // trim the string
        $slug = preg_replace('/[^a-zA-Z0-9 -]/', '', $slug); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug = str_replace(' ', '-', $slug); // replace spaces by dashes
        $slug = strtolower($slug);  // make it lowercase
        return $slug;
    }

    public function setDbTableName($string)
    {
        $this->getMapper()->setTableName($string);
        return $this;
    }

    public function setDbColumnName($string)
    {
        $this->getMapper()->setColName($string);
        return $this;
    }

    public function setDbExclusion($string)
    {
        $this->getMapper()->setExclusionString($string);
        return $this;
    }

    /**
     * Get Mapper
     *
     * @return \Zf2SlugGenerator\Mapper\DbTable
     */
    public function getMapper()
    {
        if (null === $this->mapper) {
            $this->mapper = $this->getServiceManager()->get('zf2_slug_generator_mapper');
        }
        return $this->mapper;
    }

    /**
     * Set Mapper
     *
     * @param \Zf2SlugGenerator\Mapper\DbTable $mapper
     * @return \Zf2SlugGenerator\Service\Slug
     */
    public function setMapper($mapper)
    {
        $this->mapper = $mapper;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return Slug
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
