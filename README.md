### Execute with docker
```
$ docker-compose up -d --build

# access container
$ docker exec -it webapi bash

# install dependencies
$ composer install

# enable development-mode
$ composer-development-enable
```

### Acesso a aplicação em [click here](http://localhost:8094)

# Atenção
## Utilizar esta release, pois foi realizado uma atualização no nome de uma coluna
## Release sql esta localizada em ./data/db/schema.sql

## Documentação SWAGGER da aplicação aqui [click here](http://localhost:8094/v1/documentacao)
## json SWAGGER da aplicação aqui [click here](http://localhost:8094/v1/documentacao/json) ou na raiz do diretório em openapi.json

### Documentação POSTMAN aqui [click here](https://documenter.getpostman.com/view/7013209/UVeCQTxs) ou na raiz do diretório em API Aula Pós Galvao.postman_collection.json

### Acessar adminer para banco em [click here](http://localhost:8081)

#### Dados para conectar no banco em docker-compose.yml

