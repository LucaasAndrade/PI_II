<?php

session_start();

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
    $user_authentication = false;

    foreach ($users_app as $user) {
        if ($user['email'] == $_POST['user__email'] && $user['senha'] == $_POST['user__password']) {
            $user_authentication = true;
            break;
        }
    }

    if ($user_authentication) {
        // Usuário autenticado com sucesso
        $_SESSION['autenticado'] = 'SIM';
        header('Location: ../pages/home.php');
    } else {
        // Autenticação falhou
        $_SESSION['autenticado'] = 'NAO';
        header('Location: ../pages/login.php?login=erro');
    }
}
