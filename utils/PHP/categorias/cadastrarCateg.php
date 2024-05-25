<?php

require_once('../conexao.php');

try {

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $CATEGORIA_NOME = $_POST['nome'];
  $CATEGORIA_DESC = $_POST['desc'];
  $CATEGORIA_ATIVO = isset($_POST['ativo']) ? 1 : 0;



  $stmt = $pdo->prepare('INSERT INTO CATEGORIA(CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO) VALUES (:CATEGORIA_NOME, :CATEGORIA_DESC, :CATEGORIA_ATIVO)');

  $stmt->bindParam(':CATEGORIA_NOME', $CATEGORIA_NOME, PDO::PARAM_STR);
  $stmt->bindParam(':CATEGORIA_DESC', $CATEGORIA_DESC, PDO::PARAM_STR);
  $stmt->bindParam(':CATEGORIA_ATIVO', $CATEGORIA_ATIVO, PDO::PARAM_BOOL);

  $stmt->execute();
 }
} catch (PDOException $e) {
 echo 'Erro:' . $e;
}
