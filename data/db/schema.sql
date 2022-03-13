CREATE DATABASE apiunialfa DEFAULT CHARSET 'utf8' DEFAULT COLLATE 'utf8_bin';
USE apiunialfa;

CREATE TABLE categoria (
                           id SMALLINT AUTO_INCREMENT NOT NULL,
                           categoria_nome VARCHAR(45) NOT NULL,
                           PRIMARY KEY (id)
);


CREATE UNIQUE INDEX categoria_idx
    ON categoria
        ( nome );

CREATE TABLE produto (
                         id INT AUTO_INCREMENT NOT NULL,
                         categoria_id SMALLINT NOT NULL,
                         nome VARCHAR(45) NOT NULL,
                         preco NUMERIC(9,2) NOT NULL,
                         PRIMARY KEY (id)
);


CREATE UNIQUE INDEX produto_idx
    ON produto
        ( nome );

CREATE TABLE acesso (
                        id INT AUTO_INCREMENT NOT NULL,
                        token CHAR(32) NOT NULL,
                        PRIMARY KEY (id)
);


CREATE UNIQUE INDEX acesso_idx
    ON acesso
        ( token );

ALTER TABLE produto ADD CONSTRAINT categoria_produto_fk
    FOREIGN KEY (categoria_id)
        REFERENCES categoria (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;
