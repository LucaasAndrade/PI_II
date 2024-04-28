<?php

require_once "../conexao.php";

$id = $_GET['id'];

if (isset($id)) {
    try {
        $sql = "DELETE FROM ADMINISTRADOR WHERE ADM_ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: ../../pages/adm/listar_adm.php');
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
    }
}
