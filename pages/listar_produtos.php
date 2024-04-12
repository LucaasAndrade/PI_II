<?php

require_once('../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../index.php');
    exit();
}

try {
    $stmt = $pdo->prepare('SELECT * FROM PRODUTO');
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erro:' . $e->getMessage() . PHP_EOL;
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
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?php echo $produto['id_produto']; ?></td>
                    <td><?php echo $produto['nome']; ?></td>
                    <td><?php echo $produto['descricao']; ?></td>
                    <td><?php echo $produto['preco']; ?></td>
                    <td> <img src="<?php echo "../uploads/{$produto['imagem']}"; ?>" width="50" alt="imagem do produto" /> </td>
                    <td>
                        <a href="../utils/editar_produto.php?id=<?php echo $produto['id_produto'] ?>" class="btn btn-primary">Editar</a>
                        <a href="../utils/excluir_produto.php?id=<?php echo $produto['id_produto'] ?>" class="btn btn-danger">Deletar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>

        <a href="painel_adm.php" class="btn btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i> Voltar ao Painel do Administrador</a>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>