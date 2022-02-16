<?php

declare(strict_types=1);

namespace App;

use App\Handler\AcessoHandler;
use App\Handler\ListarAcessoHandler;
use App\Handler\ExcluirAcessoHandler;
use App\Handler\AcessoHandlerFactory;
use App\Handler\AtualizaAcessoHandler;
use App\Handler\CadastroAcessoHandler;
use App\Handler\VisualizaAcessoHandler;
use App\Handler\ListarAcessoHandlerFactory;
use App\Handler\ExcluirAcessoHandlerFactory;
use App\Handler\CadastroAcessoHandlerFactory;
use App\Handler\AtualizarAcessoHandlerFactory;
use App\Handler\VisualizarAcessoHandlerFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,

                CadastroAcessoHandler::class => CadastroAcessoHandlerFactory::class,
                ListarAcessoHandler::class => ListarAcessoHandlerFactory::class,
                VisualizaAcessoHandler::class => VisualizarAcessoHandlerFactory::class,
                ExcluirAcessoHandler::class => ExcluirAcessoHandlerFactory::class,
                AtualizaAcessoHandler::class => AtualizarAcessoHandlerFactory::class,

                AcessoHandler::class => AcessoHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
