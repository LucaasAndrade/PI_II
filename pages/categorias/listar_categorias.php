<?php
require_once('../../utils/conexao.php');

if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}

$stmt = $pdo->prepare('SELECT * FROM categoria');
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/globalstyles.css">
    <title>Listar categoria</title>
</head>


<body>
    <section class="dynamic-section">
        <h1> Listar Categoria </h1>

        <table class="tableCateg">
            <thead>
                <tr>
                    <th>Nome categoria</th>
                    <th>Descrição da categoria</th>
                    <th>Ativo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
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

                        <td><a href="editar_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="excluir_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>
