<?php
require_once('../../utils/conexao.php');


if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        try {
            $stmt = $pdo->prepare("SELECT PRODUTO.*, CATEGORIA.CATEGORIA_NOME, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_IMAGEM.IMAGEM_ORDEM, PRODUTO_ESTOQUE.PRODUTO_QTD
            FROM PRODUTO
            JOIN CATEGORIA ON PRODUTO.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID
            LEFT JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
            LEFT JOIN PRODUTO_ESTOQUE ON PRODUTO.PRODUTO_ID = PRODUTO_ESTOQUE.PRODUTO_ID
            WHERE PRODUTO.PRODUTO_ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao consultar informações: " . $e->getMessage();
        }
    } else {
        header('Location: lista_users.php');
        exit();
    }

    try {
        $stmt_categoria = $pdo->prepare("SELECT * FROM CATEGORIA");
        $stmt_categoria->execute();
        $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p style='color=red;'> Erro ao buscar categorias" . $e->getMessage() . "</p>";
    }

    try {
        $stmt_imagem = $pdo->prepare("SELECT PRODUTO.*, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_IMAGEM.IMAGEM_ORDEM, PRODUTO_IMAGEM.IMAGEM_ID
        FROM PRODUTO
        JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID 
        WHERE PRODUTO.PRODUTO_ID = :id");
        $stmt_imagem->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_imagem->execute();
        $imagens_produto = $stmt_imagem->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p style='color=red;'> Erro ao buscar categorias" . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/globalstyles.css">

</head>

<body>
    <section class="form__container container mt-5">
        <div>
            <a href="listar_produtos.php" class="btn btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i></i>
                Voltar</a>
        </div>
        <form action="../../utils/produtos/editarProd.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $produto['PRODUTO_ID']; ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control"
                    value="<?php echo $produto['PRODUTO_NOME']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" cols="30" rows="10" class="form-control"
                    required><?php echo $produto['PRODUTO_DESC']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" name="preco" class="form-control" value="<?php echo $produto['PRODUTO_PRECO']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="desconto" class="form-label">Desconto</label>

                <input type="number" name="desconto" class="form-control"
                    value="<?php echo $produto['PRODUTO_DESCONTO']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="qtd_estoque" class="form-label">Quantidade estoque:</label>
                <input type="number" name="qtd_estoque" class="form-control"
                    value="<?php echo $produto['PRODUTO_QTD']; ?>" required>
            </div>
            <div class="mb-3">

                <?php
                foreach ($imagens_produto as $imagem) {
                    echo "<div class='mb-3'>";
                    echo "<label for='imagem_url' class='form-label'>Imagem URL:</label>";
                    echo "<input type='text' name='imagem_url[]' class='form-control' value='{$imagem['IMAGEM_URL']}' required>";
                    echo "</div>";

                    echo "<div class='mb-3'>";
                    echo "<label for='imagem_ordem' class='form-label'>Imagem Ordem:</label>";
                    echo "<input type='number' name='imagem_ordem[]' class='form-control' value='{$imagem['IMAGEM_ORDEM']}' required>";
                    echo "</div>";

                    // Inclua o campo imagem_id como um input hidden
                    echo "<input type='hidden' name='imagem_id[]' value='{$imagem['IMAGEM_ID']}'>";
                }
                ?>
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
                <div class="mb-3">
                    <label for="ativo" class="form-label">Ativo</label>
                    <input type="checkbox" name="ativo" value="1"
                        <?php echo $produto['PRODUTO_ATIVO'] == 1 ? 'checked' : '' ?>>
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar">
        </form>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>