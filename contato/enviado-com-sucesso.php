						<div id="conteudo-interno">
							<div id="conteudo-contato">
<?php
	// if($_SESSION['nome'] != "" || $quebraUrl4[0] == "?gtm_debug"){

		$tagsConversao = str_replace("&#39;", "'", $tagsConversao);
		echo html_entity_decode($tagsConversao);		
?>
								<div id="conteudo-enviado">
									<p class="icone-enviado"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/email.png" width="150"/></p>
									<p class="titulo">Seu contato foi enviado com sucesso!</p>
									<p class="texto">Obrigado <strong><?php echo $_SESSION['nome'];?></strong> por nos enviar uma mensagem.<br/>Em breve estaremos entrando em contato.</p>
									<br/>
									<br/>
									
								</div>
<?php
		$_SESSION['nome'] = "";
	// }else{
	// 	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."contato/'>";		
	// }	
?>
							</div>
							<p class="botao-bottom" style="display: flex;justify-content:center"><a href="<?php echo $configUrl;?>contato/">Voltar</a></p>
						</div>
