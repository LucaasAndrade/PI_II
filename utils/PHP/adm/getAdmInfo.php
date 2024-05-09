<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once('../conexao.php');

$id = $_GET['id'];

try {
 $stmt = $pdo->prepare('SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id');
 $stmt->bindParam(':id', $id, PDO::PARAM_INT);
 $stmt->execute();
 $admin = $stmt->fetch(PDO::FETCH_ASSOC);


 echo json_encode(['admin' => $admin]);
} catch (PDOException $e) {
 echo json_encode(['error' => 'Erro ao consultar dados do administrador: ' . $e->getMessage()]);
}
