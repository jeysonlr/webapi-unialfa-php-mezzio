<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class AcessoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return AcessoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AcessoHandler
    {
        return new AcessoHandler($container->get('DbAdapter'));
    }
}
