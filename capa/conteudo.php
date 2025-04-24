						<div id="repete-conteudo">
<?php
	include('banner-capa.php');
?>
						<div id="repete-solucoes">
							<div id="conteudo-solucoes">
								<div id="bloco-titulo">
									<p class="titulo">Soluções</p>
									<div id="linha"></div>
								</div>
								<div id="mostra-solucoes" class="wow animate__animated animate__fadeInRight">
<?php
	$cont = 0;

	$sqlCategoria = "SELECT * FROM solucoes WHERE statusSolucao = 'T' ORDER BY codOrdenacaoSolucao ASC LIMIT 0,8";
	$resultCategoria = $conn->query($sqlCategoria);
	while ($dadosCategoria = $resultCategoria->fetch_assoc()) {

		$sqlImagem = "SELECT * FROM solucoesImagens WHERE codSolucao = " . $dadosCategoria['codSolucao'] . " ORDER BY codSolucaoImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		$cont++;

		if ($cont == 3) {
			$cont = 0;
			$margin = "margin-right:0px; ";
		} else {
			$margin = "";
		}
?>
											<div title="<?php echo $dadosCategoria['nomeSolucao']; ?>" id="bloco-solucoes" style="<?php echo $margin; ?> cursor:pointer;">
												<a href="<?php echo $configUrl . 'solucoes/' . $dadosCategoria['codSolucao'] . '-' . $dadosCategoria['urlSolucao'] . '/'; ?>">
													<p class="nome-solucoes" style="background: url('<?php echo $configUrlGer . 'f/solucoes/' . $dadosImagem['codSolucao'] . '-' . $dadosImagem['codSolucaoImagem'] . '-O.' . $dadosImagem['extSolucaoImagem']; ?>') center top no-repeat; background-size:95px;"><?php echo $dadosCategoria['nomeSolucao']; ?></p>
													<div class="descricao-solucoes"><?php echo $dadosCategoria['descricaoSolucao']; ?></div>
													<div id="mais"><p class="mais">SAIBA MAIS</p></div>
												</a>
											</div>
<?php
		}
?>
									</div>
								</div>
							</div>
							<div id="repete-porque" class="wow animate__animated animate__fadeIn">
								<div id="conteudo-porque">
									<div id="bloco-titulo">
										<p class="titulo">Por que contratar</p>
										<div id="linha"></div>
									</div>	
									<div id="mostra-porque">
<?php 
		$sqlPorque = "SELECT * FROM porque WHERE statusPorque = 'T' ORDER BY codOrdenacaoPorque ASC LIMIT 0,4";
		$resultPorque = $conn->query($sqlPorque);
		while($dadosPorque =  $resultPorque->fetch_assoc()){

		$sqlImagem = "SELECT * FROM porqueImagens WHERE codPorque = " . $dadosPorque['codPorque'] . " ORDER BY codPorqueImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();
?>
										<div id="bloco-porque">
											<p  class = "nome" style="background: url('<?php echo $configUrlGer . 'f/porque/' . $dadosImagem['codPorque'] . '-' . $dadosImagem['codPorqueImagem'] . '-O.' . $dadosImagem['extPorqueImagem']; ?>') 15px center no-repeat; background-size:100px;" class="nome"><?php echo $dadosPorque['nomePorque']; ?></p>
										</div>
<?php
		}
?>
									</div>
								</div>
							</div>
							<div id="repete-nossa-histotria" class="wow animate__animated animate__fadeInRight">
<?php
	$sqlQuemSomos = "SELECT * FROM quemSomos WHERE statusQuemSomos = 'T' AND codQuemSomos = 1 ";
	$resultQuemSomos = $conn->query($sqlQuemSomos);
	while ($dadosQuemSomos = $resultQuemSomos->fetch_assoc()) {

		$sqlImagemQuemSomos = "SELECT * FROM quemSomosImagens WHERE codQuemSomos = '" . $dadosQuemSomos['codQuemSomos'] . "' AND capaQuemSomosImagem = 'T'";
		$resultImagemQuemSomos = $conn->query($sqlImagemQuemSomos);
		$dadosImagemQuemSomos = $resultImagemQuemSomos->fetch_assoc();
		if ($dadosImagemQuemSomos['extQuemSomosImagem'] != "") {
?>
										<div id="bloco-nossa-historia">
											<a title="<?php echo $nomeEmpresa ?>" href="<?php echo $configUrl; ?>sobre/">
												<div id="conteudo-nossa-historia">
													<div id="imagem">
														<div class="img-nossa-historia" rel="lightbox[roadtrip]" style=" background: url('<?php echo $configUrlGer . 'f/quemSomos/' . $dadosImagemQuemSomos['codQuemSomos'] . '-' . $dadosImagemQuemSomos['codQuemSomosImagem'] . '-O.' . $dadosImagemQuemSomos['extQuemSomosImagem']; ?>') center center no-repeat; background-size: 100%, cover"></div>
													</div>
													<div id="descricao-equipe">
														<div id="bloco-titulo">
															<p class="titulo">Sobre nós</p>
															<div id="linha"></div>
														</div>
														<p class="descricao"> <?php echo nl2br($dadosQuemSomos['descricaoCQuemSomos']); ?> </p>
													</div>
												</div>
											</a>
										</div>
<?php
		}
	}
?>
									<img src="<?php echo $configUrl.'f/i/quebrado/caixa-2.png'; ?>"alt="">
								</div>

								<div id="repete-equipe" >
									<div id="conteudo-equipe" class="wow animate__animated animate__fadeInLeft">
										<div id="bloco-titulo">
											<p class="titulo">Nossa equipe</p>
											<div id="linha"></div>
										</div>
										<div id="mostra-equipe">
<?php 
	$sqlEquipe = "SELECT * FROM equipe WHERE statusEquipe = 'T' ORDER BY codOrdenacaoEquipe ASC LIMIT 0,2";
	$resultEquipe = $conn->query($sqlEquipe);
	while($dadosEquipe = $resultEquipe->fetch_assoc()){

	$sqlImagem = "SELECT * FROM equipeImagens WHERE codEquipe = " . $dadosEquipe['codEquipe'] . " and capaEquipeImagem = 'T' ORDER BY codEquipeImagem ASC LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();

	$celularConsultora = str_replace("(", "", $dadosEquipe['celularEquipe']);
	$celularConsultora = str_replace(")", "", $celularConsultora);
	$celularConsultora = str_replace(" ", "", $celularConsultora);
	$celularConsultora = str_replace("-", "", $celularConsultora);

?>
											<div title="<?php echo $dadosEquipe['nomeEquipe'].' - '.$dadosEquipe['subNomeEquipe']; ?>" id="bloco-equipe" onclick="abrirAcesso(<?php echo $celularConsultora ?>);">
												<div id="mostra-imagem">
													<div id="imagem" style="background: url('<?php echo $configUrlGer . 'f/equipe/' . $dadosImagem['codEquipe'] . '-' . $dadosImagem['codEquipeImagem'] . '-O.' . $dadosImagem['extEquipeImagem']; ?>') center center no-repeat; background-size: cover;"></div>
												</div>
												<div id="conteudo">
													<p class="nome"><?php echo $dadosEquipe['nomeEquipe']; ?></p>
													<p class="funcao"><?php echo $dadosEquipe['subNomeEquipe']; ?></p>
													<div id="wtz">
														<p class="botao">Entre em contato</p>
													</div>
												</div>
											</div>
<?php 
	}
?>
										</div>
									</div>
								</div>
<?php
	$sqlDepoimento = "SELECT count(codDepoimento) total FROM depoimentos WHERE statusDepoimento = 'T'";
	$resultDepoimento = $conn->query($sqlDepoimento);
	$dadosDepoimento = $resultDepoimento->fetch_assoc();

	if ($dadosDepoimento['total'] >= 1 && $url[2] != "depoimentos") {
?>
								<div id="repete-depoimentos">
									<div id="conteudo-depoimentos">
										<div id="bloco-titulo">
											<p class="titulo">Depoimentos</p>
											<div id="linha"></div>
										</div>
										<div id="mostra-depoimentos" class="wow animate__animated animate__fadeInRight">
											<div class="owl-carrossel">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel depoimentosCarrossel owl-loaded owl-drag">
<?php
	$cont2 = 0;
	$sqlDepoimento = "SELECT * FROM depoimentos WHERE statusDepoimento = 'T' ORDER BY codOrdenacaoDepoimento ASC";
	$resultDepoimento = $conn->query($sqlDepoimento);
	while ($dadosDepoimento = $resultDepoimento->fetch_assoc()) {

		$cont2++;

		$sqlImagem = "SELECT * FROM depoimentosImagens WHERE codDepoimento = " . $dadosDepoimento['codDepoimento'] . " ORDER BY codDepoimentoImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();
?>
															<li class="carrosel-depoimento">
																<a title="<?php echo $dadosDepoimento['nomeDepoimento']; ?>" href="<?php echo $configUrl; ?>depoimentos/">
																	<div class="bloco-imagem">
																		<div class="moldura">
																			<p class="imagem-blur" style="background:transparent url('<?php echo $configUrlGer . 'f/depoimentos/' . $dadosImagem['codDepoimento'] . '-' . $dadosImagem['codDepoimentoImagem'] . '-O.' . $dadosImagem['extDepoimentoImagem']; ?>') center center no-repeat; background-size:100%;"></p>
<?php 
	if($dadosImagem['codDepoimento'] != "" &&  $dadosImagem['codDepoimento'] == $dadosImagem['codDepoimento'] ){
?>
																			<p class="imagem-depoimentos" style="background:transparent url('<?php echo $configUrlGer . 'f/depoimentos/' . $dadosImagem['codDepoimento'] . '-' . $dadosImagem['codDepoimentoImagem'] . '-O.' . $dadosImagem['extDepoimentoImagem']; ?>') center center no-repeat; background-size:auto 100%; "></p>
<?php 
	}else{		
?> 		
																			<p class="imagem-depoimentos" style="background:transparent url('<?php echo $configUrl . 'f/i/quebrado/sem-foto.png'; ?>') center center no-repeat; background-size:auto 100%; "></p>
<?php
	}
?>
																		</div>
																	</div>
																	<div id="fundo-depoimento">
																		<div id="nome-cidade">
																			<p class="nome-depoimento"><?php echo $dadosDepoimento['nomeDepoimento']; ?> - </p>
																			<p class="cidade-depoimento"> <?php echo $dadosDepoimento['cidadeDepoimento']; ?></p>
																		</div>
																		<p class="estrelas-depoimento"><img style="display:block; margin-left: 129px; margin-top: 5px;" src="<?php echo $configUrl; ?>f/i/quebrado/estrelas.svg" width="85px" /></p>
																		<div id="alinha-depoimento">
																			<div class="texto-depoimento"><?php echo strip_tags($dadosDepoimento['descricaoDepoimento']); ?></div>
																		</div>
																	</div>
																	<br class="clear" />
																</a>
															</li>
<?php
	}
?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<script>
											var $rfgs = jQuery.noConflict();
											$rfgs(document).ready(function() {
												var owlProdutos = $rfgs('.depoimentosCarrossel');
												owlProdutos.owlCarousel({
													autoplay: false,
													autoplayTimeout: 20000,
													smartSpeed: 1000,
													fluidSpeed: 10000,
													items: 2,
													loop: true,
													autoWidth: false,
													margin: 100,
													nav: true,
													dots: true,
													dotsEach: true
												});
											});
										</script>
									</div>
									<img id="caixa" src="<?php echo $configUrl.'f/i/quebrado/caixa.png'; ?>"alt="">
								</div>
<?php
	}
?>
								<div id="repete-clientes">
									<div id="conteudo-clientes">
										<div id="bloco-titulo">
											<p class="titulo">Clientes</p>
											<div id="linha"></div>							
										</div>
										<div id="mostra-clientes">
											<div class="owl-carrossel">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel clientesCarrossel owl-loaded owl-drag">
<?php
		$sqlCliente = "SELECT L.* FROM clientes L inner join clientesImagens LI on L.codCliente = LI.codCliente WHERE L.statusCliente = 'T' ORDER BY L.codOrdenacaoCliente ASC, L.codCliente DESC";
		$resultCliente = $conn->query($sqlCliente);
		while($dadosCliente = $resultCliente->fetch_assoc()){
		
			$sqlImagem = "SELECT * FROM clientesImagens WHERE codCliente = ".$dadosCliente['codCliente']." ORDER BY codClienteImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();
?>
															<li class="imagem-cliente wow animate__animated animate__fadeIn" style="padding-top:20px;">
<?php
			if($dadosCliente['linkCliente'] != ""){
?>	
																<a target="_blank" title="<?php echo $dadosCliente['nomeCliente'];?>" href="<?php echo $dadosCliente['linkCliente'];?>" >
																	<p style="position:relative; width:220px; height:220px; display:table-cell; vertical-align:middle;"><img src="<?php echo $configUrlGer.'f/clientes/'.$dadosImagem['codCliente'].'-'.$dadosImagem['codClienteImagem'].'-W.webp';?>" style="max-width:100%; max-height:100%; display:table; margin:0 auto;"/></p>
																</a>
<?php
			}else{
?>						
																<a>
																	<p style="position:relative; width:220px; height:220px; display:table-cell; vertical-align:middle;"><img src="<?php echo $configUrlGer.'f/clientes/'.$dadosImagem['codCliente'].'-'.$dadosImagem['codClienteImagem'].'-W.webp';?>" style="max-width:100%; max-height:100%; display:table; margin:0 auto;"/></p>
																</a>
<?php
			}
?>
															</li>
<?php	
		}
?>
														</div>
													</div>
												</div>
											</div>
											<script>
												var $rfg = jQuery.noConflict();
												var owl = $rfg('.clientesCarrossel');
													owl.owlCarousel({
														autoplay:true,
														speed: 1500,
														autoplayTimeout: 20000,
														smartSpeed: 1000,										
														fluidSpeed: 10000,										
														items:5,
														loop:true,
														autoWidth:true,
														margin:5,
														nav: true,
														dots: false									
													});
											</script>
										</div>
									</div>
								</div>
								


<?php
	$sqlBlog = "SELECT count(DISTINCT N.codBlog) total FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE N.statusBlog = 'T' and N.dataProBlog <= '" . date('Y-m-d') . " " . date('H:i:s') . "'";
	$resultBlog = $conn->query($sqlBlog);
	$dadosBlog = $resultBlog->fetch_assoc();

	if ($dadosBlog['total'] >= 1) {
?>
								<div id="repete-blog">
									<div id="conteudo-blog">
										<div id="bloco-titulo">
											<p class="titulo">Novidades</p>
											<div id="linha"></div>
										</div>
										<div id="mostra-blog" class="wow animate__animated animate__fadeInLeft">
											<div class="owl-carrossel">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel blogCarrossel owl-loaded owl-drag">
<?php
		$cont = 0;

		$sqlBlog = "SELECT DISTINCT N.* FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE N.statusBlog = 'T' and N.dataProBlog <= '" . date('Y-m-d') . " " . date('H:i:s') . "' ORDER BY N.dataBlog DESC, N.codBlog DESC";
		$resultBlog = $conn->query($sqlBlog);
		while ($dadosBlog = $resultBlog->fetch_assoc()) {

			$sqlImagem = "SELECT * FROM blogImagens WHERE codBlog = " . $dadosBlog['codBlog'] . " ORDER BY capaBlogImagem ASC, codBlogImagem ASC LIMIT 0,1";
			$resultImagem  = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

?>
																<div id="bloco-blog">	
																	<a title="Ver mais - <?php echo  $dadosBlog['nomeBlog']; ?>" href="<?php echo $configUrl.'novidades/'.$dadosBlog['codBlog'].'-'.$dadosBlog['urlBlog'].'/';?>">
																		<div id="bloco-imagem" style=" background:transparent url('<?php echo $configUrlGer . 'f/blog/' . $dadosImagem['codBlog'] . '-' . $dadosImagem['codBlogImagem'] . '-O.'.$dadosImagem['extBlogImagem']; ?>') center top no-repeat; background-size:cover, 100%;">
																			<div id="sombra">
																				<p id="titulo"><?php echo $dadosBlog['nomeBlog']; ?></p>
																				<div id="descricao"><?php echo $dadosBlog['descricaoBlog']; ?></div>
																				<p id="ver">VER MAIS</p>
																			</div>
																		</div>
																	</a>
																</div>
<?php
		}
?>
														</div>
													</div>
												</div>
											</div>
											<script>
												var $rfgs = jQuery.noConflict();
												var owl = $rfgs('.blogCarrossel');
												owl.owlCarousel({
													autoplay: true,
													autoplayTimeout: 20000,
													smartSpeed: 1000,
													fluidSpeed: 10000,
													items: 3,
													loop: true,
													autoWidth: false,
													margin: 20,
													nav: true,
													dots: true
												});
											</script>
										</div>
									</div>
								</div>
<?php
	}
?>
						</div>