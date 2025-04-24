<?php
	include('../../f/conf/config.php');
	
	$codDepoimento = $_POST['codDepoimento'];
	$codOrdenacaoDepoimento = $_POST['codOrdenacaoDepoimento'];
	
	$sqlCons = "SELECT * FROM depoimentos WHERE codDepoimento = '".$codDepoimento."'";
	$resultCons = $conn->query($sqlCons);
	$dadosCons = $resultCons->fetch_assoc();
		
	$sql =  "UPDATE depoimentos SET codOrdenacaoDepoimento = '".$codOrdenacaoDepoimento."' WHERE codDepoimento = '".$codDepoimento."'";
	$result = $conn->query($sql);
?>
