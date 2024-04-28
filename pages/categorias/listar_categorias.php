<?php
require_once('../../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../../index.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM categoria');
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Listar categoria</title>
</head>

<body>
    <section class="dynamic-section">
        <h1> Listar Categoria </h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nome categoria</th>
                    <th>Descrição da categoria</th>
                    <th>Ativo</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) : ?>
                    <tr>
                        <td><?php echo $categoria['CATEGORIA_NOME'] ?></td>
                        <td><?php echo $categoria['CATEGORIA_DESC'] ?></td>
                        <td>
                            <?php if ($categoria['CATEGORIA_ATIVO'] == '0') : ?>
                                <p class="text-danger">Não ativo</p>
                            <?php else : ?>
                                <p class="text-success">Ativo</p>
                            <?php endif; ?>
                        </td>
                        <td><a href="excluir_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>" class="btn btn-primary"><i class='bx bxs-message-square-x'></i></a></td>
                        <td><a href="editar_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>" class="btn btn-danger"><i class='bx bxs-edit-alt'></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

<<<<<<< HEAD
    <table border="1">
        <tr>
            <th> Nome categoria</th>
            <th> Descrição da categoria</th>
            <th> Ativo</th>
        </tr>
        <?php foreach($categorias as $categoria): ?>
        <td>
            <tr>
                <td><?php echo $categoria['CATEGORIA_NOME'] ?></td>
                <td><?php echo $categoria['CATEGORIA_DESC'] ?></td>
                <td><?php echo $categoria['CATEGORIA_ATIVO'] == 1  ? "<p style='color: green'> Ativo </p>" : "<p style='color: red'> Não ativo </p>" ?></td>
                <td><a href="excluir_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>"> Excluir </a></td>
                <td><a href="editar_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>"> Editar </a></td>
            </tr>
        </td>
        <?php endforeach; ?>
    </table>

    <a href="../painel_adm.php">Voltar para menu</a>

=======
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
>>>>>>> 0bd3cfa518be4c950e9b60a67db78a68688e6c85
</body>

</html>