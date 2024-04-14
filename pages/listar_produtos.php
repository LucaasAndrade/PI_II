<?php

require_once('../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../index.php');
    exit();
}

try {
    $stmt = $pdo->prepare(
    "SELECT PRODUTO.*, 
            CATEGORIA.CATEGORIA_NOME, 
            PRODUTO_IMAGEM.IMAGEM_URL, 
            PRODUTO_IMAGEM.IMAGEM_ORDEM, 
            PRODUTO_ESTOQUE.PRODUTO_QTD
        FROM PRODUTO 
            JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
            LEFT JOIN CATEGORIA ON PRODUTO.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID
            LEFT JOIN PRODUTO_ESTOQUE ON PRODUTO.PRODUTO_ID = PRODUTO_ESTOQUE.PRODUTO_ID 
            GROUP BY produto.PRODUTO_ID");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    print_r($produtos);
} catch (PDOException $e) {
    echo 'Erro ao listar produtos:' . $e->getMessage() . PHP_EOL;
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/globalStyles.css">


</head>

<body>
    <section class="list__container">
        <h2>Lista de produtos</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ordem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ativo</th>
                    <th>Desconto</th>
                    <th>Estoque</th>
                    <th>Imagem</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?php echo $produto['PRODUTO_ID']; ?></td>
                    <td><?php echo $produto['IMAGEM_ORDEM']; ?></td>
                    <td><?php echo $produto['PRODUTO_NOME']; ?></td>
                    <td><?php echo $produto['PRODUTO_DESC']; ?></td>
                    <td><?php echo $produto['PRODUTO_PRECO']; ?></td>
                    <td><?php echo $produto['CATEGORIA_NOME']; ?></td>
                    <td>
                        <?php echo ($produto['PRODUTO_ATIVO'] == '0') ? "<p class='text-danger'>Não ativo</p>" :  "<p class='text-success'>Ativo</p>"?>
                    </td>
                    <td><?php echo $produto['PRODUTO_DESCONTO']; ?></td>
                    <td><?php echo $produto['PRODUTO_QTD'] <= 0 ? "Produto sem estoque" : $produto['PRODUTO_QTD']; ?></td>
                    <td> <img src="<?php echo "{$produto['IMAGEM_URL']}"; ?>" width="50" alt="imagem do produto" />
                    </td>
                    <td>
                        <a href="../utils/editar_produto.php?id=<?php echo $produto['PRODUTO_ID'] ?>" class="btn btn-primary">Editar</a>
                        <a href="../utils/excluir_produto.php?id=<?php echo $produto['PRODUTO_ID'] ?>" class="btn btn-danger">Deletar</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <a href="painel_adm.php" class="btn btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i> Voltar ao Painel
            do Administrador</a>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>