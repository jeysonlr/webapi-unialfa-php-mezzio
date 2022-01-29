<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CadastroAcessoHandler implements RequestHandlerInterface
{
    /** @var Adapter */
    private $dbAdapter;

    public function __construct(
        Adapter $dbAdapter
    ) {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $token = $request->getBody()->getContents();

        $sql = new Sql($this->dbAdapter);
        $insert = $sql->insert('acesso');
        $insert->columns(['token']);
        $insert->values(['token' => json_decode($token)->token], $insert::VALUES_MERGE);

        $stmt = $sql->prepareStatementForSqlObject($insert);
        $stmt->execute();

        return new JsonResponse(['data' => 'Registro criado com sucesso'], 201);
    }
}
