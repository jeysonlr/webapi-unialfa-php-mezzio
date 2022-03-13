<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use App\Handler\AcessoHandler;
use App\Handler\ProdutoHandler;
use App\Handler\CategoriaHandler;
use Psr\Container\ContainerInterface;
use App\Handler\Swagger\SwaggerHandler;
use App\Handler\Swagger\DocumentationHandler;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    $app->route('/v1/acesso',
        AcessoHandler::class, [
        'GET', 'POST', 'PATCH', 'DELETE'
        ]
    );

    $app->route('/v1/categoria',
        CategoriaHandler::class, [
        'GET', 'POST', 'PATCH', 'DELETE'
        ]
    );

    $app->route('/v1/produto',
        ProdutoHandler::class, [
        'GET', 'POST', 'PATCH', 'DELETE'
        ]
    );

    $app->get('/v1/documentacao', [
        SwaggerHandler::class,
    ], 'infrastructure.swagger');

    $app->get('/v1/documentacao/json', [
        DocumentationHandler::class
    ], 'nfrastructure.documentation');

};
