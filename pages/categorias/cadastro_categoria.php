<?php

require_once('../../utils/conexao.php');


if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../index.php');
    exit();
}

try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $CATEGORIA_NOME = $_POST['nome_categoria'];
        $CATEGORIA_DESC = $_POST['desc_categoria'];
        $CATEGORIA_ATIVO = isset($_POST['ativo_categoria']) ? 1 : 0;

        // print_r($_POST);

        $stmt = $pdo->prepare('INSERT INTO categoria(CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO) VALUES (:CATEGORIA_NOME, :CATEGORIA_DESC, :CATEGORIA_ATIVO)');

        $stmt->bindParam(':CATEGORIA_NOME', $CATEGORIA_NOME, PDO::PARAM_STR);
        $stmt->bindParam(':CATEGORIA_DESC', $CATEGORIA_DESC, PDO::PARAM_STR);
        $stmt->bindParam(':CATEGORIA_ATIVO', $CATEGORIA_ATIVO, PDO::PARAM_BOOL);

        $stmt->execute();


        echo "<p style='color: green'> Categoria cadastrada com sucesso </p>";
    }
} catch (PDOException $e) {
    echo 'Erro:' . $e;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echo: Cadastro Categoria </title>

    <style>
    textarea {
        resize: none;
    }

    span {
        margin-inline: 5px;
    }
    </style>
</head>

<body>
    <section class="dynamic-section">
        <h1>
            Cadastro Categoria
        </h1>

        <form action="" method="POST">

            <div>
                <div>
                    <label for="nome_categoria"> Nome Categoria: </label>
                </div>
                <input type="text" name="nome_categoria">
            </div>


            <div>
                <div>
                    <label for="desc_categoria"> Descrição da Categoria: </label>
                </div>
                <textarea name="desc_categoria" id="" cols="30" rows="10"></textarea>
            </div>

            <div>

                <label for="ativo_categoria">Categoria Ativa: </label>

                <input type="checkbox" name="ativo_categoria">
            </div>

            <div>
                <input type="submit">
            </div>



        </form>

    </section>
</body>

</html>