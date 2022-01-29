<?php

namespace App\Handler;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class AtualizarAcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return AtualizarAcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AtualizarAcessoHandler
    {
        return new AtualizarAcessoHandler($container->get('DbAdapter'));
    }
}