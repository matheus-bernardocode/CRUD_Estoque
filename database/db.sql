CREATE DATABASE estoque;

use estoque;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT UNSIGNED NOT NULL default 0,
    data_validade DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO produtos
(nome, categoria, descricao, preco, quantidade_estoque, data_validade)
VALUES
('Arroz 5kg', 'Alimentos', 'Arroz branco tipo 1.', 25.90, 20, '2027-05-10'),
('Leite Integral', 'Bebidas', 'Leite integral de 1 litro.', 5.49, 35, '2026-12-20'),
('Biscoito Chocolate', 'Alimentos', 'Biscoito recheado sabor chocolate.', 4.99, 15, '2027-02-15');