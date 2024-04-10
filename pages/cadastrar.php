<?php

require_once('../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $ativo = isset($_POST['ativo']);


    try {
        $sql = "INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO) VALUES (:nome,
        :email, :senha, :ativo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->execute();

        echo "<p style='color:green'>Usuário cadastrado!</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red'>Erro ao cadastrar usuário. </p>" . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <section class="w-50 m-5">
        <div>
            <a href="login.php" class="btn btn-dark"><i class="fa-solid fa-arrow-rotate-left"></i></i> Voltar</a>
        </div>
        <form action="cadastrar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label" value="<?php $nome ?>">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label" value="<?php $email ?>">>E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label" value="<?php $senha ?>">>Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ativo" class="form-label" value="<?php $ativo ?>">>Ativo</label>
                <input type="checkbox" name="ativo" required>
            </div>
            <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>