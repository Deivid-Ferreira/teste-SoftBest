<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "categorias";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>Categoria <strong>".$_SESSION['nome']."</strong> cadastrada com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['alteracao'] == "ok"){
					$erroConteudo = "<p class='erro'>Categoria <strong>".$_SESSION['nome']."</strong> alterada com sucesso!</p>";
					$_SESSION['alteracao'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['ativacao'] == "ok"){
					$erroConteudo = "<p class='erro'>Categoria <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacao'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['descricao'] = "";
				}else
				if($_SESSION['exclusao'] == "ok"){
					$erroConteudo = "<p class='erro'>Categoria <strong>".$_SESSION['nome']."</strong> excluída com sucesso!</p>";
					$_SESSION['exclusao'] = "";
					$_SESSION['nome'] = ""; 
					$_SESSION['descricao'] = "";
				}	
?>

				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Área de Atuação</p>
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
					 
						<form name="filtro" action="<?php echo $configUrl;?>site/categorias/" method="post" />
							<div class="botao-novo" style="margin-left:0px;"><a title="Nova Categoria" onClick="abreCadastrar()"><div class="esquerda-novo"></div><div class="conteudo-novo">Nova Categoria</div><div class="direita-novo"></div></a></div>
							<div class="botao-novo" style="display:none; margin-left:0px;" id="botaoFechar"><a title="Fechar Cadastrar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
							<br class="clear" />
						</form>
					</div>
					</div>
					
					<div id="cadastrar" style="display:none; margin-left:30px; margin-top:30px; margin-bottom:30px;">
<?php
				if(isset($_POST['cadastrar']) || isset($_POST['cadastrar-novo'])){
					
					include ('f/conf/criaUrl.php');
					$urlCategoria = criaUrl($_POST['nome']);

					if($_POST['status'] == 'T'){
						$ativar = 'T';
					}else{
						$ativar = 'F';
					}							

					$sqlUltimoCategoria = "SELECT codOrdenacaoCategoria FROM categorias ORDER BY codOrdenacaoCategoria DESC LIMIT 0,1";
					$resultUltimoCategoria = $conn->query($sqlUltimoCategoria);
					$dadosUltimoCategoria = $resultUltimoCategoria->fetch_assoc();
					
					$novoOrdem = $dadosUltimoCategoria['codOrdenacaoCategoria'] + 1;	

					$sql = "INSERT INTO categorias VALUES(0, ".$novoOrdem.", '".$_POST['nome']."', 'T',  '".str_replace("'", "&#39;",	$_POST['descricao'] )."', '".$urlCategoria."')";
					$result = $conn->query($sql);
					
					if($result == 1){
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['cadastro'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/categorias/'>";
					}else{
						$erroConteudo = "<p class='erro'>Problemas ao cadastrar a categoria!</p>";
					}
				}else{
					$_SESSION['nome'] = "";
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
						<form action="<?php echo $configUrlGer; ?>site/categorias/" method="post">
							<p class="bloco-campo"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" style="width:375px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo" style="width:855px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>
							 
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar Categoria" value="Salvar" /><p class="direita-botao"></p></div></p>						
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
				
				$sqlConta = "SELECT * FROM categorias WHERE codCategoria != ''";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
							if($dadosConta['nomeCategoria'] != ""){
?>
							<table class="tabela-menus" >
								<tr class="titulo-tabela" border="none">
									<th class="canto-esq">Ordenar</th>
									<th>Nome</th>
									<th>Imagens</th>
									<th>Categorias</th>
									<th>Status</th>
									<th>Alterar</th>
									<th class="canto-dir">Excluir</th>
								</tr>					
<?php
					if($url[5] == 1 || $url[5] == ""){
						$pagina = 1;
						$sqlCategoria = "SELECT * FROM categorias ORDER BY statusCategoria ASC, codOrdenacaoCategoria ASC LIMIT 0,30";
					}else{
						$pagina = $url[5];
						$paginaFinal = $pagina * 30;
						$paginaInicial = $paginaFinal - 30;
						$sqlCategoria = "SELECT * FROM categorias ORDER BY statusCategoria ASC, codOrdenacaoCategoria ASC LIMIT ".$paginaInicial.",30";
					}		
					
					$resultCategoria = $conn->query($sqlCategoria);
					while($dadosCategoria = $resultCategoria->fetch_assoc()){
						$sqlCategoriaImagem = " SELECT * FROM categoriasImagens WHERE codCategoria  ='".$dadosCategoria['codCategoria']."'";
						$resultCategoriaImagem = $conn->query($sqlCategoriaImagem);
						$dadosCategoriaImagem =$resultCategoriaImagem->fetch_assoc();

						
						if($dadosCategoria['statusCategoria'] == "T"){
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
									<td class="dez" style="text-align:center;"><input type="number" class="campo" style="width:30px; text-align:center; border:1px solid #0000FF; outline:none;" value="<?php echo $dadosCategoria['codOrdenacaoCategoria'];?>" onClick="alteraCor(<?php echo $dadosCategoria['codCategoria'];?>);" onBlur="alteraOrdem(<?php echo $dadosCategoria['codCategoria'];?>, this.value);" id="codOrdena<?php echo $dadosCategoria['codCategoria'];?>"/></td>
									<td class="oitenta"><a href='<?php echo $configUrlGer; ?>site/categorias/alterar/<?php echo $dadosCategoria['codCategoria'] ?>/' title='Veja os detalhes da categoria <?php echo $dadosCategoria['nomeCategoria'] ?>'><?php echo $dadosCategoria['nomeCategoria'];?></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/imagens/<?php echo $dadosCategoria['codCategoria'] ?>/' title='Deseja cadastrar imagens para a categoria <?php echo $dadosCategoria['nomeCategoria'] ?>?' ><img style="<?php echo $dadosCategoriaImagem['codCategoriaImagem'] == "" ? 'display:none;' : 'padding-top:5px;';?>" src="<?php echo $configUrlGer.'f/categorias/'.	$dadosCategoriaImagem['codCategoria'].'-'.$dadosCategoriaImagem['codCategoriaImagem'].'-O.'.$dadosCategoriaImagem['extCategoriaImagem'];?>" height="50"/><img style="<?php echo  $dadosCategoriaImagem['codCategoriaImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a></td>	
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/subCategorias/<?php echo $dadosCategoria['codCategoria'] ?>/' title='Deseja cadastrar sub-categoria para a categoria <?php echo $dadosCategoria['nomeCategoria'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/linha-produto.png" alt="icone"></a></td>	
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/ativacao/<?php echo $dadosCategoria['codCategoria'] ?>/' title='Deseja <?php echo $statusPergunta ?> a categoria <?php echo $dadosCategoria['nomeCategoria'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/categorias/alterar/<?php echo $dadosCategoria['codCategoria'] ?>/' title='Deseja alterar a categoria <?php echo $dadosCategoria['nomeCategoria'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosCategoria['codCategoria'] ?>, "<?php echo htmlspecialchars($dadosCategoria['nomeCategoria']) ?>");' title='Deseja excluir a categoria <?php echo $dadosCategoria['nomeCategoria'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
					}
?>
								<script>
									function confirmaExclusao(cod, nome){
										if(confirm("Deseja excluir a categoria "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>site/categorias/excluir/'+cod+'/';
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
										$po.post("<?php echo $configUrlGer;?>site/categorias/ordem.php", {codCategoria: cod, codOrdenacaoCategoria: ordem}, function(data){		
											$po("#codOrdena"+cod).css("border", "1px solid #0000FF");
										});											
									}
								</script>								 
							</table>	
<?php
				}
				
				$regPorPagina = 30;
				$area = "site/categorias";
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
