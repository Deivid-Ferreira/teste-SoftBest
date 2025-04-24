<?php
	header("Content-Type: application/xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	
	include('f/conf/config.php');
	include('f/conf/conexao.php');

 
	$hoje = date('Y-m-d');
?>
	 
	<urlset
		xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9
		https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
		<url>
			<loc>https://baretaadvocacia.com.br/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>
		<url>
			<loc>https://baretaadvocacia.com.br/sobre/</loc>
			<lastmod><?php echo $hoje;?></lastmod>				
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://baretaadvocacia.com.br/solucoes/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>						
		<url>
			<loc>https://baretaadvocacia.com.br/clientes/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>							
		<url>
			<loc>https://baretaadvocacia.com.br/depoimentos/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://baretaadvocacia.com.br/novidades/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
<?php 
	$sqlSolucao = "SELECT * FROM solucoes WHERE statusSolucao = 'T' ORDER BY codSolucao DESC";
	$resultSolucao = $conn->query($sqlSolucao);
	
	while($dadosSolucao = $resultSolucao->fetch_assoc()){
			
		echo "<url>
				<loc>https://baretaadvocacia.com.br/areas-de-solucoes/".$dadosSolucao['codSolucao']."-".$dadosSolucao['urlSolucao']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlBlog = "SELECT * FROM blog WHERE statusBlog = 'T' ORDER BY codBlog DESC";
	$resultBlog = $conn->query($sqlBlog);
	while($dadosBlog = $resultBlog->fetch_assoc()){
			
		echo "<url>
				<loc>https://baretaadvocacia.com.br/novidades/".$dadosBlog['urlBlog']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	$sqlEquipe = "SELECT * FROM equipe WHERE statusEquipe  = 'T' ORDER BY codEquipe  DESC";
	
	$resultEquipe  = $conn->query($sqlEquipe );
	while($dadosEquipe  = $resultEquipe->fetch_assoc()){
		
		echo "<url>
				<loc>https://baretaadvocacia.com.br/equipe/".$dadosEquipe['codEquipe'].'-'.$dadosEquipe['urlEquipe']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
?>				
	</urlset>
