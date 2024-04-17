<?php

session_start();

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/globalstyles.css">
</head>

<body>
    <section class="painel__admin__container">

        <nav class="sidebar">
            <header>
                <div class="text">
                    <span class="header-text ">Painel do administrador</span>
                </div>
                <i class='bx bx-chevron-right toggle'></i>
            </header>
            <div class="menu__bar">
                <div class="menu">
                    <ul class="menu__links">
                        <li class="nav__link">
                            <a href="adm/cadastro_adm.php">
                                <i class='bx bxs-user-circle'></i>
                                Cadastrar administrador
                            </a>
                        </li>
                        <li class="nav__link">
                            <a href="adm/listar_adm.php">
                                <i class='bx bx-list-ul'></i>
                                Listar administradores
                            </a>
                        </li>
                        <li class="nav__link">
                            <a href="produtos/cadastro_produto.php">
                                <i class='bx bxs-box'></i>
                                Cadastrar produto
                            </a>
                        </li>
                        <li class="nav__link">
                            <a href="produtos/listar_produtos.php">
                                <i class='bx bx-list-ul'></i>
                                Listar produtos
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="button__content">

                    <ul>
                        <li>
                            <a href="../utils/logoff.php">
                                <i class='bx bx-log-out'></i>
                                Logout
                            </a>
                        </li>
                        <li class="mode">
                            <div class="moon__sun">
                                <i class='bx bx-moon icon moon'></i>
                                <i class='bx bx-sun icon sun'></i>
                            </div>
                            <span class="mode__text">Dark Mode</span>
                            <div class="toggle-switch">
                                <span class="switch"></span>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="../utils/js/script.js"></script>
</body>

</html>