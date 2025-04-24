<?php
	ob_start();
	session_start();

	include ('f/conf/config.php');
	include ('f/conf/functions.php');

	$url = explode("/", $aux.$_SERVER['REQUEST_URI']);

	$quebraUrl2 = explode("=", $url[2]);
	$quebraUrl3 = explode("=", $url[3]);
	$quebraUrl4 = explode("=", $url[4]);

	if($quebraUrl2[0] == "?fbclid" || $quebraUrl2[0] == "?gclid" || $quebraUrl2[0] == "?gtm_debug"){
		$url[2] = "";
		$url[3] = "";
		$url[4] = "";
	}
	if($quebraUrl3[0] == "?fbclid" || $quebraUrl3[0] == "?gclid" || $quebraUrl3[0] == "?gtm_debug" || $quebraUrl3[0] == "?numero"){
		$url[3] = "";
		$url[4] = "";
	}
	if($quebraUrl4[0] == "?fbclid" || $quebraUrl4[0] == "?gclid" || $quebraUrl4[0] == "?gtm_debug" || $quebraUrl4[0] == "?numero"){
		$url[4] = "";
	}

	include ('f/conf/titles.php');
	
	if($url[4] != ""){
		$arquivoRetornar = $url[2].'/'.$url[3].'/'.$url[4].'/';
			if(is_numeric($url[4])){
				if(file_exists($url[2].'/'.$url[3].'/conteudo.php')){
					$arquivo = $url[2].'/'.$url[3].'/conteudo.php';
				}else
					if(file_exists($url[2].'/'.$url[3].'/detalhes.php')){
						$arquivo = $url[2].'/'.$url[3].'/detalhes.php';
					}else
						if(file_exists($url[2].'/'.$url[3].'.php')){
							$arquivo = $url[2].'/'.$url[3].'.php';
						}else
							if(file_exists($url[2].'/conteudo.php')){
								$arquivo = $url[2].'/conteudo.php';
							}else{
								$arquivo = '404/conteudo.php';
							}
					
			}else
				if(file_exists($url[2].'/detalhes.php') && $url[2] == "areas-de-atuacao"){
					$arquivo = $url[2].'/detalhes.php';
				}else
					if(file_exists($url[2].'/conteudo.php')){
						$arquivo = $url[2].'/conteudo.php';
					}else
						if(file_exists($url[2].'/'.$url[3].'/'.$url[4].'.php')){
							$arquivo = $url[2].'/'.$url[3].'/'.$url[4].'.php';
						}else{
							$arquivo = '404/conteudo.php';
						}
	}else
		if($url[3] != ""){
			$arquivoRetornar = $url[2].'/'.$url[3].'/';
			
			if(is_numeric($url[3])){
				if(file_exists($url[2].'/conteudo.php')){
					$arquivo = $url[2].'/conteudo.php';
				}else										
					if(file_exists($url[2].'/conteudo.php')){
						$arquivo = $url[2].'/conteudo.php';
					}
			}else	
				if($url[3] == "contato-whatsapp-enviado"){
					$arquivo = 'contato-whatsapp-enviado.php';
				}else															
				if(file_exists($url[2].'/'.$url[3].'/conteudo.php')){
					$arquivo = $url[2].'/'.$url[3].'/conteudo.php';																						
				}else
					if(file_exists($url[2].'/detalhes.php')){
						$arquivo = $url[2].'/detalhes.php';												
					}else								
						if(file_exists($url[2].'/'.$url[3].'.php')){
							$arquivo = $url[2].'/'.$url[3].'.php';
						}else
							if(file_exists($url[2].'/conteudo.php')){
								$arquivo = $url[2].'/conteudo.php';
							}else
								if($url[2] == "busca"){
									$arquivo = $url[2].'/conteudo.php';
								}else{
									$arquivo = '404/conteudo.php';
								}
				
		}else
			if($url[2] != ""){
				$arquivoRetornar = $url[2].'/';

				if($url[2] == "contato-whatsapp-enviado"){
					$arquivo = 'contato-whatsapp-enviado.php';
				}else								
				if(file_exists($url[2].'/conteudo.php')){
					$arquivo = $url[2].'/conteudo.php';
				}else
					if(file_exists($url[2].'.php')){
						$arquivo = $url[2].'.php';
					}else{
						$arquivo = '404/conteudo.php';
					}	
			}else
				if($url[2] == ""){
					$arquivoRetornar = "";
					
					$arquivo = 'capa/conteudo.php';
				}else{
					$arquivo = '404/conteudo.php';
				}							
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
	<head>
		<title><?php echo $title;?></title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="author" content="SoftBest" />
		<meta name="description" content="<?php echo $description;?>" />
		<meta name="keywords" content="<?php echo $keywords;?>" />
		<meta name="language" content="<?php echo $linguagem;?>"/>
		<meta name="city" content="<?php echo $cidade;?>"/>
		<meta name="state" content="<?php echo $estado;?>"/>
		<meta name="country" content="<?php echo $pais;?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">		
		<meta name="theme-color" content="#364349">
		<meta name="apple-mobile-web-app-status-bar-style" content="#364349">
		<meta name="msapplication-navbutton-color" content="#364349">		
<?php
	if($arquivo != "404/conteudo.php"){
?>
		<meta name="robots" content="index,follow"/>	
<?php
	}else{
?>
		<meta name="robots" content="noindex">
<?php
	}
?>
		
		<link rel="canonical" href="<?php echo $dominio;?>/<?php echo $arquivoRetornar;?>" />	
		<link rel="shortcut icon" href="<?php echo $configUrl;?>f/i/icon.png" />
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrl;?>f/c/estilo.css" media="all" title="Layout padrão" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">	
	
		<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $chaveSite;?>"></script>
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/jquery.js"></script>			
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/mascaras.js"></script>		
		
<?php
	if($configUrlSeg != ""){
?>		
		
		 <script>
		  var ua = navigator.userAgent.toLowerCase();

		  var uMobile = '';

		  //Lista de dispositivos que Ã© possÃ­vel acessar
		  uMobile = '';
		  uMobile += 'iphone;ipod;ipad;windows phone;android;iemobile 8';

		  //Separa os itens em arrays
		  v_uMobile = uMobile.split(';');

		  //verifica se vocÃª estÃ¡ acessando pelo celular
		  var boolMovel = false;
		  for (i=0;i<=v_uMobile.length;i++)
		  {
		  if (ua.indexOf(v_uMobile[i]) != -1)
		  {
		  boolMovel = true;
		  }
		  }

		  if (boolMovel == true)
		  {
		   location.href="<?php echo $configUrlSeg.$arquivoRetornar.$ancora;?>";	  			  
		  }else{
		  }
		 </script>		
						
<?php
	}
		
	if($url[2] != ""){
?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" />
		<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>
		<script>
		lightbox.option({
		  'resizeDuration': 200,
		  'wrapAround': true
		  })
		</script>
<?php	
	}
	
	if($url[2] == "expertise" && $url[3] != ""){
?>		
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.theme.default.min.css">
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/jquery.min.js"></script>
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/owl.carousel.js"></script>	
<?php
	}else
	if($url[2] == ""){	
?>
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.theme.default.min.css">
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/jquery.min.js"></script>
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/owl.carousel.js"></script>					
<?php
	}		
?>
		<meta property="og:title" content="<?php echo $title;?>"/>
		<meta property="og:image" content="<?php echo $configUrl;?>f/i/comp.png"/>
		<meta property="og:description" content="<?php echo $description;?>"/>
		<meta property="og:url" content="<?php echo $configUrl.$arquivoRetornar;?>"/>
		<link href="<?php echo $configUrl;?>f/i/comp.png" rel="image_src" />

<?php 
	$dominio = "http://".$_SERVER['SERVER_NAME']."/priscila-marinho/";
?>

<style type="text/css">
@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-Thin.otf') format('opentype');
  font-weight: 100;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-ExtraLight.otf') format('opentype');
  font-weight: 200;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-Light.otf') format('opentype');
  font-weight: 300;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-Regular.otf') format('opentype');
  font-weight: 400;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-Medium.otf') format('opentype');
  font-weight: 500;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-SemiBold.otf') format('opentype');
  font-weight: 600;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-Bold.otf') format('opentype');
  font-weight: 700;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-ExtraBold.otf') format('opentype');
  font-weight: 800;
  font-style: normal;
}

@font-face {
  font-family: 'Metropolis';
  src: url('<?php echo $dominio; ?>f/i/fonte/Metropolis-Black.otf') format('opentype');
  font-weight: 900;
  font-style: normal;
}
	* {
		font-family: 'Metropolis', sans-serif;
	}
</style>

		
<?php
	$tagsHead = str_replace("&#39;", "'", $tagsHead);
	echo html_entity_decode($tagsHead);
?>				
	</head>
<?php
	if(isset($_COOKIE['politica'.$cookie]) == ""){
		$load = "onLoad='fadeInPolitica(); carregaBanner();'";
	}else{
		$load = "onLoad='carregaBanner();'";
	}	
?>	
	<body <?php echo $load;?>>
<?php
	$tagsBody = str_replace("&#39;", "'", $tagsBody);
	echo html_entity_decode($tagsBody);
	
?>
		<div id="tudo">
		<p class="botao-whatsapp"><a class="one" target="_blank" title="Converse com a gente através do WhatsApp!"  onClick="abrirAcesso();">Entre em contato!<br /><?php echo $celular; ?></a></p>
<?php				
	$celularWhats = str_replace("(", "", $celular); 
	$celularWhats = str_replace(")", "", $celularWhats); 
	$celularWhats = str_replace(" ", "", $celularWhats); 
	$celularWhats = str_replace("-", "", $celularWhats); 
	
	$telefoneWhats = str_replace("(", "", $telefone); 
	$telefoneWhats = str_replace(")", "", $telefoneWhats); 
	$telefoneWhats = str_replace(" ", "", $telefoneWhats); 
	$telefoneWhats = str_replace("-", "", $telefoneWhats); 
			
	$mensagemWhats ="Olá, vim através do site e gostaria de solicitar um contato!";
	$retornoWhats = $configUrl.$arquivoRetornar;

	if($url[2] == ""){
?>							
			<script type="text/javascript">
				var $gh2 = jQuery.noConflict();
				$gh2(document).ready(function(){
					$gh2(window).scroll(function(){
						if($gh2(this).scrollTop() >= 50){
							$gh2("#topo").removeClass("normal").addClass("scroll");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";
						}else{
							$gh2("#topo").removeClass("scroll").addClass("normal");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
						}
					});
				});

				$gh2(window).scroll(function(){
					if($gh2(this).scrollTop() >= 50){
						$gh2("#topo").removeClass("normal").addClass("scroll");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";							
					}else{
						$gh2("#topo").removeClass("scroll").addClass("normal");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
					}
				});					
			</script>
			<div id="topo" class="normal" > 
<?php
	}else{
?>				
			<script type="text/javascript">
				var $gh2 = jQuery.noConflict();
				$gh2(document).ready(function(){
					$gh2(window).scroll(function(){
						if($gh2(this).scrollTop() >= 50){
							$gh2("#topo").removeClass("interno").addClass("scroll");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";								
						}else{
							$gh2("#topo").removeClass("scroll").addClass("interno");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
						}
					});
				});

				$gh2(window).scroll(function(){
					if($gh2(this).scrollTop() >= 50){
						$gh2("#topo").removeClass("interno").addClass("scroll");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";														
					}else{
						$gh2("#topo").removeClass("scroll").addClass("interno");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
					}
				});					
			</script>
			<div id="topo" class="interno" > 
<?php
	}	
	include ('capa/topo.php');
?>
			</div>		
			<div id="conteudo">
<?php
	include ($arquivo);
?>
			</div>
			<div id="rodape">
<?php
	include ('capa/rodape.php');
?>
			</div>
				<script type="text/javascript">
					function retiraCaptcha(){
						var $gt = jQuery.noConflict();
						$gt(".grecaptcha-badge").fadeOut("slow");
					}
					setTimeout("retiraCaptcha();", 2000);
				</script>
			</div>		
			<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/wow.min.js"></script>			
			<script>
				new WOW().init();
			</script>			
		</div>
	</body>
</html>
<?php
	$conn->close();
?>
