<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "depoimentos";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>Depoimento <strong>".$_SESSION['nome']."</strong> cadastrado com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
				}else	
				if($_SESSION['alteracao'] == "ok"){
					$erroConteudo = "<p class='erro'>Depoimento <strong>".$_SESSION['nome']."</strong> alterado com sucesso!</p>";
					$_SESSION['alteracao'] = "";
					$_SESSION['nomeAlt'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['ativacao'] == "ok"){
					$erroConteudo = "<p class='erro'>Depoimento <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacao'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['exclusao'] == "ok"){
					$erroConteudo = "<p class='erro'>Depoimento <strong>".$_SESSION['nome']."</strong> excluído com sucesso!</p>";
					$_SESSION['exclusao'] = "";
					$_SESSION['nome'] = "";
				}			
?>

				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Cadastros</p>
						<p class="flexa"></p>
						<p class="nome-lista">Depoimentos</p>
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
							<form name="filtro" action="<?php echo $configUrl;?>site/depoimentos/" method="post" />
								<div class="botao-novo" style="margin-left:0px;"><a title="Novo Depoimento" onClick="abreCadastrar()"><div class="esquerda-novo"></div><div class="conteudo-novo">Novo Depoimento</div><div class="direita-novo"></div></a></div>
								<div class="botao-novo" style="display:none; margin-left:0px;" id="botaoFechar"><a title="Fechar Cadastrar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
								<br class="clear" />
							</form>
						</div>
					</div>				
					<div id="cadastrar" style="display:none; margin-left:30px; margin-top:30px; margin-bottom:30px;">
<?php
				if(isset($_POST['cadastrar'])){
					
					include ('f/conf/criaUrl.php');
					$urlDepoimento = criaUrl($_POST['nome']);

					$descricao = str_replace("../../", $configUrlGer, $_POST['descricao']);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					
					$sqlUltimoDepoimento = "SELECT codOrdenacaoDepoimento FROM depoimentos ORDER BY codOrdenacaoDepoimento DESC";
					$resultUltimoDepoimento = $conn->query($sqlUltimoDepoimento);
					$dadosUltimoDepoimento = $resultUltimoDepoimento->fetch_assoc();
					
					$novoOrdem = $dadosUltimoDepoimento['codOrdenacaoDepoimento'] + 1;	

					$sql = "INSERT INTO depoimentos VALUES(0, ".$novoOrdem.", '".preparaNome($_POST['nome'])."', '".$_POST['cidade']."', '".str_replace("'", "&#39;", $descricao)."', 'T', '".$urlDepoimento."')";
					$result = $conn->query($sql);
					
					if($result == 1){
						if(isset($_POST['cadastrar'])){
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['cadastro'] = "ok";
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/depoimentos/'>";
						}else{
							$erroData = "<p class='erro'>Depoimento <strong>".$_POST['nome']."</strong> cadastrado com sucesso!</p>";
						}
					}else{
						$erroData = "<p class='erro'>Problemas ao cadastrar depoimento!</p>";
					}
				
				}else{
					$_SESSION['nome'] = "";
					$_SESSION['cidade'] = "";
					$_SESSION['descricao'] = "";
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
						<form action="<?php echo $configUrlGer; ?>site/depoimentos/" method="post">
							<p class="bloco-campo-float"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" style="width:460px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>
							
							<p class="bloco-campo-float"><label>Cidade / UF: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="cidade" style="width:400px;" required value="<?php echo $_SESSION['cidade']; ?>" /></p>
							
							<br class="clear"/>
							
							<p class="bloco-campo" style="width:900px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:663px; height:300px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar Depoimento Capa" value="Salvar" /><p class="direita-botao"></p></div></p>						
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
				
				$sqlConta = "SELECT * FROM depoimentos WHERE codDepoimento != ''";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeDepoimento'] != ""){
?>
						<table class="tabela-menus" >
							<tr class="titulo-tabela" border="none">
								<th class="canto-esq">Ordenação</th>
								<th>Nome</th>
								<th>Imagem</th>
								<th>Status</th>
								<th>Alterar</th>
								<th class="canto-dir">Excluir</th>
							</tr>					
<?php


					if($url[5] == 1 || $url[5] == ""){
						$pagina = 1;
						$sqlDepoimento = "SELECT * FROM depoimentos ORDER BY statusDepoimento ASC, codOrdenacaoDepoimento ASC LIMIT 0,30";
					}else{
						$pagina = $url[5];
						$paginaFinal = $pagina * 30;
						$paginaInicial = $paginaFinal - 30;
						$sqlDepoimento = "SELECT * FROM depoimentos ORDER BY statusDepoimento ASC, codOrdenacaoDepoimento ASC LIMIT ".$paginaInicial.",30";
					}		
					
					$resultDepoimento = $conn->query($sqlDepoimento);
					while($dadosDepoimento = $resultDepoimento->fetch_assoc()){
						$mostrando++;
						
						if($dadosDepoimento['statusDepoimento'] == "T"){
							$status = "status-ativo";
							$statusIcone = "ativado";
							$statusPergunta = "desativar";
						}else{
							$status = "status-desativado";
							$statusIcone = "desativado";
							$statusPergunta = "ativar";
						}	

						$sqlImagem = "SELECT * FROM depoimentosImagens WHERE codDepoimento = ".$dadosDepoimento['codDepoimento']." ORDER BY codDepoimentoImagem ASC LIMIT 0,1";
						$resultImagem = $conn->query($sqlImagem);
						$dadosImagem = $resultImagem->fetch_assoc();
						
						if($dadosDepoimento['codDepoimento'] == 0){								
?>
								<tr class="tr">
									<td class="dez" style="text-align:center;">--</td>									
									<td class="oitenta"><a><?php echo $dadosDepoimento['nomeDepoimento'];?></a></td> 
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>site/depoimentos/imagens/<?php echo $dadosDepoimento['codDepoimento'] ?>/' title='Deseja gerenciar imagens do depoimento <?php echo $dadosDepoimento['nomeDepoimento'] ?>?' ><span style="width:70px; height:60px; display:table-cell; vertical-align:middle;"><img style="<?php echo $dadosImagem['codDepoimentoImagem'] == "" ? 'display:none;' : '';?> max-width:70px; max-height:60px;" src="<?php echo $configUrlGer.'f/depoimentos/'.$dadosImagem['codDepoimento'].'-'.$dadosImagem['codDepoimentoImagem'].'-W.webp';?>"/></span><img style="<?php echo $dadosImagem['codDepoimentoImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a></td>
									<td class="botoes"><a style="cursor:no-drop;"><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a style="cursor:no-drop;"><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a style="cursor:no-drop;"><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
						}else{
?>
								<tr class="tr">
									<td class="dez" style="text-align:center;"><input type="number" class="campo" style="width:30px; text-align:center; border:1px solid #0000FF; outline:none;" value="<?php echo $dadosDepoimento['codOrdenacaoDepoimento'];?>" onClick="alteraCor(<?php echo $dadosDepoimento['codDepoimento'];?>);" onBlur="alteraOrdem(<?php echo $dadosDepoimento['codDepoimento'];?>, this.value);" id="codOrdena<?php echo $dadosDepoimento['codDepoimento'];?>"/></td>									
									<td class="oitenta"><a href='<?php echo $configUrlGer; ?>site/depoimentos/alterar/<?php echo $dadosDepoimento['codDepoimento'] ?>/' title='Veja os detalhes do depoimento <?php echo $dadosDepoimento['nomeDepoimento'] ?>'><?php echo $dadosDepoimento['nomeDepoimento'];?></a></td> 
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>site/depoimentos/imagens/<?php echo $dadosDepoimento['codDepoimento'] ?>/' title='Deseja gerenciar imagens do depoimento <?php echo $dadosDepoimento['nomeDepoimento'] ?>?' ><span style="width:70px; height:60px; <?php echo $dadosImagem['codDepoimentoImagem'] == "" ? 'display:none;' : 'display:table-cell;';?> vertical-align:middle;"><img style="max-width:70px; max-height:60px;" src="<?php echo $configUrlGer.'f/depoimentos/'.$dadosImagem['codDepoimento'].'-'.$dadosImagem['codDepoimentoImagem'].'-W.webp';?>"/></span><img style="<?php echo $dadosImagem['codDepoimentoImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/depoimentos/ativacao/<?php echo $dadosDepoimento['codDepoimento'] ?>/' title='Deseja <?php echo $statusPergunta ?> o depoimento <?php echo $dadosDepoimento['nomeDepoimento'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/depoimentos/alterar/<?php echo $dadosDepoimento['codDepoimento'] ?>/' title='Deseja alterar o depoimento <?php echo $dadosDepoimento['nomeDepoimento'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosDepoimento['codDepoimento'] ?>, "<?php echo htmlspecialchars($dadosDepoimento['nomeDepoimento']) ?>");' title='Deseja excluir o depoimento <?php echo $dadosDepoimento['nomeDepoimento'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
						}
					}
?>
								<script>
									function confirmaExclusao(cod, nome){
										if(confirm("Deseja excluir o depoimento "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>site/depoimentos/excluir/'+cod+'/';
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
										$po.post("<?php echo $configUrlGer;?>site/depoimentos/ordem.php", {codDepoimento: cod, codOrdenacaoDepoimento: ordem}, function(data){		
											$po("#codOrdena"+cod).css("border", "1px solid #0000FF");
										});											
									}
								</script>								 
							</table>	
<?php
				}
				
				$regPorPagina = 30;
				$area = "site/depoimentos";
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
