<?php

 $nome = $_POST["login"];
$senha = $_POST["senha"];

// Usuários válidos
$users_app = [
    [
        'email' => 'adm@teste.com.br',
        'senha' => '123456'
    ],

    [
        'email' => 'user@teste.com.br',
        'senha' => 'abcd'
    ],
    [
        'email' => 'admin',
        'senha' => '1234'
    ]
];

if (empty($_POST['user__email']) || empty($_POST['user__password'])) {
    // Usuário não preencheu todos os campos
    header('Location: ../pages/login.php?login=erro2');
} else {
    echo "<p class=" . "login" . "> Login ou Senha inválidos";
} 
?>
