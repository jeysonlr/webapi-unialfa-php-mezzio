<?php

namespace App\Handler;

use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarAcessoHandler implements RequestHandlerInterface
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
        $select = $sql->select('acesso');
        $select->columns(['id','token']);

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        while($record = $result->current()) {
            $data[] = $record;
            $result->next();
        }

        return new JsonResponse(['data' => $data], 200);
    }
}