<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "dvds-locados";
	
	//obtem id da locação
	if(!empty($_GET['id'])){
		$alu_id = cleanString(pegaNumero($_GET['id']));
	} else {
		header ("location: dvds-locados.php");
	}
	
	$mysql = new conexao;
	$clienteDvdLocado = $mysql->sql_query("SELECT
											  DVD.dvd_nome
											 ,DVD.dvd_id
											 ,CLI.cli_nome
											 ,CLI.cli_numero_rg
											 ,ALU.alu_data_aluguel
											 ,ALU.alu_data_recebimento
											 ,CLI.cli_percentual_desconto
											 ,ALU.alu_preco_total
											 ,ALU.alu_preco_desconto
											 ,ALU.alu_preco_liquido
											FROM
											  clientes CLI,
											  dvds DVD,
											  aluguel ALU,
											  aluguel_itens ALUI

											WHERE 
											  CLI.cli_id = ALU.alu_cli_id AND
											  ALUI.alui_alu_id = ALU.alu_id AND
											  ALUI.alui_dvd_id = DVD.dvd_id AND
											  ALU.alu_finalizado = 0 AND
											  ALU.alu_id = ".$alu_id);
	$mysql->desconecta;
	
	if($clienteDvdLocado){
		
		while($aluguelCliente = mysql_fetch_object($clienteDvdLocado)){ 
			$dvd_nome = $dvd_nome."<br>".$aluguelCliente->dvd_nome;
			$dvd_id[] = $aluguelCliente->dvd_id;
			$cli_nome = $aluguelCliente->cli_nome;
			$cli_numero_rg = $aluguelCliente->cli_numero_rg;
			$alu_data_aluguel = formataDataCompleta($aluguelCliente->alu_data_aluguel);
			$alu_data_recebimento = formataDataCompleta($aluguelCliente->alu_data_recebimento);	

			$alu_preco_total = $aluguelCliente->alu_preco_total;
			$alu_preco_desconto = $aluguelCliente->alu_preco_desconto;
			$alu_preco_liquido = $aluguelCliente->alu_preco_liquido;
		}
		
	} else {
		header("dvds-locados.php");
	}
	
	if($_POST['finalizar-locacao'] == "Finalizar Locação"){
		$alu_quantidade_dias_atraso = $_POST['alu_quantidade_dias_atraso'];
		
		if(empty($alu_quantidade_dias_atraso)) $alu_quantidade_dias_atraso = 0;
		
		$alu_data_recebimento = dataHoraAtual();
		
		//Atualiza a quantidade de dias de atraso
		$mysql = new conexao;
		$atualizaAluguel = $mysql->sql_query("UPDATE aluguel SET 
												alu_quantidade_dias_atraso = ".$alu_quantidade_dias_atraso.",
												alu_data_recebimento = '".$alu_data_recebimento."',
												alu_finalizado = 1
												WHERE alu_id = ".$alu_id) OR die(mysql_error());
		$mysql->desconecta;
		
		foreach ($dvd_id as $dvd){
			$devolver_dvd_id = $dvd;
			
			//Atualiza a quantidade de dias de atraso
			$mysql = new conexao;
			$devolver_dvd = $mysql->sql_query("UPDATE dvds SET 
													dvd_situacao = 1
													WHERE dvd_id = ".$devolver_dvd_id) OR die(mysql_error());
			$mysql->desconecta;
		}
		
		if ($atualizaAluguel){
			echo "<script>alert('Devolução efetuada com sucesso!');</script>";
			echo "<script>window.location.href = 'index.php';;</script>";
		}
	}
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $metaRobots;?>
	
    <meta name="description" content="">
    <link rel="icon" href="">

    <title>Filmes locados para  - <?php echo $nomeSite;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $dominio;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link href="<?php echo $dominio;?>css/style.css" rel="stylesheet">
  </head>

  <body>
	
	<div class="container">
	  
	  <!-- header -->
      <?php include_once("_header.php");?>

	  <div class="row more-t50 more-b30">
	  
		<div class="col-md-12">
			<h2>
				<span class="more-r10">Cliente / DVD Locado</span>
			</h2>
		</div>
	  
	  </div>
		
	  
	  <div class="row more-t30 more-b10">
		<div class="col-md-6">
			<p><strong>Cliente:</strong> <?php echo $cli_nome;?><br>
			RG: <?php echo $cli_numero_rg;?></p>
			
			<p><strong>Data de locação:</strong> <?php echo $alu_data_aluguel;?><br>
			<strong>Data limite de recebimento:</strong> <?php echo $alu_data_recebimento;?></p>
			
		</div>
		
		<div class="col-md-6">
			<p><strong>Filme(s) locado(s):</strong>
			<br><?php echo $dvd_nome;?></p>
		</div>
		
	  </div>
	  
	  <div class="row more-t20 more-b30">
		
		<div class="col-md-6">
			<h3><strong>Pagamento</strong></h3>
			<p>
			Valor total: R$ <?php echo $alu_preco_total;?><br>
			Desconto aplicado: R$ <?php echo $alu_preco_desconto;?><br>
			
			<h3>Valor a pagar: R$ <?php echo $alu_preco_liquido;?></h3>
			</p>
		</div>
		
		<div class="col-md-6">
			<form action="" name="finaliza-locacao" method="POST">
				
				<div class="input-group more-b10">
				  <label>Dias de atraso:</label>
				  <input type="number" class="form-control" name="alu_quantidade_dias_atraso"  id="alu_quantidade_dias_atraso" value="<?php if (!empty($alu_quantidade_dias_atraso)) echo $alu_quantidade_dias_atraso; ?>" maxlength="11">
				</div>
				
				<input type="submit" class="btn more-t20 btn-lg" role="button" name="finalizar-locacao" value="Finalizar Locação">
				
			</form>
		</div>
	</div>
			
      <!-- footer -->
      <?php include_once("_footer.php");?>

    </div> <!-- /container -->
	
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	
	
  </body>
</html>
