<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if(controleUsuario($conn) == "tem usuario"){
			
			$area = "leads";
			if(validaAcesso($conn, $area) == "ok"){

				$sqlNomePagamento = "SELECT codLead, nomeLead, statusLead FROM leads WHERE codLead = '".$url[6]."' LIMIT 0,1";
				$resultNomePagamento = $conn->query($sqlNomePagamento);
				$dadosNomePagamento = $resultNomePagamento->fetch_assoc();
?>
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Construtora</p>
						<p class="flexa"></p>
						<p class="nome-lista">Leads</p>
						<p class="flexa"></p>
						<p class="nome-lista">Alterar</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomePagamento['nomeLead'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
				if($dadosNomePagamento['statusLead'] == "T"){
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
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/leads/ativacao/<?php echo $dadosNomePagamento['codLead'] ?>/' title='Deseja <?php echo $statusPergunta ?> o lead <?php echo $dadosNomePagamento['nomeLead'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomePagamento['codLead'] ?>, "<?php echo htmlspecialchars($dadosNomePagamento['nomeLead']) ?>");' title='Deseja excluir o lead <?php echo $dadosNomePagamento['nomeLead'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){

								if(confirm("Deseja excluir o lead "+nome+"?")){
									window.location='<?php echo $configUrlGer; ?>site/leads/excluir/'+cod+'/';
								}
							}
						</script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Leads" href="<?php echo $configUrl;?>site/leads/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
<?php
				if(isset($_POST['alterar'])){

					include ('f/conf/criaUrl.php');
					$urlLead = criaUrl($_POST['nome']);

					$descricao = str_replace("../../../../", $configUrlGer, $_POST['descricao']);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../../../", $configUrlGer, $descricao);
																						
					$sql = "UPDATE leads SET nomeLead = '".preparaNome($_POST['nome'])."', descricaoLead = '".str_replace("'", "&#39;", $descricao)."', urlLead = '".$urlLead."' WHERE codLead = '".$url[6]."'";
					$result = $conn->query($sql); 
					
					if($result == 1){
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['alteracao'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/leads/'>";
					}else{
						$erroData = "<p class='erro'>Problemas ao alterar lead!</p>";
					}
				}else{
					$sql = "SELECT * FROM leads WHERE codLead = ".$url[6];
					$result = $conn->query($sql);
					$dadosLead = $result->fetch_assoc();
					$_SESSION['nome'] = $dadosLead['nomeLead'];
					$_SESSION['descricao'] = $dadosLead['descricaoLead'];
					$_SESSION['status'] = $dadosLead['statusLead'];
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
								document.getElementById("descricao").disabled = false;
								document.getElementById("alterar").disabled = false;
							}
						</script> 
						<form action="<?php echo $configUrlGer; ?>site/leads/alterar/<?php echo $url[6] ;?>/" method="post">
							<p class="bloco-campo"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input id="nome" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> required class="campo" type="text" name="nome" style="width:842px;" value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo" style="width:855px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" id="alterar" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> type="submit" name="alterar" title="Alterar" value="Alterar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
						</form>
					</div>
				</div>
<?php
				if($_SESSION['erro'] == "ok"){
					$_SESSION['nome'] = "";
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
