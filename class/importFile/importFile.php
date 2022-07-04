<?php

class ImportFile
{
	private $filePermitido;
	private $fileSize;
	private $pasta;

	public function __construct($filePermitido, $fileSize, $pasta)
	{
		$this->filePermitido 	= $filePermitido;
		$this->fileSize 		= $fileSize;
		$this->pasta 			= $pasta;
	}

	public function testFile($file)
	{
		if (is_object($file)) {
			$fileUpload = array();
			foreach ($file as $key => $value) {
				$nome_arquivo = $value['name'];
				$size_arquivo = $value['size'];

				$ext = strtolower(strrchr($nome_arquivo, '.'));

				
				if (in_array($ext, $this->filePermitido)) {
					$tamanho = round($size_arquivo / 1024);

					if ($tamanho < $this->fileSize) {
						$nome_atual = md5(uniqid(time())).$ext;
						$tmp = $value['tmp_name'];

						$fileUpload[] = array
											(	
												'nome_real'  => $nome_arquivo,
												'nome_atual' => $nome_atual,
												'tmp'		 => $tmp
											);
					} else {
						return "O arquivo {$nome_arquivo} deve ser menor que 1MB";
					}
				} else {
					return "A extensão {$ext} do arquivo {$nome_arquivo} não é permitido";
				}
			}
			return $fileUpload;
		} else {
			return 'O parâmero tem que ser um objeto';
		}	
	}

	public function importFile($file)
	{
		foreach ($file as $key => $value) {
			if (!move_uploaded_file($value['tmp'], $this->pasta.$value['nome_atual'])) {
				return 'Erro ao fazer o upload no arquivo ->´( ' . "{$this->pasta}{$value['nome_atual']}";
			}
		}
		return 'ok';

	}

	public function getNomeArquivo($file, $empresa)
	{
		try {  
                $stmt = Conexao::getInstance()->prepare('SELECT * FROM historico_file
                										 WHERE nome_arquivo = :login
                										 AND SENHA = :senha
                                                         AND EMPRESA = :empresa');
                $stmt->bindParam(':login', $file['nome_real']);
                $stmt->bindParam(':senha', md5($senha));
                

                $stmt->execute();

                $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($final_result)) {
                	$this->openSession($final_result[0]['LOGIN']);
                	return $this->setLogAdmin($login, $dt, $empresa);
                }
                return 'acesso negado';
            } catch (Exception $e) {
                return $e->getMessage();
            }
	}

	public function setHistoricoArquivo($file, $campanha, $dt, $user, $empresa, $banco)
	{
		try {  
                $stmt = Conexao::getInstance()->prepare('INSERT INTO historico_file
                										(
                											nome_campanha,
                											nome_arquivo,
                											nome_arquivo_file,
                											dt_upload,
                											user,
                											empresa,
                											id_banco,
                											status_campanha
                										)
                										VALUES 
                										(
                											:nome_campanha,
                											:nome_arquivo,
                											:nome_arquivo_file,
                											:dt_upload,
                											:user,
                											:empresa,
                											:banco,
                											0
                										);');

                foreach ($file as $key => $value) {
	                $stmt->bindParam(':nome_campanha', $campanha);
	                $stmt->bindParam(':nome_arquivo', $value['nome_real']);
	                $stmt->bindParam(':nome_arquivo_file', $value['nome_atual']);
	                $stmt->bindParam(':dt_upload', $dt);
	                $stmt->bindParam(':user', $user);
	                $stmt->bindParam(':empresa', $empresa);
	                $stmt->bindParam(':banco', $banco);
	                $stmt->execute();
                }
                $idInserted = Conexao::getInstance()->lastInsertId();
                
                return array('res' => 'ok', 'idInserted' => $idInserted);
            } catch (Exception $e) {
                return $e->getMessage();
            }
		foreach ($file as $key => $value) {

			if (!move_uploaded_file($value['tmp'], $this->pasta.$value['nome_atual'])) {
				return 'Erro ao fazer o upload no arquivo ->´( ' . "{$this->pasta}{$value['nome_atual']}";
			}
		}
	}

	public function importCsvNew($file)
	{
		try {  
		    $stmt = Conexao::getInstance()->prepare("LOAD DATA LOCAL INFILE :file INTO TABLE load_data
													FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
													LINES TERMINATED BY 'frog'
													IGNORE 1 LINES
													(nome, idade, sexo);");
		    $stmt->bindParam(':file', $file);
		    
		    $stmt->execute();
		    echo 'ok';
		} catch (Exception $e) {
		    echo $e->getMessage();
		}
	}	

	public function importTempBoleto($file, $idHistorico)
	{
		try {  
		    $stmt = Conexao::getInstance()->prepare("LOAD DATA LOCAL INFILE :file INTO TABLE BOLETO_TEMP
		    										CHARACTER SET 'utf8'
													FIELDS TERMINATED BY ';' ENCLOSED BY '\"'
													
													IGNORE 1 LINES
													(
														
														CARTEIRA,
														BANCO,
														AGENCIA,
														DIG_AGENCIA,
														COD_CEDENTE,
														DIG,
														RAZAO_SOCIAL,
														CNPJ,
														CODIGO,
														CPF_CNPJ,
														NOME_RAZAO_SOCIAL,
														ENDERECO,
														CIDADE,
														UF,
														CEP,
														VENCIMENTO,
														NOSSO_NUMERO,
														NOSSO_NUMERO_DIGITO,
														LINHA_DIGITAVEL,
														TIPO_PROPOSTA1,
														VALOR_ENTREGA_PROPOSTA1,
														QTDE_PARCELAS_PROPOSTA1,
														VALOR_PARCELAS_PROPOSTA1,
														VALOR_DESCONTO_PROSTOSTA1,
														PERCENTUAL_CET_PROPOSTA1,
														TIPO_PROPOSTA2,
														VALOR_ENTRADA_PROPOSTA2,
														QTDE_PARCELAS_PROPOSTA2,
														VALOR_PARCELAS_PROPOSTA2,
														VALOR_DESCONTO_PROSTOSTA2,
														PERCENTUAL_CET_PROPOSTA2,
														TIPO_PROPOSTA3,
														VALOR_ENTRADA_PROPOSTA3,
														QTDE_PARCELAS_PROPOSTA3,
														VALOR_PARCELAS_PROPOSTA3,
														VALOR_DESCONTO_PROSTOSTA3,
														PERCENTUAL_CET_PROPOSTA3,
														TIPO_PROPOSTA4,
														VALOR_ENTRADA_PROPOSTA4,
														QTDE_PARCELAS_PROPOSTA4,
														VALOR_PARCELAS_PROPOSTA4,
														VALOR_DESCONTO_PROSTOSTA4,
														PERCENTUAL_CET_PROPOSTA4,
														TARIFA_EMISSAO,
														NUMERO_DOCUMENTO,
														DATA_DOCUMENTO,
														NUMERO_CONTRATO,
														SALDO_ABERTO
													);");
		    $stmt->bindParam(':file', $file);
		    $stmt->execute();
		    
		    //return $this->importBoleto();
		    return $this->setIdHistoricoInBoletoTemp($idHistorico);
		} catch (Exception $e) {
		    echo $e->getMessage();
		}
	}

	private function setIdHistoricoInBoletoTemp($idHistorico)
	{
		try {  
			    $stmt = Conexao::getInstance()->prepare("UPDATE BOLETO_TEMP
														 SET tipo_registro=0, STATUS_MAILING=0, ID_HISTORICO_FILE= :idHistorico
														 WHERE tipo_registro=1
														 AND STATUS_MAILING=1;");
			    
			    $stmt->bindParam(':idHistorico', $idHistorico);
			    $stmt->execute();

			    return $this->importBoleto($idHistorico);
			} catch (Exception $e) {
			    echo $e->getMessage();
			}
	}

	public function importBoleto($idHistorico)
	{
		try {  
			    $stmt = Conexao::getInstance()->prepare("INSERT INTO BOLETO 
			    										 SELECT * FROM BOLETO_TEMP
			    										 WHERE ID_HISTORICO_FILE = :id_historico");
			    
			    $stmt->bindParam(':id_historico', $idHistorico);
			    $stmt->execute();

			    $arrRes = array('linhas' => $stmt->rowCount());
			    return $arrRes;
			} catch (Exception $e) {
			    echo $e->getMessage();
			}
	}

}