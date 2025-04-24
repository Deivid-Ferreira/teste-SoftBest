<?php
	session_start();
	
	include('f/conf/config.php');
	include('f/conf/functions.php');

	require 'vendor/autoload.php';

	$token = $_POST['token'];
	$action = $_POST['action'];

	 $area = $_POST['area-msg'];
	  
	 if($_POST['especializacao-msg'] != ""){
		$especializacao = " - ".$_POST['especializacao-msg'];
	 }

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
		$assunto = "Área de Atuação - " .$_POST['nomeArea'];
		
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

		$nome = $_POST['nomeContato'];
		$celular = $_POST['celularContato'];
		$mensagem = $_POST['mensagemContato'];

		$nomeRemetente = $nomeEmpresaMenor;
		$nomeDestino = $nomeEmpresaMenor;
		$emailDestino = $email;
							
		include ('corpo-email-contato.php');

		$mailer->setFrom($emailRemetente, $nomeRemetente);
		$mailer->AddAddress($emailDestino, $nomeDestino);
		$mailer->Subject = $assunto;
		$mailer->Body = $conteudoEmailEmpresa;
		$mailer->Send();
		$mailer->ClearAllRecipients();
		$mailer->ClearAttachments();

		$sql =  "INSERT INTO contatos VALUES(0, '".$assunto."', '".date("Y-m-d")."', '".$_POST['nomeContato']."', '".$_POST['emailContato']."', '', '', '".$_POST['celularContato']."', '".$_POST['mensagemContato']."', 'T')";
		$result = $conn->query($sql);
		
		if($result == 1){
			$_SESSION['nome'] = $_POST['nomeContato'];
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."contato/enviado-com-sucesso/'>";										
		}else{
			$_SESSION['erro'] = "<p class='erro'>Problemas ao enviar contato!</p>";
		}			
		
	}else{
		$_SESSION['erro'] = "<p class='erro'>Problemas ao verificar Captcha, atualize a página e tente novamente!</p>";
	}		
?>
