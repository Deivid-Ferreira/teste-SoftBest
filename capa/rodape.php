
<script type="text/javascript">
				var $th = jQuery.noConflict();
				var didScroll;
				var lastScrollTop = 0;
				var delta = 5;
				var navbarHeight = 150;

				$th(window).scroll(function(event) {
					didScroll = true;
				});

				setInterval(function() {
					if (didScroll) {
						hasScrolled();
						didScroll = false;
					}
				}, 250);

				function hasScrolled() {

					var st = $th(this).scrollTop();

					// Make sure they scroll more than delta
					if (Math.abs(lastScrollTop - st) <= delta)
						return;

					// If they scrolled down and are past the navbar, add class .nav-up.
					// This is necessary so you never see what is "behind" the navbar.
					if (st > lastScrollTop && st > navbarHeight) {
						// Scroll Down
						$th('.botao-whatsapp').css("right", "");
					} else {
						// Scroll Up
						if (st + $th(window).height() < $th(document).height()) {
							$th('.botao-whatsapp').css("right", "0px");
						}
					}
					lastScrollTop = st;
				}
			</script>
<?php		
	if(isset($_COOKIE['politica'.$cookie]) == ""){
?>
				<script>
					function salvaPolitica(){
						var $pol = jQuery.noConflict();															
						$pol("#politica-privacidade").fadeOut(200);
						$pol.post("<?php echo $configUrl;?>salva-politica.php", {cod: 1},function(data){
							$pol("#politica-privacidade").fadeOut(200);							
						});  																						
					}	
					
					function fadeInPolitica(){
						var $polF = jQuery.noConflict();															
						$polF("#politica-privacidade").fadeIn(200);						
					}			
				</script>
				<script type="text/javascript">
					function retiraCaptcha() {
						var $gt = jQuery.noConflict();
						$gt(".grecaptcha-badge").fadeOut("slow");
					}

					setTimeout("retiraCaptcha();", 2000);
				</script>
				<div id="politica-privacidade" style="display:none;" class="animate__animated animate__pulse animate__slow animate__infinite">
					<p class="texto">Ao navegar este site você concorda com as <a target="_blank" class="texto" href="<?php echo $configUrl;?>politica-de-privacidade/">políticas de privacidade</a>. <a class="botao-ok" onClick="salvaPolitica();">Ok</a> </p>
				</div>
<?php
	}
?>	
		<div id="repete-rodape" >
            <div id="conteudo-rodape">
                <div id="col-esq-rodape">
                    <div id="logo-rodape">
                        <p class="logo"><a title="<?php echo $nomeEmpresa; ?>" href="<?php echo $configUrl; ?>"><img style="display:block; width: 350px;" src="<?php echo $configUrl; ?>f/i/quebrado/logo.png" width="100%" /></a></p>
                    </div>
                    <div id="dados-site">
						<div id="sup">                 
						   <div id="mapa-site">
								<li class="<?php echo $url[2] == "sobre" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>sobre/">Sobre</a></li>
								<li class="<?php echo $url[2] == "solucoes" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>solucoes/">Soluções</a></li>
								<li class="<?php echo $url[2] == "clientes" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>clientes/">Clientes</a></li>
								<li class="<?php echo $url[2] == "depoimentos" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>depoimentos/">Depoimentos</a></li>
								<li class="<?php echo $url[2] == "novidades" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>novidades/">Novidades</a></li>
								<li class="<?php echo $url[2] == "contato" ? 'ativo' : 'p'; ?>"  style=" border-right: 0px;  margin-right: 0px; padding-right: 0px;"><a  style=" margin-right: 0px; padding-right: 0px; cursor:pointer "  onclick="abrirAcesso()" >Contato</a></li>
                    		</div>
						</div>
						<div id="inferior">
							<div class="facebook" <?php if( $facebook == ""){ ?> style="<?php if( $facebook == ""){ ?> display:none; <?php } ?>"<?php } ?> ><a target="_blank" title="Visite-nos no Facebook" href="https://www.facebook.com/<?php echo $facebook; ?>"><img style="display:block;" src="<?php echo $configUrl; ?>f/i/quebrado/facebook-branco.svg" width="32" /></a></div>
							<div class="instagram"><a target="_blank" title="Siga-nos no Instagram" href="https://www.instagram.com/<?php echo $instagram; ?>"><img style="display:block; " src="<?php echo $configUrl; ?>f/i/quebrado/Instagram.svg" width="35" height="35" /></a></div>
							<div class="whatsapp"><a target="_blank"  title="Clique para Chamar no WhatsApp!" onClick="abrirAcesso();" ><img style="display:block; cursor:pointer;" src="<?php echo $configUrl; ?>f/i/quebrado/whats-verde.svg" width="32"/><p class="numero"></p></a></div>
						</div>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </div>
        <div id="repete-copy">
            <div id="conteudo-copy">
                <p class="politica"><a  href="<?php echo $configUrl; ?>politica-de-privacidade/">Política de Privacidade</a></p>
                <p class="copy">Copyright 2025 - Todos os direitos reservados - <?php echo $nomeEmpresaMenor; ?></p>
                <p class="softbest"><a target="_blank" title="Desenvolvido por: www.softbest.com.br" href="http://www.softbest.com.br"><img style="display:block;" src="<?php echo $configUrl; ?>f/i/logo-softbest.svg" width="60" /></a></p>
                <br class="clear" />
            </div>
        </div>

