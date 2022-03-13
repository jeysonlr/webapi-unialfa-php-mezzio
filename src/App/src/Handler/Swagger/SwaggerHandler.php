<?php

namespace App\Handler\Swagger;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Twig\Loader\FilesystemLoader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class SwaggerHandler implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $loader = new FilesystemLoader(__DIR__.'/../../templates');
        $twig = new Environment($loader);
        $host = "http://localhost:8094/v1";

        return new HtmlResponse(
            $twig->render(
                'documentation.html.twig',
                ['url' => sprintf('%s/documentacao/json', $host)]
            )
        );
    }
}
