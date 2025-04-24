				<script type="text/javascript">
					function mostraRecado(configUrl, codRecado, totalRecado){
						var i;
						for(i=1; i<=totalRecado; i++){
							if(i != codRecado){
								document.getElementById("escondido"+i).style.display="none";
								document.getElementById("icone"+i).style.background="transparent url('"+configUrl+"f/i/default/corpo-default/corpo-filtro-seta-baixo.gif') left top no-repeat";
							}
						}
						if(document.getElementById("escondido"+codRecado).style.display=="none"){
							document.getElementById("escondido"+codRecado).style.display="block";
							document.getElementById("icone"+codRecado).style.background="transparent url('"+configUrl+"f/i/default/corpo-default/corpo-filtro-seta-alto.gif') left top no-repeat";
						}else{
							document.getElementById("escondido"+codRecado).style.display="none";
							document.getElementById("icone"+codRecado).style.background="transparent url('"+configUrl+"f/i/default/corpo-default/corpo-filtro-seta-baixo.gif') left top no-repeat";			
						}
					}
				</script>
	
<?php
	$sqlRegistro1 = "SELECT count(codRecado) registros FROM recados WHERE capaRecado = 'T' and enviaEmailRecado = '0'";
	$resultRegistro1 = mysql_query($sqlRegistro1);
	$dadosRegistro1 = mysql_fetch_array($resultRegistro1);
	$totalRecado1 = $dadosRegistro1['registros'];
	
	$sqlRegistro2 = "SELECT count(R.codRecado) registros FROM recados R inner join recadosUsuario RC on R.codRecado = RC.codRecado WHERE R.capaRecado = 'T' and R.enviaEmailRecado = 'V' and RC.codUsuario = ".$_COOKIE['codAprovado'.$cookie]."";
	$resultRegistro2 = mysql_query($sqlRegistro2);
	$dadosRegistro2 = mysql_fetch_array($resultRegistro2);
	$totalRecado2 = $dadosRegistro2['registros'];
		
	if($totalRecado1 >= 1 || $totalRecado2 >= 1){
?>		
				<div id="filtro" style="margin-bottom:5px;">
					<div id="recados-capa">
						<p class="titulo-recado">Recados</p>
						<div id="conteudo-recados">
<?php	
		$cont = 1;
		$sqlRecado = "SELECT * FROM recados WHERE capaRecado = 'T' ORDER BY dataRecado ASC";
		$resultRecado = mysql_query($sqlRecado);
		while($dadosRecado = mysql_fetch_array($resultRecado)){
			
			if($dadosRecado['enviaEmailRecado'] == "0"){
				$nome2 = "[ <span style='font-size:16px; font-weight:normal;'>Para todos</span> ] ";
			}else{
				$nome2 = "[ <span style='font-size:16px; font-weight:normal;'>Para você</span> ] ";
			}
			
			if($dadosRecado['enviaEmailRecado'] == "0"){
?>						
							<div class="recado" style="margin-bottom:15px;">
								<div class="nome-recado" style="padding-bottom:10px;">
									<p class="link"><a href="javascript:mostraRecado('<?php echo $configUrl;?>', '<?php echo $cont;?>', '<?php echo $totalRecado;?>');" title="Clique para ver o recado"><?php echo $nome2;?><?php echo $dadosRecado['nomeRecado']." - ".data($dadosRecado['dataRecado']);?></a></p>
									<p class="icone" id="icone<?php echo $cont;?>" onClick="mostraRecado('<?php echo $configUrl;?>', '<?php echo $cont;?>', '<?php echo $totalRecado;?>');"><span class="oculto">Botão mostra e oculta detalhes</span></p>
									<br class="clear" />								
								</div>
								<div id="escondido<?php echo $cont;?>" class="descricao-recado" style="display:none;">
									<?php echo $dadosRecado['descricaoRecado'];?>
								</div>
							</div>
<?php
			}else
			if($dadosRecado['enviaEmailRecado'] == "V"){
				
				$sqlRecadoUsuario = "SELECT * FROM recadosUsuario WHERE codRecado = ".$dadosRecado['codRecado']." and codUsuario = ".$_COOKIE['codAprovado'.$cookie]."";
				$resultRecadoUsuario = mysql_query($sqlRecadoUsuario);
				$dadosRecadoUsuario = mysql_fetch_array($resultRecadoUsuario);
				
				if($dadosRecadoUsuario['codRecadoUsuario'] != ""){					
?>
							<div class="recado" style="margin-bottom:15px;">
								<div class="nome-recado" style="padding-bottom:10px;">
									<p class="link"><a href="javascript:mostraRecado('<?php echo $configUrl;?>', '<?php echo $cont;?>', '<?php echo $totalRecado;?>');" title="Clique para ver o recado"><?php echo $nome2;?><?php echo $dadosRecado['nomeRecado']." - ".data($dadosRecado['dataRecado']);?></a></p>
									<p class="icone" id="icone<?php echo $cont;?>" onClick="mostraRecado('<?php echo $configUrl;?>', '<?php echo $cont;?>', '<?php echo $totalRecado;?>');"><span class="oculto">Botão mostra e oculta detalhes</span></p>
									<br class="clear" />								
								</div>
								<div id="escondido<?php echo $cont;?>" class="descricao-recado" style="display:none;">
									<?php echo $dadosRecado['descricaoRecado'];?>
								</div>
							</div>
<?php
				}
			}			
			$cont++;
		}
?>					
						</div>					
					</div>	
				</div>	
<?php
	}
	
	$sqlSomaRB = "SELECT SUM(CP.valorContaParcial) total FROM contasParcial CP inner join contas C on CP.codConta = C.codConta WHERE C.areaPagamentoConta = 'R'";
	$resultSomaRB = mysql_query($sqlSomaRB);
	$dadosSomaRB = mysql_fetch_array($resultSomaRB);
		
	$sqlSomaPB = "SELECT SUM(CP.valorContaParcial) total FROM contasParcial CP inner join contas C on CP.codConta = C.codConta WHERE C.areaPagamentoConta = 'P'";
	$resultSomaPB = mysql_query($sqlSomaPB);
	$dadosSomaPB = mysql_fetch_array($resultSomaPB);	
?>
				<div id="dados-conteudo">
					<div id="cols-cem">
<?php
	$area = "compromissos";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-compromissos">
							<p class="frase">Compromissos</p>							
							<div id="fundo-compromissos">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#2E8B57;">
										<th style="width:15%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Data</th>
										<th style="width:15%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Usuário(s)</th>
										<th style="width:35%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Título</th>
										<th style="width:35%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:5px;">Tipo Compromisso</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$cont = 0;
		$contTodos = 0;
		
		$sqlCompromissos = "SELECT DISTINCT C.* FROM compromissos C inner join compromissosUsuario CU on C.codCompromisso = CU.codCompromisso WHERE C.dataCompromisso >= '".date('Y-m-d')."' and C.statusCompromisso = 'T' and (CU.codUsuario = ".$_COOKIE['codAprovado'.$cookie]." or C.codUsuario = '0') ORDER BY C.dataCompromisso ASC, C.horaCompromisso ASC, C.codCompromisso ASC LIMIT 0,20";
		$resultCompromissos = mysql_query($sqlCompromissos);
		while($dadosCompromissos = mysql_fetch_array($resultCompromissos)){
			
			$sqlTipoCompromisso = "SELECT * FROM tipoCompromisso WHERE codTipoCompromisso = ".$dadosCompromissos['codTipoCompromisso']." LIMIT 0,1";
			$resultTipoCompromisso = mysql_query($sqlTipoCompromisso);
			$dadosTipoCompromisso = mysql_fetch_array($resultTipoCompromisso);
			
			$enviado = "";
			
			if($dadosCompromissos['codUsuario'] == "0"){
				$enviado = "Todos";
			}else{
				$sqlCompromissoUsuario = "SELECT * FROM compromissosUsuario WHERE codCompromisso = ".$dadosCompromissos['codCompromisso']."";
				$resultCompromissoUsuario = mysql_query($sqlCompromissoUsuario);
				while($dadosCompromissoUsuario = mysql_fetch_array($resultCompromissoUsuario)){
					
					$sqlUsuario = "SELECT nomeUsuario FROM usuarios WHERE codUsuario = ".$dadosCompromissoUsuario['codUsuario']." ORDER BY nomeUsuario ASC";
					$resultUsuario = mysql_query($sqlUsuario);
					$dadosUsuario = mysql_fetch_array($resultUsuario);
					
					if($enviado == ""){	
						$enviado = $dadosUsuario['nomeUsuario'];	
					}else{
						$enviado .= ", ".$dadosUsuario['nomeUsuario'];
					}
				}						
			}
			
			$cont++;
			$contTodos++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:15%; border-left:1px solid #CCC; color:#31625E; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><?php echo data($dadosCompromissos['dataCompromisso']);?><br/><?php echo $dadosCompromissos['horaCompromisso'];?></th>
											<th style="width:15%; color:#31625E; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><?php echo $enviado;?></th>
											<th style="width:35%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo $dadosCompromissos['nomeCompromisso'];?></th>
											<th style="width:35%; font-weight:normal; border-bottom:1px solid #ccc; color:#31625E; border-right:1px solid #ccc; padding:6px;"><?php echo $dadosTipoCompromisso['nomeTipoCompromisso'];?></th>
										</tr>
<?php
		}
?>
									</table>
								</div>	
								<div id="total">
									<p class="botao"><a title="Acessar Compromissos" href="<?php echo $configUrlGer;?>comercial/compromissos/">Acessar Compromissos</a></p>
									<p class="total">Total de <?php echo $contTodos;?> compromissos(s)</p>
									<br class="clear"/>
								</div>
							</div>
						</div>
<?php
	}
?>					
					</div>
					<div id="col-esq-conteudo">
<?php
	$area = "cheques";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-cheques">
							<p class="frase">Cheques a Pagar</p>
							<div id="fundo-cheques">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#8B5A2B;">
										<th style="width:60%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Fornecedor</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:0px;">Bom para</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:5px;">Valor</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$valorTotal = 0;
		$cont = 0;

		$sqlCheque1 = "SELECT * FROM cheques WHERE areaCheque = 'P' and statusCheque = 'T' ORDER BY bomparaCheque ASC LIMIT 0,30";
		$resultCheque1 =  mysql_query($sqlCheque1);
		while($dadosCheque1 = mysql_fetch_array($resultCheque1)){
			
			$cont++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}

			$sqlContaParcial = "SELECT * FROM contasParcial WHERE codContaParcial = ".$dadosCheque1['codContaParcial']."";
			$resultContaParcial = mysql_query($sqlContaParcial);
			$dadosContaParcial = mysql_fetch_array($resultContaParcial);

			$sqlConta = "SELECT * FROM contas WHERE codConta = ".$dadosContaParcial['codConta']."";
			$resultConta = mysql_query($sqlConta);
			$dadosConta = mysql_fetch_array($resultConta);
			
			$valorPagar = $dadosContaParcial['valorContaParcial'];
			
			$sqlFornecedor = "SELECT nomeFornecedor FROM fornecedores WHERE codFornecedor = ".$dadosConta['codFornecedor']." LIMIT 0,1";
			$resultFornecedor = mysql_query($sqlFornecedor);
			$dadosFornecedor = mysql_fetch_array($resultFornecedor);

			if($dadosCheque1['statusCheque'] == "T" && $dadosCheque1['bomparaCheque'] <= date("Y-m-d")){
				$corCheque = "color:#FF0000;";
			}else{
				$corCheque = "color:#31625E;";
			}			
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:60%; border-left:1px solid #CCC; <?php echo $corCheque;?> font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><?php echo $dadosFornecedor['nomeFornecedor'];?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; <?php echo $corCheque;?> font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo data($dadosCheque1['bomparaCheque']);?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; <?php echo $corCheque;?> font-weight:normal;  border-right:1px solid #ccc; padding:6px;">R$ <?php echo number_format($valorPagar, 2, ",", ".");?></th>
										</tr>
<?php
			$valorTotal =  $valorTotal + $valorPagar;
		}
?>
									</table>
								</div>								
								<div id="total">
									<p class="botao"><a title="Acessar Cheques a Pagar" href="<?php echo $configUrlGer;?>financeiro/cheques/pagos/">Acessar Cheques a Pagar</a></p>
									<p class="total">Total de R$ <?php echo number_format($valorTotal, 2, ",", ".");?></p>
									<br class="clear"/>
								</div>	
							</div>						
						</div>
<?php
	}

	$area = "contas-pagar";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-pagar">
							<p class="frase">Contas a Pagar</p>
							<div id="fundo-pagar">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#FF0000;">
										<th style="width:30%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Fornecedor</th>
										<th style="width:30%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:0px;">Nome</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:0px;">Vencimento</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:5px;">Valor</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$valorTotal = 0;
		$cont = 0;
		$sqlContaPagar = "SELECT * FROM contas WHERE areaPagamentoConta = 'P' and baixaConta = 'T' and statusConta = 'T' and vencimentoConta <= '".date('Y-m-d')."'";
		$resultContaPagar = mysql_query($sqlContaPagar);
		while($dadosContaPagar = mysql_fetch_array($resultContaPagar)){
			
			$cont++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}

			$sqlContaParcial = "SELECT SUM(valorContaParcial) registros FROM contasParcial WHERE codConta = ".$dadosContaPagar['codConta']."";
			$resultContaParcial = mysql_query($sqlContaParcial);
			$dadosContaParcial = mysql_fetch_array($resultContaParcial);
			
			$valorPagar = $dadosContaPagar['vParcela'] - $dadosContaParcial['registros'];
			
			$sqlFornecedor = "SELECT nomeFornecedor FROM fornecedores WHERE codFornecedor = ".$dadosContaPagar['codFornecedor']." LIMIT 0,1";
			$resultFornecedor = mysql_query($sqlFornecedor);
			$dadosFornecedor = mysql_fetch_array($resultFornecedor);
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:30%; border-left:1px solid #CCC; color:#31625E; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><?php echo $dadosFornecedor['nomeFornecedor'];?></th>
											<th style="width:30%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo $dadosContaPagar['nomeConta'];?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo data($dadosContaPagar['vencimentoConta']);?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;">R$ <?php echo number_format($valorPagar, 2, ",", ".");?></th>
										</tr>
<?php
			$valorTotal =  $valorTotal + $valorPagar;
		}
?>
									</table>
								</div>								
								<div id="total">
									<p class="botao"><a title="Acessar Contas a Receber" href="<?php echo $configUrlGer;?>financeiro/contas-pagar/">Acessar Contas a Pagar</a></p>
									<p class="total">Total de R$ <?php echo number_format($valorTotal, 2, ",", ".");?></p>
									<br class="clear"/>
								</div>	
							</div>						
						</div>
<?php
	}
?>
					</div>
					<div id="col-dir-conteudo">
<?php
	$area = "cheques";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-cheques-receber">
							<p class="frase">Cheques a Receber</p>
							<div id="fundo-cheques-receber">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#054686;">
										<th style="width:60%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Cliente</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:0px;">Bom para</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:5px;">Valor</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$valorTotal = 0;
		$cont = 0;

		$sqlCheque1 = "SELECT * FROM cheques WHERE areaCheque = 'R' and statusCheque = 'T' ORDER BY bomparaCheque ASC LIMIT 0,30";
		$resultCheque1 =  mysql_query($sqlCheque1);
		while($dadosCheque1 = mysql_fetch_array($resultCheque1)){
			
			$cont++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}

			$sqlContaParcial = "SELECT * FROM contasParcial WHERE codContaParcial = ".$dadosCheque1['codContaParcial']."";
			$resultContaParcial = mysql_query($sqlContaParcial);
			$dadosContaParcial = mysql_fetch_array($resultContaParcial);

			$sqlConta = "SELECT * FROM contas WHERE codConta = ".$dadosContaParcial['codConta']."";
			$resultConta = mysql_query($sqlConta);
			$dadosConta = mysql_fetch_array($resultConta);
			
			$valorPagar = $dadosContaParcial['valorContaParcial'];
			
			$sqlCliente = "SELECT nomeCliente FROM clientes WHERE codCliente = ".$dadosConta['codCliente']." LIMIT 0,1";
			$resultCliente = mysql_query($sqlCliente);
			$dadosCliente = mysql_fetch_array($resultCliente);

			if($dadosCheque1['statusCheque'] == "T" && $dadosCheque1['bomparaCheque'] <= date("Y-m-d")){
				$corCheque = "color:#FF0000;";
			}else{
				$corCheque = "color:#31625E;";
			}			
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:60%; border-left:1px solid #CCC; <?php echo $corCheque;?> font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><?php echo $dadosCliente['nomeCliente'];?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; <?php echo $corCheque;?> font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo data($dadosCheque1['bomparaCheque']);?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; <?php echo $corCheque;?> font-weight:normal;  border-right:1px solid #ccc; padding:6px;">R$ <?php echo number_format($valorPagar, 2, ",", ".");?></th>
										</tr>
<?php
			$valorTotal =  $valorTotal + $valorPagar;
		}
?>
									</table>
								</div>								
								<div id="total">
									<p class="botao"><a title="Acessar Cheques a Receber" href="<?php echo $configUrlGer;?>financeiro/cheques/recebidos/">Acessar Cheques a Receber</a></p>
									<p class="total">Total de R$ <?php echo number_format($valorTotal, 2, ",", ".");?></p>
									<br class="clear"/>
								</div>	
							</div>						
						</div>
<?php
	}
						
	$area = "contas-receber";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-receber">
							<p class="frase">Contas a Receber</p>
							<div id="fundo-receber">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#2E6193;">
										<th style="width:30%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Cliente</th>
										<th style="width:30%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:0px;">Nome</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:0px;">Vencimento</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:5px;">Valor</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$valorTotal = 0;
		$cont = 0;
		$sqlContaPagar = "SELECT * FROM contas WHERE areaPagamentoConta = 'R' and baixaConta = 'T' and statusConta = 'T' and vencimentoConta <= '".date('Y-m-d')."'";
		$resultContaPagar = mysql_query($sqlContaPagar);
		while($dadosContaPagar = mysql_fetch_array($resultContaPagar)){
			
			$cont++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}

			$sqlContaParcial = "SELECT SUM(valorContaParcial) registros FROM contasParcial WHERE codConta = ".$dadosContaPagar['codConta']."";
			$resultContaParcial = mysql_query($sqlContaParcial);
			$dadosContaParcial = mysql_fetch_array($resultContaParcial);
			
			$valorPagar = $dadosContaPagar['vParcela'] - $dadosContaParcial['registros'];
			
			$sqlCliente = "SELECT nomeCliente FROM clientes WHERE codCliente = ".$dadosContaPagar['codCliente']." LIMIT 0,1";
			$resultCliente = mysql_query($sqlCliente);
			$dadosCliente = mysql_fetch_array($resultCliente);
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:30%; border-left:1px solid #CCC; color:#31625E; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><?php echo $dadosCliente['nomeCliente'];?></th>
											<th style="width:30%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo $dadosContaPagar['nomeConta'];?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><?php echo data($dadosContaPagar['vencimentoConta']);?></th>
											<th style="width:20%; border-bottom:1px solid #ccc; color:#31625E; font-weight:normal;  border-right:1px solid #ccc; padding:6px;">R$ <?php echo number_format($valorPagar, 2, ",", ".");?></th>
										</tr>
<?php
			$valorTotal =  $valorTotal + $valorPagar;
		}
?>
									</table>
								</div>								
								<div id="total">
									<p class="botao"><a title="Acessar Contas a Receber" href="<?php echo $configUrlGer;?>financeiro/contas-receber/">Acessar Contas a Receber</a></p>
									<p class="total">Total de R$ <?php echo number_format($valorTotal, 2, ",", ".");?></p>
									<br class="clear"/>
								</div>	
							</div>						
						</div>
<?php
	}
?>

					</div>
					<br class="clear"/>
					<div id="cols-cem">
<?php
	$area = "negociacoes";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-negociacoes">
							<p class="frase">Negociações</p>							
							<div id="fundo-negociacoes">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#4f4d5a;">
										<th style="width:30%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Título</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Cliente</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Corretor</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Tipo Negociação</th>
										<th style="width:10%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-right-radius:5px;">Status</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$cont = 0;
		$contTodos = 0;
		$sqlNegociacaos = "SELECT * FROM negociacoes WHERE statusNegociacao != 'FI'".$filtraUsuario." ORDER BY statusNegociacao ASC, dataPrevisaoNegociacao ASC, codNegociacao DESC";
		$resultNegociacaos = mysql_query($sqlNegociacaos);
		while($dadosNegociacaos = mysql_fetch_array($resultNegociacaos)){
			
			$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$dadosNegociacaos['codTipoImovel']." LIMIT 0,1";
			$resultTipoImovel = mysql_query($sqlTipoImovel);
			$dadosTipoImovel = mysql_fetch_array($resultTipoImovel);
			
			$sqlUsuario = "SELECT * FROM usuarios WHERE codUsuario = ".$dadosNegociacaos['codUsuario']." LIMIT 0,1";
			$resultUsuario = mysql_query($sqlUsuario);
			$dadosUsuario = mysql_fetch_array($resultUsuario);
			
			$dataPrazo = date('Y-m-d');
			$dataAbertura = $dadosNegociacaos['dataAbreNegociacao'];

			$diferenca = strtotime($dataPrazo) - strtotime($dataAbertura);
			$tempo = floor($diferenca / (60 * 60 * 24));

			if($dadosNegociacaos['dataPrevisaoNegociacao'] == date('Y-m-d')){
				$prazo = "Hoje";
			}else{
				$dataPrazo = $dadosNegociacaos['dataPrevisaoNegociacao'];
				$dataAtual = date('Y-m-d');

				$diferenca = strtotime($dataPrazo) - strtotime($dataAtual);
				$prazo = floor($diferenca / (60 * 60 * 24));
				if($prazo == 1){
					$prazo = $prazo." dia";
				}else{
					$prazo = $prazo." dias";
				}
			}
			
			if($dadosNegociacaos['statusNegociacao'] == "EA"){
				$cor = "color:#FF0000;";
				$status = "Em Andamento";
			}else
			if($dadosNegociacaos['statusNegociacao'] == "EP"){
				$cor = "color:#FF0000; font-weight:bold;";
				$status = "Em Potencial";
			}else
			if($dadosNegociacaos['statusNegociacao'] == "R"){
				$cor = "color:#0000FF;";
				$status = "Retorno";
			}else
			if($dadosNegociacaos['statusNegociacao'] == "F"){
				$cor = "color:#31625E;";
				$status = "Fechado";
			}else						
			if($dadosNegociacaos['statusNegociacao'] == "NF"){
				$cor = "color:#000;";
				$status = "Não Fechado";
			}
					
			$cont++;
			$contTodos++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:30%; border-left:1px solid #CCC; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/negociacoes/detalhes/<?php echo $dadosNegociacaos['codNegociacao'];?>/"><?php echo $dadosNegociacaos['nomeNegociacao'];?></a></th>
											<th style="width:20%; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/negociacoes/detalhes/<?php echo $dadosNegociacaos['codNegociacao'];?>/"><?php echo $dadosNegociacaos['clienteNegociacao'];?></a></th>
											<th style="width:20%; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/negociacoes/detalhes/<?php echo $dadosNegociacaos['codNegociacao'];?>/"><?php echo $dadosUsuario['nomeUsuario'];?></a></th>
											<th style="width:20%; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/negociacoes/detalhes/<?php echo $dadosNegociacaos['codNegociacao'];?>/"><?php echo $dadosTipoImovel['nomeTipoImovel'];?></a></th>
											<th style="width:10%; border-bottom:1px solid #ccc; font-weight:normal;  border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/negociacoes/detalhes/<?php echo $dadosNegociacaos['codNegociacao'];?>/"><?php echo $status;?></a></th>
										</tr>
<?php
		}
?>
									</table>
								</div>	
								<div id="total">
									<p class="botao"><a title="Acessar Negociacaos" href="<?php echo $configUrlGer;?>comercial/negociacoes/">Acessar Negociações</a></p>
									<p class="total">Total de <?php echo $contTodos;?> negoociações(s)</p>
									<br class="clear"/>
								</div>
							</div>
						</div>
<?php
	}

	$area = "contatos";
	if(validaAcesso($area) == "ok"){	
?>						
						<div id="bloco-contatos">
							<p class="frase">Contatos</p>							
							<div id="fundo-contatos">
								<table style="width:100%;">
									<tr style="width:100%; background-color:#632525;">
										<th style="width:60%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px; border-top-left-radius:5px;">Nome</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Telefone</th>
										<th style="width:20%; padding:5px; padding-top:8px; padding-bottom:8px; color:#FFF; font-size:15px;">Corretor</th>
									</tr>
								</table>
								<div id="bloco-rola" style="width:100%; max-height:500px; overflow-y:auto;">
									<table style="width:100%;">
<?php
		$cont = 0;
		$contTodos = 0;
		$sqlContatos = "SELECT * FROM contatos WHERE statusContato = 'T'".$filtraUsuario." ORDER BY statusContato ASC, dataContato DESC, codContato DESC";
		$resultContatos = mysql_query($sqlContatos);
		while($dadosContatos = mysql_fetch_array($resultContatos)){
			
			if($dadosContatos['codUsuario'] == 0){
				$corretor = "Site";
			}else{					
				$sqlUsuario = "SELECT nomeUsuario FROM usuarios WHERE codUsuario = ".$dadosContatos['codUsuario']." LIMIT 0,1";
				$resultUsuario = mysql_query($sqlUsuario);
				$dadosUsuario = mysql_fetch_array($resultUsuario);
				
				$corretor = $dadosUsuario['nomeUsuario'];
			}
					
			$cor = "#31625E";		
					
			$cont++;
			$contTodos++;
			
			if($cont == 1){
				$background = "#FFF;";
			}else{
				$cont = 0;
				$background = "#f5f5f5;";
			}
?>							
										<tr style="width:100%; background-color:<?php echo $background;?>">
											<th style="width:60%; border-left:1px solid #CCC; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/contatos/detalhes/<?php echo $dadosContatos['codContato'];?>/"><?php echo $dadosContatos['nomeContato'];?></a></th>
											<th style="width:20%; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/contatos/detalhes/<?php echo $dadosContatos['codContato'];?>/"><?php echo $dadosContatos['telefoneContato'];?></a></th>
											<th style="width:20%; font-weight:normal; border-bottom:1px solid #ccc; border-right:1px solid #ccc; padding:6px;"><a style="<?php echo $cor;?>" href="<?php echo $configUrlGer;?>comercial/contatos/detalhes/<?php echo $dadosContatos['codContato'];?>/"><?php echo $corretor;?></a></th>
										</tr>
<?php
		}
?>
									</table>
								</div>	
								<div id="total">
									<p class="botao"><a title="Acessar Contatos" href="<?php echo $configUrlGer;?>comercial/contatos/">Acessar Contatos</a></p>
									<p class="total">Total de <?php echo $contTodos;?> contatos(s)</p>
									<br class="clear"/>
								</div>
							</div>
						</div>
<?php
	}
?>											
					</div>
					<br class="clear"/>
				</div>
