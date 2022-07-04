<?php
/**
* Esta classe é responsavel por controlar o fluxo do sistema,
* recebendo parâmetros e chamando as classes.
*/	

session_start();

include_once("../class/db/conexao.php");

class Controller
{
	/**
	* Variável privada que contém os parâmetros passado pelos usuário.
	* @access private
	* @name $parametros;
	*/
	private $parametros;

	/**
	* Variável privada que contém a hora e a data no formato H:i d/m/Y.
	* @access private
	* @name $hrDataAtual;
	*/
	private $hrDataAtual;

	/**
	* Variável privada que contém os arquivos passado pelos usuários
	* @access private
	* @name $parametrosFiles;
	*/
	private $parametrosFiles;

	/**
	* Variável privada que contém a hora e a data no formato Y-m-d H:i:s.
	* @access private
	* @name $dtTime;
	*/
	private $dtTime;

	/**
	* Variável privada que contém session.
	* @access private
	* @name $sessionParam;
	*/
	private $sessionParam;

	/**
	* Variável privada que contém o id da empresa
	* @access private
	* @name $idEmpresa;
	*/
	private $idEmpresa;

	/**
	* Construtor da classe
	* @access public
	* @param String $parametros
	* @return void
	*/
	public function __construct($parametros, $parametrosFiles, $sessionParam)
	{
		$this->idEmpresa 		= 1;
		$this->parametros 		= $parametros;
		$this->parametrosFiles 	= $parametrosFiles;
		$this->hrDataAtual		= date('H:i d/m/Y');
		$this->dtTime 			= date('Y-m-d H:i:s');
		$this->sessionParam 	= $sessionParam;
		$this->direcionarArquivo($parametros->arquivo);
	}

	/**
	* Função para direcionar as mais variadas funções do sistema
	* @access private
	* @param $nomeArquivo
	* @return função ou uma mensagem de parametros incorretos
	*/
	private function direcionarArquivo($nomeArquivo)
	{
		switch ($nomeArquivo)
		{
			case 'consulta/contrato.php':
				$this->funcConsultaInicial($nomeArquivo);
				break;
			case 'email/email.php':
				$this->funcSendEmail($nomeArquivo);
				break;
			case 'acesso/acesso.php':
				$this->funcAcessoAdmim($nomeArquivo);
				break;
			case 'importFile/importFile.php':
				$this->funcImportFileCsv($nomeArquivo);
				break;
			case 'boleto/geraBoleto.php':
				$this->funcGeraBoleto($nomeArquivo);
				break;
			case 'admin/admin.php':
				$this->funcAdmin($nomeArquivo);
				break;
			case 'cep/cep.php':
				$this->funcCep($nomeArquivo);
				break;
			default:
				echo 'parametros incorretos-> ' . $nomeArquivo;
		}
	}

	/**
	* Função consultar o CFP/CNPJ e inicializar o sistema
	* @access private
	* @param $nomeArquivo
	* @return String $resposta
	*/
	private function funcConsultaInicial($nomeArquivo)
	{
		$this->openFile($nomeArquivo);
		$objConsulta = new ConsultaContratos();

		switch ($this->parametros->tipo) {
			case 'contrato':
				$resposta = $objConsulta->consultaCpfCnpj($this->parametros->cpfCnpf, $this->idEmpresa);
				echo json_encode(array($resposta));
				break;
			case 'celular':
				$resposta = $objConsulta->gravaCelular($this->parametros->celular, $this->sessionParam['cpf_cnpj'], $this->dtTime, $this->idEmpresa, 0, 0);
				echo ($resposta == 'ok') ? json_encode(array('resposta' => $resposta)) : $resposta;
				break;
			case 'codigo':
				$resposta = $objConsulta->consultaCodigo($this->parametros->codigo, $this->sessionParam['cpf_cnpj'], $this->idEmpresa);
				echo (is_array($resposta)) ? json_encode($resposta) : $resposta;
				break;
			case 'setBoletoInfo':
				$resposta = $objConsulta->setBoletoInfo($this->sessionParam['dados_cli']->ID, $this->parametros->valorOpcao, $this->parametros->logradouro, $this->parametros->numero, $this->parametros->bairro, $this->parametros->cidade, $this->parametros->uf, $this->parametros->cep, $this->parametros->complemento, $this->idEmpresa);
				echo (is_array($resposta)) ? json_encode($resposta) : $resposta;
				break;
			default:
				echo 'Parametro tipo incorreto ' . $this->parametros->tipo;
				break;
		}

	}

	/**
	* Função para enviar email com a opção da proposta escolhida pelo usuário
	* @access private
	* @param $nomeArquivo
	* @return ok ou descrição do erro
	*/
	private function funcSendEmail($nomeArquivo)
	{
		$this->openFile('PHPMailer-master/PHPMailerAutoload.php');
		$this->openFile($nomeArquivo);
		$this->openFile('consulta/contrato.php');

		$objConsulta = new ConsultaContratos();
		$mail 		 = new Email();

		switch ($this->parametros->tipo) {
			case 'propostaOpcao':
				$proposta = $objConsulta->getPropostaPorOpcao($this->parametros->opcaoProposta, $this->sessionParam['cpf_cnpj'], $this->idEmpresa);
				$resposta = $mail->propostaOpcao($proposta, $this->parametros->opcaoProposta, $objConsulta);
				
				echo ($resposta == 'ok') ? json_encode(array('ok')) : $resposta;
				break;
			case 'propostaCliente':
				$proposta = $objConsulta->getPropostaPorOpcao(0, $this->sessionParam['cpf_cnpj'], $this->idEmpresa);
				$resposta = $mail->propostaCliente($proposta, $this->parametros, $objConsulta, $this->dtTime);
				
				echo ($resposta == 'ok') ? json_encode(array('ok')) : $resposta;
				break;
			default:
				echo 'Parametro tipo incorreto ' . $this->parametros->tipo;
				break;
		}
	}

	/**
	* Função que recebe as informações do cliente e gera bole
	* @access private
	* @param $nomeArquivo
	* @return boleto ou descrição do erro
	*/
	private function funcGeraBoleto($nomeArquivo)
	{
		$this->openFile($nomeArquivo);
		$this->openFile('consulta/contrato.php');
		$this->openFile('boleto/barcode.php');

		$objBoleto = new GeraBoleto();
		$objConsulta = new ConsultaContratos();
		$objBarCode = new barCodeGenrator();

		switch ($this->parametros->tipo) {
			case 'boleto1':
				$dadosUser = $objConsulta->getPropostaPorOpcao($this->parametros->valorOpcao, $this->sessionParam['cpf_cnpj'], $this->idEmpresa);
				
				// Função que indica que o cliente gerou um boleto.
				$indicador = $objConsulta->setBoleto($this->sessionParam['codigoSms'], $this->sessionParam['cpf_cnpj'], $this->idEmpresa);

				$nomeCodBarra = md5(uniqid(time())) . '.gif';
				$codBarra = $objBoleto->montaCodBarra($dadosUser['LINHA_DIGITAVEL']);

				$objBarCode->initialize($codBarra['codBarra'], 1, '../class/boleto/cod_barra/' . $nomeCodBarra);
				$CaminhoCodBarra = '../class/boleto/cod_barra/' . $nomeCodBarra;

				$parametroboleto = array
										(
											'dias_de_prazo_para_pagamento' => '5',
											'taxa_boleto' => 0.00
										);
				//$boletoInfo = $objConsulta->getBoletoInfo($this->sessionParam['cpf_cnpj'], $this->idEmpresa);
				$resposta = $objConsulta->setBoletoInfo($this->sessionParam['dados_cli']->ID, $this->parametros->valorOpcao, $this->idEmpresa, $this->dtTime);

				$objBoleto->geraBoletoSantander($dadosUser, $parametroboleto, 0, $CaminhoCodBarra);
				break;
			case 'enviarLinhaDigitavelSms':
				$dadosUser = $objConsulta->getPropostaPorOpcao($this->parametros->valorOpcao, $this->sessionParam['cpf_cnpj'], $this->idEmpresa);
				$parametroboleto = array
										(
											'dias_de_prazo_para_pagamento' => '5',
											'taxa_boleto' => 0.00
										);
				
				//$boletoInfo = $objConsulta->getBoletoInfo($this->sessionParam['cpf_cnpj'], $this->idEmpresa);										
				
				$dadosBoleto = $objBoleto->geraBoletoSantander($dadosUser, $parametroboleto, 1, '');
				$celularUser = $objConsulta->getCelularUser($this->sessionParam['codigoSms']);
				
				$resposta = $objConsulta->gravaCelular($celularUser[0]['CEL_CLI'], $this->sessionParam['cpf_cnpj'], $this->dtTime, $this->idEmpresa, $this->sessionParam['codigoSms'], $dadosBoleto);
				echo ($resposta == ok) ? json_encode(array($resposta)) : $resposta;
				break;
			case 'enviarEmail':
				$this->openFile('PHPMailer-master/PHPMailerAutoload.php');
				$this->openFile('email/email.php');
				$this->openFile('mPDF/mpdf.php');

				$mail 		 = new Email();
				$objMPdf	 = new mPDF();

				$nomeArquivo = '../boleto_pdf/boleto_' . md5(uniqid(time())) . '.pdf';
				// Inseri tamanho do cod. barras
				$bodyEmail = str_replace("<img id", "<img width='750'", $this->parametros->bodyEmail);
				
				$objMPdf->WriteHTML($bodyEmail);
				$objMPdf->Output($nomeArquivo);

				$textEmail = 	"<i><b><div style='font-size:14.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;color:#002060'>
									<p>
										Prezado cliente, segue anexo o boleto para pagamento do seu acordo realizado h&aacute; poucos minutos em nosso site, nas condi&ccedil;&otilde;es e vencimento combinados.
									</p>
									<br>
									<p>
										Lembramos que este boleto pode ser pago em qualquer ag&ecirc;ncia banc&aacute;ria at&eacute; o vencimento, e em caso de d&uacute;vidas, contate-nos atrav&eacute;s dos telefones (11) 3927-9630 ou 0800 721 0145.
									</p>
									<br>
									<p>
										Agradecemos pela realiza&ccedil;&atilde;o do seu Acordo e aguardamos a baixa do pagamento.
									</p>
								 </div></b></i>";

				$res = $mail->sendEmailBoleto($textEmail, $this->parametros->email, $nomeArquivo);
				echo ($res == 'ok') ? json_encode(array($res)) : $res;
				break;
			default:
				echo 'Parâmetro invalido na função funcGeraBoleto';
		}
	}

	/**
	* Função para comparar se o usuário e senha existem na base
	* @access private
	* @param $nomeArquivo
	* @return ok ou acesso negado
	*/
	private function funcAcessoAdmim($nomeArquivo)
	{
		$this->openFile($nomeArquivo);

		$objAcesso = new Acesso();
		$res = $objAcesso->acessoAdmin($this->parametros->login, $this->parametros->senha, $this->dtTime, $this->idEmpresa);
		//var_dump($res);
		$arr = array('res' => $res);
		echo json_encode($arr);
	}

	/**
	* Função que administra a area de admin do sistema, faz operações como buscar os tipos de 
	* boletos(bancos), gerencia campanhas e etc...
	* @access private
	* @param $nomeArquivo
	* @return String json ou erro
	*/
	private function funcAdmin($nomeArquivo)
	{
		$this->openFile($nomeArquivo);

		$objAdm = new Admin();

		switch ($this->parametros->type) {
			case 'getBancos':
				$banco = $objAdm->getBancos(1);
				echo (is_array($banco)) ? json_encode($banco) : $banco;
				break;
			case 'getCampanha':
				$campanha = $objAdm->getCampanha($this->idEmpresa);
				echo (is_array($campanha)) ? json_encode($campanha) : $campanha;
				break;
			case 'getCampanhaData':
				$campanha = $objAdm->getCampanhaData($this->idEmpresa, $this->parametros->de, $this->parametros->ate, $this->parametros->total);
				echo (is_array($campanha)) ? json_encode($campanha) : $campanha;
				break;
			case 'setDetalheCampanha':
				$res = $objAdm->setDetalheCampanha($this->parametros->paramCampanha, $this->parametros->idCampanha, $this->dtTime);
				echo ($res == 'ok') ? json_encode(array($res)) : $res;
				break;
			case 'desabilitaCampanha':
				$res = $objAdm->desabilitaCampanha($this->parametros->idCampanha, $this->dtTime, 0);
				echo ($res == 'ok') ? json_encode(array($res)) : $res;
				break;
			case 'excluirCampanha':
				$res = $objAdm->excluirCampanha($this->parametros->idCampanha, $this->dtTime);
				echo ($res == 'ok') ? json_encode(array($res)) : $res;
				break;
			case 'loadCampanhaInformacoes':
				$informacaoCampanha = $objAdm->getInformacaoCampanha($this->parametros->idCampanha);
				echo (is_array($informacaoCampanha)) ? json_encode($informacaoCampanha) : $informacaoCampanha;
				break;
			case 'upDateDetalheCampanha':
				$res = $objAdm->upDateDetalheCampanha($this->parametros->paramCampanha, $this->parametros->idCampanha, $this->dtTime);
				echo ($res == 'ok') ? json_encode(array($res)) : $res;
				break;
			case 'userAcesso':
				$acesso = $objAdm->getAcesso(0, $this->idEmpresa);
				echo (is_array($acesso)) ? json_encode($acesso) : $acesso;
				break;
			case 'userAcessoDt':
				$acesso = $objAdm->getAcesso($this->parametros->dt, $this->idEmpresa);
				echo (is_array($acesso)) ? json_encode($acesso) : $acesso;
				break;
			case 'getAnalitico':
				$analitico = $objAdm->getAnalitico($this->idEmpresa);
				echo (is_array($analitico)) ? json_encode($analitico) : $analitico;
				break;
			default:
				echo 'Parâmetros incorretos -> ' . $this->parametros->type . ' linha -> ' . __LINE__;
		}

	}

	/**
	* Função que importa um arquivo csv
	* @access private
	* @param $nomeArquivo
	* @return ok ou falso
	*/
	private function funcImportFileCsv($nomeArquivo)
	{
		$this->openFile($nomeArquivo);
		
		$filePermitido  = array('.csv');
		$fileSize 		= 1111024;
		$pasta 			= '../file/';
		
		$objImportFIle 	= new ImportFile($filePermitido, $fileSize, $pasta);
		$fileUpload	   	= $objImportFIle->testFile($this->parametrosFiles);
		if (is_array($fileUpload)) {
			if (!empty($fileUpload)) {
				
				$res = $objImportFIle->importFile($fileUpload);
				
				if ($res == 'ok') {
					$res = $objImportFIle->setHistoricoArquivo($fileUpload, $this->parametros->campanha, $this->dtTime, $this->sessionParam['userAdm'], $this->idEmpresa, $this->parametros->banco);

					if (is_array($res)) {
						$arrRes = $objImportFIle->importTempBoleto('../file/'.$fileUpload[0]['nome_atual'], $res['idInserted']);
						
						if (is_array($arrRes)) {
							echo json_encode($arrRes);
						} else {
							echo $res;
						}
					} else {
						echo $res;
					}
				} else {
					echo $res;
				}
			} else {
				echo 'Selecione um arquivo .csv';
			}
		} else {
			echo $fileUpload;
		}
	}

	private function funcCep($nomeArquivo)
	{
		$this->openFile($nomeArquivo);

		$objCep = new Cep();
		echo $objCep->getCep($this->parametros->cep);
	}

	/**
	* Função para chamar as classes que estão nos arquivos na pasta class
	* @access private
	* @param $nomeArquivo
	* @return função ou uma mensagem de parametros incorretos
	*/
	private function openFile($nomeArquivo)
	{
		if(file_exists('../class/' . $nomeArquivo))
		{
			include_once('../class/' . $nomeArquivo);
		}		
	}

}

// Parâmetros passado pelo js
$parametros = (isset($_REQUEST)) ? (object) $_REQUEST : false;

// Parâmetros de arquivos passado pelo js
$parametrosFiles = (isset($_FILES)) ? (object) $_FILES : false;

// Passa a session como parametro
$sessionParam = array
				(
					'userAdm' => isset($_SESSION["login_personal_adm"]) ? $_SESSION["login_personal_adm"] : false,
					'codigoSms' => isset($_SESSION['codigo_sms_personalcob']) ? $_SESSION['codigo_sms_personalcob'] : false,
					'cpf_cnpj' => isset($_SESSION['cpf_cnpj_personal']) ? $_SESSION['cpf_cnpj_personal'] : false,
					'dados_cli' => isset($_SESSION['dados_cli_completo']) ? $_SESSION['dados_cli_completo'] : false
				);

// Objeto Controller
$controller = new Controller($parametros, $parametrosFiles, $sessionParam);




