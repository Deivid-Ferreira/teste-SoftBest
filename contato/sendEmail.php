<?php
	session_start();
	
	include('../f/conf/config.php');
	include('../f/conf/functions.php');

	require '../vendor/autoload.php';

	$token = $_POST['token'];
	$action = $_POST['action'];
	
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => $chaveSecreta,
		'response' => $token
	);
	  
	// call curl to POST request
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$arrResponse = json_decode($response, true);
	  
	// verify the response

	if($arrResponse["success"] == true && $arrResponse["score"] >= 0.5){
					
		$assunto = "Contato";

		$sqlEmail = "SELECT * FROM emails WHERE statusEmail = 'T' LIMIT 0,1";
		$resultEmail = $conn->query($sqlEmail);
		$dadosEmail = $resultEmail->fetch_assoc();

		$emailRemetente = $dadosEmail['enderecoEmail'];
		$senhaRemetente = $dadosEmail['senhaEmail'];

		$mailer = new PHPMailer\PHPMailer\PHPMailer();
		$mailer->IsSMTP();
		$mailer->SMTPDebug = 0;
		$mailer->Port = 587;			 
		$mailer->Host = $hostEmail;
		$mailer->SMTPAuth = true;
		$mailer->Username = $emailRemetente;
		$mailer->Password = $senhaRemetente;
		//~ $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mailer->IsHTML(true);
		$mailer->CharSet = 'utf-8';

		$nome = $_POST['nome'];
		$emailC = $_POST['email'];
		$celular = $_POST['celular'];
		$descricao = $_POST['descricao'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];

		$nomeRemetente = $nomeEmpresaMenor;
		$nomeDestino = $nomeEmpresaMenor;
		$emailDestino = $email;
							
		include ('corpo-email.php');

		$mailer->setFrom($emailRemetente, $nomeRemetente);
		$mailer->AddAddress($emailDestino, $nomeDestino);
		$mailer->Subject = $assunto;
		$mailer->Body = $conteudoEmailEmpresa;
		$mailer->Send();
		$mailer->ClearAllRecipients();
		$mailer->ClearAttachments();

		if($emailC != ""){
			
			$nomeRemetente = $nomeEmpresaMenor;
			$nomeDestino = $nomeEmpresaMenor;
			$emailDestino = $emailC;

			include ('corpo-email.php');

			$mailer->setFrom($emailRemetente, $nomeRemetente);
			$mailer->AddAddress($emailDestino, $nomeDestino);
			$mailer->Subject = $assunto;
			$mailer->Body = $conteudoEmailCliente;
			$mailer->Send();
			$mailer->ClearAllRecipients();
			$mailer->ClearAttachments();
		
		}

		$sql =  "INSERT INTO contatos VALUES(0, '".$assunto."', '".date("Y-m-d")."', '".$_POST['nome']."', '".$_POST['email']."', '".$_POST['cidade']."', '".$_POST['estado']."', '".$_POST['celular']."', '".$_POST['descricao']."', 'T')";
		$result = $conn->query($sql);
		
		if($result == 1){
			$_SESSION['nome'] = $_POST['nome'];
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."contato/enviado-com-sucesso/'>";										
		}else{
			$_SESSION['erro'] = "<p class='erro'>Problemas ao enviar contato!</p>";
		}
		
	}else{
		$_SESSION['erro'] = "<p class='erro'>Problemas ao verificar Captcha, atualize a página e tente novamente!</p>";
	}		
?>
