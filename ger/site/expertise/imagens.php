<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "expertise";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				$sqlNomeExpertise = "SELECT * FROM expertise WHERE codExpertise = '".$url[6]."'";
				$resultNomeExpertise = $conn->query($sqlNomeExpertise);
				$dadosNomeExpertise = $resultNomeExpertise->fetch_assoc();
?>	
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Expertise</p>
						<p class="flexa"></p>
						<p class="nome-lista">Imagens</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomeExpertise['nomeExpertise'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
				if($dadosNomeExpertise['statusExpertise'] == "T"){
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
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/expertise/ativacao/<?php echo $dadosNomeExpertise['codExpertise'] ?>/' title='Deseja <?php echo $statusPergunta ?> a expertise <?php echo $dadosNomeExpertise['nomeExpertise'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>site/expertise/alterar/<?php echo $dadosNomeExpertise['codExpertise'] ?>/' title='Deseja alterar a expertise <?php echo $dadosNomeExpertise['nomeExpertise'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar-branco.gif" alt="icone" /></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomeExpertise['codExpertise'] ?>, "<?php echo htmlspecialchars($dadosNomeExpertise['nomeExpertise']) ?>");' title='Deseja excluir a expertise <?php echo $dadosNomeExpertise['nomeExpertise'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
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
				if($_POST['codAlterTipo'] != "" && $_POST['tipoAlterTipo'] != ""){
					$sqlAltera = "UPDATE expertiseImagens SET tipoExpertiseImagem = '".$_POST['tipoAlterTipo']."' WHERE codExpertiseImagem = ".$_POST['codAlterTipo']."";
					$resultAltera = $conn->query($sqlAltera);
				}
				
				if(isset($_POST['cadastrar'])){
					
					$exclusao = "";
					
					if($_POST['cont'] >  0){
												
						for($i=0; $i<=$_POST['cont']; $i++){
							$contadorDel = "excluir".$i;
							if(isset($_POST[$contadorDel])){
								$exclusao = "ok";
								$sqlConsultaDelete = "SELECT * FROM expertiseImagens WHERE codExpertiseImagem = ".$_POST[$contadorDel];
								$resultConsultaDelete = $conn->query($sqlConsultaDelete);
								$dadosConsultaDelete = $resultConsultaDelete->fetch_assoc();
								
								$sqlDelete = "DELETE FROM expertiseImagens WHERE codExpertiseImagem = ".$_POST[$contadorDel];
								$resultDelete = $conn->query($sqlDelete);
								if(file_exists("f/expertise/".$dadosConsultaDelete['codExpertise']."-".$dadosConsultaDelete['codExpertiseImagem']."-O.".$dadosConsultaDelete['extExpertiseImagem'])){
									unlink("f/expertise/".$dadosConsultaDelete['codExpertise']."-".$dadosConsultaDelete['codExpertiseImagem']."-O.".$dadosConsultaDelete['extExpertiseImagem']);
									unlink("f/expertise/".$dadosConsultaDelete['codExpertise']."-".$dadosConsultaDelete['codExpertiseImagem']."-W.webp");
								}
							
								if($resultDelete == 1){
									$noErros = "ok";
								}
							}
						}
					}
					
					if($exclusao == ""){
						
						$pastaDestino = "f/expertise/";
											
						$file = $_FILES['imagem'];
						$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
							
						if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])){	
							
							$file_name = uniqid() . '.' . $ext;							
															
							$sqlExpertise = "SELECT * FROM expertise WHERE codExpertise = ".$url[6]." ORDER BY codExpertise DESC LIMIT 0,1";
							$resultExpertise = $conn->query($sqlExpertise);
							$dadosExpertise = $resultExpertise->fetch_assoc();
															
							$sql =  "INSERT INTO expertiseImagens VALUES(0, ".$url[6].", 'I', '".$ext."')";
							$result = $conn->query($sql);
													
							if($result == 1){

								function saveWebPImage($original_image, $new_image_path, $quality = 100) {
									if (imagewebp($original_image, $new_image_path, $quality)) {
										return true;
									} else {
										return false;
									}
								}
																
								$sqlNome = "SELECT * FROM expertiseImagens ORDER BY codExpertiseImagem DESC";
								$resultNome = $conn->query($sqlNome);
								$dadosNome = $resultNome->fetch_assoc();
								
								$codExpertiseImagem = $dadosNome['codExpertiseImagem'];
								$codExpertise = $dadosNome['codExpertise'];
								$nomeExpertiseImagem = $dadosNome['nomeExpertiseImagem'];
								
								move_uploaded_file($file['tmp_name'], $pastaDestino.$codExpertise."-".$codExpertiseImagem."-O.".$ext);
								
								chmod ($pastaDestino.$codExpertise."-".$codExpertiseImagem."-O.".$ext, 0755);
								
								if($ext != "svg"){
																
									$imagemWebP = $pastaDestino.$codExpertise."-".$codExpertiseImagem."-W.webp";

									switch ($ext) {
										case 'jpg':
										case 'jpeg':
										$original_image = imagecreatefromjpeg($pastaDestino.$codExpertise."-".$codExpertiseImagem."-O.".$ext);
										break;
										case 'png':
										$original_image = imagecreatefrompng($pastaDestino.$codExpertise."-".$codExpertiseImagem."-O.".$ext);
										break;
										case 'gif':
										$original_image = imagecreatefromgif($pastaDestino.$codExpertise."-".$codExpertiseImagem."-O.".$ext);
										break;
									}

									saveWebPImage($original_image, $imagemWebP, 95);

									imagedestroy($original_image);

									chmod ($pastaDestino.$codExpertise."-".$codExpertiseImagem."-W.webp", 0755);						
								
								}		
														
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

						<form action="<?php echo $configUrlGer; ?>site/expertise/imagens/<?php echo $url[6];?>/" enctype="multipart/form-data" method="post">
							<p class="aviso" style="color:#718B8F; margin-bottom:20px; font-size:15px;"><label style="color:#FF0000;">Observação:</label>As extensões permitidas estão listadas abaixo;<br/>Tamanho recomendado está listado abaixo;<br/>Para cadastrar imagens, clique em escolher arquivo e selecione uma ou mais imagens e clique em salvar;<br/>As imagens são salvas automaticamente;<br/>Para excluir as imagens, selecione a imagem e clique no botão excluir;</p>
							
							<p class="bloco-campo"><label class="label" style="font-size:15px; line-height:20px; font-weight:normal;"><strong>Extensão:</strong> png, jpg, jpeg ou svg<br/><strong>Ícone:</strong> SVG | <strong>Banner:</strong> 1920px x 600px</labeL>
							<input class="campo" type="file" name="imagem" style="width:400px; margin-top:10px;" value="" /></p>
							
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar" value="Salvar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
							<br/>
							<br/>
							<div class="lista-imagens">
<?php
				$sqlRegistro = "SELECT * FROM expertiseImagens WHERE codExpertise = ".$url[6]."";
				$resultRegistro = $conn->query($sqlRegistro);
				$dadosRegistro = $resultRegistro->fetch_assoc();
				$registros = mysqli_num_rows($resultRegistro);
				
				  
				$pagina = $url[7];
				if($pagina == 1 || $pagina == "" ){
					$sqlConsulta = "SELECT * FROM expertiseImagens WHERE codExpertise = ".$url[6]." ORDER BY tipoExpertiseImagem ASC, codExpertiseImagem ASC LIMIT 0, 14";
					$somaLimite = "14";
					$pgInicio = "0";		
				}else{
					$somaLimite = $pagina * 14;
					$pgInicio = $somaLimite - 14;
					$sqlConsulta = "SELECT * FROM expertiseImagens WHERE codExpertise = ".$url[6]." ORDER BY tipoExpertiseImagem ASC, codExpertiseImagem ASC LIMIT ".$pgInicio.", 14";
				}

				$cont = 0;

				$resultConsulta = $conn->query($sqlConsulta);
				while($dadosImagem = $resultConsulta->fetch_assoc()){
					$mostrando = $mostrando + 1;		
?>       
								<div class="imagem" style="width:300px; height:200px; margin-right:30px;">
									<p style="width:300px; height:142px; display:table-cell; vertical-align:middle;"><img src="<?php echo $configUrl."f/expertise/".$dadosImagem['codExpertise'].'-'.$dadosImagem['codExpertiseImagem'].'-O.'.$dadosImagem['extExpertiseImagem'];?>" alt="Imagem Expertise" width="150"/><br/></p>
									<label>
										<select class="campo" id="select<?php echo $dadosImagem['codExpertiseImagem'];?>" style="width:200px; text-align:center; margin-bottom:10px; margin-top:10px;" onChange="mudaStatus(<?php echo $dadosImagem['codExpertiseImagem'];?>, this.value);">
											<option value="I" <?php echo $dadosImagem['tipoExpertiseImagem'] == "I" ? '/SELECTED/' : '';?> >Ícone</option>
											<option value="B" <?php echo $dadosImagem['tipoExpertiseImagem'] == "B" ? '/SELECTED/' : '';?> >Banner</option>
										</select>
									</label>
									<label><input type="checkbox" name="excluir<?php echo $cont; ?>" value="<?php echo $dadosImagem['codExpertiseImagem']; ?>" /> Excluir</label>
								</div>			
<?php
					$cont = $cont + 1;
				}
?>
								<input type="hidden" name="cont" value="<?php echo $cont; ?>" />
							</div>
						</form>
						<script type="text/javascript">
							function mudaStatus(cod, tipo){
								document.getElementById("codAlterTipo").value=cod;
								document.getElementById("tipoAlterTipo").value=tipo;
								document.getElementById("alteraStatus").submit();
							}
						</script>
						<form id="alteraStatus" action="<?php echo $configUrlGer; ?>site/expertise/imagens/<?php echo $url[6];?>/" method="post">
							<input type="hidden" value="" id="tipoAlterTipo" name="tipoAlterTipo"/>
							<input type="hidden" value="" id="codAlterTipo" name="codAlterTipo"/>
						</form>
					</div>
					<br class="clear" />
					<br/>
 <?php
				if($erro == "ok"){
					$_SESSION['erroDados'] = ""; 
					
					
				}
				$regPorPag = 14;
				$area = "site/expertise/imagens/".$url[6];
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
