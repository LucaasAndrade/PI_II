<?php
require_once('conexao.php');

session_destroy();
header('Location: ../../index.php');
