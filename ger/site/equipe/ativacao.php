<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "equipe";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){
				
				if($url[5] != ""){
				
					$sqlCons = "SELECT nomeEquipe, statusEquipe FROM equipe WHERE codEquipe = ".$url[6]." LIMIT 0,1";
					$resultCons = $conn->query($sqlCons);
					$dadosCons = $resultCons->fetch_assoc();
					
					echo "<div id='filtro'>";
				
					if($dadosCons['statusEquipe'] == "T"){
						echo "<p style='margin:20px; font-size:20px;'><img style='margin-right:10px;' src='".$configUrl."f/i/default/corpo-default/loading.gif' alt='Loading' />Desativando...</p>";
					}else{
						echo "<p style='margin:20px; font-size:20px;'><img style='margin-right:10px;' src='".$configUrl."f/i/default/corpo-default/loading.gif' alt='Loading' />Ativando...</p>";
					}
					
					echo "</div>";
					
					if($dadosCons['statusEquipe'] == "T"){
						$alteraStatus = "F";
						$_SESSION['acao'] = "desativado";
					}else{
						$alteraStatus = "T";
						$_SESSION['acao'] = "ativado";
					}
					
					$sql =  "UPDATE equipe SET statusEquipe = '".$alteraStatus."' WHERE codEquipe = ".$url[6];
					$result = $conn->query($sql);
				
					if($result == 1){
						$_SESSION['nome'] = $dadosCons['nomeEquipe'];
						$_SESSION['ativacao'] = "ok";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/equipe/'>";
					}
				
				}else{
					echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."site/equipe/'>";
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
