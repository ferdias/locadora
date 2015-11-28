<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "dvds-locados";
	
	if ($_POST['pesquisar'] == "Pesquisar"){
		$nomeCliente = $_POST['pesquisar-cliente'];
		
		$busca = " AND CLI.cli_nome LIKE '%".$nomeCliente."%' ";
	}
	
	$mysql = new conexao;
	$listarClientesDvds = $mysql->sql_query("SELECT
										  ALU.alu_id
										 ,CLI.cli_nome
										 ,CLI.cli_numero_rg
										 ,ALU.alu_data_aluguel
										 ,ALU.alu_data_recebimento
										FROM
										  clientes CLI,
										  dvds DVD,
										  aluguel ALU,
										  aluguel_itens ALUI

										WHERE 
										  CLI.cli_id = ALU.alu_cli_id AND
										  ALUI.alui_alu_id = ALU.alu_id AND
										  ALUI.alui_dvd_id = DVD.dvd_id AND
										  ALU.alu_finalizado = 0".$busca."
										GROUP BY ALU.alu_id
										ORDER BY
										  ALU.alu_data_aluguel DESC");
	$mysql->desconecta;
	
	$qtdLista = mysql_num_rows($listarClientesDvds);
	
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

    <title>DVD's Locados - <?php echo $nomeSite;?></title>

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
	  
		<div class="col-md-6">
			<h2>
				<span class="more-r10">DVD's Locados</span>
				<a class="btn btn-success" href="alugar.php" role="button">Alugar DVD</a>
			</h2>
		</div>
		
		<div class="col-md-6">
			<form action="" method="POST" name="pesquisa-cliente">
			<h2>
				<div class="input-group pull-right"> 
				  <input type="text" class="form-control" name="pesquisar-cliente" id="pesquisar-cliente" value="<?php if (!empty($nomeCliente)) echo $nomeCliente;?>" placeholder="Pesquisar cliente...">
				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit" name="pesquisar" value="Pesquisar">Pesquisar!</button>
				  </span>
				</div><!-- /input-group -->
			</h2>
			</form>
		</div>
	  
	  </div>
	  
	  <?php if ($qtdLista >= 1 ) {?>
	  <table class="table">
	  
			<tr>
				<td><strong>Id</strong></td>
				<td><strong>Nome</strong></td>
				<td><strong>RG</strong></td>
				<td><strong>Data Locação</strong></td>
				<td><strong>Devolução limite</strong></td>
			</tr>
	  
			<?php
				while($aluguel = mysql_fetch_object($listarClientesDvds)){ 
					
					$alu_id = $aluguel->alu_id;
					$cli_nome = $aluguel->cli_nome;
					$cli_numero_rg = $aluguel->cli_numero_rg;
					$alu_data_aluguel = formataDataCompleta($aluguel->alu_data_aluguel);
					$alu_data_recebimento = formataDataCompleta($aluguel->alu_data_recebimento);
					
					echo "
					<tr>
						<td>".$alu_id."</td>
						<td><a href=\"cliente-dvd-locado.php?id=".$alu_id."\">".$cli_nome."</a></td>
						<td>".$cli_numero_rg."</td>
						<td>".$alu_data_aluguel."</td>
						<td>".$alu_data_recebimento."</td>
					</tr>
					";
					
				}
			?>
	  </table>
	  
	  <?php } else {
		  echo "<p>Não foram encontradas locações!</p>";
	  }?>

      <!-- footer -->
      <?php include_once("_footer.php");?>

    </div> <!-- /container -->
	
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	
	
  </body>
</html>
