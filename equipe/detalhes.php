						<div id="conteudo-interno">
							<div id="bloco-titulo">	
								
								<p class="titulo">EQUIPE</p>			
								<p class="linha"></p>																											
							</div>
<?php
	$quebraUrl = explode("-", $url[3]);
	
	$sqlEquipe = "SELECT * FROM equipe WHERE statusEquipe = 'T' and codEquipe = '".$quebraUrl[0]."' LIMIT 0,1";
	$resultEquipe = $conn->query($sqlEquipe);
	$dadosEquipe = $resultEquipe->fetch_assoc();

	$sqlImagem = "SELECT * FROM equipeImagens WHERE codEquipe = ".$dadosEquipe['codEquipe']." ORDER BY capaEquipeImagem ASC, codEquipeImagem ASC LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();
?>
							<div id="conteudo-equipe-detalhes">
							<p class="botao-topo" ><a href="<?php echo $configUrl;?>equipe/">Voltar</a></p>
								<div id="mostra-detalhes">
									<div id="imagem-detalhes">
										<p class="imagem-equipe"><a rel="lightbox[roadtrip]" title="<?php echo $dadosEquipe['nomeEquipe'];?>" href="<?php echo $configUrlGer.'f/equipe/'.$dadosImagem['codEquipe'].'-'.$dadosImagem['codEquipeImagem'].'-W.webp';?>" style="width:100%; height:650px; display:block; background:transparent url('<?php echo $configUrlGer.'f/equipe/'.$dadosImagem['codEquipe'].'-'.$dadosImagem['codEquipeImagem'].'-W.webp';?>') center center no-repeat; background-size:cover, 100%;"></a></p>															
									</div>
									<div id="dados-detalhes">
										<p class="nome-equipe"><?php echo $dadosEquipe['nomeEquipe'];?></p>
										<p class="subNome-equipe"><?php echo $dadosEquipe['subNomeEquipe'];?></p>
										<div class="descricao-equipe"><?php echo $dadosEquipe['descricaoEquipe'];?></div>
									</div>
									<br class="clear"/>
								</div>
								<p class="botao-topo" ><a href="<?php echo $configUrl;?>equipe/">Voltar</a></p>
							</div>
						</div>
