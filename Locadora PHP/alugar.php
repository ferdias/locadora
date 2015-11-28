<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "alugar";
	
	$mysql = new conexao;
	$listarDvds = $mysql->sql_query("SELECT DVD.dvd_id, DVD.dvd_nome
									FROM dvds DVD
									WHERE DVD.dvd_situacao = 1 ORDER BY DVD.dvd_nome DESC");
	$mysql->desconecta;
	
	$mysql = new conexao;
	$listarClientes = $mysql->sql_query("SELECT CLI.cli_id, CLI.cli_nome, CLI.cli_numero_rg
										FROM clientes CLI WHERE CLI.cli_situacao = 1 ORDER BY CLI.cli_nome DESC");
	$mysql->desconecta;
	
	if ($_POST['alugar-dvd'] == "Alugar"){
		
		$cli_id = $_POST['cli_id'];
		
		$dvds_id = array();
		$dvds_id = $_POST['dvd_id'];
		
		if (empty($dvds_id)){
			echo "<script>alert('Selecione ao menos um DVD e um Cliente para efetuar a locação!')</script>";
		} else{
			//Função de aluguel de DVD
			echo alugaDvd($cli_id, $dvds_id);
			header("location: dvds-locados.php");
		}
		
	}

		
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alugar DVD - <?php echo $nomeSite;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $dominio;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link href="<?php echo $dominio;?>css/style.css" rel="stylesheet">
	<link href="<?php echo $dominio;?>css/chosen.css" rel="stylesheet">
  </head>

  <body>
	
	<div class="container">
	  
	  <!-- header -->
      <?php include_once("_header.php");?>

		
	  <h2 class="more-t50 more-b30">
		<span class="more-r10">Alugar DVD &nbsp;&nbsp;<span style="font-size: 14px;"><a href="dvds-locados.php">DVD's locados →</a></span></span>
	  </h2>
	  
	  <form action="" name="form-loca-dvd" method="POST">
		  <h3>Filmes</h3>
				<select data-placeholder="Selecione um ou mais filmes para locação..." name="dvd_id[]" multiple class="chosen-select" tabindex="8">
					 <?php
						while($dvd = mysql_fetch_object($listarDvds)){ 
						
							$dvd_id = $dvd->dvd_id;
							$dvd_nome = $dvd->dvd_nome;
							$cla_descricao = $dvd->cla_descricao;
							
							echo "
							<option value=".$dvd_id.">".$dvd_nome."</option>
							";
							
						}
					?>
				</select>
				
			
			<h3>Cliente</h3>
			<select class="form-control" data-placeholder="Selecione o cliente" name="cli_id">
			
				
				<?php
					while($cliente = mysql_fetch_object($listarClientes)){ 
						$cli_id = $cliente->cli_id;
						$cli_nome = $cliente->cli_nome;
						$cli_numero_rg = $cliente->cli_numero_rg;
						
						echo "
							<option value=".$cli_id.">".$cli_nome." - RG ".$cli_numero_rg."</option>
						";
						
					}
				?>
				
			</select>
			
			<input type="submit" class="btn btn-success btn-lg more-t30" role="button" name="alugar-dvd" id="alugar-dvd" value="Alugar">

		</form>
		
      <!-- footer -->
      <?php include_once("_footer.php");?>

    </div> <!-- /container -->
	
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	<script src="<?php echo $dominio;?>js/chosen.jquery.js"></script>
	
	<script>
      $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });
    </script>
	
	
  </body>
</html>
