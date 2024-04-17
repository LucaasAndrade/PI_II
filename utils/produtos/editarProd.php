<?php

require_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $desc = $_POST['descricao'];
    $preco = $_POST['preco'];
    $ativo = isset($_POST['ativo']) ? '1' : '';

    try {

        $stmt = $pdo->prepare("UPDATE PRODUTO SET PRODUTO_NOME = :nome, PRODUTO_DESC = :descricao, PRODUTO_PRECO = :preco, ADM_ATIVO = :ativo WHERE PRODUTO_ID  = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_BOOL);
        $stmt->execute();

        header('Location: ../../pages/produtos/listar_produto.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro ao alterar informações: " . $e->getMessage();
    }
}
