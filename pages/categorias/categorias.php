<?php
require_once('../../utils/PHP/conexao.php');

if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}
try {
 $stmt = $pdo->prepare('SELECT * FROM CATEGORIA');
 $stmt->execute();
 $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

 $categoriaEdit = [];

 foreach ($categorias as $categoria) {
  if ($categoria['CATEGORIA_ID'] !== null) {
   $categoriaEdit[] = [
    'id' => $categoria['CATEGORIA_ID'],
    'nome' => $categoria['CATEGORIA_NOME'],
    'desc' => $categoria['CATEGORIA_DESC'],
    'ativo' => $categoria['CATEGORIA_ATIVO'],
   ];
  }
 }
} catch (PDOException $e) {

 echo 'Erro ao buscar categorias:' . $e->getMessage() . PHP_EOL;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title>Listar categoria</title>
</head>


<body>
 <section class="dynamic-section">
  <div class="header__adm  d-flex  my-2  justify-content-between  ">
   <div class="search__container w-50">
    <div class="input-group ">
     <div class="input-group ">
      <input type="search" id="search-input" class="form-control rounded" placeholder="Pesquisar por nome..." aria-label="Search" aria-describedby="search-addon" />
      <button type="button" id="search-button" class="btn btn-dark" data-mdb-ripple-init>Pesquisar</button>
     </div>
    </div>
   </div>
   <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addCategModal" data-bs-whatever="@mdo"><i class="bi bi-window-plus"></i></button>
  </div>

  <table class="table  table-info  table-striped tableCateg">
   <thead>
    <tr>
     <th scope="col">Categoria</th>
     <th scope="col">Descrição</th>
     <th scope="col">Ativo</th>
     <th scope="col">Ações</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($categorias as $categoria) : ?>
     <tr>
      <td class="searchable"><?php echo $categoria['CATEGORIA_NOME'] ?></td>
      <td class="searchable">
       <?php
       $descricao =  $categoria['CATEGORIA_DESC'];
       if (strlen($descricao) > 55) {
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
      </td>
      <td class="searchable">
       <?php if ($categoria['CATEGORIA_ATIVO'] == '0') : ?>
        <p class="text-danger">Não ativo</p>
       <?php else : ?>
        <p class="text-success">Ativo</p>
       <?php endif; ?>
      </td>

      <td>
       <button class="btn btn-primary edit-categ-button" data-bs-target="#editCategModal" data-id="<?php echo  $categoria['CATEGORIA_ID']; ?>">
        <i class="fa-solid fa-pen-to-square"></i>
       </button>
       <button class="btn btn-danger delete-categ-button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo  $categoria['CATEGORIA_ID']; ?>">
        <i class="fa-solid fa-trash"></i>
       </button>
      </td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>


  <!-- Modal edição -->
  <div class="modal moda  fade edit-modal" id="editCategModal" tabindex="-1" aria-labelledby="editCategModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title fs-5 text-dark " id="editCategModalLabel">Edição de categoria</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      <form action="../utils/PHP/categorias/editarCategoria.php" method="post" enctype="multipart/form-data" class="edit-categ-form">
       <input id="edit-id" type="hidden" name="id">

       <div class="mb-3">
        <label for="nome_categoria"> Nome Categoria: </label>
        <input class="form-control" type="text" name="nome_categoria" id="edit-nome" required>
       </div>
       <div class="form-check  mb-3">
        <label for="ativo" class="form-check-label">Ativo</label>
        <input id="edit-ativo" class="form-check-input" type="checkbox" name="ativo_categoria">
       </div>
       <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea style="resize: none;" id="edit-desc" name="desc_categoria" cols="30" rows="10" class="form-control" required></textarea>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Enviar edição</button>
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
      <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar exclusão</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      Tem certeza de que deseja excluir esta categoria?
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      <button type="button" class="btn btn-danger" id="confirmDeleteCateg" data-bs-dismiss="modal">Confirmar</button>
     </div>
    </div>
   </div>
  </div>

  <!-- Adição modal -->
  <div class="modal  fade" id="addCategModal" tabindex="-1" aria-labelledby="addCategModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title text-dark   fs-5" id="addCategModalLabel">Cadastrar categoria</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      <form class="form__cadastro__categ" method="POST">

       <div class="form-group my-2">
        <div>
         <label for="nome_categoria"> Nome Categoria: </label>
        </div>
        <input type="text" name="nome_categoria" id="nome_categoria" class="form-control">
       </div>

       <div class="form-group my-2">
        <div>
         <label for="desc_categoria"> Descrição da Categoria: </label>
        </div>
        <textarea style="resize: none;" maxlength="150" name="desc_categoria" id="desc_categoria" cols="30" rows="5" class="form-control"></textarea>
       </div>

       <div class="form-check my-2 ">

        <label for="ativo_categoria" class="form-check-label">Categoria Ativa </label>

        <input type="checkbox" name="ativo_categoria" id="ativo_categoria" class="form-check-input">
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-dark">Cadastrar</button>
       </div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </section>
 </section>


</body>


</html>