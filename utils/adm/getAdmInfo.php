<?php
require_once('../conexao.php');

if (!isset($_GET['id'])) {
    echo json_encode(['erro' => 'ID do administrador não reconhecido.']);
    exit();
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare('SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        echo json_encode(['error' => 'Administrador não encontrado']);
        exit();
    }

    
    echo json_encode($admin);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao consultar dados do administrador: ' . $e->getMessage()]);
}
?>

