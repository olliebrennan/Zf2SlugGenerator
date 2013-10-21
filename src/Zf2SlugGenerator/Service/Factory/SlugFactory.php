<?php

namespace Zf2SlugGenerator\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SlugFactory
 * Use a factory to allow the opcode cache to do it's magick
 *
 * @package Zf2SlugGenerator\Service\Factory
 */
class SlugFactory implements FactoryInterface
{
    /**
     * Create the service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Zf2SlugGenerator\Service\Slug
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Zf2SlugGenerator\Mapper\DbTable');
        $mapper->setDbAdapter($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        $mapper->setEntityPrototype($serviceLocator->get('Zf2SlugGenerator\Entity\Result'));

        $service = new \Zf2SlugGenerator\Service\Slug();
        $service->setServiceManager($serviceLocator)
            ->setMapper($mapper);
        return $service;
    }
}
