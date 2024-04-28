<?php

require_once "../../utils/conexao.php";

$id = $_GET['id'];

if (isset($id)) {
    try {
        $sql = "DELETE FROM CATEGORIA WHERE CATEGORIA_ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: listar_categorias.php');



        
        echo "<div class='alert alert-success' role='alert'>
        Excluído com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
    }
}