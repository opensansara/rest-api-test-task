<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;

abstract class AbstractController implements ControllerInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}