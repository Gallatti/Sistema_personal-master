<?php
/**
* Esta classe valida externamente o login e a senha do
* usuário cadastrado da didio.
*/

class ValidacaoEsterna
{
	/**
	* Variável privada que guarda valor true ou false.
	* @access private
	* @name $resultado
	*/
	private $resultado;

	/**
	* Construtor da classe
	* @access public
	* @param String $nome, $senha
	* @return void
	*/
	public function __construct($login, $senha)
	{
		$this->validaAcesso($login, $senha);
	}

	/**
	* Função para retornar o resultado da busca
	* @access private
	* @param
	* @return $resultado
	*/
	public function getResultado()
	{
		return $this->resultado;
	}

	/**
	* Função para atribuir valor true ou false na variável $resultado
	* @access private
	* @param String $login, $senha
	* @return void
	*/
	private function validaAcesso($login, $senha)
	{
		$this->resultado = $this->my_file_get_contents("http://accon.io:5889/vendor/access/?_set={$login}&_tk={$senha}");
	}

	/**
	* Função para validar se o login e senha estão corretos
	* @access private
	* @param String $site_url
	* @return $file_contents
	*/
	private function my_file_get_contents($site_url)
	{
		$ch = curl_init();
		$timeout = 10;	
		curl_setopt ($ch, CURLOPT_URL, $site_url);	
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				    'control-access-credentials:uxPg+PE2uG2VqXe6bSg2rysL1j0='
				    ));
		$file_contents = curl_exec($ch);	
		curl_close($ch);
		return $file_contents;
	}
}
