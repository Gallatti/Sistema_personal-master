<?php

class Beneficio
{
	private $userId;
	private $userNome;
	private $userLogin;
	private $userLoja;

	public function __construct($userId, $userNome, $userLogin, $userLoja)
	{
		$this->userId 		= $userId;
		$this->userNome 	= $userNome;
		$this->userLogin 	= $userLogin;
		$this->userLoja 	= $userLoja;
	}

	public function getBeneficio()
	{
		$sql = "SELECT * FROM clientes_bnf
				WHERE ID_CLI = {$this->userId}
				AND LOJA = '{$this->userLoja}'
				ORDER BY ID DESC
				LIMIT 1;";
		
		$beneficio = ConsultaBase::selectQuery($sql);
		$beneficio = (!empty($beneficio)) ? $beneficio : false;
		return $beneficio;
	}
}