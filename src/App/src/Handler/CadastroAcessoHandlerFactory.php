<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class CadastroAcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return CadastroAcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): CadastroAcessoHandler
    {
        return new CadastroAcessoHandler($container->get('DbAdapter'));
    }
}
