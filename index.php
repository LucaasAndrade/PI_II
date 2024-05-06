<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/globalstyles.css">
</head>

<body>

    <main class="login__container">
        <section class="img__login__banner">
            <img src="images/login/banner.png" alt="banner da página de login">
        </section>
        <section class="form__container">
            <img src="images/logo.png" alt="logo echo" width="450">
            <form method="POST" action="utils/PHP/valida_login.php">
                <div>
                    <label for="user__email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control" name="user__email" aria-describedby="emailHelp" required placeholder="Digite seu e-mail...">
                    <div id="emailHelp" class="form-text">Nunca iremos compartilhar seus dados</div>
                </div>
                <div>
                    <label for="user__password" class="form-label">Senha:</label>
                    <input type="password" class="form-control" name="user__password" placeholder="Digite sua senha..." required>
                </div>


            <!--     <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check-box">
                    <label class="form-check-label" for="check-box">Manter-me conectado</label>
                </div> -->
                <button type="submit" class="btn__form btn btn-primary">Entrar</button>
                <?php
                if (isset($_GET['erro'])) {
                    echo '<div class="alert alert-danger mt-2 text-center border-0 p-2  " role="alert">Nome de usuário ou senha incorretos!</div>';
                }
                ?>
                <?php
                if (isset($_GET['erro2'])) {
                    echo '<div class="alert alert-danger mt-2 text-center border-0 p-2  " role="alert">Por favor, preencha todos os campos.</div>';
                }
                ?>
            </form>
        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>