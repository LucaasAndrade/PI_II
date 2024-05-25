<?php

require_once('../conexao.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $id = $_POST['id'];
 $nome = $_POST['nome_categoria'];
 $desc = $_POST['desc_categoria'];
 $ativo = isset($_POST['ativo_categoria']) ? 1 : 0;

 try {

  $stmt = $pdo->prepare("UPDATE CATEGORIA SET CATEGORIA_NOME = :CATEGORIA_NOME, CATEGORIA_DESC = :CATEGORIA_DESC, CATEGORIA_ATIVO = :CATEGORIA_ATIVO WHERE CATEGORIA_ID = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':CATEGORIA_NOME', $nome, PDO::PARAM_STR);
  $stmt->bindParam(':CATEGORIA_DESC', $desc, PDO::PARAM_STR);
  $stmt->bindParam(':CATEGORIA_ATIVO', $ativo, PDO::PARAM_BOOL);
  $stmt->execute();

  header('Location: listar_categorias.php');
  exit();
 } catch (PDOException $e) {
  echo "Erro ao alterar informações: " . $e->getMessage();
 }
}
