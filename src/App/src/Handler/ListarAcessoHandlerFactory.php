<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class ListarAcessoHandlerFactory
{
    /**
    * @param ContainerInterface $container
    * @return ListarAcessoHandler
    * @throws ContainerExceptionInterface
    * @throws NotFoundExceptionInterface
    */
    public function __invoke(ContainerInterface $container): ListarAcessoHandler
    {
        return new ListarAcessoHandler($container->get('DbAdapter'));
    }
}