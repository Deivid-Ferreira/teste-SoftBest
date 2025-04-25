						<div id="conteudo-interno">
							
							<div id="bloco-titulo">	
								<p class="titulo">Novidades</p>
								<p id="linha"></p>
							</div>
<?php
	$quebraUrl = explode("-", $url[3]);
	
	$sqlBlog = "SELECT * FROM blog WHERE statusBlog = 'T' and codBlog = '".$quebraUrl[0]."' LIMIT 0,1";
	$resultBlog = $conn->query($sqlBlog);
	$dadosBlog = $resultBlog->fetch_assoc();

	$sqlImagem = "SELECT * FROM blogImagens WHERE codBlog = ".$dadosBlog['codBlog']." ORDER BY capaBlogImagem ASC, codBlogImagem ASC LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();
?>
							<div id="conteudo-blog-detalhes">
								<div id="mostra-detalhes">
								<p class="botao-topo"><a href="<?php echo $configUrl;?>novidades/">Voltar</a></p>
									<div id="imagem-detalhes">
										<p class="imagem-blog"><a rel="lightbox[roadtrip]" title="<?php echo $dadosBlog['nomeBlog'];?>" href="<?php echo $configUrlGer.'f/blog/'.$dadosImagem['codBlog'].'-'.$dadosImagem['codBlogImagem'].'-W.webp';?>"><img style="display:block;" src="<?php echo $configUrlGer.'f/blog/'.$dadosImagem['codBlog'].'-'.$dadosImagem['codBlogImagem'].'-W.webp';?>" width="100%"/></a></p>															
									</div>
									<div id="dados-detalhes">
										<p class="nome-blog"><?php echo $dadosBlog['nomeBlog'];?></p>
										<div class="descricao-blog"><?php echo $dadosBlog['descricaoBlog'];?></div>
										<p class="fonte-blog"><?php echo $dadosBlog['fonteBlog'];?></p>
									</div>
									<br class="clear"/>
								</div>
<?php
	$sqlConta1 = "SELECT * FROM blogImagens WHERE codBlog = '".$dadosBlog['codBlog']."' and codBlogImagem != ".$dadosImagem['codBlogImagem'];
	$resultConta1 = $conn->query($sqlConta1);
	$dadosConta1 = $resultConta1->fetch_assoc();
	$registros1 = mysqli_num_rows($resultConta1);
	if($registros1 > 0){
?>
								<div id="outras">
									<div id="bloco-titulo" style="padding-top:0px">	
										<p class="titulo blog" >Mais Imagens</p>
									</div>
<?php								
		$contO = 0;
		$sqlImagens = "SELECT * FROM blogImagens WHERE codBlog = '".$dadosBlog['codBlog']."' and codBlogImagem != '".$dadosImagem['codBlogImagem']."' ORDER BY capaBlogImagem ASC, codBlogImagem ASC";
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
									<p class="imagem-outras" style="<?php echo $margin;?>"><a rel="lightbox[roadtrip]" title="<?php echo $dadosBlog['nomeBlog'];?>" href="<?php echo $configUrlGer.'f/blog/'.$dadosImagens['codBlog'].'-'.$dadosImagens['codBlogImagem'].'-W.webp';?>" style="display:block; background:transparent url('<?php echo $configUrlGer.'f/blog/'.$dadosImagens['codBlog'].'-'.$dadosImagens['codBlogImagem'].'-W.webp';?>') center center no-repeat; background-size:cover, 100%;"></a></p>
<?php
		}
?>
									<br class="clear"/>
								</div>
<?php
	}
?>
								<p class="botao-bottom"><a href="<?php echo $configUrl;?>novidades/">Voltar</a></p>
							</div>
							
						</div>
