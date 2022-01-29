<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class ExcluirAcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return ExcluirAcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): ExcluirAcessoHandler
    {
        return new ExcluirAcessoHandler($container->get('DbAdapter'));
    }
}
