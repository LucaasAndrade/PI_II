<?php
require_once('../../utils/conexao.php');


if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}



if ($_SERVER['REQUEST_METHOD'] == 'GET') {

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
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Lista produtos</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="../../styles/globalstyles.css">

</head>

<body>
 <section class="dynamic-section">
  <section class="form__container container mt-5">

   <form action="../utils/adm/editarAdm.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $usuario['ADM_ID']; ?>">

    <div class="mb-3">
     <label for="nome" class="form-label">Nome</label>
     <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $usuario['ADM_NOME']; ?>" required>
    </div>
    <div class="mb-3">
     <label for="email" class="form-label">E-mail</label>
     <input type="email" name="email" class="form-control" value="<?php echo $usuario['ADM_EMAIL']; ?>" required>
    </div>
    <div class="mb-3">
     <label for="senha" class="form-label">Senha</label>
     <input type="password" name="senha" class="form-control" value="<?php echo $usuario['ADM_SENHA']; ?>" required>
    </div>
    <div class="mb-3">
     <label for="ativo" class="form-label">Ativo</label>
     <input type="checkbox" name="ativo" value="1" <?php echo $usuario['ADM_ATIVO'] == 1 ? 'checked' : '' ?>>
    </div>
    <input type="submit" class="btn btn-primary" value="Enviar">
   </form>

  </section>
 </section>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
 </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
 </script>
</body>

</html>