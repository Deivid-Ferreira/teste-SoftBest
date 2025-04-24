<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "blog";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				$sqlNomePagamento = "SELECT codBlog, nomeBlog, statusBlog FROM blog WHERE codBlog = '".$url[6]."' LIMIT 0,1";
				$resultNomePagamento = $conn->query($sqlNomePagamento);
				$dadosNomePagamento = $resultNomePagamento->fetch_assoc();
?>
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Novidades</p>
						<p class="flexa"></p>
						<p class="nome-lista">Alterar</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomePagamento['nomeBlog'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
				if($dadosNomePagamento['statusBlog'] == "T"){
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
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/blog/ativacao/<?php echo $dadosNomePagamento['codBlog'] ?>/' title='Deseja <?php echo $statusPergunta ?> o blog <?php echo $dadosNomePagamento['nomeBlog'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomePagamento['codBlog'] ?>, "<?php echo htmlspecialchars($dadosNomePagamento['nomeBlog']) ?>");' title='Deseja excluir o blog <?php echo $dadosNomePagamento['nomeBlog'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){

								if(confirm("Deseja excluir o blog "+nome+"?")){
									window.location='<?php echo $configUrlGer; ?>site/blog/excluir/'+cod+'/';
								}
							}
						</script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Blog" href="<?php echo $configUrl;?>site/blog/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
<?php
				if(isset($_POST['alterar'])){

					include ('f/conf/criaUrl.php');
					$urlBlog = criaUrl($_POST['nome']);

					$descricao = str_replace("../../../../", $configUrlGer, $_POST['descricao']);

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
																											
					$sql = "UPDATE blog SET nomeBlog = '".preparaNome($_POST['nome'])."', dataBlog = '".data($_POST['data'])."', descricaoBlog = '".str_replace("'", "&#39;", $descricao)."', fonteBlog = '".$_POST['fonte']."', dataProBlog = '".$dataP." ".$horaP."', urlBlog = '".$urlBlog."' WHERE codBlog = '".$url[6]."'";
					$result = $conn->query($sql); 
					
					if($result == 1){
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['alteracao'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/blog/'>";
					}else{
						$erroData = "<p class='erro'>Problemas ao alterar novidade!</p>";
					}
				}else{
					$sql = "SELECT * FROM blog WHERE codBlog = ".$url[6];
					$result = $conn->query($sql);
					$dadosBlog = $result->fetch_assoc();
					$_SESSION['nome'] = $dadosBlog['nomeBlog'];
					$_SESSION['data'] = data($dadosBlog['dataBlog']);
					$_SESSION['descricao'] = $dadosBlog['descricaoBlog'];
					$_SESSION['fonte'] = $dadosBlog['fonteBlog'];
					$_SESSION['status'] = $dadosBlog['statusBlog'];
					
					$quebraDataPro = explode(" ", $dadosBlog['dataProBlog']);
					if($quebraDataPro[0] != "0000-00-00"){
						$_SESSION['dataP'] = data($quebraDataPro[0]);
						$_SESSION['horaP'] = $quebraDataPro[1];
					}else{
						$_SESSION['dataP'] = "";
						$_SESSION['horaP'] = "";
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
					
						<div class="botao-editar"><a title="Editar" href="javascript:habilitaCampo();"><div class="esquerda-editar"></div><div class="conteudo-editar">Editar</div><div class="direita-editar"></div></a></div>					
						<p class="obrigatorio">Campos obrigatórios *</p>
						<br/>
						<script>
							function habilitaCampo(){
								document.getElementById("nome").disabled = false;
								document.getElementById("data").disabled = false;
								document.getElementById("fonte").disabled = false;
								document.getElementById("dataP").disabled = false;
								document.getElementById("horaP").disabled = false;
								document.getElementById("alterar").disabled = false;
							}
						</script> 
						<form action="<?php echo $configUrlGer; ?>site/blog/alterar/<?php echo $url[6] ;?>/" method="post">
							<p class="bloco-campo-float"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input id="nome" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> required class="campo" type="text" name="nome" style="width:720px;" value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo-float"><label>Data: <span class="obrigatorio"> * </span></label>
							<input class="campo" id="data" name="data" required type="text" required  <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:140px;" value="<?php echo $_SESSION['data']; ?>" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data)"/></p>

							<br class="clear"/>

							<p class="bloco-campo" style="width:900px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><label>Fonte: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="fonte" name="fonte" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:888px;" value="<?php echo $_SESSION['fonte']; ?>" /></p>

							<div style="width:900px; padding-bottom:10px; margin-top:30px; margin-bottom:20px;">
								<p style="font-size:18px; border-bottom:1px solid #ccc; padding-bottom:5px; margin-bottom:20px;">Programar Novidade</p>

								<p class="bloco-campo-float"><label>Data: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="dataP" name="dataP" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:100px;" value="<?php echo $_SESSION['dataP']; ?>" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);"/></p>

								<p class="bloco-campo-float"><label>Hora: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="horaP" name="horaP" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:100px;" value="<?php echo $_SESSION['horaP']; ?>" onKeyDown="Mascara(this,Hora);" onKeyPress="Mascara(this,Hora);" onKeyUp="Mascara(this,Hora);"/></p>
								
								<br class="clear"/>
							</div>
							
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" id="alterar" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> type="submit" name="alterar" title="Alterar" value="Alterar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
						</form>
					</div>
				</div>
<?php
				if($_SESSION['erro'] == "ok"){
					$_SESSION['nome'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
					$_SESSION['fonte'] = "";
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
