<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "categorias";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				$sqlNomeCategoria = "SELECT * FROM categorias WHERE codCategoria = '".$url[6]."'";
				$resultNomeCategoria = $conn->query($sqlNomeCategoria);
				$dadosNomeCategoria = $resultNomeCategoria->fetch_assoc();
?>	
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Área de Atuação</p>
						<p class="flexa"></p>
						<p class="nome-lista">Imagens</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomeCategoria['nomeCategoria'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
				if($dadosNomeCategoria['statusCategoria'] == "T"){
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
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/categorias/ativacao/<?php echo $dadosNomeCategoria['codCategoria'] ?>/' title='Deseja <?php echo $statusPergunta ?> a área de atuação  <?php echo $dadosNomeCategoria['nomeCategoria'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='<?php echo $configUrlGer; ?>site/categorias/<?php echo $url[6];?>/alterar/<?php echo $url[5];?>/' title='Deseja alterar o área de atuação  <?php echo $dadosNomeCategoria['nomeCategoria'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar-branco.gif" alt="icone" /></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomeCategoria['codCategoria'] ?>, "<?php echo htmlspecialchars($dadosNomeCategoria['nomeCategoria']) ?>");' title='Deseja excluir o área de atuação capa <?php echo $dadosNomeCategoria['nomeCategoria'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){
								if(confirm("Deseja excluir o banner capa "+nome+"?")){
									window.location='<?php echo $configUrlGer; ?>site/categorias/excluir/'+cod+'/';
								}
							}
						 </script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Categorias Capa" href="<?php echo $configUrlGer; ?>site/categorias/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">

<?php	 
				if(isset($_POST['cadastrar'])){ 
					
					$exclusao = "";
					
					if($_POST['cont'] >  0){
						
						for($i=0; $i<=$_POST['cont']; $i++){
							$contadorDel = "excluir".$i;
							if(isset($_POST[$contadorDel])){
								$exclusao = "ok";
								
								$sqlConsultaDelete = "SELECT * FROM categoriasImagens WHERE codCategoriaImagem = ".$_POST[$contadorDel];
								$resultConsultaDelete = $conn->query($sqlConsultaDelete);
								$dadosConsultaDelete = $resultConsultaDelete->fetch_assoc();
								
								$sqlDelete = "DELETE FROM categoriasImagens WHERE codCategoriaImagem = ".$_POST[$contadorDel];
								$resultDelete = $conn->query($sqlDelete);
								if(file_exists("f/categorias/".$dadosConsultaDelete['codCategoria']."-".$dadosConsultaDelete['codCategoriaImagem']."-O.".$dadosConsultaDelete['extCategoriaImagem'])){
									unlink("f/categorias/".$dadosConsultaDelete['codCategoria']."-".$dadosConsultaDelete['codCategoriaImagem']."-O.".$dadosConsultaDelete['extCategoriaImagem']);
									unlink("f/categorias/".$dadosConsultaDelete['codCategoria']."-".$dadosConsultaDelete['codCategoriaImagem']."-W.webp");
								}
							
								if($resultDelete == 1){
									$noErros = "ok";
								}
							}
						}
					}
					
					if($exclusao == ""){
						
						$pastaDestino = "f/categorias/";
											
						$file = $_FILES['imagem'];
						$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
							
						if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'svg'])){	
							
							
							$file_name = uniqid() . '.' . $ext;							
															
							$sqlCategoria = "SELECT * FROM categorias WHERE codCategoria = ".$url[6]." ORDER BY codCategoria DESC LIMIT 0,1";
							$resultCategoria = $conn->query($sqlCategoria);
							$dadosCategoria = $resultCategoria->fetch_assoc();
							$sql =  "INSERT INTO categoriasImagens VALUES(0, ".$url[6].", '', '".$ext."')";
							$result = $conn->query($sql);
							if($result == 1){
								
								function saveWebPImage($original_image, $new_image_path, $quality = 100) {
									if (imagewebp($original_image, $new_image_path, $quality)) {
										return true;
									} else {
										return false;
									}
								}
																
								$sqlNome = "SELECT * FROM categoriasImagens ORDER BY codCategoriaImagem DESC";
								$resultNome = $conn->query($sqlNome);
								$dadosNome = $resultNome->fetch_assoc();

								$codCategoriaImagem = $dadosNome['codCategoriaImagem'];
								$codCategoria = $dadosNome['codCategoria'];
								$nomeCategoriaImagem = $dadosNome['nomeCategoriaImagem'];
								
								move_uploaded_file($file['tmp_name'], $pastaDestino.$codCategoria."-".$codCategoriaImagem."-O.".$ext);
								
								chmod ($pastaDestino.$codCategoria."-".$codCategoriaImagem."-O.".$ext, 0755);
																
								$imagemWebP = $pastaDestino.$codCategoria."-".$codCategoriaImagem."-W.webp";

								switch ($ext) {
									case 'jpg':
									case 'jpeg':
									$original_image = imagecreatefromjpeg($pastaDestino.$codCategoria."-".$codCategoriaImagem."-O.".$ext);
									break;
									case 'png':
									$original_image = imagecreatefrompng($pastaDestino.$codCategoria."-".$codCategoriaImagem."-O.".$ext);
									break;
									case 'gif':
									$original_image = imagecreatefromgif($pastaDestino.$codCategoria."-".$codCategoriaImagem."-O.".$ext);
									break;
								}

								saveWebPImage($original_image, $imagemWebP, 95);

								imagedestroy($original_image);

								chmod ($pastaDestino.$codCategoria."-".$codCategoriaImagem."-W.webp", 0755);								
														
								$erroData = "<p class='erro'>Imagem cadastrada com sucesso!</p>";														
						
							}else{
								$erroData = "<p class='erro'>Problemas ao cadastrar imagem!</p>";
							}
									
						}else{
							$erroData = "<p class='erro'>Extenção não permitida ou imagem não selecionada!</p>";
						}				
					}else{
						$erroData = "<p class='erro'>Imagem excluída com sucesso!</p>";
					}				
				}
?>
<?php	
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

						<form action="<?php echo $configUrlGer; ?>site/categorias/imagens/<?php echo $url[6];?>/" enctype="multipart/form-data" method="post">
							
							<p class="aviso" style="color:#718B8F; margin-bottom:20px; font-size:15px;"><label style="color:#FF0000;">Observação:</label>As extensões permitidas estão listadas abaixo;<br/>Tamanho recomendado está listado abaixo;<br/>Para cadastrar imagens, clique em escolher arquivo e selecione uma ou mais imagens e clique em salvar;<br/>As imagens são salvas automaticamente;<br/>Para excluir as imagens, selecione a imagem e clique no botão excluir;</p>

							<p class="aviso" style="color:#718B8F; margin-bottom:20px; font-size:15px;"><label style="color:#FF0000;">Importante:</label>A primeira imagem cadastrada será mostrada na Versão Desktop e a segunda será mostrada na versão Mobile.</p>
							
							<p class="bloco-campo"><label class="label" style="font-size:15px; line-height:20px; font-weight:normal;"><strong>Extensão:</strong> png, jpg, jpeg e svg. Formato recomendado : <strong>svg</strong><br/><strong>Tamanho Desktop:</strong> 165 x 165. <br>
							<input class="campo" type="file" name="imagem" style="width:400px; margin-top:10px;" value="" /></p>
							
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar" value="Salvar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
							<br/>
							<br/>
							<div class="lista-imagens">
<?php
				$sqlRegistro = "SELECT * FROM categoriasImagens WHERE codCategoria = ".$url[6]."";
				$resultRegistro = $conn->query($sqlRegistro);
				// $dadosRegistro = $resultRegistro->fetch_assoc();
				$registros = mysqli_num_rows($resultRegistro);

				  
				// $pagina = $url[7];
				// if($pagina == 1 || $pagina == "" ){
				// 	$sqlConsulta = "SELECT * FROM categoriasImagens WHERE codCategoria = ".$url[8]." ORDER BY codCategoriaImagem ASC LIMIT 0, 14";
				// 	$somaLimite = "14";
				// 	$pgInicio = "0";		
				// }else{
				// 	$somaLimite = $pagina * 14;
				// 	echo "entrou";
				// 	$pgInicio = $somaLimite - 14;
				// 	$sqlConsulta = "SELECT * FROM categoriasImagens WHERE codCategoria = ".$url[8]." ORDER BY codCategoriaImagem ASC LIMIT ".$pgInicio.", 14";
				// 	echo $sqlConsulta;
				// }				
				// $resultConsulta = $conn->query($resultRegistro);

				$cont = 0;


				while($dadosRegistro = $resultRegistro->fetch_assoc()){
					
					$mostrando = $mostrando + 1;		
?>       
								<div class="imagem" style="width:300px; height:200px; margin-right:30px;">
									<p style="width:300px; height:142px; display:table-cell; vertical-align:middle;"><img src="<?php echo $configUrl."f/categorias/".$dadosRegistro['codCategoria'].'-'.$dadosRegistro['codCategoriaImagem'].'-O.'.$dadosRegistro['extCategoriaImagem'].'';?>" alt="Imagem Categoria" style="max-width:300px; max-height:120px;"/><br/></p>
									<label><input type="checkbox" name="excluir<?php echo $cont; ?>" value="<?php echo $dadosRegistro['codCategoriaImagem']; ?>" /> Excluir</label>
								</div>			
<?php
					$cont = $cont + 1;
				}
?>
								<input type="hidden" name="cont" value="<?php echo $cont; ?>" />
							</div>
						</form>
					</div>
					<br class="clear" />
					<br/>
 <?php
				if($erro == "ok"){
					$_SESSION['erroDados'] = ""; 
					
					
				}
				$regPorPag = 14;
				$area = "site/categorias/imagens/".$url[6];
				include('f/conf/paginacao-imagens.php');
?>
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
