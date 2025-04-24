<?php
	$configUrl = "http://192.168.1.200/priscila-marinho/";
	$configUrlSeg = "http://192.168.1.200/priscila-marinho_m/";
	$configUrlGer = "http://192.168.1.200/priscila-marinho/ger/";

	$configServer = "localhost";
	$configLogin = "root";
	$configSenha = "epitafio";
	$configBaseDados = "priscila-marinho";

	$conn = new mysqli($configServer, $configLogin, $configSenha, $configBaseDados);

	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}
	
	$nomeEmpresa = "Priscila Marinho - Consultora de Negócios Internacionais - SC";
	$nomeEmpresaMenor = "Priscila Marinho";
	
	$cookie = "PriscilaMarinhoSite";
	
	$aux = "";
	
	$politicaNome = "Priscila Marinho";
	$politicaNomeA = "a Priscila Marinho";

	$linguagem = "Portuguese";
	$pais = "Brazil";
	$estado = "Santa Catarina";
	$cidade = "Sombrio";

	$sqlInformacao = "SELECT * FROM informacoes WHERE codInformacao = 1";
	$resultInformacao = $conn->query($sqlInformacao);
	$dadosInformacao = $resultInformacao->fetch_assoc();
		
	$endereco = $dadosInformacao['enderecoInformacao'];
	$rota = $dadosInformacao['rotaInformacao'];
	$telefone = $dadosInformacao['telefoneInformacao'];
	$celular = $dadosInformacao['celularInformacao'];
	$email = $dadosInformacao['emailInformacao'];	
	$email2 = $dadosInformacao['email2Informacao'];	
	$facebook = $dadosInformacao['facebookInformacao'];
	$instagram = $dadosInformacao['instagramInformacao'];	
	$mapa = $dadosInformacao['mapaInformacao'];
	$tagsHead = $dadosInformacao['tagsHeadInformacao'];
	$tagsBody = $dadosInformacao['tagsBodyInformacao'];
	$tagsConversao = $dadosInformacao['tagsConversaoInformacao'];
	
	$keywordsConfig = "";

	$hostEmail = "email-ssl.com.br";
	$dominio = "https://baretaadvocacia.com.br";
	$dominioSem = "baretaadvocacia.com.br";

	$chaveSite = "6LcaVnUqAAAAAAMMX0ZBAdvvXgNllmRnjI_FoN26";
	$chaveSecreta = "6LcaVnUqAAAAACd2uoBc6vdQ5j5_OwQlGQfWipJx";
	
	$cor1 = "#9A9A9A";
	$cor2 = "#9A9A9A";
?>
	
