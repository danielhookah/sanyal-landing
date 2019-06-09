<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Views\Twig;

abstract class Controller
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct($container)
    {
        $this->setContainer($container);
    }

    /**
     * @return Twig
     * @throws ContainerException
     */
    public function getView(): Twig
    {
        return $this->getContainer()->get('view');
    }

    /**
     * @return Container
     */
    public function getContainer(): ?Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->container->em;
    }
}