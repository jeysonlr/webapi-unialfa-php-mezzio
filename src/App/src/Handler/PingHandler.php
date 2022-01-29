<?php

declare(strict_types=1);

namespace App\Handler;

use DateTime;
use Exception;
use DateTimeZone;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PingHandler implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $datetime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

        return new JsonResponse(
            ['ack' => $datetime->format('d/m/Y H:i:s')]
        );
    }
}
