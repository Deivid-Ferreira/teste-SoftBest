<?php
	$configServer = "localhost";
	$configLogin = "root";
	$configSenha = "epitafio";
	$configBaseDados = "priscila-marinho";	
	
	$conn = new mysqli($configServer, $configLogin, $configSenha, $configBaseDados);

	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}

	$configUrl = "http://192.168.1.200/priscila-marinho/ger/";
	$configUrlGer = "http://192.168.1.200/priscila-marinho/ger/";
	$configUrlSite = "http://192.168.1.200/priscila-marinho/";

	$cookie = "PriscilaMarilnhoSite";
	$configLimite = 10;

	$aux = "";
	
	$urlUpload = "/priscila-marinho/ger";

	$nomeEmpresa = "Ger | Priscila Marinho [Gerenciador de Conteúdo]";
	$nomeEmpresaMenor = "Pricila Marinho";
	$hostEmail = "email-ssl.com.br";
	
	$cor1 = "#718b8f";
	$cor2 = "#718b8f";
	$cor3 = "#000";
?>
	
