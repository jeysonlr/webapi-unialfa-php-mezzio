<?php

namespace App\Handler;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class AtualizarAcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return AtualizaAcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AtualizaAcessoHandler
    {
        return new AtualizaAcessoHandler($container->get('DbAdapter'));
    }
}