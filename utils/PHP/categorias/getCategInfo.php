<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once('../conexao.php');

$id = $_GET['id'];

// Validação de entrada
if (!filter_var($id, FILTER_VALIDATE_INT)) {
 echo json_encode(['error' => 'ID inválido']);
 exit;
}

try {

 $stmt_categoria = $pdo->prepare('SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO FROM CATEGORIA WHERE CATEGORIA_ID = :id');
 $stmt_categoria->bindParam(':id', $id, PDO::PARAM_INT);
 $stmt_categoria->execute();
 $categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);



 echo json_encode(['categoria' => $categoria]);
} catch (PDOException $e) {
 echo json_encode(['error' => 'Erro ao consultar informações das categorias: ' . $e->getMessage()]);
}
