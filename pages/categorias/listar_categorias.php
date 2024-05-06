<?php
require_once('../../utils/PHP/conexao.php');

if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}
try {
 $stmt = $pdo->prepare('SELECT * FROM categoria');
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

<html lang="pt-br">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="../../styles/globalstyles.css">
 <title>Listar categoria</title>
</head>


<body>
 <section class="dynamic-section">
  <h1> Listar Categoria </h1>

  <table class="tableCateg">
   <thead>
    <tr>
     <th>Nome categoria</th>
     <th>Descrição da categoria</th>
     <th>Ativo</th>
     <th>Editar</th>
     <th>Excluir</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($categorias as $categoria) : ?>
     <tr>
      <td><?php echo $categoria['CATEGORIA_NOME'] ?></td>
      <td><?php echo $categoria['CATEGORIA_DESC'] ?></td>
      <td>
       <?php if ($categoria['CATEGORIA_ATIVO'] == '0') : ?>
        <p class="text-danger">Não ativo</p>
       <?php else : ?>
        <p class="text-success">Ativo</p>
       <?php endif; ?>
      </td>

      <td> <button class="btn btn-primary edit-categ-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo  $categoria['CATEGORIA_ID']; ?>">
        <i class="fa-solid fa-pen-to-square"></i>
       </button></td>
      <td> <button class="btn btn-danger delete-categ-button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo  $categoria['CATEGORIA_ID']; ?>">
        <i class="fa-solid fa-trash"></i>
       </button></td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>

  <!-- Modal edição -->
  <div class="modal fade edit-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">Edição de categoria</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      <form action="../utils/PHP/categorias/editarCategoria.php" method="post" enctype="multipart/form-data" class="edit-categ-form">
       <input id="edit-id" type="hidden" name="id">

       <div class="mb-3">
        <label for="nome_categoria"> Nome Categoria: </label>
        <input class="form-control" type="text" name="nome_categoria" id="edit-nome" required>
       </div>
       <div class="d-flex gap-2 mb-3">
        <label for="ativo" class="form-check-label">Ativo</label>
        <input id="edit-ativo" class="form-check" type="checkbox" name="ativo_categoria">
       </div>
       <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea style="resize: none;" id="edit-desc" name="desc_categoria" cols="30" rows="10" class="form-control" required></textarea>
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
 </section>
 </section>

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>