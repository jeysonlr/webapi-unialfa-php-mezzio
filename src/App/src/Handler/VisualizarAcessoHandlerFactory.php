<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class VisualizarAcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return VisualizaAcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): VisualizaAcessoHandler
    {
        return new VisualizaAcessoHandler($container->get('DbAdapter'));
    }
}