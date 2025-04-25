						<div id="conteudo-interno">
							<div id="bloco-titulo">
								<p class="titulo">Clientes</p>
								<p id="linha"></p>								
							</div>
							<div id="conteudo-clientes">
<?php
	$sqlCliente = "SELECT * FROM clientes WHERE statusCliente = 'T' ORDER BY codOrdenacaoCliente ASC";
	$resultCliente = $conn->query($sqlCliente);
	while($dadosCliente = $resultCliente->fetch_assoc()){
				
		$sqlImagem = "SELECT * FROM clientesImagens WHERE codCliente = ".$dadosCliente['codCliente']." ORDER BY codClienteImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();
		
		if($dadosImagem['codClienteImagem'] != ""){		
?>											
								<div id="bloco-clientes">
<?php
			if($dadosCliente['linkCliente'] != ""){
?>
									<div class="imagem-clientes"><a target="_blank" title="<?php echo $dadosParcero['nomeCliente'];?>" href="<?php echo $dadosCliente['linkCliente'];?>"><span style="width:270px; height:270px; display:table-cell; vertical-align:middle;"><img src="<?php echo $configUrlGer.'f/clientes/'.$dadosImagem['codCliente'].'-'.$dadosImagem['codClienteImagem'].'-W.webp';?>" style="max-width:100%; max-height:100%; display:table; margin:0 auto;"/></span></a></div>																	
<?php
			}else{
?>									
									<div class="imagem-clientes"><span style="width:270px; height:270px; display:table-cell; vertical-align:middle;"><img src="<?php echo $configUrlGer.'f/clientes/'.$dadosImagem['codCliente'].'-'.$dadosImagem['codClienteImagem'].'-W.webp';?>" style="max-width:100%; max-height:100%; display:table; margin:0 auto;"/></span></div>																	
<?php
			}
?>
								</div>
<?php
		}
	}
?>
							</div>	
						</div>
