<?php

require_once "infra/conexao.php";

$sql = "SELECT * FROM produtos ORDER BY nome ASC";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar os produtos: " . $conexao->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestão de Estoque</title>

    <link rel="stylesheet" href="style/style.css">

</head>

<body>

    <header>

        <h1>Gestão de Estoque</h1>

        <p>Controle dos produtos cadastrados no mercado.</p>

    </header>

    <hr>

    <main>

        <section>

            <h2>Cadastrar produto</h2>

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

                <label for="preco">Preço:</label><br>

                <input type="number" id="preco" name="preco" step="0.01" min="0" required>

                <br><br>

                <label for="estoque">Quantidade em estoque:</label><br>

                <input type="number" id="estoque" name="estoque" min="0" value="0" required>

                <br><br>

                <label for="data_validade">Data de validade:</label><br>

                <input type="date" id="data_validade" name="data_validade" required>

                <br><br>

                <button type="submit">Cadastrar</button>

            </form>

        </section>

        <hr>

        <section>

            <h2>Produtos cadastrados</h2>

            <?php if ($resultado->num_rows > 0) { ?>

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Validade</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($produto = $resultado->fetch_assoc()) { ?>

                            <tr>

                                <td>
                                    <?php echo $produto["id"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($produto["nome"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($produto["categoria"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($produto["descricao"]); ?>
                                </td>

                                <td>
                                    R$
                                    <?php
                                    echo number_format(
                                        $produto["preco"],
                                        2,
                                        ",",
                                        "."
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php echo $produto["quantidade_estoque"]; ?>
                                </td>

                                <td>
                                    <?php
                                    echo date(
                                        "d/m/Y",
                                        strtotime($produto["data_validade"])
                                    );
                                    ?>
                                </td>

                                <td>

                                    <a href="public/editar.php?id=<?php echo $produto["id"]; ?>">
                                        Editar
                                    </a>

                                    |

                                    <a href="public/excluir.php?id=<?php echo $produto["id"]; ?>"
                                        onclick="return confirm('Deseja realmente excluir este produto?');">
                                        Excluir
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <p>Nenhum produto cadastrado.</p>

            <?php } ?>

        </section>

    </main>

</body>

</html>