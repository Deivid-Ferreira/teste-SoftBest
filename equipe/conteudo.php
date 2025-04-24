
						<div id="conteudo-interno">
							<div id="bloco-titulo">	
								<p class="titulo">EQUIPE</p>				
							</div>
							<div id="conteudo-equipe">
								<div id="mostra-equipe">
<?php
	$cont = 0;
	$cont2 = 0;
	$sqlEquipe = "SELECT DISTINCT N.* FROM equipe N inner join equipeImagens NI on N.codEquipe = NI.codEquipe WHERE statusEquipe = 'T' and N.codEquipe != '0' ORDER BY N.codOrdenacaoEquipe ASC";
	$resultEquipe = $conn->query($sqlEquipe);
	while($dadosEquipe = $resultEquipe->fetch_assoc()){
		
		$cont++;		
		$cont2++;		
		$sqlImagem = "SELECT * FROM equipeImagens WHERE codEquipe = ".$dadosEquipe['codEquipe']." ORDER BY capaEquipeImagem ASC, codEquipeImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();	
		
		if($cont == 4){
			$cont = 0;
			$margin = "margin-right:0px;";
		}else{
			$margin = "";
		}	
?>
									<div id="bloco-equipe" style="<?php echo $margin;?>">
										<a title="<?php echo $dadosEquipe['nomeEquipe'];?>" href="<?php echo $configUrl.'equipe/'.$dadosEquipe['codEquipe'].'-'.$dadosEquipe['urlEquipe'].'/';?>">
											<div class="imagem-equipe" style="display:block; background:transparent url('<?php echo $configUrlGer.'f/equipe/'.$dadosImagem['codEquipe'].'-'.$dadosImagem['codEquipeImagem'].'-W.webp';?>') center top no-repeat; background-size:cover, 100%; border-radius:15px"></div>
											<p class="nome-equipe"><span><?php echo $dadosEquipe['nomeEquipe'];?></span></p>
											<p class="oab" style="<?php if( $dadosEquipe['subNomeEquipe'] == "" ){ ?> display:none; <?php }?>"><?php echo $dadosEquipe['subNomeEquipe'];?></p> 
											<p class="saiba-mais">Conheça</p>
										</a>
									</div>

<?php			
	}
?>		
									<br class="clear"/>
								</div>
							</div>
<?php
	if($cont2 == 0){
?>							
							<p class="embreve" style="font-size: 16px; font-weight: bold; text-align: center; color: #132B51; padding-top: 149px;">Em Breve</p>
<?php
	}
?>
						</div>
