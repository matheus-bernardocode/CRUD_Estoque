<?php

require_once "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = (int) $_POST["id"];
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $descricao = $_POST["descricao"];
    $faixaEtaria = $_POST["faixa_etaria"];
    $preco = (float) $_POST["preco"];
    $estoque = (int) $_POST["estoque"];

    $sql = "UPDATE brinquedos
            SET nome = ?,
                categoria = ?,
                descricao = ?,
                faixa_etaria = ?,
                preco = ?,
                quantidade_estoque = ?
            WHERE id = ?";

    $comando = $conexao->prepare($sql);

    $comando->bind_param(
        "ssssdii",
        $nome,
        $categoria,
        $descricao,
        $faixaEtaria,
        $preco,
        $estoque,
        $id
    );

    $comando->execute();
    $comando->close();

    header("Location: ../index.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("Brinquedo não informado.");
}

$id = (int) $_GET["id"];

$sql = "SELECT * FROM brinquedos WHERE id = ?";

$comando = $conexao->prepare($sql);
$comando->bind_param("i", $id);
$comando->execute();

$resultado = $comando->get_result();
$brinquedo = $resultado->fetch_assoc();

$comando->close();

if (!$brinquedo) {
    die("Brinquedo não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar brinquedo</title>
</head>

<body>

    <h1>Editar brinquedo</h1>

    <form method="POST">

        <input type="hidden" name="id" value="<?php echo $brinquedo["id"]; ?>">

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($brinquedo["nome"]); ?>" required>

        <br><br>

        <label for="categoria">Categoria:</label><br>
        <input type="text" id="categoria" name="categoria"
            value="<?php echo htmlspecialchars($brinquedo["categoria"]); ?>" required>

        <br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4"
            cols="40"><?php echo htmlspecialchars($brinquedo["descricao"]); ?></textarea>

        <br><br>

        <label for="faixa_etaria">Faixa etária:</label><br>
        <input type="text" id="faixa_etaria" name="faixa_etaria"
            value="<?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?>" required>

        <br><br>

        <label for="preco">Preço:</label><br>
        <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?php echo $brinquedo["preco"]; ?>"
            required>

        <br><br>

        <label for="estoque">Quantidade em estoque:</label><br>
        <input type="number" id="estoque" name="estoque" min="0" value="<?php echo $brinquedo["quantidade_estoque"]; ?>"
            required>

        <br><br>

        <button type="submit">Salvar alterações</button>

        <a href="../index.php">Cancelar</a>

    </form>

</body>

</html>