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
use Laminas\Diactoros\Response\EmptyResponse;

class ProdutoHandler implements RequestHandlerInterface
{
    /** @var Adapter */
    private $dbAdapter;

    /** @var Sql */
    private $sql;

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
        $data = array();
        $method = $request->getMethod();
        $this->sql = new Sql($this->dbAdapter);
        $queryParams = $request->getQueryParams();

        switch ($method){
            case 'GET':
                $select = $this->sql->select('produto');
                $select->columns(['id', 'nome', 'preco', 'categoria_id']);

                $select->join(
                    'categoria',
                    'produto.categoria_id = categoria.id',
                    'categoria_nome'
                );

                if (!empty($queryParams)) {
                    $select->where(['produto.id' => $queryParams['id']]);
                }

                $stmt = $this->sql->prepareStatementForSqlObject($select);
                $result = $stmt->execute();

                while($record = $result->current()) {
                    $data[] = $record;
                    $result->next();
                }

                return new JsonResponse(['data' => $data], 200);

                break;

            case'POST':
                $body = json_decode($request->getBody()->getContents());

                if (!$this->buscarCategoria($body->categoria_id)) {
                    return new JsonResponse([
                        "error" => "Não foi possível cadastrar o produto!",
                        "reason" => "Não foi localizada nenhuma categoria com id {$body->categoria_id}"
                    ],401);
                }

                $insert = $this->sql->insert('produto');
                $insert->values(['categoria_id' => $body->categoria_id], $insert::VALUES_MERGE);
                $insert->values(['nome' => $body->nome], $insert::VALUES_MERGE);
                $insert->values(['preco' => $body->preco], $insert::VALUES_MERGE);

                $stmt = $this->sql->prepareStatementForSqlObject($insert);
                $stmt->execute();

                return new EmptyResponse(201);

                break;

            case 'PATCH':
                $body = json_decode($request->getBody()->getContents());
                $update = $this->sql->update('produto');
                $update->set([
                    'nome'=> $body->nome,
                    'preco'=> $body->preco
                ]);

                $update->where(['id' => $queryParams['id']]);

                $stmt = $this->sql->prepareStatementForSqlObject($update);
                $stmt->execute();

                return new EmptyResponse(204);

                break;

            case 'DELETE':
                $delete = $this->sql->delete('produto');
                $delete->where(['id' => $queryParams['id']]);

                $stmt = $this->sql->prepareStatementForSqlObject($delete);
                $stmt->execute();

                return new EmptyResponse(204);

                break;
        }
    }

    /**
     * @param int $idCategoria
     * @return void
     * @throws Exception
     */
    private function buscarCategoria(int $idCategoria): bool
    {
        $select = $this->sql->select('categoria');
        $select->columns(['id', 'categoria_nome']);

        $select->where(['id' => $idCategoria]);

        $stmt = $this->sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (!$result->current()) {
            return false;
        }

        return true;
    }
}
