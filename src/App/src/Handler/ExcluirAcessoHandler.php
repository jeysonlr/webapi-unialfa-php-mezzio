<?php

namespace App\Handler;

use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ExcluirAcessoHandler implements RequestHandlerInterface
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
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $sql = new Sql($this->dbAdapter);
        $delete = $sql->delete('acesso');
        $delete->where(['id' => $request->getAttribute('id')]);

        $stmt = $sql->prepareStatementForSqlObject($delete);
        $result = $stmt->execute();

        ($result->current() === false) ? $data = [] :  $data = [$result->current()];

        return new JsonResponse(['data' => "Registro com id ". $request->getAttribute('id'). " excluido com sucesso!"], 201);
    }
}
