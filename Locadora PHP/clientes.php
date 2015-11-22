<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "clientes";
	
	if ($_POST['pesquisar'] == "Pesquisar"){
		$nomeCliente = $_POST['pesquisar-cliente'];
		
		$busca = "WHERE CLI.cli_nome LIKE '%".$nomeCliente."%' ";
	}
	
	$mysql = new conexao;
	$listarClientes = $mysql->sql_query("SELECT CLI.cli_id, CLI.cli_nome, CLI.cli_situacao, CLI.cli_data_cadastro, CLI.cli_numero_rg FROM clientes CLI ".$busca."ORDER BY CLI.cli_data_cadastro DESC");
	$mysql->desconecta;
	
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

    <title>Clientes - <?php echo $nomeSite;?></title>

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
				<span class="more-r10">Clientes</span>
				<a class="btn btn-success" href="cadastrar-cliente.php" role="button">Cadastrar cliente</a>
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
	  
	  <table class="table">
	  
			<tr>
				<td><strong>Id</strong></td>
				<td><strong>Nome</strong></td>
				<td><strong>RG</strong></td>
				<td><strong>Data Cadastro</strong></td>
				<td><strong>Ativo</strong></td>
			</tr>
	  
			<?php
				while($cliente = mysql_fetch_object($listarClientes)){ 
					$cli_id = $cliente->cli_id;
					$cli_nome = $cliente->cli_nome;
					$cli_numero_rg = $cliente->cli_numero_rg;
					$cli_data_cadastro = formataDataCompleta($cliente->cli_data_cadastro);
					$cli_situacao = $cliente->cli_situacao;
					
					if ($cli_situacao == 1) {
						$cli_situacao = "Sim";
					} else {
						$cli_situacao = "Não";
					}
					
					echo "
					<tr>
						<td>".$cli_id."</td>
						<td><a href=\"editar-cliente.php?id=".$cli_id."\">".$cli_nome."</a></td>
						<td>".$cli_numero_rg."</td>
						<td>".$cli_data_cadastro."</td>
						<td>".$cli_situacao."</td>
					</tr>
					";
					
				}
			?>
	  
	  </table>

      <!-- footer -->
      <?php include_once("_footer.php");?>

    </div> <!-- /container -->
	
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	
	
  </body>
</html>
