<div id="repete-banners" class="wow animate__animated animate__fadeIn">
		<div id="conteudo-banner">
			<div id="bloco-banner">
				<div class="owl-carrossel">
					<div class="row">
						<div class="large-12 columns">
							<div class="loop owl-carousel bannerCapa owl-loaded owl-drag">
								<?php
								$cont = 0;

								$sqlBanner = "SELECT * FROM banners WHERE statusBanner = 'T' ORDER BY codOrdenacaoBanner ASC";
								$resultBanner = $conn->query($sqlBanner);
								while ($dadosBanner = $resultBanner->fetch_assoc()) {
									$sqlImagem = "SELECT * FROM bannersImagens WHERE codBanner = '" . $dadosBanner['codBanner'] . "' ORDER BY codBannerImagem ASC LIMIT 0,1";
									$resultImagem = $conn->query($sqlImagem);
									$dadosImagem = $resultImagem->fetch_assoc();

									if ($dadosImagem['extBannerImagem'] != "") {

										$cont++;

										if ($dadosImagem['extBannerImagem'] != "mp4" && $dadosImagem['extBannerImagem'] != "MP4") {

											if ($dadosBanner['linkBanner'] != "") {

												if ($dadosBanner['novaAbaBanner'] == "S") {
													$target = "target='_blank'";
												} else {
													$target = "";
												}
?>
											<li class="imagem"><a class="imagem-banner" <?php echo $target; ?> title="<?php echo $dadosBanner['nomeBanner']; ?>" href="<?php echo $dadosBanner['linkBanner']; ?>" <?php if (strpos($dadosBanner['linkBanner'], 'api.whatsapp.com') !== false) { ?> onClick="event.preventDefault(); abrirAcesso('<?php echo $dadosBanner['linkBanner']; ?>');" <?php } ?> style="width:100%; height: 851px; display:block; background:transparent url('<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-W.webp'; ?>') center center no-repeat;"> </a></li>
<?php
											} else {
?>
												<li class="imagem-banner" style="width:100%; height:851px; display:block; background:transparent url('<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-W.webp'; ?>') center center no-repeat;"></li>
<?php
											}
										} else {
?>
											<li class="imagem-banner">
												<video id="video" class="vid" disablePictureInPicture controlsList="nodownload" style="min-width: 100%; min-height: 100%; width: 100%; display:block;" src="<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-O.' . $dadosImagem['extBannerImagem']; ?>" type="video/mp4" loop muted autoplay></video>
											</li>
<?php
										}
									}
								}
?>
							</div>
						</div>
					</div>
				</div>
				<script>
					var $rfg = jQuery.noConflict();
					var owl = $rfg('.bannerCapa');
					owl.owlCarousel({
						autoplay: true,
						speed: 1500,
						autoplayTimeout: 10000,
						smartSpeed: 1000,
						fluidSpeed: 1000,
						items: 1,
						loop: true,
						videoHeight: 930,
						video: true,
						lazyLoad: true,
						lazyLoad: true,
						autoWidth: false,
						autoplayHoverPause: false,
						margin: 0,
						nav: false,
						dots: true
					});
				</script>
			</div>
		</div>
	</div>