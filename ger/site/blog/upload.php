<?php
	include('../../f/conf/config.php');

	$pastaDestino = $_SERVER['DOCUMENT_ROOT'].$urlUpload.'/f/blog/';
	
	$codBlog = $_POST['codBlog'];

	function saveWebPImage($original_image, $new_image_path, $quality = 100) {
		if (imagewebp($original_image, $new_image_path, $quality)) {
			return true;
		} else {
			return false;
		}
	}
									
	foreach ($_FILES['arquivo']['tmp_name'] as $index => $tmp_name) {

		if (!is_uploaded_file($tmp_name)) {
			continue;
		}
		  
		$file_name = $_FILES['arquivo']['name'][$index];
		$file_type = $_FILES['arquivo']['type'][$index];
		$file_size = $_FILES['arquivo']['size'][$index];

		if (strpos($file_type, 'image') === false) {
			continue;
		}

		$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
  
		if(in_array($ext, ['jpg', 'jpeg', 'png', 'svg'])){	
			
			$file_name = uniqid().'.'.$ext;							
				
			$sqlBlog = "INSERT INTO blogImagens VALUES(0, ".$codBlog.", 'F', '".$ext."')";
			$resultBlog = $conn->query($sqlBlog);	

			$sqlPegaBlog = "SELECT codBlogImagem FROM blogImagens ORDER BY codBlogImagem DESC LIMIT 0,1";
			$resultPegaBlog = $conn->query($sqlPegaBlog);
			$dadosPegaBlog = $resultPegaBlog->fetch_assoc();
						
			$codBlogImagem = $dadosPegaBlog['codBlogImagem'];
				
			move_uploaded_file($tmp_name, $pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
							
			chmod($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext, 0755);
			
			if($ext != "svg"){
							   
				$imagemWebP = $pastaDestino.$codBlog."-".$codBlogImagem."-W.webp";

				switch ($ext) {
					case 'jpg':
					case 'jpeg':
					$original_image = imagecreatefromjpeg($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
					break;
					case 'png':
					$original_image = imagecreatefrompng($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
					break;
					case 'gif':
					$original_image = imagecreatefromgif($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
					break;
				}

				saveWebPImage($original_image, $imagemWebP, 95);
				imagedestroy($original_image);

				chmod($pastaDestino.$codBlog."-".$codBlogImagem."-W.webp", 0755);								
			}

		}else{
			$erroExt = "erro";
		}
	}

	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."site/blog/imagens/".$codBlog."/'>";		
?>
