<?php

//include_once("{$pathDB}/conexao.php");
//include_once("{$pathClass}/open/openSite.php");

class ValidaLogin
{
	private $loginUser;
	private $senhaUser;
	private $dateAtual;
	private $dadosUsuario;
	private $acessoStatus;
	
	//public function __construct($loginUser, $senhaUser){
	public function __construct($loginUser){
		$this->dateAtual = date('Y-m-d H:i:s');
		
		$this->loginUser = $loginUser;
		//$this->senhaUser = $senhaUser;
		$this->confirmaAcesso();
	}

	private function confirmaAcesso(){
		if ($this->loginUser != '')
		{
			// Transforma a senha no formato sha1
			//$this->senhaUser = sha1($this->senhaUser);
			// Confere se o login e senha existem na tabela clientes_web
			$dados = $this->selectValidarUsuario();
			// Se teve retorno continua...
			if (!empty($dados)) {
				$this->dadosUsuario = $this->transformaArrayEmObjto($dados);
				$this->abreSessao($this->dadosUsuario->ID_CLI, $this->dadosUsuario->CLI_NOME, $this->dadosUsuario->CLI_LOGIN, $this->dadosUsuario->LOJA);
				$rowCount = $this->setLogUser();
				$this->acessoStatus = ($rowCount == 1) ? 'ok' : 'erro setLogUser';
			} else {
				$this->acessoStatus = 'dados incorretos';
			}
		} else {
			$this->acessoStatus = 'dados incorretos';
		}
	}

	private function selectValidarUsuario()
	{
		//$dadosUsuario = ConsultaBase::selectQueryLogin($this->loginUser, $this->senhaUser);
		$dadosUsuario = ConsultaBase::selectQueryLogin($this->loginUser, $this->senhaUser);
		return $dadosUsuario;
	}

	public function transformaArrayEmObjto($dados)
	{
		$obj = new stdClass();
		foreach($dados[0] as $key => $value){
			$obj->$key = $value; 
		}
		return $obj;
	}

	private function abreSessao($idUser, $nomeUser, $loginUser, $loja)
	{
		$_SESSION['id-user'] 	= $idUser;
		$_SESSION['nome-user'] 	= $nomeUser;
		$_SESSION['login-user'] = $loginUser;
		$_SESSION['loja-user'] 	= $loja; 
	}

	private function setLogUser()
	{
		$sql = "INSERT INTO log_user
				(
					ID_CLI,
					LOGIN_CLI,
					HR_ACESSO
				)
				VALUES 
				(
					{$this->dadosUsuario->ID},
					'{$this->dadosUsuario->CLI_LOGIN}',
					'{$this->dateAtual}'
				);";
		$rowCount = ConsultaBase::insertQuery($sql);
		return $rowCount;
	}

	public function getAcessoStatus()
	{
		return $this->acessoStatus;
	}

}