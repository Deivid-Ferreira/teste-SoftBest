				<script type="text/javascript">
					function leadWhatsApp(cod, area){
						var $FL = jQuery.noConflict();
						var nomeLead = document.getElementById("nomeContato"+cod).value;
						var celularLead = document.getElementById("celularContato"+cod).value;
						var siteLocal = area;
						$FL("#loading-fundo").fadeIn(250);
						$FL("#loading-icone").fadeIn(250);								
						grecaptcha.execute('<?php echo $chaveSite;?>', {action: 'action_form'}).then(function(token) {
							$FL.post("<?php echo $configUrl;?>salvaLead.php", {nomeLead: nomeLead, celularLead: celularLead, siteLocal: siteLocal, token: token, action: "action_form"}, function(data){
								if(data.trim() == "ok"){
									$FL("#nomeContato"+cod).val("");									
									$FL("#celularContato"+cod).val("");	
									$FL("#loading-fundo").fadeOut(250);
									$FL("#loading-icone").fadeOut(250);
									$FL(".blackout").fadeOut(250);
									$FL("#popup").fadeOut(250);


									if(celularConsultora != "" && celularConsultora != null){
										window.open("<?php echo $configUrl;?>contato-whatsapp-enviado/?numero=" + celularConsultora + "&msg=<?php echo $whatsAppMsg;?>", "_blank");
									}else{
										window.open("<?php echo $configUrl;?>contato-whatsapp-enviado/?numero=<?php echo $celularWhats;?>&msg=<?php echo $whatsAppMsg;?>", "_blank");					
									}

								}else
								if(data.trim() == "erro sql lead"){
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: #100");
								}else
								if(data.trim() == "erro captcha"){
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: #200");
								}else{
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: desconhecido");
								}
								
								return false										
							});
						});
						
						return false;
						
						//Erro #100: Erro ao inserir Lead;
						//Erro #200: Erro ao Captcha;
					}	

					function fechaAcesso(){
						var $FLs = jQuery.noConflict();
						$FLs(".blackout").fadeOut(250);
						$FLs("#popup").fadeOut(250);
					}														
					var celularConsultora = "";
					function abrirAcesso(numero){
						var $FLgs = jQuery.noConflict();
						$FLgs(".blackout").fadeIn(250);
						$FLgs("#popup").fadeIn(250);
						celularConsultora = numero;
					}														
				</script> 
				<p class="blackout" style="display:none;" onClick="fechaAcesso();"></p>
				<div id="popup" style="display:none;">
					<p class="x" onClick="fechaAcesso();">X</p>
					<p class="logo"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/logo-whats-2.svg" width="230"/></p>
					<p class="titulo">Chame-nos no WhatsApp.</p>
					<p class="titulo2">Solicite o contato de um corretor.</p>
					<form id="targetFormTopo" action="<?php echo $configUrl;?>" method="post" onSubmit="return false, leadWhatsApp('P', 'S');">
						<p class="campo-nome"><input type="text" id="nomeContatoP" value="" placeholder="Nome" required /></p>
						<p class="campo-whats"><input type="text" id="celularContatoP" value="" placeholder="WhatsApp" required onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);" /></p>
						<p class="botao-envia"><input type="submit" value="Iniciar Atendimento"/></p>
					</form>
				</div> 
			   <div id="repete-topo" >
                    <div id="conteudo-topo">
                        <div id="esq-topo">
                            <div id="logo-topo">
                                <p class="logo"><a title="<?php echo $nomeEmpresa; ?>" href="<?php echo $configUrl; ?>"><img id="logo-img" style="display:block;" src="<?php echo $configUrl; ?>f/i/quebrado/normal.png" width="100%" /></a></p>
                            </div>
                        </div>
                        <div id="meio-topo">
                            <div id="mostra-menu">

                                <p class="<?php echo $url[2] == "sobre" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>sobre/">Sobre</a></p>
                                <p class="<?php echo $url[2] == "solucoes" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>solucoes/">Soluções</a></p>
                                <p class="<?php echo $url[2] == "clientes" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>clientes/">Clientes</a></p>
                                <p class="<?php echo $url[2] == "depoimentos" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>depoimentos/">Depoimentos</a></p>
                                <p class="<?php echo $url[2] == "novidades" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>novidades/">Novidades</a></p>
                                <p class="<?php echo $url[2] == "contato" ? 'ativo' : ''; ?>" style="margin-right: 40px;" ><a onclick="abrirAcesso()" style="cursor: pointer;">Contato</a></p>
                                <br class="clear" />
                            </div>
                        </div>
						<div id="redes">
							<div class="facebook" style="border-left: 2px solid rgba(255, 255, 255, 0.58); padding-left: 20px; margin-right: 5px; padding-bottom: 4px; padding-top: 4px;"><a target="_blank" title="Siga-nos e curta nossa página no Facebook" href="https://www.facebook.com/<?php echo $facebook; ?>"><img style="display:block;" src="<?php echo $configUrl; ?>f/i/quebrado/facebook-branco.svg" width="30" /></a></div>
							<div class="instagram" style="  "><a target="_blank" title="Siga-nos no Instagram" href="https://www.instagram.com/<?php echo $instagram; ?>"><img style="display:block;" src="<?php echo $configUrl; ?>f/i/quebrado/Instagram.svg" width="35" /></a></div>
						</div>
                    </div>
                </div>

            