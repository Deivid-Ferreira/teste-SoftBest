<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "expertise";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>Expertise <strong>".$_SESSION['nome']."</strong> cadastrada com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['alteracao'] == "ok"){
					$erroConteudo = "<p class='erro'>Expertise <strong>".$_SESSION['nome']."</strong> alterada com sucesso!</p>";
					$_SESSION['alteracao'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['ativacao'] == "ok"){
					$erroConteudo = "<p class='erro'>Expertise <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacao'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['exclusao'] == "ok"){
					$erroConteudo = "<p class='erro'>Expertise <strong>".$_SESSION['nome']."</strong> excluída com sucesso!</p>";
					$_SESSION['exclusao'] = "";
					$_SESSION['nome'] = "";
				}			
?>
				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Expertise</p>
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
							<form name="filtro" action="<?php echo $configUrl;?>site/expertise/" method="post" />
								<div class="botao-novo" style="margin-left:0px;"><a title="Nova Expertise" onClick="abreCadastrar()"><div class="esquerda-novo"></div><div class="conteudo-novo">Nova Expertise</div><div class="direita-novo"></div></a></div>
								<div class="botao-novo" style="display:none; margin-left:0px;" id="botaoFechar"><a title="Fechar Cadastrar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
								<br class="clear" />
							</form>
						</div>
					</div>				
					<div id="cadastrar" style="display:none; margin-left:30px; margin-top:30px; margin-bottom:30px;">
<?php
				if(isset($_POST['cadastrar'])){
					
					include ('f/conf/criaUrl.php');
					$urlExpertise = criaUrl($_POST['url']);

					$sqlUltimoExpertise = "SELECT codOrdenacaoExpertise FROM expertise ORDER BY codOrdenacaoExpertise DESC LIMIT 0,1";
					$resultUltimoExpertise = $conn->query($sqlUltimoExpertise);
					$dadosUltimoExpertise = $resultUltimoExpertise->fetch_assoc();
					
					$novoOrdem = $dadosUltimoExpertise['codOrdenacaoExpertise'] + 1;	

					$descricao = str_replace("../../", $configUrlGer, $_POST['descricao']);
					
					$sql = "INSERT INTO expertise VALUES(0, ".$novoOrdem.", '".preparaNome($_POST['nome'])."', '".$_POST['menu']."', '".str_replace("'", "&#39;", $descricao)."', 'T', '".$urlExpertise."')";
					$result = $conn->query($sql);
					
					if($result == 1){
						if(isset($_POST['cadastrar'])){
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['cadastro'] = "ok";
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/expertise/'>";
						}else{
							$erroData = "<p class='erro'>Expertise <strong>".$_POST['nome']."</strong> cadastrada com sucesso!</p>";
						}
					}else{
						$erroData = "<p class='erro'>Problemas ao cadastrar expertise!</p>";
					}
				
				}else{
					$_SESSION['nome'] = "";
					$_SESSION['menu'] = "";
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
						<form action="<?php echo $configUrlGer; ?>site/expertise/" method="post">
							<p class="bloco-campo-float"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" style="width:400px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo-float"><label>Menu: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="menu" style="width:150px;" required value="<?php echo $_SESSION['menu']; ?>" /></p>

							<p class="bloco-campo-float"><label>Url: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="url" style="width:240px;" required value="<?php echo $_SESSION['url']; ?>" /></p>

							<br class="clear"/>

							<p class="bloco-campo" style="width:855px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar Expertise" value="Salvar" /><p class="direita-botao"></p></div></p>						
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
				
				$sqlConta = "SELECT nomeExpertise FROM expertise WHERE codExpertise != ''";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeExpertise'] != ""){
?>
						<table class="tabela-menus">
							<tr class="titulo-tabela" border="none">
								<th class="canto-esq">Ordenar</th>
								<th>Nome</th>
								<th>Ícone</th>
								<th>Status</th>
								<th>Alterar</th>
								<th class="canto-dir">Excluir</th>
							</tr>	
							<tbody id="tabela-itens">																
<?php

					$sqlExpertise = "SELECT * FROM expertise ORDER BY statusExpertise ASC, codOrdenacaoExpertise ASC, codExpertise DESC";
					$resultExpertise = $conn->query($sqlExpertise);
					while($dadosExpertise = $resultExpertise->fetch_assoc()){
						
						if($dadosExpertise['statusExpertise'] == "T"){
							$status = "status-ativo";
							$statusIcone = "ativado";
							$statusPergunta = "desativar";
						}else{
							$status = "status-desativado";
							$statusIcone = "desativado";
							$statusPergunta = "ativar";
						}

						$sqlImagem = "SELECT * FROM expertiseImagens WHERE codExpertise = ".$dadosExpertise['codExpertise']." ORDER BY codExpertiseImagem ASC LIMIT 0,1";
						$resultImagem = $conn->query($sqlImagem);
						$dadosImagem = $resultImagem->fetch_assoc();							
?>
								<tr class="tr">
									<td class="dez handle" style="width:5%; text-align:center; cursor:move;"><a style="text-decoration:none; font-size:22px;" title='Arraste para ordenar'>⇅ <input type="hidden" name="codExpertise" value="<?php echo $dadosExpertise['codExpertise'];?>"/></a></td> 
									<td class="oitenta"><a href='<?php echo $configUrlGer; ?>site/expertise/alterar/<?php echo $dadosExpertise['codExpertise'] ?>/' title='Veja os detalhes da expertise <?php echo $dadosExpertise['nomeExpertise'] ?>'><?php echo $dadosExpertise['nomeExpertise'];?></a></td> 
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>site/expertise/imagens/<?php echo $dadosExpertise['codExpertise'] ?>/' title='Deseja gerenciar imagens do banner <?php echo $dadosExpertise['nomeExpertise'] ?>?' ><img style="<?php echo $dadosImagem['codExpertiseImagem'] == "" ? 'display:none;' : 'padding-top:10px;';?>" src="<?php echo $configUrlGer.'f/expertise/'.$dadosImagem['codExpertise'].'-'.$dadosImagem['codExpertiseImagem'].'-O.'.$dadosImagem['extExpertiseImagem'];?>" height="45"/><img style="<?php echo $dadosImagem['codExpertiseImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/expertise/ativacao/<?php echo $dadosExpertise['codExpertise'] ?>/' title='Deseja <?php echo $statusPergunta ?> a expertise <?php echo $dadosExpertise['nomeExpertise'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/expertise/alterar/<?php echo $dadosExpertise['codExpertise'] ?>/' title='Deseja alterar a expertise <?php echo $dadosExpertise['nomeExpertise'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosExpertise['codExpertise'] ?>, "<?php echo htmlspecialchars($dadosExpertise['nomeExpertise']) ?>");' title='Deseja excluir a expertise <?php echo $dadosExpertise['nomeExpertise'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
					}
?>								 
							</tbody>					 
						</table>	
						<script type="text/javascript">
							function confirmaExclusao(cod, nome){
								if(confirm("Deseja excluir a expertise "+nome+"?")){
									window.location='<?php echo $configUrlGer; ?>site/expertise/excluir/'+cod+'/';
								}
							}
							
							$tgb = jQuery.noConflict();
							const dragArea = document.querySelector("#tabela-itens");
							new Sortable(dragArea, {
								animation: 350,
								filter: '.disabled',
								handle: '.handle',									
								onEnd: function(e) {
									var allinputs = document.querySelectorAll('input[name="codExpertise"]');
									var myLength = allinputs.length;
									var cont = 0;
									for (i = 0; i < myLength; i++) {
										cont++;
										$tgb.post("<?php echo $configUrlGer;?>site/expertise/ordena.php", {codExpertise: allinputs[i].value, codOrdenacaoExpertise: cont});
									}
								}
							});				
						</script>	
						<p style="font-size:15px; color:#31625E; text-align:center; padding-top:20px;">Total de registros: <strong style="font-size:15px; color:#31625E;"><?php echo $registros;?></strong></p>													
<?php
				}else{		
?>							
						<p style="font-size:15px; color:#31625E; text-align:center; padding-top:20px;">Nenhum registro encontrado!</p>																				
<?php
				}
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
