<?php

require_once('../../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
   header('Location: ../../index.php');
   exit();
}

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
} catch (PDOException $e) {
   echo 'Erro ao listar produtos:' . $e->getMessage() . PHP_EOL;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Produtos</title>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>



</head>

<body>
   <section class="dynamic-section">
      <section class="card__container">
         <h2 class="mt-5">Lista de produtos</h2>
         <div class="row mt-3">
            <?php foreach ($produtosComImagens as $produtoComImagens) : ?>
               <div class="product-card">
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
                        <button class="glide__arrow glide__arrow--left " data-glide-dir="<"><i class="fa-solid fa-arrow-left"></i></button>
                        <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa-solid fa-arrow-right"></i></button>
                     </div>
                  </div>
                  <h3><?php echo $produtoComImagens['produto']['PRODUTO_NOME']; ?></h3>
                  <div class="text-product">
                     <p><?php echo $produtoComImagens['produto']['PRODUTO_DESC']; ?></p>
                     <p><strong>Preço:</strong> R$ <?php echo number_format($produtoComImagens['produto']['PRODUTO_PRECO'], 2, ',', '.'); ?></p>
                     <p><strong>Desconto:</strong> R$ <?php echo number_format($produtoComImagens['produto']['PRODUTO_DESCONTO'], 2, ',', '.'); ?></p>
                  </div>
                  <div class="links-card">
                     <a href="../utils/produtos/editarProd.php?id=<?php echo $produtoComImagens['produto']['PRODUTO_ID']; ?>" class="btn edit-prod-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo  $produtoComImagens['produto']['PRODUTO_ID']; ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <?php echo $produtoComImagens['produto']['PRODUTO_ID']; ?>
                     </a>

                     <a href="../utils/produtos/excluirProd.php?id=<?php echo $produtoComImagens['produto']['PRODUTO_ID']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
         </div>

      </section>




      <!-- Modal edição -->
      <div class="modal fade edit-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edição de produto</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="../utils/produtos/editarProd.php" method="post" enctype="multipart/form-data" class="edit-produto-form">
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
                        <select id="edit-categoria" name="categoria_id" class="form-select" required>

                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="ativo" class="form-label">Ativo</label>
                        <input id="edit-ativo" type="checkbox" name="ativo">
                     </div>
                     <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>

                  </form>

               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

               </div>
            </div>
         </div>
      </div>
   </section>

   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>