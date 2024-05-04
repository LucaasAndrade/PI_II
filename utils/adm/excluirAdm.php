<?php

require_once "../conexao.php";

$id = $_POST['id'];

if (isset($id)) {
    try {
        $sql = "DELETE FROM ADMINISTRADOR WHERE ADM_ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        echo "<div class='alert alert-success' role='alert'>
        Excluído com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
    }
}
