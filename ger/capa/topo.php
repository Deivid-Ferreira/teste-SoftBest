			<script type="text/javascript">
				function trocaBackground(cod){
					document.getElementById('trocaBackground-6').style.background="transparent url('<?php echo $configUrl;?>f/i/default/menu-default/menu-inativo.gif') left top no-repeat";
					document.getElementById('trocaBackground-'+cod).style.background="transparent url('<?php echo $configUrl;?>f/i/default/menu-default/menu-ativo.gif') left bottom no-repeat";
				}
			</script>
			<div id="topo">
				<div id="topo-esq">
					<p class="slogan"><a title="<?php echo $nomeEmpresa;?>" href="<?php echo $configUrl;?>" style="width:123px; height:35px; margin-left:10px; margin-top:3px; background:transparent url('<?php echo $configUrlGer;?>f/i/icon-topo.png') center center no-repeat; background-size: contain, 100%;;"></a></p>
					<div id="menu">
						<p class="<?php echo $url[3] == 'site' || $url[3] == '' ? 'menu-site-ativo' : 'menu-site';?>"><a href="javascript:trocaBackground(6);"  id="trocaBackground-6" onClick="mostraItens(6)" >Site</a></p>
					</div>
				</div>
				<div id="topo-dir">
					<div id="icones-topo">
						<p class="icone-configuracoes" style="border-right:none;"><a href="<?php echo $configUrl;?>configuracoes/" title="" >Configurações</a></p>
						<br class="clear" />
					</div>
					<br class="clear" />
					<div id="dados-usuario-topo">
						<div id="dados-cliente-topo">
<?php
	$sqlImagemUsuario = "SELECT * FROM usuariosImagens WHERE codUsuario = ".$_COOKIE['codAprovado'.$cookie]." ORDER BY codUsuarioImagem DESC LIMIT 0,1";
	$resultImagemUsuario = $conn->query($sqlImagemUsuario);
	$dadosImagemUsuario = $resultImagemUsuario->fetch_assoc();
	if($dadosImagemUsuario['codUsuario'] != ""){	
		$imagemUsuario = $configUrl."configuracoes/minha-foto/".$dadosImagemUsuario['codUsuario']."-".$dadosImagemUsuario['codUsuarioImagem']."-G.".$dadosImagemUsuario['extUsuarioImagem'];
	}else{
		$imagemUsuario = $configUrl."f/i/default/topo-default/avatar.gif";
	}
?>	
							<p class="nome-cliente"><?php echo $nomeEmpresaMenor;?></p>
							<p class="nome-usuario"><span class="titulo-usuario">Usuário:</span> <?php echo $_COOKIE['loginAprovado'.$cookie];?></p>
							<p class="icone-sair"><a href="<?php echo $configUrl;?>sair.php" title=""><span class="oculto">Sair</span></a></p>
						</div>
						<div id="imagem-cliente-topo">
							<a href="<?php echo $configUrl;?>configuracoes/minha-foto/" title="Alterar foto" ><img style="border-radius:5px;" src="<?php echo $imagemUsuario;?>" alt="" /></a>
						</div>
					</div>
				</div>
				<br class="clear" />
				<div id="barra-menu">
					<div id="menu-dinamico">
						<div id="site" <?php echo $url[3] == "" ? "style='display:none;'" : "";?>>
							<ul>
								<li><a <?php echo $url[4] == "leads" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/leads/">Leads</a></li>
								<li><a <?php echo $url[4] == "banners" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/banners/">Banners Capa</a></li>
								<li><a <?php echo $url[4] == "quemSomos" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/quemSomos/">Sobre</a></li>
								<li><a <?php echo $url[4] == "solucoes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/solucoes/">Soluções</a></li>	
								<li><a <?php echo $url[4] == "clientes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/clientes/">Clientes</a></li>
								<li><a <?php echo $url[4] == "depoimentos" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/depoimentos/">Depoimentos</a></li>	
								<li><a <?php echo $url[4] == "blog" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/blog/">Novidades</a></li>								
								<li><a <?php echo $url[4] == "porque" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/porque/">Por que contratar</a></li>							
								<li><a <?php echo $url[4] == "equipe" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/equipe/">Equipe</a></li>
								<li><a <?php echo $url[4] == "relatorios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/relatorios/">Relatórios de Acessos</a></li>
								<li><a <?php echo $url[4] == "informacoes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/informacoes/">Informações</a></li>
							</ul>
						</div>			
					</div>
					<div id="menu-normal">
						<div id="site" style="<?php echo $url[3] == 'site' || $url[3] == '' ? 'display:block;' : 'display:none;';?>">
							<ul>
								<li><a <?php echo $url[4] == "leads" || $url[4] == "" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/leads/">Leads</a></li>
								<li><a <?php echo $url[4] == "banners" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/banners/">Banners Capa</a></li>
								<li><a <?php echo $url[4] == "quemSomos" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/quemSomos/">Sobre</a></li>
								<li><a <?php echo $url[4] == "solucoes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/solucoes/">Soluções</a></li>																									
								<li><a <?php echo $url[4] == "clientes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/clientes/">Clientes</a></li>	
								<li><a <?php echo $url[4] == "depoimentos" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/depoimentos/">Depoimentos</a></li>	
								<li><a <?php echo $url[4] == "blog" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/blog/">Novidades</a></li>							
								<li><a <?php echo $url[4] == "porque" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/porque/">Por que contratar</a></li>							
								<li><a <?php echo $url[4] == "equipe" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/equipe/">Equipe</a></li>
								<li><a <?php echo $url[4] == "relatorios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/relatorios/">Relatórios de Acessos</a></li>
								<li><a <?php echo $url[4] == "informacoes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>site/informacoes/">Informações</a></li>
							</ul>
						</div>						
					</div>
				</div>
			</div>
