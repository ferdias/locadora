<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "clientes";
	
	//obtem id do cliente
	if(!empty($_GET['id'])){
		$id_cliente = cleanString(pegaNumero($_GET['id']));
	} else {
		header ("location: dvds.php");
	}
	
	$mysql = new conexao;
	$infoCliente = $mysql->sql_query("SELECT CLI.cli_id, CLI.cli_nome, CLI.cli_data_nascimento, CLI.cli_data_cadastro, CLI.cli_situacao, CLI.cli_percentual_desconto, CLI.cli_numero_rg, CLI.cli_numero_cpf FROM clientes CLI WHERE CLI.cli_id = ".$id_cliente." ORDER BY CLI.cli_data_cadastro DESC");
	$mysql->desconecta;
	
	if (mysql_num_rows($infoCliente) < 1) header("location: clientes.php");
	
	//Atribui dados do cliente às variáveis
	while($cliente = mysql_fetch_object($infoCliente)){ 
		$cli_id = $cliente->cli_id;
		$cli_nome = $cliente->cli_nome;
		$cli_data_nascimento = $cliente->cli_data_nascimento;
		$cli_data_cadastro = formataDataCompleta($cliente->cli_data_cadastro);
		$cli_situacao = $cliente->cli_situacao;
		$cli_percentual_desconto = $cliente->cli_percentual_desconto;
		$cli_numero_rg = $cliente->cli_numero_rg;
		$cli_numero_cpf = $cliente->cli_numero_cpf;
	}
	
	//Atualiza cliente
	if ($_POST['atualizar-cliente'] == "Atualizar"){
		
		$cli_nome_up = cleanString($_POST['cli_nome']);
		$cli_data_nascimento_up = cleanString($_POST['cli_data_nascimento']);
		$cli_situacao_up = cleanString($_POST['cli_situacao']);
		$cli_percentual_desconto_up = cleanString($_POST['cli_percentual_desconto']);
		$cli_numero_rg_up = cleanString($_POST['cli_numero_rg']);
		$cli_numero_cpf_up = cleanString($_POST['cli_numero_cpf']);
		
		$returnAtualizaCliente = atualizaCliente($id_cliente, $cli_nome_up, $cli_data_nascimento_up, $cli_situacao_up, $cli_percentual_desconto_up, $cli_numero_rg_up, $cli_numero_cpf_up);
		
		if ($returnAtualizaCliente == 1){
			echo "<script>alert('Cliente atualizado com sucesso!');</script>";
			echo "<script>window.location.href = 'clientes.php';;</script>";
		} else if ($returnAtualizaCliente == 2){
			echo "<script>alert('Erro ao atualizar cliente');</script>";
		} else if ($returnAtualizaCliente == 0){
			echo "<script>alert('Preencha os campos obrigatórios marcados com *');</script>";
		}	
	}
	
	//Se pressionado o botão excluir, exclui cliente
	if ($_POST['excluir-cliente'] == "Excluir"){
		$mysql = new conexao;
		$deletaCliente = $mysql->sql_query("DELETE FROM clientes WHERE cli_id = ".$id_cliente);
		$mysql->desconecta;
		
		if($deletaCliente){
			echo "<script>alert('Cliente deletado com sucesso!');</script>";
			echo "<script>window.location.href = 'clientes.php';;</script>";
		}
	}
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Atualizar Cliente - <?php echo $nomeSite;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $dominio;?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $dominio;?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo $dominio;?>css/bootstrap-modal.css" rel="stylesheet">
	
    <!-- CSS Personalizado -->
    <link href="<?php echo $dominio;?>css/style.css" rel="stylesheet">
  </head>

  <body>
	
	<div class="container">
	  
	  <!-- header -->
      <?php include_once("_header.php");?>

      <h2 class="more-t50 more-b30">
		<span class="more-r10">Editar Cliente</span>
		<a class="btn btn-success" href="clientes.php" role="button"> ← Listar todos clientes</a>
	  </h2>
	  
	  <p class="more-b20"><strong>Cliente desde:</strong> <?php echo $cli_data_cadastro;?></p>
	  
	  <form action="" name="editar-cliente" method="POST">
			
		<div class="container">
		  <div class="row">
		  
			<div class="col-md-6">
				<div class="input-group more-b10">
					<label>Nome *</label>
					<input type="text" class="form-control" name="cli_nome" id="cli_nome" maxlength="255" value="<?php if (!empty($cli_nome)) echo $cli_nome; ?>" style="max-width: 300px;">
				</div>
				
				<div class="input-group more-b10">
				  <label>Data de Nascimento</label><br>
				  <input type="date" class="form-control" name="cli_data_nascimento" max="<?php echo (date("Y")-15);?>-12-31" min="<?php echo date("Y")-110;?>-12-31" id="cli_data_nascimento" value="<?php if (!empty($cli_data_nascimento)) echo $cli_data_nascimento; ?>" style="max-width: 170px;">
				</div>
				
				<div class="input-group more-b10">
				  <label>Desconto (%)</label>
				  <input type="number" class="form-control" name="cli_percentual_desconto" id="cli_percentual_desconto"  min="0" max="100" value="<?php if (!empty($cli_percentual_desconto)) echo $cli_percentual_desconto; ?>">
				</div>
			</div> <!-- /col-md-6 -->
			
			<div class="col-md-6">
			
				<div class="input-group more-b10 more-t30">
					<input type="checkbox" name="cli_situacao" id="cli_situacao" value="<?php if ($cli_situacao == 1) echo "1";?>" <?php if ($cli_situacao == 1) echo "checked";?>>
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
		</div>
		  <em>Campos marcados com (*) são obrigatórios!</em><br>
		
		  <input type="submit" class="btn more-t20 btn-lg more-r20" role="button" name="atualizar-cliente" value="Atualizar">
		  <input class="btn btn-danger" type="submit" name="excluir-cliente" value="Excluir" style="margin-top: 20px;">
	  </form>
	  
	  <!-- footer -->
	  <?php include_once("_footer.php");?>
	  
	</div> <!-- /container -->
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	<script src="<?php echo $dominio;?>js/bootstrap-modalmanager.js"></script>
	<script src="<?php echo $dominio;?>js/bootstrap-modal.js"></script>

  </body>
</html>
