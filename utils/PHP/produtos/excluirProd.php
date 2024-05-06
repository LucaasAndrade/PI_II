

        <?php

        require_once "../conexao.php";

        $id = $_POST['id'];

        if (isset($id)) {
            try {
                $pdo->beginTransaction();


                $sqlDeleteImagem = "DELETE FROM produto_imagem WHERE PRODUTO_ID = :id";
                $stmtDeleteImagem = $pdo->prepare($sqlDeleteImagem);
                $stmtDeleteImagem->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtDeleteImagem->execute();

                $sqlDeleteEstoque = "DELETE FROM produto_estoque WHERE PRODUTO_ID = :id";
                $stmtDeleteEstoque = $pdo->prepare($sqlDeleteEstoque);
                $stmtDeleteEstoque->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtDeleteEstoque->execute();



                $sqlDeleteProduto = "DELETE FROM produto WHERE PRODUTO_ID = :id";
                $stmtDeleteProduto = $pdo->prepare($sqlDeleteProduto);
                $stmtDeleteProduto->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtDeleteProduto->execute();

                $pdo->commit();
                header('Location: ../../pages/produtos/listar_produtos.php');
            } catch (PDOException $e) {
                $pdo->rollBack();
                echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
            }
        }
        ?>


