<meta charset="UTF-8" />


<table
	border="0"
	width="840"
	style="borde:solid 1px #000000"
	>
<tr>
	<td>
	
		<table 
			border="0"
			style="borde:solid 1px #000000"
			width="100%">
			<tr>
				<td>
					<img style="max-width:150px; max-height:50px;" src="../class/boleto/boleto/imagens/logosantander1.jpg" />
					
				</td>
				
				<td align="right">
					<div style="font-family:times new roman; font-size:22px; margin-top:22px;">
						Recibo do Pagador
					</div>
				</td>
			</tr>
		</table>
	
	
	</td>
</tr>

<tr>
	<td
			style="border:solid 1px #000000;">

		<table 
			border="0"
			width="100%">
			<tr valign="top">
				<td
					style="border: solid 1px #000000"
					width="600">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Cedente
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						Banco Santander S.A. CNPJ: 90.400.888/0001-42
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:10px; font-weight:bold; padding:1px;">
						 Av. Pres. Jusc Kubitschek, 2041 e 2235 - Bloco A, Vl Olímpia, SP - CEP 04543-011
					</div>
				</td>
				
				
				<td
					style="border: solid 1px #000000"
					width="200">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Agência/Código Cedente
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->agenciaCodCede; ?>
					</div>
				</td>
				
				<td
					style="border: solid 1px #000000"
					width="200">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Vencimento
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->dtVencimento; ?>
					</div>
				</td>
			</tr>

			<tr valign="top">
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Pagador
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->nomeCliente; ?>
					</div>
				</td>
				
				
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Número do Documento
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->agenciaCodCede; ?>
					</div>
				</td>
				
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Nosso Número
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->nossoNumero; ?>
					</div>
				</td>
			</tr>


			<tr valign="top">
				<td
					style="border: solid 1px #000000">
					
					<table
						cellpadding="0"
						cellspacing="0"
						width="100%">
						<tr>
							<td
								style="border-right: solid 1px #000000">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Espécie
								</div>
								<div
									style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									R$
								</div>
							</td>
							
							<td
								style="border-right: solid 1px #000000">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Quantidade
								</div>
								<div
									style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									-
								</div>
							</td>
							
							<td>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									(x) Valor
								</div>
								<div
									style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									R$ <? echo $boleto->valor; ?>
								</div>
							</td>
							
						</tr>
					</table>
					
					
				</td>
				
				
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						(=) Valor do Documento
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						R$ <? echo $boleto->valor; ?>
					</div>
				</td>
				
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						(-) Desconto
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						
					</div>
				</td>
			</tr>


			<tr valign="top">
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Demonstrativo:
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						-
					</div>
				</td>
				
				
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						(+) Outros Acréscimos
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						-
					</div>
				</td>
				
				<td
					style="border: solid 1px #000000">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						(=) Valor Cobrado
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						R$ <? echo $boleto->valor; ?>
					</div>
				</td>
			</tr>

		</table>

	
	</td>
</tr>

<tr>
	<td
			style="border:solid 1px #000000;">
	
		<table
			border="0"
			width="100%">
			<tr>
				<td width="80">
					<div
						style="height:20px; font-family:verdana; font-size:14px; padding:1px;">
						Prezado(a)
					</div>
					
				</td>
				<td>
					<div
						style="height:20px; font-family:verdana; font-size:14px; padding:1px;">
						<? echo $boleto->nomeCliente; ?> - CPF/CNPJ: <? echo $boleto->cpfCnpj; ?>
					</div>
				</td>
			</tr>
		</table>
	

	
		<table
			border="0"
			width="100%">
			<tr>
				<td width="70">
					<div
						style="height:20px; font-family:verdana; font-size:14px; padding:1px;">
						Contratos
					</div>
					
				</td>
				<td>
					<div
						style="height:20px; font-family:verdana; font-size:14px; padding:1px;">
						<? echo $boleto->numContrato; ?>
					</div>
				</td>
			</tr>
		</table>
		
		<div style="padding:2px">

			<div
				style="line-height:20px; font-family:verdana; color:black; font-size:14px; padding:1px; text-align:justify;">
				A PERSONALCOB, empresa prestadora de serviços terceirizados de cobrança de ativos financeiros do Banco Santander
				(Brasil) S.A (com sede na RUA BARÃO DE ITAPETININGA, 93, 8ºAndar, CJ.802, São Paulo/SP, CEP 01042-908, CNPJ/MF sob n. o 12.837.042/0001-60), vem declarar que o(s) contratos acima
				mencionado(s) pertencente(s) à/ao cliente <? echo $boleto->nomeCliente; ?>, encontra(m)–se, até a presente data, com
				saldo(s) devedor(es) pendente(s) de regularização.
			</div>
			<div style="margin:10px"></div>
			<div
				style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
				Dessa maneira, informamos que o pagamento poderá ser feito por meio de boleto, abaixo, que contempla: (i) opções de
				pagamento à vista com expressivo desconto; ou (ii) forma parcelada, conforme demonstrado.
			</div>
			<div style="margin:10px"></div>
			<div
				style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
				Após o pagamento da 1a parcela ou quitação, o credor providenciará a reabilitação do seu nome junto aos Órgãos de
				Proteção ao Crédito, desde que não haja outros débitos pendentes junto ao Santander.
			</div>
			<div style="margin:10px"></div>
			<div
				style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
				Caso o pagamento já tenha sido efetuado ao tempo do recebimento desta, favor desconsiderar o presente.
			</div>
			<div style="margin:10px"></div>
			<div
				style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
				Após o pagamento a entrada caso as demais parcelas não cheguem ao endereço, solicite seu boleto da parcela no (11) 3927-9630 / 0800 721 0145. O desconto é válido somente em pontualidade, para pagamento no vencimento, caso atrase o pagamento da
	parcela haverá multa e correção diária.
			</div>

			<div style="margin:10px"></div>
			
		</div>

	
	</td>
</tr>


<tr>
	<td align="right">
		<div
			style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
			>
			Autenticação Mecânica
		</div>
	</td>
</tr>


<tr>
	<td
		valign="bottom"
		height="70"
		style="border-bottom:dotted 1px #000000;">
		<div
			style="text-align:center; font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
			>
			Corte Aqui
		</div>
	</td>
</tr>


<tr>
	<td>
	
		<table 
			border="0"
			style="borde:solid 1px #000000"
			width="100%">
			<tr>
				<td>
					<img style="max-width:150px; max-height:50px;" src="../class/boleto/boleto/imagens/logosantander1.jpg" />
					
				</td>
				
				<td>
					
					<table 
						border="0"
						width="100%">
						<tr>
							<td>
								<div 
									style="
										font-family:vernda; font-size:26px;
										border-left:solid 1px #000000;
										border-right:solid 1px #000000;
									">
									033-7
								</div>
							</td>
							
							<td>
								<div 
									style="
										margin-left:20px;
										font-family:vernda; font-size:23px"
									>
									<? echo $boleto->linhaDigitavel; ?>
								</div>
							</td>
						</tr>
					</table>
					
					
					
					
				</td>
			</tr>
		</table>
	
	
	</td>
</tr>

<tr>
	<td
			style="border:solid 1px #000000;">
			
		<table 
					border="0"
					width="100%">
			<tr valign="top">
				<td
					style="border:solid 1px #000000;">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Local de Pagamento
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						Pagável em qualquer banco até a data do vencimento
					</div>					
				</td>
				
				<td 
					width="300"
					style="border:solid 1px #000000;"
					>
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Vencimento
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->dtVencimento; ?>
					</div>
				</td>
			</tr>


			<tr valign="top">
				<td
					style="border:solid 1px #000000;">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Beneficiário
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						Banco Santander S.A. CNPJ: 90.400.888/0001-42
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:10px; font-weight:bold; padding:1px;">
						Av. Pres. Jusc Kubitschek, 2041 e 2235 - Bloco A, Vl Olímpia, SP - CEP 04543-011
					</div>										
				</td>
				
				<td 
					width="300"
					style="border:solid 1px #000000;"
					>
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Agência/Código Cedente
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">

					</div>															
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->agenciaCodCede; ?>
					</div>
				</td>
			</tr>
			
			<tr valign="top">
				<td
					style="border:solid 1px #000000;">
					
					<table 
						width="100%"
						cellpadding="0"
						cellspacing="0">
					
						<tr>
							<td
								style="border-right: solid 1px #000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Data Documento
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									<? echo $boleto->dtDocumento; ?>
								</div>								
							</td>
							
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Número do Documento
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									
								</div>								
								
							</td>
							
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Espécie Doc.
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									RC
								</div>								
							
							</td>
							
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Aceite
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									N
								</div>															
							</td>
							
							<td>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Data Processamento
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									<? echo $boleto->dtProcessamento; ?>
								</div>															
							</td>
						</tr>
					
					</table>
					
					
				</td>
				
				<td 
					width="300"
					style="border:solid 1px #000000;"
					>
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Nosso Número
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						<? echo $boleto->nossoNumero; ?>
					</div>
				</td>
			</tr>
			
			<tr valign="top">
				<td
					style="border:solid 1px #000000;">
					
					<table 
						width="100%"
						cellpadding="0"
						cellspacing="0">
					
						<tr>
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Uso do Banco
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									
								</div>								
							</td>
							
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Carteira
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									102
								</div>								
								
							</td>
							
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Espécie
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									R$
								</div>								
							
							</td>
							
							<td
								style="border-right: solid 1px #000000;">
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									Quantidade
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									
								</div>															
							</td>
							
							<td>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									(x) Valor
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
									R$ <? echo $boleto->valor; ?>
								</div>															
							</td>
						</tr>
					
					</table>
					
					
				</td>
				
				<td 
					width="300"
					style="border:solid 1px #000000;"
					>
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						(=) Valor do Documento
					</div>
					<div
						style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						R$ <? echo $boleto->valor; ?>
					</div>
				</td>
			</tr>			
			
			<tr>
				<td>
					<div>
						
						<div
							style="line-height:20px; font-family:verdana; font-weight:bold; font-size:14px; padding:1px; text-align:justify;">
							Instruções (texto de responsabilidade do cedente)
						</div>
						<div 
							style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
							Não receber após <? echo $boleto->dtVencimento; ?>. Não receber em cheque. Débito referente ao Banco Santander (Brasil) S.A.
						</div>
						<div style="margin:10px"></div>
						<div 
							style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
							Ciente: "Reconheço e pagarei a dívida acima nas condições aqui oferecidas. Fico ciente de que, caso não venha a
							cumprir com os valores e prazos fixados, tornar–se–ão sem efeito os descontos propostos, não se tratando de
							novação".
						</div>
						<div style="margin:10px"></div>
						<div
							style="line-height:20px; font-family:verdana; font-weight:bold; font-size:14px; padding:1px; text-align:justify;">
							BANCO AUTORIZADO A RECEBER ATÉ <? echo $boleto->dtVencimento; ?>
						</div>					
						<div style="margin:10px"></div>
						<div 
							style="line-height:20px; font-family:verdana; font-size:14px; padding:1px; text-align:justify;">
							Favor escolher a condição aceita e efetuar o Pgto. em qualquer agência bancária até o vencimento.
							Sr.(a) Cliente após o pagamento desse boleto procure a agência do Santander mais próxima com o seu comprovante
							de endereço atual para atualização cadastral.
							DUVIDAS LIGUE 11 (11) 3927-9630 / 0800 721 0145
							Boleto emitido por escritório conveniado do Banco Santander de acordo com a MI 79–04–0501
							Atenção: Para receber as demais parcelas, favor, dirigir–se a uma agência Santander para atualização de seu
							cadastro ou entre em contato no nosso 0800.						
						</div>					
					
					</div>
				</td>
				<td 
					width="300"
					style="border:solid 1px #000000;"
					valign="top"
					>
					<table
						width="100%"
						cellpadding="0"
						cellspacing="1"
						>
						
						<tr>
							<td
								style="border:solid 1px #000000;"
								>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									(-) Desconto
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">

								</div>							
							</td>							
						</tr>
							
						<tr>
							<td
								style="border:solid 1px #000000;"
								>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									(+) Mora/Multa
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">

								</div>							
							</td>							
						</tr>

						<tr>
							<td
								style="border:solid 1px #000000;"
								>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									(+) Outros Acrescimos
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">

								</div>															
							</td>							
						</tr>

						<tr>
							<td
								style="border:solid 1px #000000;"
								>
								<div
									style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
									>
									(=) Valor Cobrado
								</div>
								<div
									style="height:20px; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">

								</div>																							
							</td>							
						</tr>						
						
					</table>
				</td>
				
			</tr>
			
		</table>
	</td>
</tr>

<tr>
	<td style="border:solid 1px #000000;">
		<table style="borde:solid 1px #000000" width="100%">
			<tr>
				<td>
					<div
						style="height:20px; text-align:left; font-family:verdana; font-size:12px; font-weight:bold; padding:1px;">
						Pagador <? echo $boleto->nomeCliente; ?>
					</div>
					<div
						style="height:20px; text-align:left; font-family:verdana; font-size:12px; font-weight:bold; padding:1px;">
						<? echo $boleto->endereco; ?>
					</div>
					<div
						style="height:20px; text-align:left; font-family:verdana; font-size:12px; font-weight:bold; padding:1px;">
						Pagador/Avalista
					</div>
				</td>
				<td width="300">
					<div
						style="height:20px; text-align:right; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						CPF: <? echo $boleto->cpfCnpj; ?>
					</div>
					<div
						style="height:20px; text-align:center; font-family:verdana; font-size:14px; font-weight:bold; padding:1px;">
						
					</div>
					<div
						style="height:20px; text-align:right; font-family:verdana; font-size:12px; font-weight:bold; padding:1px;">
						Ficha de Compensação
					</div>
				</td>
			</tr>
		</table>

	</td>
</tr>

<tr>
	<td>
		<table style="borde:solid 1px #000000" width="100%">
			<tr>
				<td>
					<img id src="<? echo $CaminhoCodBarra; ?>">
				</td>
				<td width="300" align="right" valign="top">
					<div
						style="font-family:arial; font-size:10px; font-weight:bold; padding:1px;"
						>
						Autenticação Mecânica
					</div>
				</td>
			</tr>
		</table>
	</td>
</tr>

</table>