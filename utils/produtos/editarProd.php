<?php

require_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $desc = $_POST['descricao'];
    $preco = $_POST['preco'];
    $desconto = $_POST['desconto'];
    $qtd = $_POST['qtd_estoque'];
    $imagem_url = $_POST['imagem_url'];
    $imagem_ordem = $_POST['imagem_ordem'];
    $imagem_id = $_POST['imagem_id'];
    $ativo = isset($_POST['ativo']) ? '1' : '';
    $categoria = $_POST['categoria_id'];

    try {

      


        $stmt = $pdo->prepare("UPDATE PRODUTO_IMAGEM SET IMAGEM_ORDEM  = :ordem, IMAGEM_URL = :imagem_url, IMAGEM_ID = :imagem_id WHERE PRODUTO_ID  = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':imagem_url', $imagem_url, PDO::PARAM_STR);
        $stmt->bindParam(':ordem', $imagem_ordem, PDO::PARAM_INT);
        $stmt->bindParam(':imagem_id', $imagem_id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE PRODUTO_ESTOQUE SET PRODUTO_QTD = :qtd WHERE PRODUTO_ID  = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':qtd', $qtd, PDO::PARAM_STR);
        $stmt->execute();



        $stmt = $pdo->prepare("UPDATE PRODUTO SET PRODUTO_NOME = :nome, PRODUTO_DESC = :descricao, PRODUTO_PRECO = :preco, PRODUTO_DESCONTO = :desconto, CATEGORIA_ID = :categoria,PRODUTO_ATIVO = :ativo WHERE PRODUTO_ID  = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':desconto', $desconto, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->execute();

        header('Location: ../../pages/produtos/listar_produtos.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro ao alterar informações: " . $e->getMessage();
    }
}
