<?php

session_start();

require_once "../conexao.php";

$id = $_POST['id'];

if (isset($id)) {
 try {
  $sql = "DELETE FROM ADMINISTRADOR WHERE ADM_ID = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();


  if ($_SESSION['admin_id'] == $id) {
   session_destroy();
   header('Location: ../../index.php'); 
  }
 } catch (PDOException $e) {
  echo "<div class='alert alert-danger'> Error: {$e->getMessage()} </div>";
 }
}
