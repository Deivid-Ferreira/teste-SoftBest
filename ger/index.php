<?php
ob_start();
session_start();

date_default_timezone_set('America/Sao_Paulo');


include ('f/conf/config.php');
include ('f/conf/functions.php');
include ('f/conf/controleAcesso.php');

if($_COOKIE['loginAprovado'.$cookie] != ""){
 
if($controleUsuario == "tem usuario"){

$url = explode("/", $aux.$_SERVER['REQUEST_URI']);

	if($url[10] != ""){
		$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/'.$url[10].'/';
		
		if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/'.$url[10].'/conteudo.php')){
			$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/'.$url[10].'/conteudo.php';
		}else
			if(is_numeric($url[10])){
				if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/'.$url[9].'.php')){
					$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/'.$url[9].'.php';
				}else
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php';
					}
			}else
				if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php')){
					$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php';
				}else
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php';
						}
					
	}else		
		if($url[9] != ""){
			$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/';
			
			if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/conteudo.php')){
				$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/conteudo.php';
			}else
				if(is_numeric($url[9])){
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[8].'.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[8].'.php';
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php';
						}
				}else
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php';
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php';
							}
						
		}else		
			if($url[8] != ""){
								
				$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/';
				
				if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/conteudo.php')){
					$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/conteudo.php';
				}else
					if(is_numeric($url[8])){
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'.php';
							}
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
							}else
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php';
								}
							
 			}else		
				if($url[7] != ""){
															
					$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/';

					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/conteudo.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/conteudo.php';
					}else
						if(is_numeric($url[7])){
							if($url[4] == "cheques"){
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
								}
							}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
							}else								
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
								}
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
							}else
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php';
								}else
									if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'.php')){
										$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'.php';
									}
				}else		
					if($url[6] != ""){
						$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/';


						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/conteudo.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/conteudo.php';
						}else
							if(is_numeric($url[6])){
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
								}else
									if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php')){
										$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php';
									}else
									if(file_exists($url[3].'/'.$url[5].'/conteudo.php')){
										$arquivo = $url[3].'/'.$url[5].'/conteudo.php';
									}else
									if(file_exists($url[3].'/'.$url[4].'.php')){
										$arquivo = $url[3].'/'.$url[4].'.php';
									}else
										if(file_exists('administrativo/contratos/consultas/conteudo.php')){
											$arquivo = 'administrativo/contratos/consultas/conteudo.php';
										}else
											if(file_exists($url[3].'/'.$url[4].'/detalhes.php')){
												$arquivo = $url[3].'/'.$url[4].'/detalhes.php';
											}
							}else
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php';
								}else
									if(file_exists($url[3].'/'.$url[4].'/detalhes.php')){
										$arquivo = $url[3].'/'.$url[4].'/detalhes.php';
									}else
										if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
											$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
										}else
											if(file_exists($url[3].'/dados-registro/detalhes.php')){
												$arquivo = $url[3].'/dados-registro/detalhes.php';
											}
										
					}else
						if($url[5] != ""){
							$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/';


							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php';
							}else
								if(is_numeric($url[5])){
									if(file_exists($url[3].'/'.$url[4].'/conteudo.php')){
										$arquivo = $url[3].'/'.$url[4].'/conteudo.php';
									}else
										if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
											$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
										}else
											if(file_exists($url[3].'/detalhes.php')){
												$arquivo = $url[3].'/detalhes.php';
											}else
												if(file_exists($url[2].'/detalhes.php')){
													$arquivo = $url[2].'/detalhes.php';
												}
								}else
									if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php')){
										$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php';
									}else
										if(file_exists($url[3].'/dados-registro/detalhes.php')){
											$arquivo = $url[3].'/dados-registro/detalhes.php';
										}else
											if(file_exists($url[3].'/detalhes.php')){
												$arquivo = $url[3].'/detalhes.php';
											}else
												if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
													$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
												}else
												if(file_exists($url[2].'/dados-produto.php')){
													$arquivo = $url[2].'/dados-produto.php';
												}
						}else		
							if($url[4] != ""){
								$arquivoRetornar = $url[3].'/'.$url[4].'/';


								if($url[4] == "financeiro-geral"){
									$arquivo = $url[3].'/financeiros-geral/conteudo.php';
								}else
								if(file_exists($url[3].'/'.$url[4].'/conteudo.php')){
									$arquivo = $url[3].'/'.$url[4].'/conteudo.php';
								}else
									if(is_numeric($url[4])){
										if(file_exists($url[3].'/conteudo.php')){
											$arquivo = $url[3].'/conteudo.php';
										}else
											if(file_exists($url[2].'/detalhes.php')){
												$arquivo = $url[2].'/detalhes.php';
											}
											
									}else
										if(file_exists($url[3].'/'.$url[4].'.php')){
											$arquivo = $url[3].'/'.$url[4].'.php';
										}else
											if(file_exists($url[2].'/detalhes.php')){
													$arquivo = $url[2].'/detalhes.php';
											}else
												if(file_exists($url[2].'/detalhes.php')){
													$arquivo = $url[2].'/detalhes.php';
												}else
													if(file_exists($url[3].'/'.$url[4].'.php')){
														$arquivo = $url[3].'/'.$url[4].'.php';
													}
										
								}else
									if($url[3] != ""){
									$arquivoRetornar = $url[3].'/';
									
											if(file_exists($url[3].'/conteudo.php')){
												$arquivo = $url[3].'/conteudo.php';
											}else
												if(file_exists($url[3].'.php')){
													$arquivo = $url[3].'.php';
												}	
									}else
										if($url[3] == ""){
											$arquivoRetornar = "";


											$arquivo = 'site/contatos/conteudo.php';
										}else{
											$arquivo = '404/conteudo.php';
										}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $nomeEmpresa;?></title>

        <link rel="shortcut icon" href="<?php echo $configUrlGer;?>f/i/icon.png" />
        <link rel="stylesheet" href="<?php echo $configUrlGer;?>f/c/estilo.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo $configUrlGer;?>f/c/maikeu.css" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrlGer;?>f/j/auto_complete_softbest/auto_complete_softbest.css" media="all" title="Layout padrão" />

		<script type="text/javascript" src="<?php echo $configUrlGer;?>f/j/auto_complete_softbest/auto_complete_softbest.js"></script>        
		<script src="https://code.jquery.com/jquery-3.7.0.js"  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?php echo $configUrlGer;?>f/j/js/mascaras.js" type="text/javascript"></script>
	
		<script src="<?php echo $configUrlGer;?>f/j/ckeditor/ckeditor.js"></script>
		<script src="<?php echo $configUrlGer;?>f/j/ckeditor/samples/js/sample.js"></script>   

		<script type="text/javascript">
			function mostraItens(item){		
					document.getElementById('menu-dinamico').style.display="block";
					document.getElementById('menu-normal').style.display="none";

					if(item == 6){
						document.getElementById('site').style.display="block";
					}
			}
		</script>		
   </head>
    <body>
		<div id="tudo">
<?php
	include("capa/topo.php");
?>
			<div id="conteudo">
<?php
	include($arquivo);
?>
			</div>
<?php
	include("capa/rodape.php");
?>
		</div>
		<script>
			initSample();
		</script>	
		<style>
			.cke_notifications_area {display:none;}
		</style>				
    </body>
</html>
<?php
	}else{
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."controle-acesso.php'>";
	}

	}else{
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."login.php'>";
	}

	$conn->close();	
?>
