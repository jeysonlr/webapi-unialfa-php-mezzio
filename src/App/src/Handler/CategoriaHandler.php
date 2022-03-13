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

class CategoriaHandler implements RequestHandlerInterface
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
        $data = array();
        $method = $request->getMethod();
        $sql = new Sql($this->dbAdapter);
        $queryParams = $request->getQueryParams();

        switch ($method){
            case 'GET':
                $select = $sql->select('categoria');
                $select->columns(['id', 'categoria_nome']);

                if (!empty($queryParams)) {
                    $select->where(['id' => $queryParams['id']]);
                }

                $stmt = $sql->prepareStatementForSqlObject($select);
                $result = $stmt->execute();

                while($record = $result->current()) {
                    $data[] = $record;
                    $result->next();
                }

                return new JsonResponse(['data' => $data], (count($data) > 0) ? 200 : 204);

                break;

            case'POST':
                $body = json_decode($request->getBody()->getContents());
                $insert = $sql->insert('categoria');
                $insert->values(
                    ['categoria_nome' => $body->categoria_nome],
                    $insert::VALUES_MERGE
                );

                $stmt = $sql->prepareStatementForSqlObject($insert);
                $stmt->execute();

                return new EmptyResponse(201);

                break;

            case 'PATCH':
                $body = json_decode($request->getBody()->getContents());
                $update = $sql->update('categoria');
                $update->set(['categoria_nome'=> $body->categoria_nome]);

                $update->where(['id' => $queryParams['id']]);

                $stmt = $sql->prepareStatementForSqlObject($update);
                $stmt->execute();

                return new EmptyResponse(204);

                break;

            case 'DELETE':
                $delete = $sql->delete('categoria');
                $delete->where(['id' => $queryParams['id']]);

                $stmt = $sql->prepareStatementForSqlObject($delete);
                $stmt->execute();

                return new EmptyResponse(204);

                break;
        }
    }
}
