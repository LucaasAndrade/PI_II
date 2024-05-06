<?php

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once('../conexao.php');

if (!isset($_GET['id'])) {
 echo json_encode(['erro' => 'ID do produto não reconhecido.']);
 exit();
}


$id = $_GET['id'];

try {
 $stmt = $pdo->prepare("SELECT PRODUTO.*, CATEGORIA.CATEGORIA_NOME, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_IMAGEM.IMAGEM_ORDEM, PRODUTO_ESTOQUE.PRODUTO_QTD
            FROM PRODUTO
            JOIN CATEGORIA ON PRODUTO.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID
            LEFT JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
            LEFT JOIN PRODUTO_ESTOQUE ON PRODUTO.PRODUTO_ID = PRODUTO_ESTOQUE.PRODUTO_ID
            WHERE PRODUTO.PRODUTO_ID = :id");
 $stmt->bindParam(':id', $id, PDO::PARAM_INT);
 $stmt->execute();
 $produto = $stmt->fetch(PDO::FETCH_ASSOC);

 $stmt_imagem = $pdo->prepare("SELECT PRODUTO.*, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_IMAGEM.IMAGEM_ORDEM, PRODUTO_IMAGEM.IMAGEM_ID
        FROM PRODUTO
        JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID 
        WHERE PRODUTO.PRODUTO_ID = :id");
 $stmt_imagem->bindParam(':id', $id, PDO::PARAM_INT);
 $stmt_imagem->execute();
 $imagens_produto = $stmt_imagem->fetchAll(PDO::FETCH_ASSOC);

 $stmt_categoria = $pdo->prepare("SELECT * FROM CATEGORIA");
 $stmt_categoria->execute();
 $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);


 echo json_encode([
  'produto' => $produto,
  'imagens' => $imagens_produto,
  'categorias' => $categorias
 ]);
} catch (PDOException $e) {
 echo json_encode(['error' => 'Erro ao consultar informações de produto: ' . $e->getMessage()]);
}
