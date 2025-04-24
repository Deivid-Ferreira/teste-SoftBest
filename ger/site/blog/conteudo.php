<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "blog";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>Blog <strong>".$_SESSION['nome']."</strong> cadastrado com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
				}else	
				if($_SESSION['alteracao'] == "ok"){
					$erroConteudo = "<p class='erro'>Blog <strong>".$_SESSION['nome']."</strong> alterado com sucesso!</p>";
					$_SESSION['alteracao'] = "";
					$_SESSION['nome'] = "";
				}else	
				if($_SESSION['ativacao'] == "ok"){
					$erroConteudo = "<p class='erro'>Blog <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacao'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['exclusao'] == "ok"){
					$erroConteudo = "<p class='erro'>Blog <strong>".$_SESSION['nome']."</strong> excluído com sucesso!</p>";
					$_SESSION['exclusao'] = "";
					$_SESSION['nome'] = "";
				}			
?>

				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Novidades</p>
						<br class="clear" />
					</div>
					<div class="demoTarget">
						<div id="formulario-filtro">
							<script>
								function abreCadastrar(){
									var $rf = jQuery.noConflict();
									if(document.getElementById("cadastrar").style.display=="none"){
										document.getElementById("botaoFechar").style.display="block";
										$rf("#cadastrar").slideDown(250);
									}else{
										document.getElementById("botaoFechar").style.display="none";
										$rf("#cadastrar").slideUp(250);
									}
								}
							</script>
							<form name="filtro" action="<?php echo $configUrl;?>site/blog/" method="post" />
								<div class="botao-novo" style="margin-left:0px;"><a title="Novo Blog" onClick="abreCadastrar()"><div class="esquerda-novo"></div><div class="conteudo-novo">Nova Novidade</div><div class="direita-novo"></div></a></div>
								<div class="botao-novo" style="display:none; margin-left:0px;" id="botaoFechar"><a title="Fechar Cadastrar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
								<br class="clear" />
							</form>
						</div>
					</div>				
					<div id="cadastrar" style="display:none; margin-left:30px; margin-top:30px; margin-bottom:30px;">
<?php
				if(isset($_POST['cadastrar']) || isset($_POST['cadastrarFotos'])){
					
					include ('f/conf/criaUrl.php');
					$urlBlog = criaUrl($_POST['nome']);

					$descricao = str_replace("../../", $configUrlGer, $_POST['descricao']);
					
					if($_POST['dataP'] == ""){
						$dataP = date('Y-m-d');
					}else{
						$dataP = data($_POST['dataP']);
					}
					
					if($_POST['horaP'] == ""){
						$horaP = date('H:i:s');
					}else{
						$horaP = $_POST['horaP'];
					}
					
					$sql = "INSERT INTO blog VALUES(0, '".preparaNome($_POST['nome'])."', '".data($_POST['data'])."', '".str_replace("'", "&#39;", $descricao)."', '".$_POST['fonte']."', '".$dataP." ".$horaP."',  'T', '".$urlBlog."')";
					$result = $conn->query($sql);
					
					if($result == 1){
						if(isset($_POST['cadastrar'])){
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['cadastro'] = "ok";
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/blog/'>";
						}else{
							$sqlBlog = "SELECT codBlog FROM blog ORDER BY codBlog DESC LIMIT 0,1";
							$resultBlog = $conn->query($sqlBlog);
							$dadosBlog = $resultBlog->fetch_assoc();
							
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/blog/imagens/".$dadosBlog['codBlog']."/'>";
						}
					}else{
						$erroData = "<p class='erro'>Problemas ao cadastrar novidade!</p>";
					}
				
				}else{
					$_SESSION['nome'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
					$_SESSION['dataP'] = "";
					$_SESSION['horaP'] = "";
					$_SESSION['fonte'] = "";
				}
				
				if($_SESSION['data'] == ""){
					$_SESSION['data'] = data(date('Y-m-d'));
				}

				if($erroData != "" || $erro == "sim" || $erro == "ok"){
?>
						<div class="area-erro">
<?php
					echo $erroData;
					if($erro == "sim" || $erro == "ok"){
						include('f/conf/mostraErro.php');
					}
?>
						</div>
<?php
				}
?>				
					
						<p class="obrigatorio">Campos obrigatórios *</p>
						<br/>
						<form action="<?php echo $configUrlGer; ?>site/blog/" method="post">
							<p class="bloco-campo-float"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" style="width:720px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo-float"><label>Data: <span class="obrigatorio"> * </span></label>
							<input class="campo" id="data" name="data" required type="text" required style="width:140px;" value="<?php echo $_SESSION['data']; ?>" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data)"/></p>

							<br class="clear"/>

							<p class="bloco-campo" style="width:900px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><label>Fonte: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" name="fonte" style="width:888px;" value="<?php echo $_SESSION['fonte']; ?>" /></p>

							<div style="width:900px; padding-bottom:10px; margin-top:30px; margin-bottom:20px;">
								<p style="font-size:18px; border-bottom:1px solid #ccc; padding-bottom:5px; margin-bottom:20px;">Programar Blog</p>

								<p class="bloco-campo-float"><label>Data: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="dataP" name="dataP" style="width:100px;" value="<?php echo $_SESSION['dataP']; ?>" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);"/></p>

								<p class="bloco-campo-float"><label>Hora: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="horaP" name="horaP" style="width:100px;" value="<?php echo $_SESSION['horaP']; ?>" onKeyDown="Mascara(this,Hora);" onKeyPress="Mascara(this,Hora);" onKeyUp="Mascara(this,Hora);"/></p>
								
								<br class="clear"/>
							</div>
							
							<p class="bloco-campo" style="margin-right:0px;"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar Blog" value="Salvar" /><p class="direita-botao"></p></div></p>						
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrarFotos" title="Salvar Blog e Cadastrar Fotos" value="Salvar Blog e Cadastrar Fotos" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
						</form>
					</div>	
				</div>
				<div id="dados-conteudo">
					<div id="consultas">
					
					
<?php	
				if($erroConteudo != ""){
?>
						<div class="area-erro">
<?php
					echo $erroConteudo;	
?>
						</div>
<?php
				}
				
				$sqlConta = "SELECT * FROM blog WHERE codBlog != ''";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeBlog'] != ""){
?>
						<table class="tabela-menus" >
							<tr class="titulo-tabela" border="none">
								<th class="canto-esq">Nome</th>
								<th>Publicação</th>
								<th>Data</th>
								<th>Imagens</th>
								<th>Status</th>
								<th>Alterar</th>
								<th class="canto-dir">Excluir</th>
							</tr>					
<?php


					if($url[5] == 1 || $url[5] == ""){
						$pagina = 1;
						$sqlBlog = "SELECT * FROM blog ORDER BY statusBlog ASC, dataBlog DESC, codBlog DESC LIMIT 0,30";
					}else{
						$pagina = $url[5];
						$paginaFinal = $pagina * 30;
						$paginaInicial = $paginaFinal - 30;
						$sqlBlog = "SELECT * FROM blog ORDER BY statusBlog ASC, dataBlog DESC, codBlog DESC LIMIT ".$paginaInicial.",30";
					}		

					$resultBlog = $conn->query($sqlBlog);
					while($dadosBlog = $resultBlog->fetch_assoc()){
						$mostrando++;
						
						if($dadosBlog['statusBlog'] == "T"){
							$status = "status-ativo";
							$statusIcone = "ativado";
							$statusPergunta = "desativar";
						}else{
							$status = "status-desativado";
							$statusIcone = "desativado";
							$statusPergunta = "ativar";
						}	

						$sqlImagem = "SELECT * FROM blogImagens WHERE codBlog = ".$dadosBlog['codBlog']." ORDER BY capaBlogImagem ASC, codBlogImagem ASC LIMIT 0,1";
						$resultImagem = $conn->query($sqlImagem);
						$dadosImagem = $resultImagem->fetch_assoc();	
						
						$quebraDataPro = explode(" ", $dadosBlog['dataProBlog']);
						
						if($quebraDataPro[0] > date('Y-m-d')){
							$dataProgramada = "Postagem programada para<br/><strong>".data($quebraDataPro[0])."</strong> ás <strong>".$quebraDataPro[1]."</strong>";
						}else
						if($quebraDataPro[0] == date('Y-m-d') && $quebraDataPro[1] <= date('H:i:s')){
							$dataProgramada = "Postagem <strong>Publicada</strong>";
						}else				
						if($quebraDataPro[0] == date('Y-m-d') && $quebraDataPro[1] > date('H:i:s')){
							$dataProgramada = "Postagem programada para<br/><strong>Hoje</strong> ás <strong>".$quebraDataPro[1]."</strong>";
						}else				
						if($quebraDataPro[0] < date('Y-m-d')){
							$dataProgramada = "Postagem <strong>Publicada</strong>";
						}						
?>
								<tr class="tr">
									<td class="setenta"><a href='<?php echo $configUrlGer; ?>site/blog/alterar/<?php echo $dadosBlog['codBlog'] ?>/' title='Veja os detalhes do blog <?php echo $dadosBlog['nomeBlog'] ?>'><?php echo $dadosBlog['nomeBlog'];?></a></td>
									<td class="vinte" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>site/blog/alterar/<?php echo $dadosBlog['codBlog'] ?>/' title='Veja os detalhes do blog <?php echo $dadosBlog['nomeBlog'] ?>'><?php echo $dataProgramada;?></a></td>
									<td class="dez" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>site/blog/alterar/<?php echo $dadosBlog['codBlog'] ?>/' title='Veja os detalhes do blog <?php echo $dadosBlog['nomeBlog'] ?>'><?php echo data($dadosBlog['dataBlog']);?></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>site/blog/imagens/<?php echo $dadosBlog['codBlog'] ?>/' title='Deseja gerenciar imagens do blog <?php echo $dadosBlog['nomeBlog'] ?>?' ><img style="<?php echo $dadosImagem['codBlogImagem'] == "" ? 'display:none;' : 'padding-top:5px;';?>" src="<?php echo $configUrlGer.'f/blog/'.$dadosImagem['codBlog'].'-'.$dadosImagem['codBlogImagem'].'-W.webp';?>" height="50"/><img style="<?php echo $dadosImagem['codBlogImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/blog/ativacao/<?php echo $dadosBlog['codBlog'] ?>/' title='Deseja <?php echo $statusPergunta ?> o blog <?php echo $dadosBlog['nomeBlog'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/blog/alterar/<?php echo $dadosBlog['codBlog'] ?>/' title='Deseja alterar o blog <?php echo $dadosBlog['nomeBlog'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosBlog['codBlog'] ?>, "<?php echo htmlspecialchars($dadosBlog['nomeBlog']) ?>");' title='Deseja excluir o blog <?php echo $dadosBlog['nomeBlog'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
						$entra++;
					}
?>
								<script>
									function confirmaExclusao(cod, nome){
										if(confirm("Deseja excluir o novidade "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>site/blog/excluir/'+cod+'/';
										}
									}
								</script>
								 
							</table>	
<?php
				}
				
				$regPorPagina = 30;
				$area = "site/blog";
				include ('f/conf/paginacao.php');		
?>							
					</div>
				</div>
<?php
			}else{
?>	
				<div id="filtro">
					<div id="erro-permicao">	
<?php
				echo "<p><strong>Você não tem permissão para acessar essa área!</strong></p>";
				echo "<p>Para mais informações entre em contato com o administrador!</p>";
?>	
					</div>
				</div>
<?php
			}

		}else{
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."controle-acesso.php'>";
		}

	}else{
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."login.php'>";
	}
?>
