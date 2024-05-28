<?php
require_once('../../utils/PHP/conexao.php');

if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "painel_adm.php") === false) {
 header('Location: ../painel_adm.php');
}

try {
 $stmt = $pdo->prepare('SELECT * FROM ADMINISTRADOR');
 $stmt->execute();
 $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

 echo "<p style='color: red'> Erro ao consultar dados:" . $e->getMessage() . "</p>" . PHP_EOL;
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



  <div class="header__adm  d-flex  my-2  justify-content-between  ">
   <div class="search__container w-50">
    <div class="input-group ">
     <div class="input-group ">
      <input type="search" id="search-input" class="form-control rounded" placeholder="Pesquisar por nome..." aria-label="Search" aria-describedby="search-addon" />
      <button type="button" id="search-button" class="btn btn-dark" data-mdb-ripple-init>Pesquisar</button>
     </div>
    </div>
   </div>
   <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addAdmModal" data-bs-whatever="@mdo"><i class="fa-solid fa-user-plus"></i></button>
  </div>
  <table class="table table-info  table-striped tableADM">


   <thead>
    <tr>
     <th scope="col">Nome</th>
     <th scope="col">E-mail</th>
     <th scope="col">Ativo</th>
     <th scope="col">Ações</th>
    </tr>
   </thead>
   <tbody>


    <?php foreach ($users as $user) : ?>
     <tr>
      <td class="searchable"><?php echo $user['ADM_NOME']; ?></td>
      <td class="searchable"><?php echo isset($user['ADM_EMAIL']) ? $user['ADM_EMAIL'] : "Sem registro"; ?></td>
      <td class="searchable">
       <?php if ($user['ADM_ATIVO'] == '0') : ?>
        <p class="text-danger">Não ativo</p>
       <?php else : ?>
        <p class="text-success">Ativo</p>
       <?php endif; ?>
      </td>
      <td>
       <!-- Botão de Edição -->
       <button class="btn btn-primary edit-adm-button" data-bs-target="#editAdmModal" data-id="<?php echo $user['ADM_ID']; ?>">
        <i class="fa-solid fa-pen-to-square"></i>
       </button>
       <!-- Botão de Exclusão (apenas para usuários diferentes do usuário logado) -->
       <?php if ($user['ADM_ID'] !==  $_SESSION['admin_id']) : ?>
        <button class="btn btn-danger delete-adm-button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo $user['ADM_ID']; ?>">
         <i class="fa-solid fa-trash"></i>
        </button>
       <?php endif; ?>
      </td>
     </tr>
    <?php endforeach ?>


   </tbody>
  </table>

  <!-- Modal Edição -->
  <div class="modal fade" id="editAdmModal" tabindex="-1" aria-labelledby="editAdmModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title fs-5 text-dark " id="editAdmModalLabel">Editar Administrador</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      <form class="edit-adm-form" method="post">
       <input id="edit-id" type="number" name="id" style="display: none;">

       <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input id="edit-nome" type="text" name="nome" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input id="edit-email" type="email" name="email" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input id="edit-senha" type="password" name="senha" class="form-control" required>
       </div>
       <div class="mb-3 form-check">
        <label for="ativo" class="form-check-label ">Ativo</label>
        <input class="form-check-input " id="edit-ativo" type="checkbox" name="ativo" value="1">
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
  <div class="modal fade " id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h5 class="modal-title" id="confirmDeleteModalLabel">Notificação</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      Você não tem permissão para essa operação!
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
     </div>
    </div>
   </div>
  </div>


  <!-- Adição modal -->
  <div class="modal fade" id="addAdmModal" tabindex="-1" aria-labelledby="addAdmModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <h1 class="modal-title text-dark  fs-5" id="addAdmModalLabel">Cadastrar ADM</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
      <form class="form__cadastro__adm" method="post">
       <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" required>
       </div>
       <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" required>
       </div>
       <div class="mb-3 form-check">
        <label for="ativo" class="form-check-label">Administrador Ativo</label>
        <input type="checkbox" id="ativo" name="ativo" class="form-check-input " required>
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



</body>

</html>