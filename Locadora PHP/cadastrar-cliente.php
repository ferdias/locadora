<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "clientes";
	
	if ($_POST['cadastrar-cliente'] == "Cadastrar"){
		
		$cli_nome = cleanString($_POST['cli_nome']);
		$cli_data_nascimento = cleanString($_POST['cli_data_nascimento']);
		$cli_situacao = cleanString($_POST['cli_situacao']);
		$cli_percentual_desconto = cleanString($_POST['cli_percentual_desconto']);
		$cli_numero_rg = cleanString($_POST['cli_numero_rg']);
		$cli_numero_cpf = cleanString($_POST['cli_numero_cpf']);
		
		$returnCadastraCliente = cadastraCliente($cli_nome, $cli_data_nascimento, $cli_situacao, $cli_percentual_desconto, $cli_numero_rg, $cli_numero_cpf);
		
		if ($returnCadastraCliente == 1){
			echo "<script>alert('Cliente inserido com sucesso!');</script>";
			echo "<script>window.location.href = 'clientes.php';;</script>";
		} else if ($returnCadastraCliente == 2){
			echo "<script>alert('Erro ao inserir cliente');</script>";
		} else if ($returnCadastraCliente == 0){
			echo "<script>alert('Preencha os campos obrigatórios marcados com *');</script>";
		}	
		
	}
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastrar Clientes - <?php echo $nomeSite;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $dominio;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link href="<?php echo $dominio;?>css/style.css" rel="stylesheet">
  </head>

  <body>
	
	<div class="container">
	  
	  <!-- header -->
      <?php include_once("_header.php");?>

      <h2 class="more-t50 more-b30">
		<span class="more-r10">Cadastrar Clientes</span>
		<a class="btn btn-success" href="clientes.php" role="button"> ← Listar clientes</a>
	  </h2>
	  
	  <form action="cadastrar-cliente.php" name="cadastro-cliente" method="POST">
	  
	  <div class="row">
	  
		<div class="col-md-6">
			<div class="input-group more-b10">
				<label style="float: left;">Nome *</label>
				<input type="text" class="form-control" name="cli_nome" id="cli_nome" maxlength="255" value="<?php if (!empty($cli_nome)) echo $cli_nome; ?>" style="max-width: 300px;">
			</div>
			
			<div class="input-group more-b10">
			  <label style="float: left;">Data de Nascimento</label><br>
			  <input type="date" class="form-control" name="cli_data_nascimento" id="cli_data_nascimento" value="<?php if (!empty($cli_data_nascimento)) echo $cli_data_nascimento; ?>" style="max-width: 170px;">
			</div>
			
			<div class="input-group more-b10">
			  <label>Desconto (%)</label>
			  <input type="number" class="form-control" name="cli_percentual_desconto" id="cli_percentual_desconto" value="<?php if (!empty($cli_percentual_desconto)) echo $cli_percentual_desconto; ?>" maxlength="3">
			</div>
		</div> <!-- /col-md-6 -->
		
		<div class="col-md-6">
		
			<div class="input-group more-b10 more-t30">
				<input type="checkbox" name="cli_situacao" id="cli_situacao" value="1" checked>
				<label>Ativo</label>
			</div>
			
			<div class="input-group more-b10">
			  <label>RG *</label>
			  <input type="text" class="form-control" name="cli_numero_rg"  id="cli_numero_rg" value="<?php if (!empty($cli_numero_rg)) echo $cli_numero_rg; ?>" maxlength="10">
			</div>
			
			<div class="input-group more-b10">
			  <label>CPF *</label>
			  <input type="text" class="form-control" name="cli_numero_cpf" id="cli_numero_cpf" value="<?php if (!empty($cli_numero_cpf)) echo $cli_numero_cpf; ?>" maxlength="12">
			</div>
		
		</div> <!-- /col-md-6 -->
		
	  </div> <!-- /row -->
	
	  <em>Campos marcados com (*) são obrigatórios!</em><br>
	
	  <input type="submit" class="btn more-t20 btn-lg" role="button" name="cadastrar-cliente" value="Cadastrar">
	  </form>
	</div>

      <!-- footer -->
      <?php include_once("_footer.php");?>
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	
	
  </body>
</html>
