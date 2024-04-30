<?php

require_once('../../utils/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../../index.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM categoria');
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Categorias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/globalstyles.css">
</head>

<body>
    <h1>Listar Categorias</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nome categoria</th>
                <th>Descrição da categoria</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria) : ?>
                <tr>
                    <td><?php echo $categoria['CATEGORIA_NOME'] ?></td>
                    <td><?php echo $categoria['CATEGORIA_DESC'] ?></td>
                    <td><?php echo $categoria['CATEGORIA_ATIVO'] == 1 ? "<span style='color: green;'>Ativo</span>" : "<span style='color: red;'>Não ativo</span>" ?></td>
                    <td>
                        <a href="#" class="btn btn-danger delete-btn" data-id="<?php echo $categoria['CATEGORIA_ID'] ?>" data-toggle="modal" data-target="#confirmDeleteModal">Excluir</a>
                        <a href="editar_categoria.php?id=<?php echo $categoria['CATEGORIA_ID'] ?>" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir esta categoria?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var categoryId = $(this).data('id');
                $('#confirmDeleteBtn').attr('data-id', categoryId);
            });

            $('#confirmDeleteBtn').click(function() {
                var categoryId = $(this).data('id');
                window.location.href = 'excluir_categoria.php?id=' + categoryId;
            });
        });
    </script>
</body>

</html>
