<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "blog";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($url[5] != ""){
					
					echo "<div id='filtro'>";
						echo "<p style='margin:20px; font-size:20px;'><img style='margin-right:10px;' src='".$configUrl."f/i/default/corpo-default/loading.gif' alt='Loading' />Excluindo...</p>";
					echo "</div>";			

					$sqlCons = "SELECT nomeBlog FROM blog WHERE codBlog = ".$url[6]." LIMIT 0,1";
					$resultCons = $conn->query($sqlCons);
					$dadosCons = $resultCons->fetch_assoc();

					$sqlExcluiImagens = "SELECT * FROM blogImagens WHERE codBlog = ".$url[6]." ORDER BY codBlogImagem ASC";
					$resultExcluiImagens = $conn->query($sqlExcluiImagens);
					while($dadosExcluiImagens = $resultExcluiImagens->fetch_assoc()){
						
						if(file_exists("f/blog/".$dadosExcluiImagens['codBlog']."-".$dadosExcluiImagens['codBlogImagem']."-O.".$dadosExcluiImagens['extBlogImagem'])){
							unlink("f/blog/".$dadosExcluiImagens['codBlog']."-".$dadosExcluiImagens['codBlogImagem']."-O.".$dadosExcluiImagens['extBlogImagem']);
							unlink("f/blog/".$dadosExcluiImagens['codBlog']."-".$dadosExcluiImagens['codBlogImagem']."-W.webp");
						}
							
					}

					$sql =  "DELETE FROM blogImagens WHERE codBlog = ".$url[6];
					$result = $conn->query($sql);
										
					$sql =  "DELETE FROM blog WHERE codBlog = ".$url[6];
					$result = $conn->query($sql);

					echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."site/blog/'>";

				}else{
					echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."site/blog/'>";
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
