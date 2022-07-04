<?php

class Admin
{
	
	public function getBancos($status)
	{
		if ($status != '') {
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT * FROM BANCO_BOLETO
														 WHERE STATUS_BOLETO = :status");

		        $stmt->bindParam(':status', $status);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return $final_result;
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}
		return 'Função sem o parâmetro $status';
	}

	public function getCampanha($empresa)
	{
		// status_campanha: 0 = Bloqueado/Desativo, 1 = ativo, 9 Em andamento
		try {
	        $stmt = Conexao::getInstance()->prepare("SELECT a.id, a.nome_campanha, COUNT(c.ID) as total, a.nome_arquivo, a.dt_upload, a.dt_ultima_edicao, a.user, b.DESCRICAO AS banco, a.status_campanha FROM historico_file AS a
													 INNER JOIN BANCO_BOLETO AS b ON a.id_banco = b.ID
													 INNER JOIN BOLETO AS c ON a.id = c.ID_HISTORICO_FILE
													 WHERE a.empresa = :empresa
													 AND status_campanha IN (0, 1, 9)
													 GROUP BY a.id
													 ORDER BY a.id DESC;");
	        $stmt->bindParam(':empresa', $empresa);
        	$stmt->execute();

        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	        return $final_result;
	    } catch (Exception $e) {
	        return $e->getMessage();
	    }
	}

	public function getCampanhaData($idEmpresa, $de, $ate, $total)
	{
		if ($idEmpresa != '' && $de != '' && $ate != '' && $total != '') {
			// status_campanha: 0 = Bloqueado/Desativo, 1 = ativo, 9 Em andamento

			$de = explode('/', $de);
			$de = $de[2] . '-' . $de[1] . '-' . $de[0] . ' 00:00:00';

			$ate = explode('/', $ate);
			$ate = $ate[2] . '-' . $ate[1] . '-' . $ate[0] . ' 23:59:59';

			$initialLimit = 0;
			$finalLimit   = (int) $total;

			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT a.id, a.nome_campanha, COUNT(c.ID) as total, a.nome_arquivo, a.dt_upload, a.dt_ultima_edicao, a.user, b.DESCRICAO AS banco, a.status_campanha FROM historico_file AS a
														 INNER JOIN BANCO_BOLETO AS b ON a.id_banco = b.ID
														 INNER JOIN BOLETO AS c ON a.id = c.ID_HISTORICO_FILE
														 WHERE a.empresa = :empresa
														 AND status_campanha IN (0, 1, 9)
														 AND a.dt_upload BETWEEN :de AND :ate
														 GROUP BY a.id
														 ORDER BY a.id DESC
														 LIMIT :initiallimit, :finallimit;");
		        $stmt->bindParam(':empresa', $idEmpresa);
		        $stmt->bindParam(':de', $de);
		        $stmt->bindParam(':ate', $ate);
		        $stmt->bindParam(':finallimit', $finalLimit, PDO::PARAM_INT); 
				$stmt->bindParam(':initiallimit', $initialLimit, PDO::PARAM_INT); 
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('vazio');
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }		
		}
		return 'Parâmetros incorretos na função getCampanhaData.';
	}

	public function setDetalheCampanha($paramCampanha, $idCampanha, $dt)
	{
		try {
				$dtDivulgacao = explode('/', $paramCampanha['dtDivulgacao']);
				$dtDivulgacao = $dtDivulgacao['2'] . '-' . $dtDivulgacao['1'] . '-' . $dtDivulgacao['0'];

		        $stmt = Conexao::getInstance()->prepare("INSERT INTO CAMPANHA_INFORMACOES
		        										 (
		        										 	ID_CAMPANHA,

		        										 	DIVULGACAO,
		        										 	FRASE_DIVULGACAO,
		        										 	DT_DIVULGACAO,
		        										 	HR_DE_DIVULGACAO,
		        										 	HR_ATE_DIVULGACAO,

		        										 	PREVENTIVO,
		        										 	UM_DIA_PREVENTIVO,
		        										 	FRASE_UM_PREVENTIVO,
		        										 	HR_DE_UM_PREVENTIVO,
		        										 	HR_ATE_UM_PREVENTIVO,
		        										 	DOIS_DIA_PREVENTIVO,
		        										 	FRASE_DOIS_PREVENTIVO,
		        										 	HR_DE_DOIS_PREVENTIVO,
		        										 	HR_ATE_DOIS_PREVENTIVO,
		        										 	RETENCAO,
		        										 	UM_DIA_RETENCAO,
		        										 	FRASE_UM_RETENCAO,
		        										 	HR_DE_UM_RETENCAO,
		        										 	HR_ATE_UM_RETENCAO,
		        										 	DOIS_DIA_RETENCAO,
		        										 	FRASE_DOIS_RETENCAO,
		        										 	HR_DE_DOIS_RETENCAO,
		        										 	HR_ATE_DOIS_RETENCAO
		        										 )
		        										 VALUES
		        										 (
		        										 	:ID_CAMPANHA,

		        										 	:DIVULGACAO,
		        										 	:FRASE_DIVULGACAO,
		        										 	:DT_DIVULGACAO,
		        										 	:HR_DE_DIVULGACAO,
		        										 	:HR_ATE_DIVULGACAO,

		        										 	:PREVENTIVO,
		        										 	:UM_DIA_PREVENTIVO,
		        										 	:FRASE_UM_PREVENTIVO,
		        										 	:HR_DE_UM_PREVENTIVO,
		        										 	:HR_ATE_UM_PREVENTIVO,
		        										 	:DOIS_DIA_PREVENTIVO,
		        										 	:FRASE_DOIS_PREVENTIVO,
		        										 	:HR_DE_DOIS_PREVENTIVO,
		        										 	:HR_ATE_DOIS_PREVENTIVO,
		        										 	:RETENCAO,
		        										 	:UM_DIA_RETENCAO,
		        										 	:FRASE_UM_RETENCAO,
		        										 	:HR_DE_UM_RETENCAO,
		        										 	:HR_ATE_UM_RETENCAO,
		        										 	:DOIS_DIA_RETENCAO,
		        										 	:FRASE_DOIS_RETENCAO,
		        										 	:HR_DE_DOIS_RETENCAO,
		        										 	:HR_ATE_DOIS_RETENCAO
		        										 );");
			 	
		        $stmt->bindParam(':ID_CAMPANHA', $idCampanha);

		        $stmt->bindParam(':DIVULGACAO', $paramCampanha['divulgacao']);
		        $stmt->bindParam(':FRASE_DIVULGACAO', $paramCampanha['fraseDivulgacao']);
		        $stmt->bindParam(':DT_DIVULGACAO', $dtDivulgacao);
		        $stmt->bindParam(':HR_DE_DIVULGACAO', $paramCampanha['deDivulgacao']);
		        $stmt->bindParam(':HR_ATE_DIVULGACAO', $paramCampanha['ateDivulgacao']);

		        $stmt->bindParam(':PREVENTIVO', $paramCampanha['preventivo']);
		        $stmt->bindParam(':UM_DIA_PREVENTIVO', $paramCampanha['UmdiaPreventivo']);
		        $stmt->bindParam(':FRASE_UM_PREVENTIVO', $paramCampanha['fraseUmPreventivo']);
		        $stmt->bindParam(':HR_DE_UM_PREVENTIVO', $paramCampanha['deUmPreventivo']);
		        $stmt->bindParam(':HR_ATE_UM_PREVENTIVO', $paramCampanha['ateUmPreventivo']);
		        $stmt->bindParam(':DOIS_DIA_PREVENTIVO', $paramCampanha['DoisDiaPreventivo']);
		        $stmt->bindParam(':FRASE_DOIS_PREVENTIVO', $paramCampanha['fraseDoisPreventivo']);
		        $stmt->bindParam(':HR_DE_DOIS_PREVENTIVO', $paramCampanha['deDoisPreventivo']);
		        $stmt->bindParam(':HR_ATE_DOIS_PREVENTIVO', $paramCampanha['ateDoisPreventivo']);
		        $stmt->bindParam(':RETENCAO', $paramCampanha['retencao']);
		        $stmt->bindParam(':UM_DIA_RETENCAO', $paramCampanha['UmdiaRetencao']);
		        $stmt->bindParam(':FRASE_UM_RETENCAO', $paramCampanha['fraseUmRetencao']);
		        $stmt->bindParam(':HR_DE_UM_RETENCAO', $paramCampanha['deUmRetencao']);
		        $stmt->bindParam(':HR_ATE_UM_RETENCAO', $paramCampanha['ateUmRetencao']);
		        $stmt->bindParam(':DOIS_DIA_RETENCAO', $paramCampanha['DoisDiaRetencao']);
		        $stmt->bindParam(':FRASE_DOIS_RETENCAO', $paramCampanha['fraseDoisRetencao']);
		        $stmt->bindParam(':HR_DE_DOIS_RETENCAO', $paramCampanha['deDoisRetencao']);
		        $stmt->bindParam(':HR_ATE_DOIS_RETENCAO', $paramCampanha['ateDoisRetencao']);
		        
	        	$stmt->execute();

		        $res = $this->upDateHistoricoFile(1, $idCampanha, $dt);
		        return ($res == 'ok') ? $this->upDateStatusMailingBoleto(1, $idCampanha) : $res;
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }	
	}

	/**
	* Função que atualiza a tabela CAMPANHA_INFORMACOES
	* @access public
	* @param $paramCampanha, $idCampanha
	* @return ok ou parâmetro incorreto
	*/
	public function upDateDetalheCampanha($paramCampanha, $idCampanha, $dt)
	{
		if ($paramCampanha != '' && $idCampanha != '') {

			try {
				$dtDivulgacao = explode('/', $paramCampanha['dtDivulgacao']);
				$dtDivulgacao = $dtDivulgacao['2'] . '-' . $dtDivulgacao['1'] . '-' . $dtDivulgacao['0'];

		        $stmt = Conexao::getInstance()->prepare("UPDATE CAMPANHA_INFORMACOES
		        										 SET DIVULGACAO = :DIVULGACAO,
		        										 	 FRASE_DIVULGACAO = :FRASE_DIVULGACAO,
		        										 	 DT_DIVULGACAO = :DT_DIVULGACAO,
		        										 	 HR_DE_DIVULGACAO = :HR_DE_DIVULGACAO,
		        										 	 HR_ATE_DIVULGACAO = :HR_ATE_DIVULGACAO,
		        										 	 PREVENTIVO = :PREVENTIVO,
		        										 	 UM_DIA_PREVENTIVO = :UM_DIA_PREVENTIVO,
		        										 	 FRASE_UM_PREVENTIVO = :FRASE_UM_PREVENTIVO,
		        										 	 HR_DE_UM_PREVENTIVO = :HR_DE_UM_PREVENTIVO,
		        										 	 HR_ATE_UM_PREVENTIVO = :HR_ATE_UM_PREVENTIVO,
		        										 	 DOIS_DIA_PREVENTIVO = :DOIS_DIA_PREVENTIVO,
		        										 	 FRASE_DOIS_PREVENTIVO = :FRASE_DOIS_PREVENTIVO,
		        										 	 HR_DE_DOIS_PREVENTIVO = :HR_DE_DOIS_PREVENTIVO,
		        										 	 HR_ATE_DOIS_PREVENTIVO = :HR_ATE_DOIS_PREVENTIVO,
		        										 	 RETENCAO = :RETENCAO,
		        										 	 UM_DIA_RETENCAO = :UM_DIA_RETENCAO,
		        										 	 FRASE_UM_RETENCAO = :FRASE_UM_RETENCAO,
		        										 	 HR_DE_UM_RETENCAO = :HR_DE_UM_RETENCAO,
		        										 	 HR_ATE_UM_RETENCAO = :HR_ATE_UM_RETENCAO,
		        										 	 DOIS_DIA_RETENCAO = :DOIS_DIA_RETENCAO,
		        										 	 FRASE_DOIS_RETENCAO = :FRASE_DOIS_RETENCAO,
		        										 	 HR_DE_DOIS_RETENCAO = :HR_DE_DOIS_RETENCAO,
		        										 	 HR_ATE_DOIS_RETENCAO = :HR_ATE_DOIS_RETENCAO
		        										 WHERE ID_CAMPANHA = :ID_CAMPANHA");
			 	
		        $stmt->bindParam(':ID_CAMPANHA', $idCampanha);

		        $stmt->bindParam(':DIVULGACAO', $paramCampanha['divulgacao']);
		        $stmt->bindParam(':FRASE_DIVULGACAO', $paramCampanha['fraseDivulgacao']);
		        $stmt->bindParam(':DT_DIVULGACAO', $dtDivulgacao);
		        $stmt->bindParam(':HR_DE_DIVULGACAO', $paramCampanha['deDivulgacao']);
		        $stmt->bindParam(':HR_ATE_DIVULGACAO', $paramCampanha['ateDivulgacao']);

		        $stmt->bindParam(':PREVENTIVO', $paramCampanha['preventivo']);
		        $stmt->bindParam(':UM_DIA_PREVENTIVO', $paramCampanha['UmdiaPreventivo']);
		        $stmt->bindParam(':FRASE_UM_PREVENTIVO', $paramCampanha['fraseUmPreventivo']);
		        $stmt->bindParam(':HR_DE_UM_PREVENTIVO', $paramCampanha['deUmPreventivo']);
		        $stmt->bindParam(':HR_ATE_UM_PREVENTIVO', $paramCampanha['ateUmPreventivo']);
		        $stmt->bindParam(':DOIS_DIA_PREVENTIVO', $paramCampanha['DoisDiaPreventivo']);
		        $stmt->bindParam(':FRASE_DOIS_PREVENTIVO', $paramCampanha['fraseDoisPreventivo']);
		        $stmt->bindParam(':HR_DE_DOIS_PREVENTIVO', $paramCampanha['deDoisPreventivo']);
		        $stmt->bindParam(':HR_ATE_DOIS_PREVENTIVO', $paramCampanha['ateDoisPreventivo']);
		        $stmt->bindParam(':RETENCAO', $paramCampanha['retencao']);
		        $stmt->bindParam(':UM_DIA_RETENCAO', $paramCampanha['UmdiaRetencao']);
		        $stmt->bindParam(':FRASE_UM_RETENCAO', $paramCampanha['fraseUmRetencao']);
		        $stmt->bindParam(':HR_DE_UM_RETENCAO', $paramCampanha['deUmRetencao']);
		        $stmt->bindParam(':HR_ATE_UM_RETENCAO', $paramCampanha['ateUmRetencao']);
		        $stmt->bindParam(':DOIS_DIA_RETENCAO', $paramCampanha['DoisDiaRetencao']);
		        $stmt->bindParam(':FRASE_DOIS_RETENCAO', $paramCampanha['fraseDoisRetencao']);
		        $stmt->bindParam(':HR_DE_DOIS_RETENCAO', $paramCampanha['deDoisRetencao']);
		        $stmt->bindParam(':HR_ATE_DOIS_RETENCAO', $paramCampanha['ateDoisRetencao']);
		        
	        	$stmt->execute();

		        $res = $this->upDateHistoricoFile(1, $idCampanha, $dt);
		        return ($res == 'ok') ? $this->upDateStatusMailingBoleto(1, $idCampanha) : $res;
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }					
		}
		return 'Parâmetro incorreto em upDateDetalheCampanha';
	}

	/**
	* Função que seleciona as informações da campanha na tabela CAMPANHA_INFORMACOES pelo id da
	* campanha vindo da tabela historico_file.
	* @access public
	* @param $idCampanha
	* @return Array ou parâmetro incorreto
	*/
	public function getInformacaoCampanha($idCampanha)
	{
		if ($idCampanha != '') {
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT * FROM CAMPANHA_INFORMACOES
		        										 WHERE ID_CAMPANHA = :id");
		        
		        $stmt->bindParam(':id', $idCampanha);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('vazio');
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}
		return 'Parâmetro incorreto em getInformacaoCampanha';
	}

	/**
	* Função que atualiza o campo status_campanha da tabela historico_file.
	* @access public
	* @param $status, $id
	* @return String ok ou parâmetro incorreto
	*/
	public function upDateHistoricoFile($status, $id, $dt)
	{
		if ($status != '' && $id != '' && $dt != '') {
			try {
		        $stmt = Conexao::getInstance()->prepare("UPDATE historico_file SET status_campanha = :status, dt_ultima_edicao = :dt
		        										 WHERE id = :id");

		        $stmt->bindParam(':status', $status);
		        $stmt->bindParam(':id', $id);
		        $stmt->bindParam(':dt', $dt);
	        	$stmt->execute();

		        return 'ok';
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}
		return 'Parâmetro incorreto em upDateHistoricoFile';
	}

	/**
	* Função que atualiza o campo STATUS_MAILING da tabela BOLETO.
	* @access public
	* @param $status, $id
	* @return String ok ou parâmetro incorreto
	*/
	public function upDateStatusMailingBoleto($status, $id)
	{
		if ($status != '' && $id != '') {
			try {
		        $stmt = Conexao::getInstance()->prepare("UPDATE BOLETO SET STATUS_MAILING = :status
		        										 WHERE ID_HISTORICO_FILE = :id");

		        $stmt->bindParam(':status', $status);
		        $stmt->bindParam(':id', $id);
	        	$stmt->execute();

		        return 'ok';
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}
		return 'Parâmetro incorreto em upDateStatusMailingBoleto';
	}

	/**
	* Função que desabilita a campanha relacionada ao id
	* @access public
	* @param $id
	* @return String ok ou parâmetro incorreto
	*/
	public function desabilitaCampanha($id, $dt)
	{
		if ($id != '' && $dt != '') {
			$res = $this->upDateHistoricoFile('0', $id, $dt);
		    return ($res == 'ok') ? $this->upDateStatusMailingBoleto('0', $id) : $res;
		}
		return 'Parâmetro incorreto em desabilitaCampanha';
	}

	/**
	* Função que exclui a campanha relacionada ao id, antes de excluir a campanha será verificada
	* a data a data e o horário de inicio da DIVULGAÇÃO.
	* Se o dia for igual ao menor que o dia atual então verificar o horário de inicio da DIVULGAÇÃO,
	* somente concluir a exclusão até um minuto antes do horario de inicio da DIVULGAÇÃO.
	* @access public
	* @param $id
	* @return String ok ou parâmetro incorreto
	*/
	public function excluirCampanha($idCampanha, $dt)
	{
		if ($id != '' && $dt != '') {
			
		}
		return 'Parâmetro incorreto em excluirCampanha';
	}

	/**
	* Função para selecionar os acessos dos usuários no sistema
	* @access public
	* @param $data, $idEmpresa
	* @return array ou string erro
	*/
	public function getAcesso($data, $idEmpresa)
	{
		if ($data == 0) {
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT COUNT(ID) AS total, DT_ACESSO FROM LOG_CPF_CNPJ
														 WHERE ID_EMPRESA = :ID_EMPRESA
														 GROUP BY YEAR(DT_ACESSO), MONTH(DT_ACESSO)
														 ORDER BY ID DESC;");

		        $stmt->bindParam(':ID_EMPRESA', $idEmpresa);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('vazio');
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}

		$data = explode('-', $data);
		$ano  = $data[0];
		$mes  = $data[1];

		try {
	        $stmt = Conexao::getInstance()->prepare("SELECT a.DT_ACESSO, b.NOME_RAZAO_SOCIAL, b.CPF_CNPJ, c.id AS id_camapnha, c.nome_campanha FROM LOG_CPF_CNPJ AS a
													 INNER JOIN BOLETO AS b ON a.CPF_CNPJ = b.CPF_CNPJ
													 INNER JOIN historico_file AS c ON b.ID_HISTORICO_FILE = c.id
													 WHERE a.ID_EMPRESA = :ID_EMPRESA
													 AND YEAR(a.DT_ACESSO) = :ANO
													 AND MONTH(a.DT_ACESSO) = :MES
													 AND c.empresa = :ID_EMPRESA
													 GROUP BY DT_ACESSO, CPF_CNPJ
													 ORDER BY a.ID DESC;");

	        $stmt->bindParam(':ID_EMPRESA', $idEmpresa);
	        $stmt->bindParam(':ANO', $ano);
	        $stmt->bindParam(':MES', $mes);
        	$stmt->execute();

        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	        return (!empty($final_result)) ? $final_result : array('vazio');
	    } catch (Exception $e) {
	        return $e->getMessage();
	    }
	    
	}

	public function getAnalitico($idEmpresa)
	{
		$acesso 		= $this->getAcesso(0, $idEmpresa);
		$analiticoArr 	= array();
		$i 				= 0;
		if (is_array($acesso) && $acesso[0] != 'vazio') {
			foreach ($acesso as $key => $value) {
				
				$totalTelefone 		= $this->getTotalTelefone($value['DT_ACESSO'], $idEmpresa);
				$totalCodValidado 	= $this->getTotalCodValidado($value['DT_ACESSO'], $idEmpresa);
				$totalBoleto 		= $this->getTotalBoleto($value['DT_ACESSO'], $idEmpresa);
				$totalSms	 		= $this->getTotalSmsLinhaDigitavel($value['DT_ACESSO'], $idEmpresa);
				$totalBoletoEmail	= $this->getTotalBoletoEmail($value['DT_ACESSO'], $idEmpresa);
				
				$analiticoArr[$i++] = array(
					'totalAcessos' 		=> array('total' => $value['total'], 'dtAcesso' => $value['DT_ACESSO']),
					'totalTelefone' 	=> array('total' => $totalTelefone[0]['total']),
					'totalCodValidado' 	=> array('total' => $totalCodValidado[0]['total']),
					'totalBoleto' 		=> array('total' => $totalBoleto[0]['total']),
					'totalSmsLd' 		=> array('total' => $totalSms[0]['total']),
					'totalBoletoEmail'	=> array('total' => $totalBoletoEmail[0]['total'])
				);

			}
			return $analiticoArr;
		}
		return $acesso;		
	}

	public function getTotalTelefone($dt, $idEmpresa)
	{
		if ($dt != '') {
			$dt = explode('-', $dt);
			
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT COUNT(ID) AS total, DATAHORA FROM CELULAR_CLI
														 WHERE ID_EMPRESA = :id_empresa
														 AND YEAR(DATAHORA) = :ano
														 AND MONTH(DATAHORA) = :mes
														 AND FLAG = 1
														 AND LINHA_DIGITAVEL = 'X'
														 GROUP BY YEAR(DATAHORA), MONTH(DATAHORA)
														 ORDER BY ID DESC;");
		        
		        $stmt->bindParam(':id_empresa', $idEmpresa);
		        $stmt->bindParam(':ano', $dt[0]);
		        $stmt->bindParam(':mes', $dt[1]);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('total' => 0, 'DATAHORA' => 0);
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }

		}
		return 'Parâmetro incorreto na função getTotalTelefone!';

	}

	public function getTotalCodValidado($dt, $idEmpresa)
	{
		if ($dt != '') {
			$dt = explode('-', $dt);
			
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT COUNT(ID) AS total, DATAHORA FROM CELULAR_CLI
														 WHERE ID_EMPRESA = :id_empresa
														 AND YEAR(DATAHORA) = :ano
														 AND MONTH(DATAHORA) = :mes
														 AND VALIDOU = 1
														 AND LINHA_DIGITAVEL = 'X'
														 GROUP BY YEAR(DATAHORA), MONTH(DATAHORA)
														 ORDER BY ID DESC;");
		        
		        $stmt->bindParam(':id_empresa', $idEmpresa);
		        $stmt->bindParam(':ano', $dt[0]);
		        $stmt->bindParam(':mes', $dt[1]);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('total' => 0, 'DATAHORA' => 0);
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }

		}
		return 'Parâmetro incorreto na função getTotalCodValidado!';

	}

	public function getTotalBoleto($dt, $idEmpresa)
	{
		if ($dt != '') {
			$dt = explode('-', $dt);
			
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT COUNT(ID) AS total, DATAHORA FROM CELULAR_CLI
														 WHERE ID_EMPRESA = :id_empresa
														 AND YEAR(DATAHORA) = :ano
														 AND MONTH(DATAHORA) = :mes
														 AND VALIDOU = 1
														 AND LINHA_DIGITAVEL = 'X'
														 AND BOLETO = 1
														 GROUP BY YEAR(DATAHORA), MONTH(DATAHORA)
														 ORDER BY ID DESC;");
		        
		        $stmt->bindParam(':id_empresa', $idEmpresa);
		        $stmt->bindParam(':ano', $dt[0]);
		        $stmt->bindParam(':mes', $dt[1]);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('total' => 0, 'DATAHORA' => 0);
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }

		}
		return 'Parâmetro incorreto na função getTotalCodValidado!';

	}

	public function getTotalSmsLinhaDigitavel($dt, $idEmpresa)
	{
		if ($dt != '') {
			$dt = explode('-', $dt);
			
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT COUNT(ID) AS total, DATAHORA FROM CELULAR_CLI
														 WHERE ID_EMPRESA = :id_empresa
														 AND YEAR(DATAHORA) = :ano
														 AND MONTH(DATAHORA) = :mes
														 AND FLAG = 1
														 AND LINHA_DIGITAVEL <> 'X'
														 GROUP BY YEAR(DATAHORA), MONTH(DATAHORA)
														 ORDER BY ID DESC;");
		        
		        $stmt->bindParam(':id_empresa', $idEmpresa);
		        $stmt->bindParam(':ano', $dt[0]);
		        $stmt->bindParam(':mes', $dt[1]);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('total' => 0, 'DATAHORA' => 0);
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }

		}
		return 'Parâmetro incorreto na função getTotalCodValidado!';

	}

	public function getTotalBoletoEmail($dt, $idEmpresa)
	{
		if ($dt != '') {
			$dt = explode('-', $dt);
			
			try {
		        $stmt = Conexao::getInstance()->prepare("SELECT COUNT(ID) AS total, DATA_EMAIL FROM EMAIL_CLI
														 WHERE EMPRESA = :id_empresa
														 AND YEAR(DATA_EMAIL) = :ano
														 AND MONTH(DATA_EMAIL) = :mes;");
		        
		        $stmt->bindParam(':id_empresa', $idEmpresa);
		        $stmt->bindParam(':ano', $dt[0]);
		        $stmt->bindParam(':mes', $dt[1]);
	        	$stmt->execute();

	        	$final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		        return (!empty($final_result)) ? $final_result : array('total' => 0, 'DATA_EMAIL' => 0);
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }			
		}
		return 'Parâmetro incorreto na função getTotalBoletoEmail!';
	}

}