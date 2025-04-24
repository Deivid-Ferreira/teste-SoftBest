<?php
	include('../../f/conf/config.php');
	include('../../f/conf/conexao.php');
	
	$codSolucao = $_POST['codSolucao'];
	$codOrdenacaoSolucao = $_POST['codOrdenacaoSolucao'];
		
	$sql =  "UPDATE solucoes SET codOrdenacaoSolucao = '".$codOrdenacaoSolucao."' WHERE codSolucao = '".$codSolucao."'";
	$result = $conn->query($sql);
?>
