<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "contatos";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){
				
				$sqlInformacoes = "SELECT * FROM contatos WHERE codContato = '".$url[6]."'";
				$resultInformacoes = $conn->query($sqlInformacoes);
				$dadosInformacoes = $resultInformacoes->fetch_assoc();
?>
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Contatos</p>
						<p class="flexa"></p>
						<p class="nome-lista">Detalhes</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosInformacoes['nomeContato'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
						<tr class="tr-interno">
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosInformacoes['codContato'] ?>, "<?php echo htmlspecialchars($dadosInformacoes['nomeContato']) ?>");' title='Deseja excluir o Contato <?php echo $dadosInformacoes['nomeContato'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){
								if(confirm("Deseja excluir o contato "+nome+"?")){
									window.location='<?php echo $configUrl; ?>site/contatos/excluir/'+cod+'/';
								}
							}
						</script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Contatos" href="<?php echo $configUrl;?>site/contatos/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
					<br class="clear" />
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
						<div class="detalhes-esq">
							<p class="bloco-campo"><label>Nome:</label>
							<?php echo $dadosInformacoes['nomeContato'];?></p>					
		
							<p class="bloco-campo"><label>Data:</label>
							<?php echo data($dadosInformacoes['dataContato']);?></p>					
		
							<p class="bloco-campo" style="<?php echo $dadosInformacoes['cidadeContato'] == "" ? 'display:none;' : '';?>"><label>Cidade:</label>
							<?php echo $dadosInformacoes['cidadeContato'];?> / <?php echo $dadosInformacoes['estadoContato'];?></p>										
		
							<p class="bloco-campo" style="<?php echo $dadosInformacoes['emailContato'] == "" ? 'display:none;' : '';?>"><label>E-mail:</label>
							<?php echo $dadosInformacoes['emailContato'];?></p>										

							<p class="bloco-campo"><label>Celular:</label>
							 <?php echo $dadosInformacoes['telefoneContato'];?></p>								

						</div>

						<br class="clear" />
						
						<div class="bloco-campo" style="margin-top:20px; <?php echo $dadosInformacoes['descricaoContato'] == "" ? 'display:none;' : '';?>"><label>Mensagem:</label>
						<?php echo $dadosInformacoes['descricaoContato'];?></div>		
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
