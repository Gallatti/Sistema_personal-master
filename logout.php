<?php

	session_start(); 

	unset($_SESSION['nome_cli_cob']);
	unset($_SESSION['cpf_cnpj_personal']);
	unset($_SESSION['dados_cli_completo']);
	unset($_SESSION['codigo_sms_personalcob']);

	header('Location: index.php');


