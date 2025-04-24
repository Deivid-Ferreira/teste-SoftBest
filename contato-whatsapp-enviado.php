<?php
	include('f/conf/config.php');
	
	if(isset($_GET['numero'])){
		$numero = $_GET['numero'];
	}
	
	if(isset($_GET['msg'])){
		$msg = "&text=".$_GET['msg'];
	}
	
	if(isset($_GET['retornar'])){
		$retornar = $_GET['retornar'];
	}

	$tagsConversao = str_replace("&#39;", "'", $tagsConversao);
	echo html_entity_decode($tagsConversao);
	
	if($quebraUrl2[0] != "?gtm_debug"){
?>
				<script type="text/javascript">
					location.href = "https://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $numero;?><?php echo $msg;?>";				
				</script>	
<?php
	}
?>				
