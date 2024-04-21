<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../../styles/globalStyles.css">

</head>

<body>
    <section class="container mt-5">

        <?php

        require_once("../../utils/conexao.php");

        $id = $_GET['id'];

        if (isset($id)) {
            try {
                $pdo->beginTransaction();
                $sqlDeleteImagem = "DELETE FROM produto_imagem WHERE PRODUTO_ID = :id";
                $stmtDeleteImagem = $pdo->prepare($sqlDeleteImagem);
                $stmtDeleteImagem->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtDeleteImagem->execute();

                
                $sql = "DELETE FROM produto WHERE PRODUTO_ID = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $pdo->commit();
                echo "<div class='alert alert-success' role='alert'>
                Excluído com sucesso!</div>";
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
            }
        }

        ?>
        <div class="back__container">
            <a href="listar_produtos.php" class="btn btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i></i>
            Voltar a listagem de produtos</a>
        </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>