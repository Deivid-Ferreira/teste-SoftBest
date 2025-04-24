<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "contatos";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastrar'] == "ok"){
					$erroConteudo = "<p class='erro'>Contato <strong>".$_SESSION['nome']."</strong> cadastrado com sucesso!</p>";
					$_SESSION['cadastrar'] = "";
					$_SESSION['nome'] = "";	
				}else	
				if($_SESSION['alterars'] == "ok"){
					$erroConteudo = "<p class='erro'>Contato <strong>".$_SESSION['nome']."</strong> alterado com sucesso!</p>";
					$_SESSION['alterars'] = "";
					$_SESSION['nome'] = "";	
				}else	
				if($_SESSION['ativar'] == "ok"){
					$erroConteudo = "<p class='erro'>Contato <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativar'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['excluir'] == "ok"){
					$erroConteudo = "<p class='erro'>Contato <strong>".$_SESSION['nome']."</strong> excluído com sucesso!</p>";
					$_SESSION['excluir'] = "";
					$_SESSION['nome'] = "";
				}

				if(isset($_POST['statusFiltro'])){
					if($_POST['statusFiltro'] != ""){
						$_SESSION['statusFiltro'] = $_POST['statusFiltro'];
					}else{
						$_SESSION['statusFiltro'] = "";
					}
				}
				
				if($_SESSION['statusFiltro'] != ""){
					$filtraStatus = " and statusContato = '".$_SESSION['statusFiltro']."'";
				}		
?>

				<div id="filtro">							
					<div id="localizacao-filtro">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Contatos</p>	
						<br class="clear"/>
					</div>
					<div class="demoTarget">
						<div id="formulario-filtro">
							<script>
								function enviar(){
									document.filtro.submit(); 
								}
							</script>
							<script type="text/javascript">
								function alteraStatus(status){
									document.getElementById("filtroStatus").submit();
								}
							</script>
							<form id="filtroStatus" action="<?php echo $configUrl;?>site/contatos/" method="post" >

								<p class="nome-clientes-filtro" style="width:218px;"><label class="label">Filtrar Nome:</label>
								<input type="text" style="width:200px;" name="contatos" onKeyUp="buscaAvancada();" id="busca" autocomplete="off" value="<?php echo $_SESSION['nome-contatos-filtro'];?>" /></p>
								<input style="display:none;" type="text" size="16" name="teste" value="" />

								<p class="bloco-campo-float"><label>Filtrar Status: <span class="obrigatorio"> </span></label>
									<select class="campo" name="statusFiltro" style="width:155px; padding:6px;" required onChange="alteraStatus(this.value);">
										<option value="">Todos</option>
										<option value="T" <?php echo $_SESSION['statusFiltro'] == "T" ? '/SELECTED/' : '';?>>Ativo</option>
										<option value="F" <?php echo $_SESSION['statusFiltro'] == "F" ? '/SELECTED/' : '';?>>Inativo</option>
									</select>
								</p>	
								
								<br class="clear" />
							</form>
						</div>
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
?>
						<script type="text/javascript">
							function buscaAvancada(){
								var $AGD = jQuery.noConflict();
								var busca = $AGD("#busca").val();
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								$AGD("#busca-carregada").load("<?php echo $configUrl;?>site/contatos/busca-contato.php?busca="+busca);
								if(busca == ""){
									document.getElementById("paginacao").style.display="block";
								}else{
									document.getElementById("paginacao").style.display="none";
								}
							}	
						</script>
						<div id="busca-carregada">
<?php
				$sqlConta = "SELECT nomeContato, codContato FROM contatos WHERE codContato != ''".$filtraStatus."";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeContato'] != ""){
?>
							<table class="tabela-menus" >
								<tr class="titulo-tabela" border="none">
									<th class="canto-esq" >Nome</th>
									<th>Assunto</th>
									<th>Celular</th>
									<th>Data</th>
									<th>Status</th>
									<th class="canto-dir">Excluir</th>
								</tr>					
<?php
				}
				
				if($url[5] == 1 || $url[5] == ""){
					$pagina = 1;
					$sqlContatos = "SELECT * FROM contatos WHERE codContato != ''".$filtraStatus." ORDER BY statusContato ASC, dataContato DESC, codContato DESC LIMIT 0,30";
				}else{
					$pagina = $url[5];
					$paginaFinal = $pagina * 30;
					$paginaInicial = $paginaFinal - 30;
					$sqlContatos = "SELECT * FROM contatos WHERE codContato != ''".$filtraStatus." ORDER BY statusContato ASC, dataContato DESC, codContato DESC LIMIT ".$paginaInicial.",30";
				}		

				$resultContatos = $conn->query($sqlContatos);
				while($dadosContatos = $resultContatos->fetch_assoc()){
					$mostrando++;
					
					if($dadosContatos['statusContato'] == "T"){
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
									<td class="sessenta"><a href='<?php echo $configUrlGer; ?>site/contatos/detalhes/<?php echo $dadosContatos['codContato'] ?>/' title='Veja os detalhes do contato <?php echo $dadosContatos['nomeContato'] ?>'><?php echo $dadosContatos['nomeContato'];?></a></td>
									<td class="vinte" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>site/contatos/detalhes/<?php echo $dadosContatos['codContato'] ?>/' title='Veja os detalhes do contato <?php echo $dadosContatos['nomeContato'] ?>'><?php echo $dadosContatos['assuntoContato'];?></a></td>
									<td class="vinte" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>site/contatos/detalhes/<?php echo $dadosContatos['codContato'] ?>/' title='Veja os detalhes do contato <?php echo $dadosContatos['nomeContato'] ?>'><?php echo $dadosContatos['celularContato'];?></a></td>
									<td class="dez" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>site/contatos/detalhes/<?php echo $dadosContatos['codContato'] ?>/' title='Veja os detalhes do contato <?php echo $dadosContatos['nomeContato'] ?>'><?php echo data($dadosContatos['dataContato']);?></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>site/contatos/ativacao/<?php echo $dadosContatos['codContato'] ?>/' title='Deseja <?php echo $statusPergunta ?> o contato <?php echo $dadosContatos['nomeContato'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosContatos['codContato'] ?>, "<?php echo htmlspecialchars($dadosContatos['nomeContato']) ?>");' title='Deseja excluir o contato <?php echo $dadosContatos['nomeContato'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
				}
?>
								<script>
									 function confirmaExclusao(cod, nome){

										if(confirm("Deseja excluir o contato "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>site/contatos/excluir/'+cod+'/';
										}
									  }
								 </script>
								 
							</table>							
						</div>
<?php
				if($url[3] != ""){
					$regPorPagina = 30;
					$area = "site/contatos";
					include ('f/conf/paginacao.php');
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
				echo "<p><strong>Vocês não tem permissão para acessar essa área!</strong></p>";
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
