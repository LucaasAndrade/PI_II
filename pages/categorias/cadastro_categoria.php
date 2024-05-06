<?php

require_once('../../utils/PHP/conexao.php');


if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}

try {

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $CATEGORIA_NOME = $_POST['nome_categoria'];
  $CATEGORIA_DESC = $_POST['desc_categoria'];
  $CATEGORIA_ATIVO = isset($_POST['ativo_categoria']) ? 1 : 0;

  // print_r($_POST);

  $stmt = $pdo->prepare('INSERT INTO categoria(CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO) VALUES (:CATEGORIA_NOME, :CATEGORIA_DESC, :CATEGORIA_ATIVO)');

  $stmt->bindParam(':CATEGORIA_NOME', $CATEGORIA_NOME, PDO::PARAM_STR);
  $stmt->bindParam(':CATEGORIA_DESC', $CATEGORIA_DESC, PDO::PARAM_STR);
  $stmt->bindParam(':CATEGORIA_ATIVO', $CATEGORIA_ATIVO, PDO::PARAM_BOOL);

  $stmt->execute();


  echo "<p style='color: green'> Categoria cadastrada com sucesso </p>";
 }
} catch (PDOException $e) {
 echo 'Erro:' . $e;
}


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <title>Cadastro de categoria</title>
</head>

<body>
 <section class="dynamic-section">
  <section class="form__container container mt-5">
   <h1>
    Cadastro Categoria
   </h1>

   <form action="" method="POST">

    <div class="form-group">
     <div>
      <label for="nome_categoria"> Nome Categoria: </label>
     </div>
     <input type="text" name="nome_categoria" class="form-control">
    </div>


    <div class="form-group">
     <div>
      <label for="desc_categoria"> Descrição da Categoria: </label>
     </div>
     <textarea name="desc_categoria" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">

     <label for="ativo_categoria">Categoria Ativa: </label>

     <input type="checkbox" name="ativo_categoria" class="form-check-input">
    </div>

    <div class="form-group">
     <input type="submit" class="btn btn-primary">
    </div>


   </form>
  </section>


 </section>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>