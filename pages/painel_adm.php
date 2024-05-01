<?php

require_once('../utils/conexao.php');

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

    <main class="main__container light">
        <section class="painel__admin__container">
            <nav class="sidebar close">
                <header>
                    <div class="logo__container">
                        <img src="../images/logo2.png" alt="logo echo">
                        <a class="text" href="painel_adm.php">Painel administrador</a>
                    </div>
                    <i class='bx bx-chevron-right toggle'></i>
                </header>
                <div class="menu__bar">
                    <div class="menu">
                        <ul class="menu__links">
                            <li class="nav__link">
                                <a href="adm/cadastro_adm.php">
                                    <i class='bx bxs-user-circle'></i>
                                    <span class="text">Cadastrar administrador</span>
                                </a>
                            </li>
                            <li class="nav__link">
                                <a href="adm/listar_adm.php">
                                    <i class='bx bx-list-ul'></i>
                                    <span class="text">Listar administradores</span>
                                </a>
                            </li>
                            <li class="nav__link">
                                <a href="produtos/cadastro_produto.php">
                                    <i class='bx bxs-box'></i>
                                    <span class="text">Cadastrar produto</span>
                                </a>
                            </li>
                            <li class="nav__link">
                                <a href="produtos/listar_produtos.php">
                                    <i class='bx bx-list-ul'></i>
                                    <span class="text">Listar produtos</span>
                                </a>
                            </li>
                            <li class="nav__link">
                                <a href="categorias/cadastro_categoria.php">
                                    <i class='bx bxs-category'></i>
                                    <span class="text">Cadastro de categorias</span>
                                </a>
                            </li>
                            <li class="nav__link">
                                <a href="categorias/listar_categorias.php">
                                    <i class='bx bx-list-ul'></i>
                                    <span class="text">Listar categorias</span>
                                </a>
                            </li>
                            
                            <li class="logout">
                                <a href="../utils/logoff.php">
                                    <i class='bx bx-log-out'></i>
                                    <span class="text">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="button__content">

                        <ul>

                            <li class="mode">
                                <div class="moon__sun">
                                    <i class='bx bx-moon icon moon'></i>
                                    <i class='bx bx-sun icon sun'></i>
                                </div>
                                <span class="mode__text text">Dark Mode</span>
                                <div class="toggle-switch">
                                    <span class="switch"></span>
                                </div>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </section>
        <div id="dynamic-content">
            <h1><?php echo 'Seja bem-vindo(a), ' . $_SESSION['nome_adm'] . '!' . PHP_EOL; ?></h1>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script type="module" src="../utils/js/script.js"></script>
</body>

</html>