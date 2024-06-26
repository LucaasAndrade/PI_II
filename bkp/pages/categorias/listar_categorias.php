<?php

    require_once('../../utils/conexao.php');

    if (!isset($_SESSION['admin_logado'])) {
        header('Location: ../../index.php');
        exit();
    }

    $stmt = $pdo->prepare('SELECT * FROM categoria');
    
    $stmt->execute();


    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($categorias);

    // echo '<p> teste </p>';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECHO: Listar Categorias </title>
</head>
<body>
    <h1> Listar Categoria </h1>


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

</body>
</html>