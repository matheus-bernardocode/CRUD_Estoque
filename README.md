Gestão de estoque

## Objetivo

Sistema desenvolvido em PHP e MySQL para controlar os produtos de um mercado.

O sistema permite cadastrar, visualizar, editar e excluir produtos, além de controlar a quantidade disponível em estoque e a data de validade.

## Tecnologias utilizadas

PHP
MySQL
HTML
CSS
XAMPP
Git e GitHub

## Requisitos

## Para executar o projeto é necessário ter:

XAMPP instalado
Apache ativado
MySql ativado
Navegador
PHP

## Como executar

Coloque a pasta do projeto dentro da pasta htdocs do XAMPP.
Abra o XAMPP e inicie o Apache e o MySQL.
Abra o phpMyAdmin pelo endereço:
"http://localhost/phpmyadmin".

Execute o arquivo database.sql para criar o banco de dados e a tabela.
Confira a configuração da conexão no arquivo:
infra/conexao.php
Abra o sistema no navegador:
"http://localhost/CRUD_Estoque/".

## Banco de dados
O projeto utiliza o banco de dados "estoque"
A tabela principal é "produtos".

## Campos da tabela
ID
NOME
CATEGORIA
DESCRICAO
PRECO
QUANTIDADE_ESTOQUE
DATA_VALIDADE

## Funcionalidades

Cadastro de produtos
Listagem dos produtos
Edição dos produtos
Exclusão dos produtos
Controle da quantidade em estoque
Controle da data de validade
Validação básica dos dados
Uso de Prepared Statements nas operações com o banco
Estrutura do projeto
CRUD_Estoque/
├── index.php
├── database
    └── db.sql
├── infra/
│   └── conexao.php
├── public/
│   ├── cadastrar.php
│   ├── editar.php
│   └── excluir.php
└── style/
    └── style.css
    README.md

## Observação

O sistema foi desenvolvido como atividade de recuperação utilizando PHP e MySQL, com foco no desenvolvimento de um CRUD para gerenciamento de estoque.
