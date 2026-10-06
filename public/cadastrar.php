<?php

require_once "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $descricao = $_POST["descricao"];
    $faixa_etaria = $_POST["faixa_etaria"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];

    $sql = "INSERT INTO brinquedos
            (nome, categoria, descricao, faixa_etaria, preco, quantidade_estoque)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar o cadastro: " . $conexao->error);
    }

    $stmt->bind_param(
        "ssssdi",
        $nome,
        $categoria,
        $descricao,
        $faixa_etaria,
        $preco,
        $estoque
    );

    if (!$stmt->execute()) {
        die("Erro ao cadastrar brinquedo: " . $stmt->error);
    }

    $stmt->close();

    header("Location: ../index.php");
    exit;
}

header("Location: ../index.php");
exit;