<?php

namespace Zf2SlugGenerator\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SlugFactory
 * Use a factory to allow the opcode cache to do its magick
 *
 * @package Zf2SlugGenerator\Service\Factory
 */
class SlugFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Zf2SlugGenerator\Service\Slug
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new \Zf2SlugGenerator\Service\Slug();
        $service->setServiceManager($serviceLocator);
        return $service;
    }
}
