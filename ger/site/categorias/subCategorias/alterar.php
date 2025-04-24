<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
				
			$area = "categorias";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

					$sqlNomePagamento = "SELECT codSubCategoria, nomeSubCategoria, statusSubCategoria FROM subCategorias WHERE codSubCategoria = '".$url[8]."' LIMIT 0,1";
					$resultNomePagamento = $conn->query($sqlNomePagamento);
					$dadosNomePagamento = $resultNomePagamento->fetch_assoc();

					$sqlCategoria = "SELECT codCategoria, nomeCategoria FROM categorias WHERE codCategoria = ".$url[6]."";
					$resultCategoria = $conn->query($sqlCategoria);
					$dadosCategoria = $resultCategoria->fetch_assoc();
?>
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Área de Atuação</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosCategoria['nomeCategoria'];?></p>
						<p class="flexa"></p>
						<p class="nome-lista">Categoria</p>
						<p class="flexa"></p>
						<p class="nome-lista">Alterar</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomePagamento['nomeSubCategoria'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
					if($dadosNomePagamento['statusSubCategoria'] == "T"){
						$status = "status-ativo";
						$statusIcone = "ativado";
						$statusPergunta = "desativar";
					}else{
						$status = "status-desativado";
						$statusIcone = "desativado";
						$statusPergunta = "ativar";
					}		
?>	
						<tr class="tr-interno">
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/categorias/subCategorias/<?php echo $url[6];?>/ativacao/<?php echo $dadosNomePagamento['codSubCategoria'];?>/' title='Deseja <?php echo $statusPergunta ?> a subCategoria <?php echo $dadosNomePagamento['nomeSubCategoria'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomePagamento['codSubCategoria'] ?>, "<?php echo htmlspecialchars($dadosNomePagamento['nomeSubCategoria']) ?>");' title='Deseja excluir a subCategoria <?php echo $dadosNomePagamento['nomeSubCategoria'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){
								if(confirm("Deseja excluir a subCategoria "+nome+"?")){
									window.location='<?php echo $configUrlGer; ?>site/categorias/subCategorias/<?php echo $url[6];?>/excluir/'+cod+'/';
								}
							}
						 </script>
					</table>	
					<div class="botao-consultar"><a title="Consultar SubCategorias" href="<?php echo $configUrl;?>site/categorias/subCategorias/<?php echo $url[6];?>/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
<?php
					if(isset($_POST['alterar'])){
							
						include ('f/conf/criaUrl.php');
						$urlSubCategoria = criaUrl($_POST['nome']);
																			
						$sql = "UPDATE subCategorias SET nomeSubCategoria = '".preparaNome($_POST['nome'])."',descricaoSubCategoria = '".str_replace("'", "&#39;",	$_POST['descricao'] )."', urlSubCategoria = '".$urlSubCategoria."' WHERE codSubCategoria = '".$url[8]."'";
						$result = $conn->query($sql); 
						
						if($result == 1){
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['descricao'] = $_POST['descricao'];
							$_SESSION['alteracao'] = "ok";
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/categorias/subCategorias/".$url[6]."/'>";
						}else{
							$erroData = "<p class='erro'>Problemas ao alterar a subCategorias!</p>";
						}
					}else{
						$sql = "SELECT * FROM subCategorias WHERE codSubCategoria = ".$url[8];
						$result = $conn->query($sql);
						$dadosSubCategoria = $result->fetch_assoc();
						$_SESSION['nome'] = $dadosSubCategoria['nomeSubCategoria'];
						$_SESSION['descricao'] = $dadosSubCategoria['descricaoSubCategoria'];
						$_SESSION['status'] = $dadosSubCategoria['statusSubCategoria'];
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
					
						<div class="botao-editar"><a title="Editar" href="javascript:habilitaCampo();"><div class="esquerda-editar"></div><div class="conteudo-editar">Editar</div><div class="direita-editar"></div></a></div>					
						<p class="obrigatorio">Campos obrigatórios *</p>
						<br/>
						<script>
							function habilitaCampo(){
								document.getElementById("nome").disabled = false;
								document.getElementById("alterar").disabled = false;
							}
						</script>
						<form action="<?php echo $configUrlGer; ?>site/categorias/subCategorias/<?php echo $url[6];?>/alterar/<?php echo $url[8];?>/" method="post">
							<p class="bloco-campo"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input id="nome" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> class="campo" required type="text" name="nome" style="width:310px;" value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo" style="width:855px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" id="alterar" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> type="submit" name="alterar" title="Alterar" value="Alterar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
						</form>
					</div>
				</div>
<?php
					if($_SESSION['erro'] == "ok"){
						$_SESSION['nome'] = "";
					}

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
