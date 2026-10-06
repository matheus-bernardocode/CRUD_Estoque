<?php

require_once "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
    $data_validade = $_POST["data_validade"];

    $sql = "INSERT INTO produtos
            (nome, categoria, descricao, preco, quantidade_estoque, data_validade)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar o cadastro: " . $conexao->error);
    }

    $stmt->bind_param(
        "sssdis",
        $nome,
        $categoria,
        $descricao,
        $preco,
        $estoque,
        $data_validade
    );

    if (!$stmt->execute()) {
        die("Erro ao cadastrar produto: " . $stmt->error);
    }

    $stmt->close();

    header("Location: ../index.php");
    exit;
}

header("Location: ../index.php");
exit;