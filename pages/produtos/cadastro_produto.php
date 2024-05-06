<?php

require_once('../../utils/PHP/conexao.php');


if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}

try {
 $stmt_categoria = $pdo->prepare("SELECT * FROM CATEGORIA");
 $stmt_categoria->execute();
 $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
 echo "<p style='color:red;'>Erro ao buscar categorias" . $e->getMessage() . "</p>";
}

echo "
<pre>";
print_r($_POST);
echo "</pre>";

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Cadastro de produto</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="../../styles/globalstyles.css">

</head>

<body>
 <section class="dynamic-section">

  <section class="form__container container mt-5">


   <h2>Cadastrar Produto</h2>


   <form class="form__cadastro__prod" action="../utils/PHP/produtos/cadastrarProd.php" method="post">
    <div class="mb-3">
     <label for="nome" class="form-label">Nome</label>
     <input type="text" name="nome" id="nome" class="form-control" required>
    </div>
    <div class="mb-3">
     <label for="descricao" class="form-label">Descrição</label>
     <textarea name="descricao" id="descricao" cols="30" rows="5" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
     <label for="preco" class="form-label">Preço</label>
     <input type="number" name="preco" id="preco" step="0.01" class="form-control" required>
    </div>
    <div class="mb-3">
     <label for="desconto">Desconto: </label>
     <input type="number" name="desconto" id="desconto" class="form-control" step="0.01">
    </div>
    <div class="mb-3">
     <label for="qtd">Quantidade: </label>
     <input type="number" name="qtd" id="qtd" class="form-control" step="0.01">
    </div>
    <div class="mb-3">
     <div class="mb-3">
      <label for="categoria_id">Categoria: </label>
      <select name="categoria_id" id="categoria_id" required class="form-select">
       <?php
       foreach ($categorias as $categoria) {
        echo '<option value="' . $categoria['CATEGORIA_ID'] . '">' . $categoria['CATEGORIA_NOME'] . '</option>';
       }
       ?>
      </select>
     </div>
     <label for="ativo">Ativo: </label>
     <input class="form-check-input " type="checkbox" name="ativo" value="1">
    </div>
    </div>
    <div class="mb-3" id="containerImagens">

     <label for="imagem_url[]" class="form-label">Imagem URL:</label>
     <input type="text" name="imagem_url[]" class="form-control" placeholder="URL da imagem" required>

     <label for="imagem_Ordem[]" class="form-label">Imagem Ordem:</label>
     <input type="number" name="imagem_Ordem[]" class="form-control" placeholder="Ordem" required>

    </div>
    <button type="button" class="add-img-btn btn btn-primary">Adicionar mais Imagens</button>
    <button type="submit" class="btn btn-primary">Enviar</button>
   </form>
  </section>
 </section>

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
 </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
 </script>
</body>

</html>