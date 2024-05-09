<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once('../conexao.php');

$id = $_GET['id'];

try {
 // Selecionar apenas as colunas necessárias
 $stmt = $pdo->prepare('SELECT ADM_ID, ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO FROM ADMINISTRADOR WHERE ADM_ID = :id');
 $stmt->bindParam(':id', $id, PDO::PARAM_INT);
 $stmt->execute();
 $admin = $stmt->fetch(PDO::FETCH_ASSOC);

 echo json_encode(['admin' => $admin]);
} catch (PDOException $e) {
 echo json_encode(['error' => 'Erro ao consultar dados do administrador: ' . $e->getMessage()]);
}
