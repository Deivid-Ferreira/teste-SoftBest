<?php
	if($url[2] == ""){
		$sqlHistorico = "SELECT * FROM quemSomos LIMIT 0,1";
		$resultHistorico = $conn->query($sqlHistorico);
		$dadosHistorico = $resultHistorico->fetch_assoc();
	
		$title = $nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoQuemSomos']);
	}else
	if($url[2] == "sobre"){
		$sqlHistorico = "SELECT * FROM quemSomos LIMIT 0,1";
		$resultHistorico = $conn->query($sqlHistorico);
		$dadosHistorico = $resultHistorico->fetch_assoc();
		
		$title = "Sobre | ".$nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoQuemSomos']);
	}else
	if($url[2] == "solucoes"){
		$title = "Solucoes | ".$nomeEmpresa;
		
		if($url[3] != ""){
			$quebraUrl = explode("-", $url[3]);
		
			$sqlSolucao = "SELECT nomeSolucao FROM solucoes WHERE codSolucao = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultSolucao = $conn->query($sqlSolucao);
			$dadosSolucao = $resultSolucao->fetch_assoc();

			$title = $dadosSolucao['nomeSolucao']." - Soluçoes | ".$nomeEmpresa;
			$description = strip_tags($dadosSolucao['descricaoSolucao']);
		}
	}else
	if($url[2] == "clientes"){
		$title = "Clientes | ".$nomeEmpresa;
	}else
	if($url[2] == "depoimentos"){
		$title = "Depoimentos | ".$nomeEmpresa;
	}else		
	if($url[2] == "novidades"){
		$title = "Novidades | ".$nomeEmpresa;
		
		if($url[3] != ""){
			$quebraUrl = explode("-", $url[3]);
		
			$sqlBlogs = "SELECT nomeBlog, descricaoBlog FROM blog WHERE codBlog = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultBlogs = $conn->query($sqlBlogs);
			$dadosBlogs = $resultBlogs->fetch_assoc();

			$title = $dadosBlogs['nomeBlog']." - Novidades | ".$nomeEmpresa;
			$description = strip_tags($dadosBlogs['descricaoBlog']);
		}
	}else																		
	if($url[2] == "politica-de-privacidade"){
		$title = "Política de Privacidade | ".$nomeEmpresa;
		$description = "";
	}else
	if($url[2] == "contato-whatsapp-enviado"){
		$title = "Contato WhatsApp Enviado | ".$nomeEmpresa;
		$description = "";
	}else{
		$title = "Página não encontrada | ".$nomeEmpresa;
		$description = "Utilize os menu acima para navegar pelo site";
	}
	
	$keywords = $keywordsConfig; 
?>

