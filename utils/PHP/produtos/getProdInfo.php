<?php


require_once('../conexao.php');


$id = $_GET['id'];

try {
       $stmt = $pdo->prepare("SELECT PRODUTO.*, CATEGORIA.CATEGORIA_NOME, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_IMAGEM.IMAGEM_ORDEM, PRODUTO_IMAGEM.IMAGEM_ID, PRODUTO_ESTOQUE.PRODUTO_QTD
            FROM PRODUTO
            JOIN CATEGORIA ON PRODUTO.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID
            LEFT JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
            LEFT JOIN PRODUTO_ESTOQUE ON PRODUTO.PRODUTO_ID = PRODUTO_ESTOQUE.PRODUTO_ID
            WHERE PRODUTO.PRODUTO_ID = :id");
       $stmt->bindParam(':id', $id, PDO::PARAM_INT);
       $stmt->execute();
       $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

       $produto = $resultados[0];
       $imagens = array_map(function ($resultado) {
              return [
                     'IMAGEM_URL' => $resultado['IMAGEM_URL'],
                     'IMAGEM_ORDEM' => $resultado['IMAGEM_ORDEM'],
                     'IMAGEM_ID' => $resultado['IMAGEM_ID']
              ];
       }, $resultados);

       $stmt_categoria = $pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME FROM CATEGORIA");
       $stmt_categoria->execute();
       $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);


       echo json_encode([
              'produto' => $produto,
              'imagens' => $imagens,
              'categorias' => $categorias
       ]);
} catch (PDOException $e) {
       echo json_encode(['error' => 'Erro ao consultar informações de produto: ' . $e->getMessage()]);
}
