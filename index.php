<?php

require_once "infra/conexao.php";

$sql = "SELECT * FROM brinquedos ORDER BY nome ASC";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar os brinquedos: " . $conexao->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Brinquedos</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <header>
        <h1>Cadastro de Brinquedos</h1>
        <p>Controle dos brinquedos cadastrados no sistema.</p>
    </header>

    <hr>

    <main>

        <section>

            <h2>Cadastrar novo brinquedo</h2>

            <form action="public/cadastrar.php" method="POST">

                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" required>

                <br><br>

                <label for="categoria">Categoria:</label><br>
                <input type="text" id="categoria" name="categoria" required>

                <br><br>

                <label for="descricao">Descrição:</label><br>
                <textarea id="descricao" name="descricao" rows="4" cols="40"></textarea>

                <br><br>

                <label for="faixa_etaria">Faixa etária:</label><br>
                <input type="text" id="faixa_etaria" name="faixa_etaria" placeholder="Ex: 5-10 anos" required>

                <br><br>

                <label for="preco">Preço:</label><br>
                <input type="number" id="preco" name="preco" step="0.01" min="0" required>

                <br><br>

                <label for="estoque">Quantidade em estoque:</label><br>
                <input type="number" id="estoque" name="estoque" min="0" value="0" required>

                <br><br>

                <button type="submit">Cadastrar</button>

            </form>

        </section>

        <hr>

        <section>

            <h2>Brinquedos cadastrados</h2>

            <?php if ($resultado->num_rows > 0) { ?>

                <table border="1" cellpadding="8">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Faixa etária</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($brinquedo = $resultado->fetch_assoc()) { ?>

                            <tr>

                                <td>
                                    <?php echo $brinquedo["id"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($brinquedo["nome"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($brinquedo["categoria"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($brinquedo["descricao"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?>
                                </td>

                                <td>
                                    R$
                                    <?php echo number_format(
                                        $brinquedo["preco"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>
                                </td>

                                <td>
                                    <?php echo $brinquedo["quantidade_estoque"]; ?>
                                </td>

                                <td>

                                    <a href="public/editar.php?id=<?php echo $brinquedo["id"]; ?>">
                                        Editar
                                    </a>

                                    |

                                    <a href="public/excluir.php?id=<?php echo $brinquedo["id"]; ?>"
                                        onclick="return confirm('Deseja realmente excluir este brinquedo?');">
                                        Excluir
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <p>Nenhum brinquedo cadastrado.</p>

            <?php } ?>

        </section>

    </main>

</body>

</html>