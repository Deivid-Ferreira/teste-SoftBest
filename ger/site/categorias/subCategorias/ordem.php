<?php
	include('../../../f/conf/config.php');
	
	$codSubCategoria = $_POST['codSubCategoria'];
	$codOrdenacaoSubCategoria = $_POST['codOrdenacaoSubCategoria'];
	
	$sqlCons = "SELECT * FROM subCategorias WHERE codSubCategoria = '".$codSubCategoria."'";
	$resultCons = $conn->query($sqlCons);
	$dadosCons = $resultCons->fetch_assoc();
		
	$sql =  "UPDATE subCategorias SET codOrdenacaoSubCategoria = '".$codOrdenacaoSubCategoria."' WHERE codSubCategoria = '".$codSubCategoria."'";
	$result = $conn->query($sql);
?>
