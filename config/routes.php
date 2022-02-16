<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use App\Handler\AcessoHandler;
use App\Handler\ListarAcessoHandler;
use Psr\Container\ContainerInterface;
use App\Handler\ExcluirAcessoHandler;
use App\Handler\CadastroAcessoHandler;
use App\Handler\AtualizaAcessoHandler;
use App\Handler\VisualizaAcessoHandler;

/**
 * laminas-router route configuration
 *
 * @see https://docs.laminas.dev/laminas-router/
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    $app->route('/v1/acesso', AcessoHandler::class, [
        'GET', 'POST', 'PATCH', 'DELETE'
    ]);

    $app->post('/acesso/cadastrar',
        CadastroAcessoHandler::class,
        'acesso.cadastrar'
    );

    $app->get('/acesso/listar',
        ListarAcessoHandler::class,
        'listar.cadastrar'
    );

    $app->get('/acesso/visualizar/:id',
        VisualizaAcessoHandler::class,
        'visualizar.cadastrar'
    );

    $app->put('/acesso/atualizar/:id',
        AtualizaAcessoHandler::class,
        'atualizar.cadastrar'
    );

    $app->delete('/acesso/excluir/:id',
        ExcluirAcessoHandler::class,
        'excluir.cadastrar'
    );
};
