<?php
	include('../../f/conf/config.php');
	include('../../f/conf/conexao.php');
	
	$codCategoria = $_POST['codCategoria'];
	$codOrdenacaoCategoria = $_POST['codOrdenacaoCategoria'];
	
	$sqlCons = "SELECT * FROM categorias WHERE codCategoria = '".$codCategoria."'";
	$resultCons = $conn->query($sqlCons);
	$dadosCons = $resultCons->fetch_assoc();
		
	$sql =  "UPDATE categorias SET codOrdenacaoCategoria = '".$codOrdenacaoCategoria."' WHERE codCategoria = '".$codCategoria."'";
	$result = $conn->query($sql);
?>
