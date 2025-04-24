<?php
	include('../../f/conf/config.php');
	include('../../f/conf/conexao.php');
	
	$codExpertise = $_POST['codExpertise'];
	$codOrdenacaoExpertise = $_POST['codOrdenacaoExpertise'];
		
	$sql =  "UPDATE expertise SET codOrdenacaoExpertise = '".$codOrdenacaoExpertise."' WHERE codExpertise = '".$codExpertise."'";
	$result = $conn->query($sql);
?>
