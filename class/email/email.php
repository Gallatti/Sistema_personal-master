<?php

class Email extends PHPMailer
{
	
	public function __construct()
	{
		$this->conectEmail();		
	}

	private function conectEmail()
	{
		//$this->SMTPDebug = 3;                               	// Enable verbose debug output

		$this->isSMTP();                                      	// Set mailer to use SMTP
		$this->Host 		= 'smtp.gmail.com';  				// Specify main and backup SMTP servers
		$this->SMTPAuth 	= true;                             // Enable SMTP authentication
		$this->Username 	= 'emailmicroeasy@gmail.com';		// SMTP username
		$this->Password 	= 'micro123';                       // SMTP password
		$this->SMTPSecure 	= 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$this->Port 		= 587;                              // TCP port to connect to

		$this->isHTML(true);									// Set email format to HTML
	}

	public function setOrigem($emailOrigem, $nomeOrigem)
	{
		$this->setFrom($emailOrigem, $nomeOrigem);
	}

	public function setDestino($emailDestino, $nomeDestini = '')
	{
		$this->addAddress($emailDestino, $nomeDestini);
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
	}

	public function setArquivo($caminhoArquivo, $nomeArquivo = '')
	{
		$this->addAttachment($caminhoArquivo, $nomeArquivo);
	}

	public function setBodyEmail($assunto, $body, $subBody = '')
	{
		$this->Subject = $assunto;
		$this->Body    = $body;
		$this->AltBody = $subBody;
	}

	public function enviarEmail()
	{
		if(!$this->send()) {
		    return 'Message could not be sent. Mailer Error: ' . $this->ErrorInfo;
		} else {
		    return 'Message has been sent';
		}
	}

	public function propostaOpcao($proposta, $opcao, $objConsulta)
	{
		if (!empty($proposta)) {
			$bodyEmail = "<h1>Proposta por opção</h1>
						  <hr>
						  <h1>Dados do cliente</h1>
						  <hr>
						  <ul>
						  	<li>Nome: {$proposta['NOME_RAZAO_SOCIAL']}</li>
						  	<li>CPF/CNPJ: {$proposta['CPF_CNPJ']}</li>
						  	<li>Endereço: {$proposta['ENDERECO']}, Cep: {$proposta['CEP']}</li>
						  	<li>Cidade: {$proposta['CIDADE']}, {$proposta['UF']}</li>
						  </ul>
						  <hr>
						  <h1>Dados da Proposta</h1>
						  <hr>
						  <ul>
						  	<li>Opção: {$opcao}</li>
						  	<li>Tipo proposta: {$proposta['TIPO_PROPOSTA']}</li>
						  	<li>Valor entrada: {$proposta['VALOR_ENTREGA_PROPOSTA']}</li>
						  	<li>Qtd. parcela(s): {$proposta['QTDE_PARCELAS_PROPOSTA']}</li>
						  	<li>Valor parcela(s): {$proposta['VALOR_PARCELAS_PROPOSTA']}</li>
						  	<li>Valor de desconto proposta: {$proposta['VALOR_DESCONTO_PROSTOSTA']}</li>
						  </ul>";
			$this->setOrigem('emailmicroeasy@gmail.com', 'Proposta - Personalcob');
			$this->setDestino('higor.xsapo@gmail.com');
			$this->setDestino('fernandoarlima@hotmail.com');
			$this->setBodyEmail('Proposta TRC-Taborda', $bodyEmail);

			$respostaEnvio 			= $this->enviarEmail(); //'Message has been sent'
			// setPropostaCliOpcao é um metodo da classe ConsultaContratos
			$respostaSetProposta 	= $objConsulta->setPropostaCliOpcao($proposta['ID']);

			if ($respostaEnvio != 'Message has been sent' || $respostaSetProposta != 'ok') {
				return 'Ocorreu algum erro ao enviar a proposta por e-mail';
			}
			return 'ok';
		}
		return 'Sem proposta ao enviar e-mail!';
	}

	public function propostaCliente($proposta, $dadosProposta, $objConsulta, $dtTime)
	{
		if (!empty($proposta)) {
			$bodyEmail = "<h1>Proposta do cliente</h1>
						  <hr>
						  <h1>Dados do cliente</h1>
						  <hr>
						  <ul>
						  	<li>Nome: {$proposta['NOME_RAZAO_SOCIAL']}</li>
						  	<li>CPF/CNPJ: {$proposta['CPF_CNPJ']}</li>
						  	<li>Endereço: {$proposta['ENDERECO']}, Cep: {$proposta['CEP']}</li>
						  	<li>Cidade: {$proposta['CIDADE']}, {$proposta['UF']}</li>
						  </ul>
						  <hr>
						  <h1>Dados da proposta do cliente</h1>
						  <hr>
						  <ul>
						  	<li>Valor entrada: {$dadosProposta->entrada}</li>
						  	<li>Qtd. parcela(s): {$dadosProposta->qtParcela}</li>
						  	<li>Valor parcela(s): {$dadosProposta->vlParcela}</li>
						  	<li>Data de pagamento: {$dadosProposta->dtPagamento}</li>
						  </ul>";
			$this->setOrigem('emailmicroeasy@gmail.com', 'Proposta - Personalcob');

			// Destinos
			$this->setDestino('suporte@microeasy.com.br');
			$this->setDestino('fernandolima@microeasy.com.br');

			// Setando o corpo do e-mail
			$this->setBodyEmail('Proposta Personalcob', $bodyEmail);

			$respostaEnvio 			= $this->enviarEmail(); //'Message has been sent'

			// setPropostaCliSemOpcao é um metodo da classe ConsultaContratos
			$respostaSet = $objConsulta->setPropostaCliSemOpcao($dadosProposta, $proposta['CPF_CNPJ'], $dtTime);
			
			if ($respostaEnvio != 'Message has been sent' || $respostaSet != 'ok') {
				return 'Ocorreu algum erro ao enviar a proposta por e-mail';
			}
			return 'ok';
		}
		return 'Sem proposta ao enviar e-mail!';
	}

	public function sendEmailBoleto($bodyEmail, $destinatario, $nomeArquivo)
	{
		$this->setOrigem('emailmicroeasy@gmail.com', 'Boleto - Personalcob');
		$this->setDestino($destinatario);
		$this->setArquivo($nomeArquivo, 'BOLETO.pdf');
		
		$this->setBodyEmail('Boleto Personalcob', $bodyEmail);

		$respostaEnvio 			= $this->enviarEmail(); //'Message has been sent'
		
		if ($respostaEnvio != 'Message has been sent') {
			return 'Ocorreu algum erro ao enviar a proposta por e-mail';
		}
		return 'ok';
	}

	private function setEmailOpcao($dadosCliente, $dt, $valorOpcao, $destinatario, $idEmpresa)
	{
		if ($dadosCliente != false) {
			try {
		        $stmt = Conexao::getInstance()->prepare("INSERT INTO EMAIL_CLI
		        										 (
		        										 	CPF_CNPJ,
		        										 	ID_BOLETO,
		        										 	OPCAO_PROPOSTA,
		        										 	EMAIL,
		        										 	EMPRESA,
		        										 	DATA_EMAIL
		        										 )
		        										 VALUES
		        										 (
		        										 	:CPF_CNPJ,
		        											:ID_BOLETO,
		        											:OPCAO_PROPOSTA,
		        											:EMAIL,
		        											:EMPRESA,
		        											:DATA_EMAIL
		        										 );");
		        
		        $stmt->bindParam(':CPF_CNPJ', $dadosCliente->CPF_CNPJ);
		        $stmt->bindParam(':ID_BOLETO', $dadosCliente->ID);
		        $stmt->bindParam(':OPCAO_PROPOSTA', $valorOpcao);
		        $stmt->bindParam(':EMAIL', $destinatario);
		        $stmt->bindParam(':EMPRESA', $idEmpresa);
		        $stmt->bindParam(':DATA_EMAIL', $dt);
	        	$stmt->execute();

		        return 'ok';
		    } catch (Exception $e) {
		        return $e->getMessage();
		    }
		}	
	}

}