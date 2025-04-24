<?php
	include('../../f/conf/config.php');
	include('../../f/conf/conexao.php');
	
	$codCliente = $_POST['codCliente'];
	$codOrdenacaoCliente = $_POST['codOrdenacaoCliente'];
	
	$sqlCons = "SELECT * FROM clientes WHERE codCliente = '".$codCliente."'";
	$resultCons = $conn->query($sqlCons);
	$dadosCons = $resultCons->fetch_assoc();
		
	$sql =  "UPDATE clientes SET codOrdenacaoCliente = '".$codOrdenacaoCliente."' WHERE codCliente = '".$codCliente."'";
	$result = $conn->query($sql);
?>
