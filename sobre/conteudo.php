<?php
	$sqlQuemSomos = "SELECT * FROM quemSomos  LIMIT 0,1";
	$resultQuemSomos = $conn->query($sqlQuemSomos);
	$dadosQuemSomos = $resultQuemSomos->fetch_assoc();
	
	$sqlImagemP = "SELECT * FROM quemSomosImagens WHERE capaQuemSomosImagem = 'T' AND codQuemSomos =  ".$dadosQuemSomos['codQuemSomos']." ORDER BY codQuemSomosImagem ASC LIMIT 1;";
	$resultImagemP = $conn->query($sqlImagemP);
	$dadosImagemP = $resultImagemP->fetch_assoc();
	
	$sqlImagemS = "SELECT * FROM quemSomosImagens WHERE codQuemSomos = ".$dadosQuemSomos['codQuemSomos']." ORDER BY capaQuemSomosImagem ASC, codQuemSomosImagem ASC LIMIT 1,1";
	
	$resultImagemS = $conn->query($sqlImagemS);
	$dadosImagemS = $resultImagemS->fetch_assoc();
?>	
					<div id="conteudo-interno">
						<div id="bloco-titulo">
							<p class="titulo">Sobre</p>
							<div id="linha"></div>
						</div>	
						<div id="conteudo-quemSomos">
<?php
	if($dadosImagemP['codQuemSomosImagem'] != ""){
?>
							<p class="imagem-quemSomos wow animate__animated animate__fadeIn"><a title="<?php echo $nomeEmpresaMenor; ?>" rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/quemSomos/'.$dadosImagemP['codQuemSomos'].'-'.$dadosImagemP['codQuemSomosImagem'].'-W.webp'?>"><img style="width: 100%; height: 400px; "src="<?php echo $configUrlGer.'f/quemSomos/'.$dadosImagemP['codQuemSomos'].'-'.$dadosImagemP['codQuemSomosImagem'].'-W.webp';?>" alt=""></a></p>
<?php
	}
?>
							<div class="descricao"><?php echo $dadosQuemSomos['descricaoQuemSomos'];?></div>
							<br class="clear"/>
						</div>
					</div>
