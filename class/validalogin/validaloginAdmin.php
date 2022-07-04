<?php

class ValidaloginAdmin
{
	private $login;
	private $key;

	public function __construct($login, $key)
	{
		$this->login 	= $login;
		$this->key 		= $key;
	}

	public function getAcessoAdmin()
	{
		$dados = ConsultaBase::selectQueryLoginAdmin($this->login, md5($this->key));
		if(!empty($dados))
		{
			$this->setSessionAdmin($this->login, $dados[0]['ID']);
			return true;
		}
		return false;
	}

	private function setSessionAdmin($loginAdmin, $idAdmin)
	{
		$_SESSION['login-admin'] 	= $loginAdmin;
		$_SESSION['id-admin'] 		= $idAdmin;
	}
}

