<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/globalstyles.css">
</head>

<body>

    <main class="main__container">
        <form method="POST" class="form__container" action="../utils/valida_login.php">
            <div>
                <label for="user__email" class="form-label">E-mail:</label>
                <input type="text" class="form-control" name="user__email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Nunca iremos compartilhar seus dados</div>
            </div>
            <div>
                <label for="user__password" class="form-label">Senha:</label>
                <input type="password" class="form-control" name="user__password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="check-box">
                <label class="form-check-label" for="check-box">Manter-me conectado</label>
            </div>
            <?php if (isset($_GET['login']) && $_GET['login'] == 'erro') { ?>
                <div>
                    <p class="text-danger">Usuário inválido, tente novamente!</p>
                </div>
            <?php } ?>

            <?php if (isset($_GET['login']) && $_GET['login'] == 'erro2') { ?>
                <div>
                    <p class="text-danger">Por gentileza, faça o login!</p>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary btn__form">Entrar</button>
        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>