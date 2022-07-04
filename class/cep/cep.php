<?php

header("Content-Type: text/html; charset=ISO-8859-1");

/**
* Esta classe é responsavel por buscar as informações(Rua, bairro, estado, cidade)
* referente ao CEP.
*/

class Cep
{
	
	/**
	* Função para que retorna o logradouro do cep pelo site http://republicavirtual.com.br
	* @access private
	* @param  String $cep
	* @return array
	*/
	public function getCep($cep)
	{
		$res = $this->getCepWebService($cep);
		if ($res['resultado'] == 1) {
			return "{\"cep\": \"{$cep}\", \"tipoDeLogradouro\": \"{$res['tipo_logradouro']}\", \"logradouro\": \"{$res['logradouro']}\", \"bairro\": \"{$res['bairro']}\", \"cidade\": \"{$res['cidade']}\", \"estado\": \"{$res['uf']}\"}";
		}
		
		return $this->getCep2($cep);
	}

	/**
	* Função para busca de Endereço pelo CEP
	* utilizando WebService de CEP da republicavirtual.com.br
	* @access private
	* @param  String $cep
	* @return array
	*/
	private function getCepWebService($cep)
	{
		$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.$cep.'&formato=query_string');
	   	if(!$resultado){
			$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
		}
		parse_str($resultado, $retorno);
		return $retorno;
	}

	/**
	* Função para que retorna o logradouro do cep pelo site http://correiosapi.apphb.com/cep/
	* @access public
	* @param  String $cep
	* @return array
	*/
	public function getCep2($cep)
	{
		$url = 'http://correiosapi.apphb.com/cep/' . $cep;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$head = curl_exec($ch);
		curl_close($ch);

		return utf8_decode($head);
	}

}