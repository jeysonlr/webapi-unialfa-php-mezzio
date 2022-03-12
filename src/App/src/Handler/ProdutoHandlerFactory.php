<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class ProdutoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ProdutoHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): ProdutoHandler
    {
        return new ProdutoHandler($container->get('DbAdapter'));
    }
}
