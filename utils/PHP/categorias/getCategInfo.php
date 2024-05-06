<?php

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once('../conexao.php');

$id = $_GET['id'];

try {
 $stmt_categoria = $pdo->prepare("SELECT * FROM CATEGORIA WHERE CATEGORIA_ID = :id");
 $stmt_categoria->bindParam(':id', $id, PDO::PARAM_INT);
 $stmt_categoria->execute();
 $categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);

 echo json_encode(['categoria' => $categoria]);
} catch (PDOException $e) {
 echo json_encode(['error' => 'Erro ao consultar informações das categorias: ' . $e->getMessage()]);
}
