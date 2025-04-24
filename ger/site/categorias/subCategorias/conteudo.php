<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "categorias";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>SubCategoria <strong>".$_SESSION['nome']."</strong> cadastrada com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['alteracao'] == "ok"){
					$erroConteudo = "<p class='erro'>SubCategoria <strong>".$_SESSION['nome']."</strong> alterada com sucesso!</p>";
					$_SESSION['alteracao'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['ativacao'] == "ok"){
					$erroConteudo = "<p class='erro'>SubCategoria <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacao'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['descricao'] = "";
				}else
				if($_SESSION['exclusao'] == "ok"){
					$erroConteudo = "<p class='erro'>SubCategoria <strong>".$_SESSION['nome']."</strong> excluída com sucesso!</p>";
					$_SESSION['exclusao'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['descricao'] = "";
				}	

				$sqlCategoria = "SELECT codCategoria, nomeCategoria FROM categorias WHERE codCategoria = ".$url[6]."";
				$resultCategoria = $conn->query($sqlCategoria);
				$dadosCategoria = $resultCategoria->fetch_assoc();
?>

				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Área de Atuação</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosCategoria['nomeCategoria'];?></p>
						<p class="flexa"></p>
						<p class="nome-lista">Categorias</p>
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
						<form name="filtro" action="<?php echo $configUrl;?>site/categorias/subCategorias/<?php echo $url[6];?>/" method="post" />
							<div class="botao-novo" style="margin-left:0px; margin-right:20px;"><a title="Voltar" href="<?php echo $configUrl;?>site/categorias/"><div class="esquerda-novo"></div><div class="conteudo-novo"><< Voltar</div><div class="direita-novo"></div></a></div>
							<div class="botao-novo" style="margin-left:0px;"><a title="Nova SubCategoria" onClick="abreCadastrar()"><div class="esquerda-novo"></div><div class="conteudo-novo">Nova SubCategoria</div><div class="direita-novo"></div></a></div>
							<div class="botao-novo" style="display:none; margin-left:0px;" id="botaoFechar"><a title="Fechar Cadastrar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
							<br class="clear" />
						</form>
					</div>
					</div>
					
					<div id="cadastrar" style="display:none; margin-left:30px; margin-top:30px; margin-bottom:30px;">
<?php 
				if(isset($_POST['cadastrar'])){
					include ('f/conf/criaUrl.php');
					$urlSubCategoria = criaUrl($_POST['nome']);
					$sqlUltimoSubCategoria = "SELECT codOrdenacaoSubCategoria FROM subCategorias WHERE codCategoria = ".$url[6]." ORDER BY codOrdenacaoSubCategoria DESC LIMIT 0,1";
					$resultUltimoSubCategoria = $conn->query($sqlUltimoSubCategoria);
					$dadosUltimoSubCategoria = $resultUltimoSubCategoria->fetch_assoc();
					
					$novoOrdem = $dadosUltimoSubCategoria['codOrdenacaoSubCategoria'] + 1;	

					$sql = "INSERT INTO subCategorias VALUES(0, ".$url[6].", ".$novoOrdem.", '".preparaNome($_POST['nome'])."', 'T',   '".str_replace("'", "&#39;",	$_POST['descricao'] )."','".$urlSubCategoria."')";
					echo $sql;
					$result = $conn->query($sql);
					
					if($result == 1){
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['cadastro'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/categorias/subCategorias/".$url[6]."/'>";
					}else{
						$erroConteudo = "<p class='erro'>Problemas ao cadastrar a subcategoria!</p>";
					}
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
						<form action="<?php echo $configUrlGer; ?>site/categorias/subCategorias/<?php echo $url[6];?>/" method="post">
							<p class="bloco-campo"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" style="width:400px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo" style="width:855px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar SubCategoria" value="Salvar" /><p class="direita-botao"></p></div></p>						
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
				
				$sqlConta = "SELECT * FROM subCategorias WHERE codSubCategoria != '' and codCategoria = ".$url[6]."";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeSubCategoria'] != ""){
?>
						<table class="tabela-menus" >
							<tr class="titulo-tabela" border="none">
								<th class="canto-esq">Ordenar</th>
								<th>Nome</th>
								<th>Imagens</th>
								<th>Status</th>
								<th>Alterar</th>
								<th class="canto-dir">Excluir</th>
							</tr>					
<?php
					if($url[7] == 1 || $url[7] == ""){
						$pagina = 1;
						$sqlSubCategoria = "SELECT * FROM subCategorias WHERE codSubCategoria != '' and codCategoria = ".$url[6]." ORDER BY statusSubCategoria ASC, codOrdenacaoSubCategoria ASC LIMIT 0,30";
					}else{
						$pagina = $url[7];
						$paginaFinal = $pagina * 30;
						$paginaInicial = $paginaFinal - 30;
						$sqlSubCategoria = "SELECT * FROM subCategorias WHERE codSubCategoria != '' and codCategoria = ".$url[6]." ORDER BY statusSubCategoria ASC, codOrdenacaoSubCategoria ASC LIMIT ".$paginaInicial.",30";
					}		

					$resultSubCategoria = $conn->query($sqlSubCategoria);
					while($dadosSubCategoria = $resultSubCategoria->fetch_assoc()){
						$mostrando++;

						$sqlCategoriaImagem = " SELECT * FROM subCategoriasImagens WHERE codSubCategoria  ='".$dadosSubCategoria['codSubCategoria']."'";
						
						$resultCategoriaImagem = $conn->query($sqlCategoriaImagem);
						$dadosCategoriaImagem =$resultCategoriaImagem->fetch_assoc();
						
						if($dadosSubCategoria['statusSubCategoria'] == "T"){
							$status = "status-ativo";
							$statusIcone = "ativado";
							$statusPergunta = "desativar";
						}else{
							$status = "status-desativado";
							$statusIcone = "desativado";
							$statusPergunta = "ativar";
						}		
?>

							<tr class="tr">
								<td class="dez" style="text-align:center;"><input type="number" class="campo" style="width:30px; text-align:center; border:1px solid #0000FF; outline:none;" value="<?php echo $dadosSubCategoria['codOrdenacaoSubCategoria'];?>" onClick="alteraCor(<?php echo $dadosSubCategoria['codSubCategoria'];?>);" onBlur="alteraOrdem(<?php echo $dadosSubCategoria['codSubCategoria'];?>, this.value);" id="codOrdena<?php echo $dadosSubCategoria['codSubCategoria'];?>"/></td>
								<td class="oitenta"><a href='<?php echo $configUrlGer; ?>site/categorias/subCategorias/<?php echo $url[6];?>/alterar/<?php echo $dadosSubCategoria['codSubCategoria'] ?>/' title='Veja os detalhes da subCategoria <?php echo $dadosSubCategoria['nomeSubCategoria'] ?>'><?php echo $dadosSubCategoria['nomeSubCategoria'];?></a></td>
								<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/subCategorias/<?php echo $url[6];?>/imagens/<?php echo $dadosSubCategoria['codSubCategoria'] ?>/' title='Deseja cadastrar imagens para a subCategoria <?php echo $dadosSubCategoria['nomeSubCategoria'] ?>?' ><img style="<?php echo $dadosCategoriaImagem['codSubCategoriaImagem'] == "" ? 'display:none;' : 'padding-top:5px;';?>" src="<?php echo $configUrlGer.'f/subCategorias/'.	$dadosCategoriaImagem['codSubCategoria'].'-'.$dadosCategoriaImagem['codSubCategoriaImagem'].'-W.webp';?>" height="50"/><img style="<?php echo  $dadosCategoriaImagem['codSubCategoriaImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a></td>	
								<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/subCategorias/<?php echo $url[6];?>/ativacao/<?php echo $dadosSubCategoria['codSubCategoria'] ?>/' title='Deseja <?php echo $statusPergunta ?> a subCategoria <?php echo $dadosSubCategoria['nomeSubCategoria'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
								<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/subCategorias/<?php echo $url[6];?>/alterar/<?php echo $dadosSubCategoria['codSubCategoria'] ?>/' title='Deseja alterar a subCategoria <?php echo $dadosSubCategoria['nomeSubCategoria'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
								<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosSubCategoria['codSubCategoria'] ?>, "<?php echo htmlspecialchars($dadosSubCategoria['nomeSubCategoria']) ?>");' title='Deseja excluir a subCategoria <?php echo $dadosSubCategoria['nomeSubCategoria'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
							</tr>
<?php
					}
?>
							<script>
								function confirmaExclusao(cod, nome){
									if(confirm("Deseja excluir a subCategoria "+nome+"?")){
										window.location='<?php echo $configUrlGer; ?>site/categorias/subCategorias/<?php echo $url[6];?>/excluir/'+cod+'/';
									}
								}
							</script>
							<script type="text/javascript">
								function alteraCor(cod){
									var $po2 = jQuery.noConflict();
									$po2("#codOrdena"+cod).css("border", "1px solid #FF0000");
								}

								function alteraOrdem(cod, ordem){
									var $po = jQuery.noConflict();
									$po.post("<?php echo $configUrlGer;?>site/categorias/subCategorias/ordem.php", {codSubCategoria: cod, codOrdenacaoSubCategoria: ordem}, function(data){		
										$po("#codOrdena"+cod).css("border", "1px solid #0000FF");
									});											
								}
							</script>								
						</table>	
<?php
				}
				
				$regPorPagina = 30;
				$area = "site/categorias/subCategorias/".$url[6];
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
