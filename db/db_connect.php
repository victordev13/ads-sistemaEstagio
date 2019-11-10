<?php
define('DB_HOST', 'localhost:3307');
define('DB_NAME', 'nucleo_estagio');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

function Conexao(){
  $connect = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());
  mysqli_set_charset($connect, 'utf8');
  return $connect;
}

function FecharConexao($connect){
  @mysqli_close($connect) or die(mysqli_error($connect));

}

?>