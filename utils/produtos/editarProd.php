<?php

require_once '../conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $desc = $_POST['descricao'];
    $preco = $_POST['preco'];
    $desconto = $_POST['desconto'];
    $qtd = $_POST['qtd_estoque'];
    $ativo = isset($_POST['ativo']) ? '1' : '';
    $categoria = $_POST['categoria_id'];


    if (isset($_POST['imagem_url']) && isset($_POST['imagem_ordem']) && isset($_POST['imagem_id'])) {

        $imagem_urls = $_POST['imagem_url'];
        $imagem_ordens = $_POST['imagem_ordem'];
        $imagem_ids_global = $_POST['imagem_id'];
        // print_r($_POST);
        // var_dump($imagem_ids_global);
        
        try {
            $pdo->beginTransaction();

            $stmt_update = $pdo->prepare("
            UPDATE PRODUTO_IMAGEM 
            SET IMAGEM_URL = :imagem_url, IMAGEM_ORDEM = :imagem_ordem
            WHERE PRODUTO_ID = :id AND IMAGEM_ID = :imagem_id
            ");
            
            foreach ($imagem_urls as $key => $imagem_url) {
                $stmt_update->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt_update->bindParam(':imagem_url', $imagem_url, PDO::PARAM_STR);
                $stmt_update->bindParam(':imagem_ordem', $imagem_ordens[$key], PDO::PARAM_INT);
                $stmt_update->bindParam(':imagem_id', $imagem_ids_global[$key], PDO::PARAM_INT);
                $stmt_update->execute();
            }


            $stmt_update_produto = $pdo->prepare("
                UPDATE PRODUTO 
                SET PRODUTO_NOME = :nome, PRODUTO_DESC = :descricao, 
                    PRODUTO_PRECO = :preco, PRODUTO_DESCONTO = :desconto, 
                    CATEGORIA_ID = :categoria, PRODUTO_ATIVO = :ativo 
                WHERE PRODUTO_ID = :id
            ");
            $stmt_update_produto->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_update_produto->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt_update_produto->bindParam(':descricao', $desc, PDO::PARAM_STR);
            $stmt_update_produto->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt_update_produto->bindParam(':desconto', $desconto, PDO::PARAM_STR);
            $stmt_update_produto->bindParam(':categoria', $categoria, PDO::PARAM_INT);
            $stmt_update_produto->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
            $stmt_update_produto->execute();


            $stmt_update_estoque = $pdo->prepare("
                UPDATE PRODUTO_ESTOQUE 
                SET PRODUTO_QTD = :qtd 
                WHERE PRODUTO_ID = :id
            ");
            $stmt_update_estoque->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_update_estoque->bindParam(':qtd', $qtd, PDO::PARAM_INT);
            $stmt_update_estoque->execute();

            $pdo->commit();

            header('Location: ../../pages/produtos/listar_produtos.php');
            exit();
        } catch (PDOException $e) {

            $pdo->rollBack();
            echo "Erro ao alterar informações: " . $e->getMessage();
        }
    } else {
        echo "Erro: Não foram enviadas imagens para atualização.";
    }
}
