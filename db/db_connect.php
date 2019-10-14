<?php
$db_host = "localhost:3307";
$db_name = "sistema_estagio";
$db_user = "root";
$db_password = "";

$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (mysqli_connect_errno())
  {
  echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
  }

?>