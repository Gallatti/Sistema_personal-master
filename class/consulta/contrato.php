<?php
/**
* Esta classe é responsavel por inicializar o sistema
* e consultar os registros solicitados como (CPF/CNPJ, telefones).
*/

class ConsultaContratos
{
	
	/**
	* Função para retornar os dados referente ao numero CPF/CNPJ 
	* @access private
	* @param  String $cpfCnpj
	* @return $final_result transformando o array em objeto
	*/
	public function consultaCpfCnpj($cpfCnpj, $idEmpresa){
        try {  
                $stmt = Conexao::getInstance()->prepare('SELECT b.* FROM historico_file AS a
														 INNER JOIN BOLETO AS b ON a.id = b.ID_HISTORICO_FILE
														 WHERE a.empresa = :empresa
														 AND a.status_campanha = 1
														 AND b.STATUS_MAILING = 1
														 AND b.CPF_CNPJ = :cpf
														 ORDER BY b.ID DESC
														 LIMIT 1;');
                $stmt->bindParam(':cpf', $cpfCnpj);
                $stmt->bindParam(':empresa', $idEmpresa);
                $stmt->execute();

                $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $this->inicializador($final_result, $idEmpresa);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }

    /**
	* Função para abrir sessão e retornar ok(Se o CPF/CNPJ existir) ou invalido(Se o CPF/CNPJ não existir)
	* @access private
	* @param  String $final_result
	* @return Mensagem ok(Se o CPF/CNPJ existir) ou invalido(Se o CPF/CNPJ não existir)
	*/
	private function inicializador($final_result, $idEmpresa)
	{
		
		if(!empty($final_result))
		{
			$final_result = (object) $final_result[0];
			
			$_SESSION['nome_cli_cob'] = $final_result->NOME_RAZAO_SOCIAL;
			$_SESSION['cpf_cnpj_personal'] = $final_result->CPF_CNPJ;
			$_SESSION['dados_cli_completo'] = $final_result;

			// Salvar data e hora que o cliente acessou o sistema
			$this->setDtHoraCpf($final_result->CPF_CNPJ, $idEmpresa);

			return 'ok';

		}
		return 'invalido';
	}

	/**
	* Função para gravar o número do celular do cliente ou a linha digitave do boleto na base de dados
	* @access public
	* @param  String $celular, $cpfCnpj
	* @return String ok
	*/
	public function gravaCelular($celular, $cpfCnpj, $dt, $idEmpresa, $codigo, $dadosBoleto)
	{
		if ($dadosBoleto == 0) {
			$codigo = $this->geraCodigo($cpfCnpj);
			try {  
		        $stmt = Conexao::getInstance()->prepare("INSERT INTO CELULAR_CLI
		        									(
														CPF_CNPJ, 
														CEL_CLI, 
														COD_CLI,
														DATAHORA,
														ID_EMPRESA
													)
											VALUES 
													(
														:cpfCnpj,
														:celular,
														:codigo,
														:dt,
														:idEmpresa
													);");
		        
		        $stmt->bindParam(':cpfCnpj', $cpfCnpj);
		        $stmt->bindParam(':celular', $celular);
		        $stmt->bindParam(':codigo', $codigo);
		        $stmt->bindParam(':dt', $dt);
		        $stmt->bindParam(':idEmpresa', $idEmpresa);
		        
		        $stmt->execute();

		        return 'ok';
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		} else {
			// $flag = 2 informa que é uma linha digitavel
			$flag = 2;
			$linhaDigitavel = $dadosBoleto[0];
			$dtVencimento 	= explode('/', $dadosBoleto[1]);
			$dtVencimento 	= $dtVencimento[2] . '-' . $dtVencimento[1] . '-' . $dtVencimento[0];
			try {  
		        $stmt = Conexao::getInstance()->prepare("INSERT INTO CELULAR_CLI
		        									(
														CPF_CNPJ, 
														CEL_CLI, 
														COD_CLI,
														DATAHORA,
														ID_EMPRESA,
														FLAG,
														linha_digitavel,
														dt_vencimento
													)
											VALUES 
													(
														:cpfCnpj,
														:celular,
														:codigo,
														:dt,
														:idEmpresa,
														:flag,
														:linha_digitavel,
														:dt_vencimento
													);");
		        
		        $stmt->bindParam(':cpfCnpj', $cpfCnpj);
		        $stmt->bindParam(':celular', $celular);
		        $stmt->bindParam(':codigo', $codigo);
		        $stmt->bindParam(':dt', $dt);
		        $stmt->bindParam(':idEmpresa', $idEmpresa);
		        $stmt->bindParam(':flag', $flag);
		        $stmt->bindParam(':linha_digitavel', $linhaDigitavel);
		        $stmt->bindParam(':dt_vencimento', $dtVencimento);
		        
		        $stmt->execute();

		        return 'ok';
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}

	}

	/**
	* Função que pesquisa o celular do cliente na tabela CELULAR_CLI pelo COD_CLI
	* @access public
	* @param  String $codigo
	* @return String Celular do cliente
	*/
	public function getCelularUser($codigo)
	{
		try {  
	        $stmt = Conexao::getInstance()->prepare("SELECT CEL_CLI FROM CELULAR_CLI
	        										 WHERE COD_CLI = :cod_cli
	        										 ORDER BY ID DESC
	        										 LIMIT 1;");
	        
	        $stmt->bindParam(':cod_cli', $codigo);
	        
	        $stmt->execute();

	        $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return (!empty($final_result)) ? $final_result : 'sem celular';

	    } catch (Exception $e) {
	        return $e->getMessage();
	    }
	}

	/**
	* Função que gera um código hexatecimal de 5 caracters com os 2 primeiro caracteres randomicos e os outros 3 com o CPF/CNPJ
	* @access private
	* @param  String $cpfCnpj
	* @return String $codigo
	*/
	private function geraCodigo($cpfCnpj)
	{
		if(!empty($cpfCnpj))
		{
			$codigo = mt_rand(11, 99) . substr($cpfCnpj, 0, 3);
			$codigo = strtoupper(dechex($codigo));
			if (strlen($codigo) == 4) $codigo .= 'F';
			if (strlen($codigo) == 3) $codigo .= 'FG';
			return $codigo;
		}
		return 'Parâmetro vazio geraCodigo';
	}

	/**
	* Função que consulta e retorna as propostas(parcelas) do CPF/CNPJ
	* @access public
	* @param  String $cpfCnpj
	* @return String $proposta
	*/
	public function getPropostasOld($cpfCnpj, $opcao = '')
	{
		if(!empty($cpfCnpj))
		{
			$sql = "SELECT * FROM BOL_AUX
					WHERE CPF_CNPJ = '{$cpfCnpj}' ";
			$sql .= ($opcao != '') ? "AND ID = {$opcao} " : '';
			$sql .=	"ORDER BY OPCAO ASC;";
			$proposta = ConsultaBase::selectQuery($sql);
			return (!empty($proposta)) ? json_encode($proposta) : 'Sem proposta';
		}
		return 'Parâmetro vazio getPropostas';
	}

	public function getPropostas($cpfCnpj, $idEmpresa)
	{
		if(!empty($cpfCnpj)) {
			try {
                $stmt = Conexao::getInstance()->prepare('SELECT b.ID,

                												b.CPF_CNPJ,
                												b.NOME_RAZAO_SOCIAL,
                												b.ENDERECO,
                												b.CIDADE,
                												b.UF,
                												b.CEP,

                												b.TIPO_PROPOSTA1,
                												b.VALOR_ENTREGA_PROPOSTA1,
                												b.QTDE_PARCELAS_PROPOSTA1,
                												b.VALOR_PARCELAS_PROPOSTA1,
                												b.VALOR_DESCONTO_PROSTOSTA1,

                												b.TIPO_PROPOSTA2,
                												b.VALOR_ENTRADA_PROPOSTA2,
                												b.QTDE_PARCELAS_PROPOSTA2,
                												b.VALOR_PARCELAS_PROPOSTA2,
                												b.VALOR_DESCONTO_PROSTOSTA2,

                												b.TIPO_PROPOSTA3,
                												b.VALOR_ENTRADA_PROPOSTA3,
                												b.QTDE_PARCELAS_PROPOSTA3,
                												b.VALOR_PARCELAS_PROPOSTA3,
                												b.VALOR_DESCONTO_PROSTOSTA3,

                												b.TIPO_PROPOSTA4,
                												b.VALOR_ENTRADA_PROPOSTA4,
                												b.QTDE_PARCELAS_PROPOSTA4,
                												b.VALOR_PARCELAS_PROPOSTA4,
                												b.VALOR_DESCONTO_PROSTOSTA4,

                												b.NOSSO_NUMERO,
                												b.NOSSO_NUMERO_DIGITO,
                												b.VENCIMENTO,
                												b.COD_CEDENTE,
                												b.AGENCIA,
                												b.RAZAO_SOCIAL,
                												b.CNPJ,
                												b.CODIGO,
                												b.DIG,
                												b.DATA_DOCUMENTO,

                												b.NUMERO_CONTRATO,
                												b.LINHA_DIGITAVEL
																FROM historico_file AS a
																INNER JOIN BOLETO AS b ON a.id = b.ID_HISTORICO_FILE
																WHERE a.empresa = :idEmpresa
																AND b.STATUS_MAILING = 1
																AND b.CPF_CNPJ = :cpf
																ORDER BY b.ID DESC
																LIMIT 1;');
                $stmt->bindParam(':cpf', $cpfCnpj);
                $stmt->bindParam(':idEmpresa', $idEmpresa);
                $stmt->execute();

                $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return (!empty($final_result)) ? $final_result : 'sem proposta';
            } catch (Exception $e) {
                echo $e->getMessage();
            }
		}
		return 'Parâmetro cpfCnpj vazio na função getPropostas';	
	}

	public function getPropostaPorOpcao($opcao, $cpfCnpj, $idEmpresa)
	{
		$proposta = $this->getPropostas($cpfCnpj, $idEmpresa);
		
		switch ($opcao) {
			case 1:
				$proposta = array
								(
									'ID' 							=> $proposta[0]['ID'],
									'CPF_CNPJ' 						=> $proposta[0]['CPF_CNPJ'],
									'NOME_RAZAO_SOCIAL' 			=> $proposta[0]['NOME_RAZAO_SOCIAL'],
									'ENDERECO' 						=> $proposta[0]['ENDERECO'],
									'CIDADE' 						=> $proposta[0]['CIDADE'],
									'UF' 							=> $proposta[0]['UF'],
									'CEP' 							=> $proposta[0]['CEP'],
									'TIPO_PROPOSTA' 				=> $proposta[0]['TIPO_PROPOSTA1'],
									'VALOR_ENTREGA_PROPOSTA' 		=> $proposta[0]['VALOR_ENTREGA_PROPOSTA1'],
									'QTDE_PARCELAS_PROPOSTA' 		=> $proposta[0]['QTDE_PARCELAS_PROPOSTA1'],
									'VALOR_PARCELAS_PROPOSTA' 		=> $proposta[0]['VALOR_PARCELAS_PROPOSTA1'],
									'VALOR_DESCONTO_PROSTOSTA' 		=> $proposta[0]['VALOR_DESCONTO_PROSTOSTA1'],
									'NOSSO_NUMERO' 					=> $proposta[0]['NOSSO_NUMERO'],
									'NOSSO_NUMERO_DIGITO' 			=> $proposta[0]['NOSSO_NUMERO_DIGITO'],
									'VENCIMENTO' 					=> $proposta[0]['VENCIMENTO'],
									'COD_CEDENTE' 					=> $proposta[0]['COD_CEDENTE'],
									'AGENCIA' 						=> $proposta[0]['AGENCIA'],
									'RAZAO_SOCIAL' 					=> $proposta[0]['RAZAO_SOCIAL'],
									'CNPJ' 							=> $proposta[0]['CNPJ'],
									'CODIGO' 						=> $proposta[0]['CODIGO'],
									'NUMERO_CONTRATO' 				=> $proposta[0]['NUMERO_CONTRATO'],
									'DIG' 							=> $proposta[0]['DIG'],
									'DATA_DOCUMENTO' 				=> $proposta[0]['DATA_DOCUMENTO'],
									'LINHA_DIGITAVEL'				=> $proposta[0]['LINHA_DIGITAVEL']
								);
				break;
			case 2:
				$proposta = array
								(
									'ID' 							=> $proposta[0]['ID'],
									'CPF_CNPJ' 						=> $proposta[0]['CPF_CNPJ'],
									'NOME_RAZAO_SOCIAL' 			=> $proposta[0]['NOME_RAZAO_SOCIAL'],
									'ENDERECO' 						=> $proposta[0]['ENDERECO'],
									'CIDADE' 						=> $proposta[0]['CIDADE'],
									'UF' 							=> $proposta[0]['UF'],
									'CEP' 							=> $proposta[0]['CEP'],
									'TIPO_PROPOSTA' 				=> $proposta[0]['TIPO_PROPOSTA2'],
									'VALOR_ENTREGA_PROPOSTA' 		=> $proposta[0]['VALOR_ENTRADA_PROPOSTA2'],
									'QTDE_PARCELAS_PROPOSTA' 		=> $proposta[0]['QTDE_PARCELAS_PROPOSTA2'],
									'VALOR_PARCELAS_PROPOSTA' 		=> $proposta[0]['VALOR_PARCELAS_PROPOSTA2'],
									'VALOR_DESCONTO_PROSTOSTA' 		=> $proposta[0]['VALOR_DESCONTO_PROSTOSTA2'],
									'NOSSO_NUMERO' 					=> $proposta[0]['NOSSO_NUMERO'],
									'NOSSO_NUMERO_DIGITO' 			=> $proposta[0]['NOSSO_NUMERO_DIGITO'],
									'VENCIMENTO' 					=> $proposta[0]['VENCIMENTO'],
									'COD_CEDENTE' 					=> $proposta[0]['COD_CEDENTE'],
									'AGENCIA' 						=> $proposta[0]['AGENCIA'],
									'RAZAO_SOCIAL' 					=> $proposta[0]['RAZAO_SOCIAL'],
									'CNPJ' 							=> $proposta[0]['CNPJ'],
									'CODIGO' 						=> $proposta[0]['CODIGO'],
									'NUMERO_CONTRATO' 				=> $proposta[0]['NUMERO_CONTRATO'],
									'DIG' 							=> $proposta[0]['DIG'],
									'DATA_DOCUMENTO' 				=> $proposta[0]['DATA_DOCUMENTO'],
									'LINHA_DIGITAVEL'				=> $proposta[0]['LINHA_DIGITAVEL']
								);
				break;
			case 3:
				$proposta = array
								(
									'ID' 							=> $proposta[0]['ID'],
									'CPF_CNPJ' 						=> $proposta[0]['CPF_CNPJ'],
									'NOME_RAZAO_SOCIAL' 			=> $proposta[0]['NOME_RAZAO_SOCIAL'],
									'ENDERECO' 						=> $proposta[0]['ENDERECO'],
									'CIDADE' 						=> $proposta[0]['CIDADE'],
									'UF' 							=> $proposta[0]['UF'],
									'CEP' 							=> $proposta[0]['CEP'],
									'TIPO_PROPOSTA' 				=> $proposta[0]['TIPO_PROPOSTA3'],
									'VALOR_ENTREGA_PROPOSTA' 		=> $proposta[0]['VALOR_ENTRADA_PROPOSTA3'],
									'QTDE_PARCELAS_PROPOSTA' 		=> $proposta[0]['QTDE_PARCELAS_PROPOSTA3'],
									'VALOR_PARCELAS_PROPOSTA' 		=> $proposta[0]['VALOR_PARCELAS_PROPOSTA3'],
									'VALOR_DESCONTO_PROSTOSTA' 		=> $proposta[0]['VALOR_DESCONTO_PROSTOSTA3'],
									'NOSSO_NUMERO' 					=> $proposta[0]['NOSSO_NUMERO'],
									'NOSSO_NUMERO_DIGITO' 			=> $proposta[0]['NOSSO_NUMERO_DIGITO'],
									'VENCIMENTO' 					=> $proposta[0]['VENCIMENTO'],
									'COD_CEDENTE' 					=> $proposta[0]['COD_CEDENTE'],
									'AGENCIA' 						=> $proposta[0]['AGENCIA'],
									'RAZAO_SOCIAL' 					=> $proposta[0]['RAZAO_SOCIAL'],
									'CNPJ' 							=> $proposta[0]['CNPJ'],
									'CODIGO' 						=> $proposta[0]['CODIGO'],
									'NUMERO_CONTRATO' 				=> $proposta[0]['NUMERO_CONTRATO'],
									'DIG' 							=> $proposta[0]['DIG'],
									'DATA_DOCUMENTO' 				=> $proposta[0]['DATA_DOCUMENTO'],
									'LINHA_DIGITAVEL'				=> $proposta[0]['LINHA_DIGITAVEL']
								);
				break;
						case 4:
				$proposta = array
								(
									'ID' 							=> $proposta[0]['ID'],
									'CPF_CNPJ' 						=> $proposta[0]['CPF_CNPJ'],
									'NOME_RAZAO_SOCIAL' 			=> $proposta[0]['NOME_RAZAO_SOCIAL'],
									'ENDERECO' 						=> $proposta[0]['ENDERECO'],
									'CIDADE' 						=> $proposta[0]['CIDADE'],
									'UF' 							=> $proposta[0]['UF'],
									'CEP' 							=> $proposta[0]['CEP'],
									'TIPO_PROPOSTA' 				=> $proposta[0]['TIPO_PROPOSTA4'],
									'VALOR_ENTREGA_PROPOSTA' 		=> $proposta[0]['VALOR_ENTRADA_PROPOSTA4'],
									'QTDE_PARCELAS_PROPOSTA' 		=> $proposta[0]['QTDE_PARCELAS_PROPOSTA4'],
									'VALOR_PARCELAS_PROPOSTA' 		=> $proposta[0]['VALOR_PARCELAS_PROPOSTA4'],
									'VALOR_DESCONTO_PROSTOSTA' 		=> $proposta[0]['VALOR_DESCONTO_PROSTOSTA4'],
									'NOSSO_NUMERO' 					=> $proposta[0]['NOSSO_NUMERO'],
									'NOSSO_NUMERO_DIGITO' 			=> $proposta[0]['NOSSO_NUMERO_DIGITO'],
									'VENCIMENTO' 					=> $proposta[0]['VENCIMENTO'],
									'COD_CEDENTE' 					=> $proposta[0]['COD_CEDENTE'],
									'AGENCIA' 						=> $proposta[0]['AGENCIA'],
									'RAZAO_SOCIAL' 					=> $proposta[0]['RAZAO_SOCIAL'],
									'CNPJ' 							=> $proposta[0]['CNPJ'],
									'CODIGO' 						=> $proposta[0]['CODIGO'],
									'NUMERO_CONTRATO' 				=> $proposta[0]['NUMERO_CONTRATO'],
									'DIG' 							=> $proposta[0]['DIG'],
									'DATA_DOCUMENTO' 				=> $proposta[0]['DATA_DOCUMENTO'],
									'LINHA_DIGITAVEL'				=> $proposta[0]['LINHA_DIGITAVEL']
								);
				break;
			case 0:
				$proposta = array
								(
									'ID' 							=> $proposta[0]['ID'],
									'CPF_CNPJ' 						=> $proposta[0]['CPF_CNPJ'],
									'NOME_RAZAO_SOCIAL' 			=> $proposta[0]['NOME_RAZAO_SOCIAL'],
									'ENDERECO' 						=> $proposta[0]['ENDERECO'],
									'CIDADE' 						=> $proposta[0]['CIDADE'],
									'UF' 							=> $proposta[0]['UF'],
									'CEP' 							=> $proposta[0]['CEP']
								);
				break;
			default:
				$proposta = array();
		}
		
		return $proposta;
	}

	public function consultaCodigo($codigo, $cpfCnpj, $idEmpresa)
	{
		$sql = "SELECT * FROM CELULAR_CLI
				WHERE CPF_CNPJ = '{$cpfCnpj}'
				AND COD_CLI = '{$codigo}'
				AND ID_EMPRESA = {$idEmpresa}
				ORDER BY ID DESC;";
		$resposta = ConsultaBase::selectQuery($sql);

		if (!empty($resposta))
		{
			$res = $this->updateValidou($codigo, $cpfCnpj, $idEmpresa, 1);
			if ($res == 'ok') {
				$proposta = $this->getPropostas($cpfCnpj, $idEmpresa);
				$_SESSION['codigo_sms_personalcob'] = $codigo;

				$propostaArr = array();

				if (is_array($proposta)) {
					$propostaArr[] = $proposta;
					$propostaArr[] = explode(';', substr($proposta[0]['NUMERO_CONTRATO'], 0, -2));
					return $propostaArr;
				}
				return $proposta;
			}
			return $res;
		}

		return array('invalido');
	}

	public function updateValidou($codigo, $cpfCnpj, $idEmpresa, $status)
	{
		try {  
	        $stmt = Conexao::getInstance()->prepare("UPDATE CELULAR_CLI
	        										 SET VALIDOU = :status
	        										 WHERE COD_CLI = :codigo
	        										 AND CPF_CNPJ = :cpf_cnpj
	        										 AND ID_EMPRESA = :id_empresa");
	        $stmt->bindParam(':codigo', $codigo);
	        $stmt->bindParam(':cpf_cnpj', $cpfCnpj);
	        $stmt->bindParam(':id_empresa', $idEmpresa);
	        $stmt->bindParam(':status', $status);
	        
	        $stmt->execute();

	        return 'ok';
	    } catch (Exception $e) {
	        return $e->getMessage();
	    }
	}

	public function setPropostaCliOpcao($idProposta)
	{
		$sql = "INSERT INTO PROPOSTA_CLI(
											ID_PROPOSTA
										)
							VALUES
										(
											{$idProposta}
										);";
		$row = ConsultaBase::insertQuery($sql);
		if ($row != 1)
		{
			return $row;
		}
		return 'ok';
	}

	public function setPropostaCliSemOpcao($proposta, $cpfCnpj, $dtTime)
	{
		$proposta->entrada 		= preg_replace('/[.,]/', '', $proposta->entrada);
		$proposta->vlParcela 	= preg_replace('/[.,]/', '', $proposta->vlParcela);

		$dtPagamento 			= explode('/', $proposta->dtPagamento);
		$dtPagamento 			= $dtPagamento[2] . '-' . $dtPagamento[1] . '-' . $dtPagamento[0];

		try {  
	        $stmt = Conexao::getInstance()->prepare("INSERT INTO PROPOSTA_CLI_SEM_OPCAO
													(
														CPF_CNPJ,
														VR_ENTRADA,
														VR_PARCELA,
														QTDE_PARCELA,
														DT_PAGAMENTO,
														DT_PROPOSTA
													)
													VALUES
													(
														:cpf_cnpj,
														:vr_entrada,
														:vr_parcela,
														:qtde_parcela,
														:dt_pagamento,
														:dt_proposta
													);");
	        $stmt->bindParam(':cpf_cnpj', $cpfCnpj);
	        $stmt->bindParam(':vr_entrada', $proposta->entrada);
	        $stmt->bindParam(':vr_parcela', $proposta->vlParcela);
	        $stmt->bindParam(':qtde_parcela', $proposta->qtParcela);
	        $stmt->bindParam(':dt_pagamento', $dtPagamento);
	        $stmt->bindParam(':dt_proposta', $dtTime);
	        
	        $stmt->execute();

	        return 'ok';
	    } catch (Exception $e) {
	        return $e->getMessage();
	    }
	}

	public function setDtHoraCpf($cpfCnpj, $idEmpresa)
	{
		$dtHr = date('Y-m-d H:i:s');
		$sql = "INSERT INTO LOG_CPF_CNPJ
							(
								CPF_CNPJ,
								DT_ACESSO,
								ID_EMPRESA
							)
							VALUES
							(
								'{$cpfCnpj}',
								'{$dtHr}',
								'{$idEmpresa}'
							);";

		$row = ConsultaBase::insertQuery($sql);
	}

	public function setBoletoInfo($idCli, $valorOpcao, $idEmpresa, $dt)
	{
		try {  
	        $stmt = Conexao::getInstance()->prepare("INSERT INTO BOLETO_INFO 
	        										(
	        											ID_CLIENTE, 
	        											BOLETO_OPCAO, 
	        											ID_EMPRESA,
	        											DT_GERACAO_BOLETO
	        										)
	        										VALUES
	        										(
	        											:ID_CLIENTE,
	        											:BOLETO_OPCAO,
	        											:ID_EMPRESA,
	        											:DT_GERACAO_BOLETO
	        										)");
	        $stmt->bindParam(':ID_CLIENTE', $idCli);
	        $stmt->bindParam(':BOLETO_OPCAO', $valorOpcao);
	        $stmt->bindParam(':ID_EMPRESA', $idEmpresa);
	        $stmt->bindParam(':DT_GERACAO_BOLETO', $dt);
	        
	        $stmt->execute();

	        return array('ok');
	    } catch (Exception $e) {
	        return $e->getMessage();
	    }
	}

	public function getBoletoInfo($cpfCnpj, $idEmpresa)
	{
		try {  
            $stmt = Conexao::getInstance()->prepare('SELECT	a.ID, 
															a.ID_CLIENTE, 
															a.LOGRADOURO, 
															a.BAIRRO, 
															a.CIDADE,
															a.UF, 
															a.CEP, 
															a.COMPLEMENTO, 
															a.NUMERO,
															b.CPF_CNPJ
													 FROM BOLETO_INFO AS a
													 INNER JOIN BOLETO AS b ON a.ID_CLIENTE = b.ID
													 WHERE ID_EMPRESA = :ID_EMPRESA
													 AND b.STATUS_MAILING = 1
													 AND b.CPF_CNPJ = :CPF_CNPJ
													 ORDER BY a.ID DESC
													 LIMIT 1;');

            $stmt->bindParam(':CPF_CNPJ', $cpfCnpj);
            $stmt->bindParam(':ID_EMPRESA', $idEmpresa);
            $stmt->execute();

            $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return (!empty($final_result)) ? $final_result[0] : false;
        } catch (Exception $e) {
            return $e->getMessage();
        }
	}

	public function setBoleto($codigoSms, $cpfCnpj, $idEmpresa)
	{
		if ($codigoSms != false && $codigoSms != '') {
			try {  
		        $stmt = Conexao::getInstance()->prepare("UPDATE CELULAR_CLI
		        										 SET BOLETO = 1
		        										 WHERE CPF_CNPJ = :cpf_cnpj
		        										 AND COD_CLI = :cod_sms
		        										 AND ID_EMPRESA = :id_empresa
		        										 AND linha_digitavel = 'X';");

		        $stmt->bindParam(':cod_sms', $codigoSms);
		        $stmt->bindParam(':cpf_cnpj', $cpfCnpj);
		        $stmt->bindParam(':id_empresa', $idEmpresa);
		        $stmt->execute();

		        return 'ok';
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}
		return 'Parâmetro incorreto na função setBoleto!';
	}

}
