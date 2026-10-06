<?php

require_once "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = (int) $_POST["id"];
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $descricao = $_POST["descricao"];
    $preco = (float) $_POST["preco"];
    $estoque = (int) $_POST["estoque"];
    $data_validade = $_POST["data_validade"];

    $sql = "UPDATE produtos
            SET nome = ?,
                categoria = ?,
                descricao = ?,
                preco = ?,
                quantidade_estoque = ?,
                data_validade = ?
            WHERE id = ?";

    $comando = $conexao->prepare($sql);

    $comando->bind_param(
        "sssdisi",
        $nome,
        $categoria,
        $descricao,
        $preco,
        $estoque,
        $data_validade,
        $id
    );

    $comando->execute();
    $comando->close();

    header("Location: ../index.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("Produto não informado.");
}

$id = (int) $_GET["id"];

$sql = "SELECT * FROM produtos WHERE id = ?";

$comando = $conexao->prepare($sql);
$comando->bind_param("i", $id);
$comando->execute();

$resultado = $comando->get_result();
$produto = $resultado->fetch_assoc();

$comando->close();

if (!$produto) {
    die("Produto não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar produto</title>

    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

    <h1>Editar produto</h1>

    <form method="POST">

        <input type="hidden" name="id" value="<?php echo $produto["id"]; ?>">

        <label for="nome">Nome:</label><br>

        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto["nome"]); ?>" required>

        <br><br>

        <label for="categoria">Categoria:</label><br>

        <input type="text" id="categoria" name="categoria"
            value="<?php echo htmlspecialchars($produto["categoria"]); ?>" required>

        <br><br>

        <label for="descricao">Descrição:</label><br>

        <textarea id="descricao" name="descricao" rows="4"
            cols="40"><?php echo htmlspecialchars($produto["descricao"]); ?></textarea>

        <br><br>

        <label for="preco">Preço:</label><br>

        <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?php echo $produto["preco"]; ?>"
            required>

        <br><br>

        <label for="estoque">Quantidade em estoque:</label><br>

        <input type="number" id="estoque" name="estoque" min="0" value="<?php echo $produto["quantidade_estoque"]; ?>"
            required>

        <br><br>

        <label for="data_validade">Data de validade:</label><br>

        <input type="date" id="data_validade" name="data_validade" value="<?php echo $produto["data_validade"]; ?>"
            required>

        <br><br>

        <button type="submit">Salvar alterações</button>

        <a href="../index.php">Cancelar</a>

    </form>

</body>

</html>