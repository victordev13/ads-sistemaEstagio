<?php
define('DB_HOST', 'localhost:3307');
define('DB_NAME', 'nucleo_estagio');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($connect, 'utf8');

if (mysqli_connect_errno()){
  echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
}

?>