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
    $user = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['admin_logado'] = true;
    $_SESSION['nome_adm'] = $user['ADM_NOME'];
    header('Location: ../pages/painel_adm.php');
} else {
    if (empty($nome) || empty($senha)) {
        header('Location: ../index.php?erro2');
    } else {
        header('Location: ../index.php?erro');
    }
}