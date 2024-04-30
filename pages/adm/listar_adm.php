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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/globalstyles.css">
    <!-- O JQuery deve ser carregado antes do JS, se não buga... -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>



</head>

<body>
    <section class="list__container">
        <h2>Lista de Usuários</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ativo</th>
                </tr>
            </thead>

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
                        <a href="editar_adm.php?id=<?php echo $user['ADM_ID'] ?>" class="btn btn-primary">Editar</a>
                    <td>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Deletar</button>
                    </td>

                    </td>
                </tr>

                <!-- Modal de confirmação -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar exclusão</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Tem certeza de que deseja excluir este usuário?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
        </table>

        <a href="../painel_adm.php" class="btn btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i> Voltar ao Painel
            do Administrador </a>
    </section>

    <script>
        // Quando o botão "Confirmar" do modal for clicado
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            // Enviar uma requisição para excluir o usuário
            let userId = <?php echo $user['ADM_ID']; ?>;
            fetch("../../utils/adm/excluirAdm.php?id=" + userId, {
                    method: 'POST'
                })
                .then(response => {
                    // Se a exclusão for bem-sucedida, redirecionar para a página de listar usuários
                    if (response.ok) {
                        window.location.href = "./listar_adm.php";
                    }
                })
                .catch(error => console.error('Erro ao excluir usuário:', error));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>