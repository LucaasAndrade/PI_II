<?php

require_once('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $desconto = $_POST['desconto'];
    $categoria_id = $_POST['categoria_id'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $qtd = $_POST['qtd'];
    $imagem_urls = $_POST['imagem_url'];
    $imagem_ordem = $_POST['imagem_Ordem'];


    try {
        $sql = "INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO) VALUES (:nome,
        :descricao, :preco, :desconto, :categoria_id, :ativo)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':desconto', $desconto, PDO::PARAM_STR);
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_STR);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->execute();

        $produto_id = $pdo->lastInsertID();


        $sql_estoque = "INSERT INTO PRODUTO_ESTOQUE (PRODUTO_ID, PRODUTO_QTD) VALUES (:produto_id, :qtd)";
        $stmt_estoque = $pdo->prepare($sql_estoque);
        $stmt_estoque->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
        $stmt_estoque->bindParam(':qtd', $qtd, PDO::PARAM_INT);
        $stmt_estoque->execute();

        foreach ($imagem_urls as $index => $url) {
            $ordem = $imagem_ordem[$index];
            $sql_imagem = "INSERT INTO PRODUTO_IMAGEM (IMAGEM_URL, PRODUTO_ID, IMAGEM_ORDEM) VALUES (:url_imagem, :produto_id, :ordem_imagem )";
            $stmt_imagem = $pdo->prepare($sql_imagem);
            $stmt_imagem->bindParam(':url_imagem', $url, PDO::PARAM_STR);
            $stmt_imagem->bindParam(':produto_id', $produto_id, PDO::PARAM_STR);
            $stmt_imagem->bindParam(':ordem_imagem', $ordem, PDO::PARAM_INT);

            $stmt_imagem->execute();
        }

        echo "<div class='alert alert-success' role='alert'>
        Produto cadastrado com sucesso!</div>";

        header('Location: ../../pages/produtos/listar_produtos.php');
    } catch (PDOException $e) {

        echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
    }
}
