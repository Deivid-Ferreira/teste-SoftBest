<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "categorias";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($url[7] != ""){
					
					$sqlCons = "SELECT nomeSubCategoria, statusSubCategoria FROM subCategorias WHERE codSubCategoria = ".$url[8]." LIMIT 0,1";
					$resultCons = $conn->query($sqlCons);
					$dadosCons = $resultCons->fetch_assoc();
				
					echo "<div id='filtro'>";
				
					if($dadosCons['statusSubCategoria'] == "T"){
						echo "<p style='margin:20px; font-size:20px;'><img style='margin-right:10px;' src='".$configUrl."f/i/default/corpo-default/loading.gif' alt='Loading' />Desativando...</p>";
					}else{
						echo "<p style='margin:20px; font-size:20px;'><img style='margin-right:10px;' src='".$configUrl."f/i/default/corpo-default/loading.gif' alt='Loading' />Ativando...</p>";
					}
					echo "</div>";
				
					if($dadosCons['statusSubCategoria'] == "T"){
						$alteraStatus = "F";
						$_SESSION['acao'] = "desativada";
					}else{
						$alteraStatus = "T";
						$_SESSION['acao'] = "ativada";
					}
					
					$sql =  "UPDATE subCategorias SET statusSubCategoria = '".$alteraStatus."' WHERE codSubCategoria = ".$url[8];
					$result = $conn->query($sql);
				
					if($result == 1){
						$_SESSION['nome'] = $dadosCons['nomeSubCategoria'];
						$_SESSION['ativacao'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/categorias/subCategorias/".$url[6]."/'>";
					}
				}else{
					echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/categorias/subCategorias/".$url[6]."/'>";
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
