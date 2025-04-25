						<div id="conteudo-interno">
							<div id="bloco-titulo">
								<p class="titulo">Soluções</p>
								<p id="linha"></p>																											
							</div>
							<div id="conteudo-solucoes">
								<div id="mostra-solucoes">
<?php
		$cont = 0;
		$cont2 = 0;
		$sqlSolucao = "SELECT * FROM solucoes WHERE statusSolucao = 'T' ORDER BY codOrdenacaoSolucao ASC";
		$resultSolucao = $conn->query($sqlSolucao);
		while($dadosSolucao = $resultSolucao->fetch_assoc()){	
			
			$sqlImagem = "SELECT * FROM solucoesImagens WHERE codSolucao = ".$dadosSolucao['codSolucao']." ORDER BY codSolucaoImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();
			$cont2++;
			$cont++;
			
			if($cont == 3){
				$cont = 0;
				$margin = "margin-right:0px;";
			}else{
				$margin = "";
			}
?>								
									<div title="<?php echo $dadosSolucao['nomeSolucao']; ?>" id="bloco-solucoes" style="<?php echo $margin; ?> cursor:pointer;">
										<a href="<?php echo $configUrl . 'solucoes/' . $dadosSolucao['codSolucao'] . '-' . $dadosSolucao['urlSolucao'] . '/'; ?>">
											<p class="nome-solucoes" style="background: url('<?php echo $configUrlGer . 'f/solucoes/' . $dadosImagem['codSolucao'] . '-' . $dadosImagem['codSolucaoImagem'] . '-O.' . $dadosImagem['extSolucaoImagem']; ?>') center top no-repeat; background-size:95px;"><?php echo $dadosSolucao['nomeSolucao']; ?></p>
											<div class="descricao-solucoes"><?php echo $dadosSolucao['descricaoSolucao']; ?></div>
											<div id="mais"><p class="mais">SAIBA MAIS</p></div>
										</a>
									</div>
<?php
		}
?>
								</div>
							</div>
<?php
	if($cont2 == 0){
?>							
							<p class="embreve" style="font-size: 16px; font-weight: bold; text-align: center; color: #132B51; padding-top: 124px;">Em Breve</p>
<?php
	}
?>
						</div>
