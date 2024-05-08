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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalstyles.css">



</head>

<body>
    <section class="dynamic-section">

        <h2>Administradores</h2>

        <div class="search__container">
            <div class="input-group w-25 my-5 ">
                <input type="search" class="form-control rounded" placeholder="Pesquisar" aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-dark" data-mdb-ripple-init>Pesquisar</button>
            </div>
        </div>
        <table class="table table-info table-striped tableADM">


            <thead class="table-dark">
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
                        <td><?php echo $user['ADM_NOME']; ?></td>
                        <td><?php echo !isset($user['ADM_EMAIL']) == 1 ? "Sem registro" :  $user['ADM_EMAIL'] ?> </td>
                        <td>
                            <?php if ($user['ADM_ATIVO'] == '0') : ?>
                                <p class="text-danger">Não ativo</p>
                            <?php else : ?>
                                <p class="text-success">Ativo</p>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-primary edit-adm-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo $user['ADM_ID']; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-danger delete-adm-button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo $user['ADM_ID']; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>


            </tbody>
        </table>

        <!-- Modal Edição -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Administrador</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="edit-adm-form" action="../utils/PHP/adm/editarAdm.php" method="post" enctype="multipart/form-data">
                            <input id="edit-id" type="hidden" name="id">

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
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Enviar</button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

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
                        Tem certeza de que deseja excluir este usuário?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteAdm" data-bs-dismiss="modal">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>


    </section>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>