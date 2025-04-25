<div id="conteudo-interno">
							
							<div id="bloco-titulo">	
								<p class="titulo">Soluções</p>
								<div id="linha"></div>
							</div>
<?php
	$quebraUrl = explode("-", $url[3]);
	
	$sqlSolucao = "SELECT * FROM solucoes WHERE statusSolucao = 'T' and codSolucao = '".$quebraUrl[0]."' LIMIT 0,1";
	$resultSolucao = $conn->query($sqlSolucao);
	$dadosSolucao = $resultSolucao->fetch_assoc();

	$sqlImagem = "SELECT * FROM solucoesImagens WHERE codSolucao = ".$dadosSolucao['codSolucao']." ORDER BY codSolucaoImagem ASC LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();
?>
							<div id="conteudo-solucoes-detalhes">
								<div id="mostra-detalhes">
								<p class="botao-topo"><a href="<?php echo $configUrl;?>solucoes/">Voltar</a></p>
									<div id="imagem-detalhes">
										<p class="imagem-solucoes"><a rel="lightbox[roadtrip]" title="<?php echo $dadosSolucao['nomeSolucao'];?>" href="<?php echo $configUrlGer.'f/solucoes/'.$dadosImagem['codSolucao'].'-'.$dadosImagem['codSolucaoImagem'].'-O.'.$dadosImagem['extSolucaoImagem'];?>"><img style="display: block; border-top: 2px solid #546C67; border-right: 2px solid #546C67; padding-right: 10px; border-top-right-radius: 15px; padding-top: 10px;" src="<?php echo $configUrlGer.'f/solucoes/'.$dadosImagem['codSolucao'].'-'.$dadosImagem['codSolucaoImagem'].'-O.'.$dadosImagem['extSolucaoImagem'];?>" width="150px"/></a></p>															
									</div>
									<div id="dados-detalhes">
										<p class="nome-solucoes"><?php echo $dadosSolucao['nomeSolucao'];?></p>
										<div class="descricao-solucoes"><?php echo $dadosSolucao['descricaoSolucao'];?></div>
										<p class="fonte-solucoes"><?php echo $dadosSolucao['fonteSolucao'];?></p>
									</div>
									<br class="clear"/>
								</div>
<?php
	$sqlConta1 = "SELECT * FROM solucoesImagens WHERE codSolucao = '".$dadosSolucao['codSolucao']."' and codSolucaoImagem != ".$dadosImagem['codSolucaoImagem'];
	$resultConta1 = $conn->query($sqlConta1);
	$dadosConta1 = $resultConta1->fetch_assoc();
	$registros1 = mysqli_num_rows($resultConta1);
	if($registros1 > 0){
?>
								<div id="outras">
									<div id="bloco-titulo" style="padding-top:0px">	
										<p class="titulo solucoes" >Mais Imagens</p>
									</div>
<?php								
		$contO = 0;
		$sqlImagens = "SELECT * FROM solucoesImagens WHERE codSolucao = '".$dadosSolucao['codSolucao']."' and codSolucaoImagem != '".$dadosImagem['codSolucaoImagem']."' ORDER BY  codSolucaoImagem ASC";
		$resultImagens = $conn->query($sqlImagens);
		while($dadosImagens = $resultImagens->fetch_assoc()){				

			$contO++;

			if($contO == 4){
				$contO = 0; 
				$margin = "margin-right:0px;";
			}else{
				$margin = "";
			}
?>		
									<p class="imagem-outras" style="<?php echo $margin;?>"><a rel="lightbox[roadtrip]" title="<?php echo $dadosSolucao['nomeSolucao'];?>" href="<?php echo $configUrlGer.'f/solucoes/'.$dadosImagens['codSolucao'].'-'.$dadosImagens['codSolucaoImagem'].'-W.webp';?>" style="display:block; background:transparent url('<?php echo $configUrlGer.'f/solucoes/'.$dadosImagens['codSolucao'].'-'.$dadosImagens['codSolucaoImagem'].'-W.webp';?>') center center no-repeat; background-size:cover, 100%;"></a></p>
<?php
		}
?>
									<br class="clear"/>
								</div>
<?php
	}
?>
								<p class="botao-bottom"><a href="<?php echo $configUrl;?>solucoes/">Voltar</a></p>
							</div>
							
						</div>
