<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "expertise";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				$sqlNomePagamento = "SELECT codExpertise, nomeExpertise, statusExpertise FROM expertise WHERE codExpertise = '".$url[6]."' LIMIT 0,1";
				$resultNomePagamento = $conn->query($sqlNomePagamento);
				$dadosNomePagamento = $resultNomePagamento->fetch_assoc();
?>
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Expertise</p>
						<p class="flexa"></p>
						<p class="nome-lista">Alterar</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomePagamento['nomeExpertise'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
				if($dadosNomePagamento['statusExpertise'] == "T"){
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
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/expertise/ativacao/<?php echo $dadosNomePagamento['codExpertise'] ?>/' title='Deseja <?php echo $statusPergunta ?> a expertise <?php echo $dadosNomePagamento['nomeExpertise'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomePagamento['codExpertise'] ?>, "<?php echo htmlspecialchars($dadosNomePagamento['nomeExpertise']) ?>");' title='Deseja excluir a expertise <?php echo $dadosNomePagamento['nomeExpertise'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){

								if(confirm("Deseja excluir a expertise "+nome+"?")){
									window.location='<?php echo $configUrlGer; ?>site/expertise/excluir/'+cod+'/';
								}
							}
						</script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Expertise" href="<?php echo $configUrl;?>site/expertise/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
<?php
				if(isset($_POST['alterar'])){

					include ('f/conf/criaUrl.php');
					$urlExpertise = criaUrl($_POST['nome']);

					$descricao = str_replace("../../../../", $configUrlGer, $_POST['descricao']);
																						
					$sql = "UPDATE expertise SET nomeExpertise = '".preparaNome($_POST['nome'])."', menuExpertise = '".$_POST['menu']."', descricaoExpertise = '".str_replace("'", "&#39;", $descricao)."', urlExpertise = '".$urlExpertise."' WHERE codExpertise = '".$url[6]."'";
					$result = $conn->query($sql); 
					
					if($result == 1){
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['alteracao'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/expertise/'>";
					}else{
						$erroData = "<p class='erro'>Problemas ao alterar expertise!</p>";
					}
				}else{
					$sql = "SELECT * FROM expertise WHERE codExpertise = ".$url[6];
					$result = $conn->query($sql);
					$dadosExpertise = $result->fetch_assoc();
					$_SESSION['nome'] = $dadosExpertise['nomeExpertise'];
					$_SESSION['menu'] = $dadosExpertise['menuExpertise'];
					$_SESSION['url'] = $dadosExpertise['urlExpertise'];
					$_SESSION['descricao'] = $dadosExpertise['descricaoExpertise'];
					$_SESSION['status'] = $dadosExpertise['statusExpertise'];
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
								document.getElementById("menu2").disabled = false;
								document.getElementById("url").disabled = false;
								document.getElementById("alterar").disabled = false;
							}
						</script> 
						<form action="<?php echo $configUrlGer; ?>site/expertise/alterar/<?php echo $url[6] ;?>/" method="post">
							<p class="bloco-campo-float"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" id="nome" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:400px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo-float"><label>Menu: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="menu" id="menu2" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:150px;" required value="<?php echo $_SESSION['menu']; ?>" /></p>

							<p class="bloco-campo-float"><label>Url: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="url" id="url" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:240px;" required value="<?php echo $_SESSION['url']; ?>" /></p>

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
					$_SESSION['menu'] = "";
					$_SESSION['url'] = "";
					$_SESSION['status'] = "";
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
