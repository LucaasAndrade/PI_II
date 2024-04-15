<?php

require_once('../conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../../index.php');
    exit();
}


/* if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        try {
            $stmt = $pdo->prepare("SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao consultar informações: " . $e->getMessage();
        }
    } else {
        header('Location: lista_users.php');
        exit();
    }
} */


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $ativo = isset($_POST['ativo']) ? '1' : '';

    try {

        $stmt = $pdo->prepare("UPDATE ADMINISTRADOR SET ADM_NOME = :nome, ADM_EMAIL = :email, ADM_SENHA = :senha, ADM_ATIVO = :ativo WHERE ADM_ID  = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->execute();

        header('Location: ../../pages/adm/listar_adm.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro ao alterar informações: " . $e->getMessage();
    }
}
