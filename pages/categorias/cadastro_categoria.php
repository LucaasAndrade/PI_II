<?php

require_once('../../utils/PHP/conexao.php');


if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
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
   <h2> Cadastrar Categoria</h2>

   <form class="form__cadastro__categ" method="POST">

    <div class="form-group">
     <div>
      <label for="nome_categoria"> Nome Categoria: </label>
     </div>
     <input type="text" name="nome_categoria" id="nome_categoria" class="form-control">
    </div>


    <div class="form-group">
     <div>
      <label for="desc_categoria"> Descrição da Categoria: </label>
     </div>
     <textarea style="resize: none;" maxlength="150" name="desc_categoria" id="desc_categoria" cols="30" rows="5" class="form-control"></textarea>
    </div>

    <div class="form-check">

     <label for="ativo_categoria" class="form-check-label">Categoria Ativa </label>

     <input type="checkbox" name="ativo_categoria" id="ativo_categoria" class="form-check-input">
    </div>

    <button type="submit" class=" btn btn-success">Cadastrar</button>


   </form>
  </section>


 </section>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>