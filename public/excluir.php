<?php

require_once "../infra/conexao.php";

if (!isset($_GET["id"])) {
    header("Location: ../index.php");
    exit;
}

$id = (int) $_GET["id"];

$sql = "DELETE FROM produtos WHERE id = ?";

$comando = $conexao->prepare($sql);

$comando->bind_param("i", $id);

$comando->execute();

$comando->close();

header("Location: ../index.php");
exit;