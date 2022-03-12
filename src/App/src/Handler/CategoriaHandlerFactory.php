<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class CategoriaHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return CategoriaHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): CategoriaHandler
    {
        return new CategoriaHandler($container->get('DbAdapter'));
    }
}
