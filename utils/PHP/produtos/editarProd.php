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
    $imagem_urls = $_POST['imagem_url'];
    $imagem_ordens = $_POST['imagem_Ordem'];
    $imagem_ids = $_POST['imagem_id'];

    try {

        $sql = "UPDATE PRODUTO SET PRODUTO_NOME = :nome, PRODUTO_DESC = :descricao, PRODUTO_PRECO = :preco, PRODUTO_DESCONTO = :desconto, CATEGORIA_ID = :categoria_id, PRODUTO_ATIVO = :ativo WHERE PRODUTO_ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':desconto', $desconto, PDO::PARAM_STR);
        $stmt->bindValue(':categoria_id', $categoria, PDO::PARAM_INT);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->execute();

        $sql_estoque = "UPDATE PRODUTO_ESTOQUE SET PRODUTO_QTD = :qtd WHERE PRODUTO_ID = :id";
        $stmt_estoque = $pdo->prepare($sql_estoque);
        $stmt_estoque->bindParam(':produto_id',  $id, PDO::PARAM_INT);
        $stmt_estoque->bindParam(':qtd', $qtd, PDO::PARAM_INT);
        $stmt_estoque->execute();


        foreach ($imagem_urls as $index => $url) {
            $ordem = $imagem_ordem[$index];
            $sql_imagem = "UPDATE PRODUTO_IMAGEM SET IMAGEM_URL = :url_imagem, IMAGEM_ORDEM = :ordem_imagem WHERE PRODUTO_ID = :id";
            $stmt_imagem = $pdo->prepare($sql_imagem);
            $stmt_imagem->bindParam(':url_imagem', $url, PDO::PARAM_STR);
            $stmt_imagem->bindParam(':produto_id',  $id, PDO::PARAM_INT);
            $stmt_imagem->bindParam(':ordem_imagem', $ordem, PDO::PARAM_INT);
            $stmt_imagem->execute();
        }

    } catch (PDOException $e) {

        $pdo->rollBack();
        echo "Erro ao alterar informações: " . $e->getMessage();
    }
}
