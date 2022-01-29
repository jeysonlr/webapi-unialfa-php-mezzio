<?php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Sql;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AtualizarAcessoHandler implements RequestHandlerInterface
{
    /** @var Adapter */
    private $dbAdapter;

    public function __construct(
        Adapter $dbAdapter
    )
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $random = random_bytes(16);
        $token = bin2hex($random);

        $sql = new Sql($this->dbAdapter);
        $update = $sql->update('acesso');
        $update->set(['token'=> $token]);
        $update->where(['id' => $request->getAttribute('id')]);

        $stmt = $sql->prepareStatementForSqlObject($update);
        $result = $stmt->execute();

        ($result->current() === false) ? $data = [] : $data = [$result->current()];

        return new JsonResponse(['data' => 'Registro com id '.$request->getAttribute('id').' atualizado com sucesso!'], 200);
    }
}
