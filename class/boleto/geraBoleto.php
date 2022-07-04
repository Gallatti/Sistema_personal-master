<?php

/**
* Esta classe é responsavel por controlar e gerar boletos,
* receber parâmetros e montar boletos.
*/	
class GeraBoleto
{
	/**
	* Função para gerar boleto do banco Santander ou linha digitável
	* @access private
	* @param $dadosUser, $dadosBoletos
	* @return boletos ou linha digitável
	*/
	public function geraBoletoSantander($dadosUser, $parametrosboleto, $linhaDigitavel, $CaminhoCodBarra)
	{
		/*echo '<pre>';
		print_r($dadosUser);
		echo '</pre>';
		exit;*/
		$boleto = new stdClass();
		$boleto->agenciaCodCede  = $dadosUser['AGENCIA'] . '/' . $dadosUser['COD_CEDENTE'] . '-' . $dadosUser['DIG'];
		$boleto->dtVencimento 	 = (strpos($dadosUser['VENCIMENTO'], '/')) ? $dadosUser['VENCIMENTO'] : substr($dadosUser['VENCIMENTO'], 8, 10) . '/' . substr($dadosUser['VENCIMENTO'], 5, 2) . '/' . substr($dadosUser['VENCIMENTO'], 0, 4);
		$boleto->nomeCliente 	 = $dadosUser['NOME_RAZAO_SOCIAL'];
		$boleto->nossoNumero 	 = $this->bilderNossoNumero($dadosUser['NOSSO_NUMERO'], $dadosUser['NOSSO_NUMERO_DIGITO']);
		$boleto->valor 			 = $dadosUser['VALOR_ENTREGA_PROPOSTA'];
		$boleto->linhaDigitavel  = $dadosUser['LINHA_DIGITAVEL'];
		$boleto->dtDocumento 	 = (strpos($dadosUser['DATA_DOCUMENTO'], '/')) ? $dadosUser['DATA_DOCUMENTO'] : substr($dadosUser['DATA_DOCUMENTO'], 8, 10) . '/' . substr($dadosUser['DATA_DOCUMENTO'], 5, 2) . '/' . substr($dadosUser['DATA_DOCUMENTO'], 0, 4);
		$boleto->dtProcessamento = date('d/m/Y');
		$boleto->cpfCnpj 		 = $dadosUser['CPF_CNPJ'];
		$boleto->endereco 		 = $dadosUser['ENDERECO'] . ', ' . $dadosUser['CIDADE'] . ' ' . $dadosUser['CEP'];
		$boleto->numContrato 	 = $dadosUser['NUMERO_CONTRATO'];
		
		if ($linhaDigitavel == 1) {
			return array($boleto->linhaDigitavel, $boleto->dtVencimento);
		}
		
		include("boleto/include/layout_personalizado1.php");
	}

	private function bilderNossoNumero($nossoNumero, $digito)
	{
		$total 			= strlen($nossoNumero);

		for ($i = 0; $i < $total; $i++) {
			if (substr($nossoNumero, $i, 1) != 0) {
				$total -= $i;
				return substr($nossoNumero, $i, $total) . '-' . $digito;
				echo 'Passou';
			}
		}
	}

	public function geraCodigoBanco($numero) {
	    $parte1 = substr($numero, 0, 3);
	    $parte2 = $this->modulo_11($parte1);
	    return $parte1 . "-" . $parte2;
	}

	public function modulo_11($num, $base=9, $r=0)  {
	    /**
	     *   Autor:
	     *           Pablo Costa <pablo@users.sourceforge.net>
	     *
	     *   Função:
	     *    Calculo do Modulo 11 para geracao do digito verificador 
	     *    de boletos bancarios conforme documentos obtidos 
	     *    da Febraban - www.febraban.org.br 
	     *
	     *   Entrada:
	     *     $num: string numérica para a qual se deseja calcularo digito verificador;
	     *     $base: valor maximo de multiplicacao [2-$base]
	     *     $r: quando especificado um devolve somente o resto
	     *
	     *   Saída:
	     *     Retorna o Digito verificador.
	     *
	     *   Observações:
	     *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
	     *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
	     */                                        

	    $soma = 0;
	    $fator = 2;

	    /* Separacao dos numeros */
	    for ($i = strlen($num); $i > 0; $i--) {
	        // pega cada numero isoladamente
	        $numeros[$i] = substr($num,$i-1,1);
	        // Efetua multiplicacao do numero pelo falor
	        $parcial[$i] = $numeros[$i] * $fator;
	        // Soma dos digitos
	        $soma += $parcial[$i];
	        if ($fator == $base) {
	            // restaura fator de multiplicacao para 2 
	            $fator = 1;
	        }
	        $fator++;
	    }

	    /* Calculo do modulo 11 */
	    if ($r == 0) {
	        $soma *= 10;
	        $digito = $soma % 11;
	        if ($digito == 10) {
	            $digito = 0;
	        }
	        return $digito;
	    } elseif ($r == 1){
	        $resto = $soma % 11;
	        return $resto;
	    }
	}

	public function montaCodBarra($linhaDigitavel)
	{
		$barra = preg_replace('/[^0-9]/', '', $linhaDigitavel);

		if ($this->modulo11_banco('34191000000000000001753980229122525005423000') != 1) return 'Função "modulo11_banco" está com erro!';

		if (strlen($barra) < 47 ) $barra = $barra . '00000000000' . substr(0,47 - strlen($barra));
		if (strlen($barra) != 47) {
			return 'A linha do código de barras está incompleta!' . strlen($barra);
		}

		$barra = substr($barra, 0, 4) 
				. substr($barra, 32,15) 
				. substr($barra, 4,5)
				. substr($barra, 10,10)
				. substr($barra, 21,10);

		if ($this->modulo11_banco(substr($barra, 0, 4) . substr($barra, 5, 39)) != substr($barra, 4, 1)) {
			return 'Digito verificador ' . substr($barra, 4, 1) . ', o correto é ' . $this->modulo11_banco(substr($barra, 0, 4) . substr($barra, 5, 39)) . '\nO sistema não altera automaticamente o dígito correto na quinta casa!';
		}
		//if (form.barra.value != form.barra2.value) alert('Barras diferentes');
		return array('codBarra' => $barra);
	}

	public function modulo11_banco($numero)
	{
		$numero = preg_replace('/[^0-9]/', '', $numero);
		
		$soma  = 0;
		$peso  = 2;
		$base  = 9;
		$resto = 0;
		$contador = strlen($numero) - 1;
		
		for ($i = $contador; $i >= 0; $i--) {
			//alert( peso );
			$resultado = substr($numero, $i,$i + 1);
			$resultado = substr($resultado, 0, 1);
			$soma = $soma + ($resultado * $peso);
			if ($peso < $base) {
				$peso++;
			} else {
				$peso = 2;
			}
		}
		$digito = 11 - ($soma % 11);
		//debug( '11 - ('+soma +'%11='+(soma % 11)+') = '+digito);
		if ($digito >  9) $digito = 0;
		/* Utilizar o dígito 1(um) sempre que o resultado do cálculo padrão for igual a 0(zero), 1(um) ou 10(dez). */
		if ($digito == 0) $digito = 1;
		return $digito;
	}

}