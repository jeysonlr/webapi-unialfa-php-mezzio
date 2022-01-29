<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class VisualizarAcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return VisualizarAcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): VisualizarAcessoHandler
    {
        return new VisualizarAcessoHandler($container->get('DbAdapter'));
    }
}