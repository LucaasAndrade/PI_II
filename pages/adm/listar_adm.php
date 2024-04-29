<?php
require_once '../../utils/conexao.php';

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../../index.php');
    exit();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/globalstyles.css">



</head>

<body>
    <section class="dynamic-section">
        <section class="list__container">
            <h2>Lista de Administradores</h2>

            <table class="tableADM">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ativo</th>
                        <th>Ações</th>
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
                                <button type="button" class="btn btn-primary edit-adm-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo $user['ADM_ID']; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <a href="../utils/adm/excluirAdm.php?id=<?php echo $user['ADM_ID'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                            <form class="edit-adm-form" action="../utils/adm/editarAdm.php" method="post" enctype="multipart/form-data">
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
                                <div class="mb-3">
                                    <label for="ativo" class="form-label">Ativo</label>
                                    <input id="edit-ativo" type="checkbox" name="ativo" value="1">
                                </div>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                        </div>
                    </div>
                </div>
            </div>



        </section>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>