<?php

require_once('conexao.php');

$nome = $_POST['user__email'];
$senha = $_POST['user__password'];

$sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_EMAIL = :email AND ADM_SENHA = :senha AND ADM_ATIVO = 1";

$query = $pdo->prepare($sql);

$query->bindParam(':email', $nome, PDO::PARAM_STR);
$query->bindParam(':senha', $senha, PDO::PARAM_STR);

$query->execute();

if ($query->rowCount() > 0) {
    $_SESSION['admin_logado'] = true;
    header('Location: ../pages/painel_adm.php');
} else {
    header('Location: ../index.php?erro');
}
