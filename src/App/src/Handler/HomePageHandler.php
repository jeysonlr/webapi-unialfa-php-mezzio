<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    // private $containerName;

    // private $router;

    // private $template;

    // public function __construct(
    //     string $containerName,
    //     Router\RouterInterface $router,
    //     ?TemplateRendererInterface $template = null
    // ) {
    //     $this->containerName = $containerName;
    //     $this->router        = $router;
    //     $this->template      = $template;
    // }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        return new JsonResponse($data);
    }
}
