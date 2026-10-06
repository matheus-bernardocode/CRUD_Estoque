CREATE DATABASE gestao_estoque;

use gestao_estoque;

CREATE TABLE brinquedos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT UNSIGNED NOT NULL default 0

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;