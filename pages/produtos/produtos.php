<?php

require_once('../../utils/PHP/conexao.php');

if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}

$produtosComImagens = [];

try {
 $stmt = $pdo->prepare('SELECT PRODUTO.*, CATEGORIA.CATEGORIA_NOME, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_IMAGEM.IMAGEM_ORDEM, PRODUTO_ESTOQUE.PRODUTO_QTD
    FROM PRODUTO 
    JOIN CATEGORIA ON PRODUTO.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID
    LEFT JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
    LEFT JOIN PRODUTO_ESTOQUE ON PRODUTO.PRODUTO_ID = PRODUTO_ESTOQUE.PRODUTO_ID ');
 $stmt->execute();
 $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

 foreach ($produtos as $produto) {
  if ($produto['IMAGEM_URL'] !== null) {
   $produtosComImagens[$produto['PRODUTO_ID']]['imagens'][] = [
    'url' => $produto['IMAGEM_URL'],
    'ordem' => $produto['IMAGEM_ORDEM']
   ];
   if (!isset($produtosComImagens[$produto['PRODUTO_ID']]['produto'])) {
    $produtosComImagens[$produto['PRODUTO_ID']]['produto'] = $produto;
   }
  }
 }

 $stmt_categoria = $pdo->prepare("SELECT * FROM CATEGORIA");
 $stmt_categoria->execute();
 $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
 echo 'Erro ao buscar produtos:' . $e->getMessage() . PHP_EOL;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Produtos</title>

</head>

<body>
 <section class="dynamic-section">

  <section class="prod__container">

   <div class="header__prod">
    <div class="search__container w-50">
     <div class="input-group ">
      <div class="input-group ">
       <input type="search" id="search-input" class="form-control rounded" placeholder="Pesquisar por nome..." aria-label="Search" aria-describedby="search-addon" />
       <button type="button" id="search-button" class="btn btn-dark" data-mdb-ripple-init>Pesquisar</button>
      </div>
     </div>
    </div>
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProdModal" data-bs-whatever="@mdo"><i class="bi bi-plus-circle-dotted"></i></button>
   </div>

   <section class="card__container mt-5 ">



    <?php foreach ($produtosComImagens as $produtoComImagens) : ?>
     <div>
      <div class="searchable product-card">
       <div class="glide" data-product-id="<?php echo $produtoComImagens['produto']['PRODUTO_ID']; ?>">
        <div class="glide__track" data-glide-el="track">
         <ul class="glide__slides">
          <?php foreach ($produtoComImagens['imagens'] as $imagem) : ?>
           <li class="glide__slide">
            <img src="<?php echo $imagem['url']; ?>" alt="<?php echo $produtoComImagens['produto']['PRODUTO_NOME']; ?>">
           </li>
          <?php endforeach; ?>
         </ul>
        </div>

        <div class="glide__arrows" data-glide-el="controls">
         <button class="glide__arrow glide__arrow--left " data-glide-dir=">"><i class="fa-solid fa-arrow-left" style="pointer-events: none;"></i></button>
         <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa-solid fa-arrow-right" style="pointer-events: none;"></i></button>
        </div>
       </div>
       <div class="text-product">
        <h3><?php echo $produtoComImagens['produto']['PRODUTO_NOME']; ?></h3>
        <p>
         <?php
         $descricao = $produtoComImagens['produto']['PRODUTO_DESC'];
         if (strlen($descricao) > 115) {
          $descricaoCortada = substr($descricao, 0, 115);
          $ultimaEspaco = strrpos($descricaoCortada, ' ');
          if ($ultimaEspaco !== false) {
           $descricaoFinal = substr($descricaoCortada, 0, $ultimaEspaco);
          } else {
           $descricaoFinal = $descricaoCortada;
          }
          echo $descricaoFinal . '...';
         } else {
          echo $descricao;
         }
         ?>
        </p>
        <p><strong>Preço:</strong> R$
         <?php echo number_format($produtoComImagens['produto']['PRODUTO_PRECO'], 2, ',', '.'); ?>
        </p>
        <p><strong>Desconto:</strong> R$
         <?php echo number_format($produtoComImagens['produto']['PRODUTO_DESCONTO'], 2, ',', '.'); ?>
        </p>
        <p><strong>Unidades disponíveis:</strong>
         <?php echo number_format($produtoComImagens['produto']['PRODUTO_QTD']); ?></p>
        <p><strong>Categoria:</strong>
         <?php echo $produtoComImagens['produto']['CATEGORIA_NOME']; ?>
        </p>
        <p><strong>Produto ativo:</strong>
         <?php if ($produtoComImagens['produto']['PRODUTO_ATIVO'] == '0') : ?>
          <span class="text-danger fw-bold ">Não ativo</span>
         <?php else : ?>
          <span class="text-success fw-bold ">Ativo</span>
         <?php endif; ?>
        </p>
       </div>
       <div class="links-card">

        <button class="btn btn-primary edit-prod-button" data-bs-target="#editProdModal" data-id="<?php echo  $produtoComImagens['produto']['PRODUTO_ID']; ?>">
         <i class="fa-solid fa-pen-to-square"></i>
        </button>


        <button class="btn btn-danger delete-prod-button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo  $produtoComImagens['produto']['PRODUTO_ID']; ?>">
         <i class="fa-solid fa-trash"></i>
        </button>
       </div>
      </div>
     </div>
    <?php endforeach; ?>

   </section>

  </section>

  <!-- Modal edição -->
  <div class="modal fade edit-modal" id="editProdModal" tabindex="-1" aria-labelledby="editProdModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title fs-5 text-black " id="editProdModalLabel">Edição de produto</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      <form action="../utils/PHP/produtos/editarProd.php" method="post" class="edit-produto-form" enctype="multipart/form-data">

       <input id="edit-id" type="hidden" name="id">


       <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input id="edit-nome" type="text" name="nome" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea style="resize: none;" id="edit-desc" name="descricao" cols="30" rows="10" class="form-control" required></textarea>
       </div>
       <div class="mb-3">
        <label for="preco" class="form-label">Preço</label>
        <input id="edit-preco" type="number" name="preco" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="desconto" class="form-label">Desconto</label>

        <input id="edit-desconto" type="number" name="desconto" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="qtd_estoque" class="form-label">Quantidade estoque:</label>
        <input id="edit-qtd" type="number" name="qtd_estoque" class="form-control" required>
       </div>
       <div id="imagens-container">

       </div>

       <div class="mb-3">
        <label for="categoria_id">Categoria: </label>
        <select id="edit-categoria" name="edit-categoria" class="form-select">

        </select>
       </div>
       <div class="mb-3 form-check  ">
        <label for="ativo" class="form-check-label ">Ativo</label>
        <input id="edit-ativo" type="checkbox" class="form-check-input  " name="ativo">
       </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-dark " data-bs-dismiss="modal">Enviar edição</button>
       </div>
      </form>
     </div>

    </div>
   </div>
  </div>

  <!-- Modal de confirmação -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h5 class="modal-title text-black" id="confirmDeleteModalLabel">Confirmar exclusão</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      Tem certeza de que deseja excluir este produto?
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      <button type="button" class="btn btn-danger" id="confirmDeleteProd" data-bs-dismiss="modal">Confirmar</button>
     </div>
    </div>
   </div>
  </div>

  <!-- Adição modal -->
  <div class="modal  fade" id="addProdModal" tabindex="-1" aria-labelledby="addProdModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title text-dark   fs-5" id="addProdModalLabel">Cadastrar categoria</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">

      <form class="form__cadastro__prod" action="../utils/PHP/produtos/cadastrarProd.php" method="post">
       <div class="mt-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control mt-1 " required>
       </div>
       <div class="mt-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea style="resize: none;" name="descricao" id="descricao" cols="30" rows="5" class="form-control mt-1" required></textarea>
       </div>
       <div class="mt-3">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" name="preco" id="preco" step="0.01" class="form-control mt-1" required>
       </div>
       <div class="mt-3">
        <label for="desconto">Desconto: </label>
        <input type="number" name="desconto" id="desconto" class="form-control mt-1" step="0.01">
       </div>
       <div class="mt-3">
        <label for="qtd">Quantidade: </label>
        <input type="number" name="qtd" id="qtd" class="form-control mt-1" step="0.01">
       </div>
       <div class="mt-3">
        <div class="mt-3">
         <label for="categoria_id">Categoria: </label>
         <select name="categoria_id" id="categoria_id" required class="form-select mt-1">
          <?php
          foreach ($categorias as $categoria) {
           echo '<option value="' . $categoria['CATEGORIA_ID'] . '">' . $categoria['CATEGORIA_NOME'] . '</option>';
          }
          ?>
         </select>
        </div>
        <div class="form-check mt-3">
         <label for="ativo" class="form-check-label ">Produto Ativo </label>
         <input class="form-check-input mt-1" type="checkbox" name="ativo" value="1">
        </div>
       </div>
       <div id="containerImagens">

        <label for="imagem_url[]" class="form-label mt-3">Imagem URL:</label>
        <input type=" text" name="imagem_url[]" class="form-control mt-1" placeholder="URL da imagem" required>

        <label for="imagem_Ordem[]" class="form-label mt-3">Imagem Ordem:</label>
        <input type="number" name="imagem_Ordem[]" class="form-control mt-1" placeholder="Ordem" required>

       </div>
       <button type="button" class="btn  btn-dark add-img-btn mt-3 ">Adicionar mais Imagens</button>
       <button type="submit" class="btn  btn-dark mt-3 ">Cadastrar produto</button>
      </form>
     </div>


    </div>
   </div>
  </div>
  </div>

  <script>
   document.dispatchEvent(new Event('dynamicContentLoaded'));
  </script>
 </section>


</body>

</html>