<?php

require_once('../../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../../index.php');
    exit();
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM CATEGORIA WHERE CATEGORIA_ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($categoria);
    } catch (PDOException $e) {
        echo "Erro ao consultar informações: " . $e->getMessage();
    }
} else {
    header('Location: listar_categorias.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];

    $CATEGORIA_NOME = $_POST['nome_categoria'];
    $CATEGORIA_DESC = $_POST['desc_categoria'];
    $CATEGORIA_ATIVO = isset($_POST['ativo_categoria']) ? '1' : '';

    try {

        $stmt = $pdo->prepare("UPDATE categoria SET CATEGORIA_NOME = :CATEGORIA_NOME, CATEGORIA_DESC = :CATEGORIA_DESC, CATEGORIA_ATIVO = :CATEGORIA_ATIVO WHERE CATEGORIA_ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':CATEGORIA_NOME', $CATEGORIA_NOME, PDO::PARAM_STR);
        $stmt->bindParam(':CATEGORIA_DESC', $CATEGORIA_DESC, PDO::PARAM_STR);
        $stmt->bindParam(':CATEGORIA_ATIVO', $CATEGORIA_ATIVO, PDO::PARAM_BOOL);
        $stmt->execute();

        header('Location: listar_categorias.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro ao alterar informações: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECHO: Editar Categoria</title>
</head>

<body>
    <section class="dynamic-section">
        <h1> Editar categoria </h1>

        <form action="" method="POST">

            <label for="nome_categoria"> Nome Categoria: </label>
            <input type="text" name="nome_categoria" value="<?php echo $categoria['CATEGORIA_NOME'] ?>">


            <label for="desc_categoria"> Descrição Categoria: </label>
            <input type="text" name="desc_categoria" value="<?php echo $categoria['CATEGORIA_DESC'] ?>">

            <label for="ativo_categoria"> Ativo </label>
            <input type="checkbox" name="ativo_categoria"
                <?php echo isset(($categoria['CATEGORIA_ATIVO'])) ? 'checked' : '' ?>>

            <input type="submit">



        </form>

    </section>

</body>

</html>