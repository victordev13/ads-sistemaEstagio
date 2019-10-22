<?php
require_once'../db/db_connect.php';

class Administrador
{
	public $nome;
	protected $usuario;
	private $senha;
	public $email;

	function __construct($nome, $usuario, $senha)
	{
		
	}
}

?>