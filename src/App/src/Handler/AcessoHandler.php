<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\EmptyResponse;

class AcessoHandler implements RequestHandlerInterface
{
    /** @var Adapter */
    private $dbAdapter;

    public function __construct(
        Adapter $dbAdapter
    ) {
        $this->dbAdapter = $dbAdapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = array();
        $method = $request->getMethod();
        $sql = new Sql($this->dbAdapter);
        $queryParams = $request->getQueryParams();
//        $paramToken = $queryParams['id'];

        switch ($method) {
            case 'GET':
//                var_dump(is_null($queryParams));
//                var_dump(empty($queryParams));
////                var_dump($paramToken);
//                exit;
                $select = $sql->select('acesso');
                $select->columns(['token']);

                if (!empty($queryParams)) {
                    $select->where(['id' => $queryParams['id']]);
                }

                $stmt = $sql->prepareStatementForSqlObject($select);
                $result = $stmt->execute();

                while($record = $result->current()) {
                    $data[] = $record;
                    $result->next();
                }

                return new JsonResponse(['data' => $data], 200);
            break;

            case'POST':
                $body = json_decode($request->getBody()->getContents());
                $insert = $sql->insert('acesso');
                $insert->values(['token' => $body->token], $insert::VALUES_MERGE);

                $stmt = $sql->prepareStatementForSqlObject($insert);
                $stmt->execute();

                return new EmptyResponse(201);
            break;

            case 'PATCH':
                $body = json_decode($request->getBody()->getContents());
                $update = $sql->update('acesso');
                $update->set(['token'=> $body->token]);
//                $paramToken = empty($queryParams) ?? $queryParams['id'];
                $update->where(['id' => $queryParams['id']]);

                $stmt = $sql->prepareStatementForSqlObject($update);
                $stmt->execute();

                return new EmptyResponse(204);

            break;

            case 'DELETE':
                $delete = $sql->delete('acesso');
                $delete->where(['id' => $request->getAttribute('id')]);

                $stmt = $sql->prepareStatementForSqlObject($delete);
                $stmt->execute();

                return new EmptyResponse(204);
            break;

        }
    }
}
