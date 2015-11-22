<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "dvds";
	
	
	if ($_POST['pesquisar'] == "Pesquisar"){
		$nomeDvd = $_POST['pesquisar-dvd'];
		
		$busca = "AND DVD.dvd_nome LIKE '%".$nomeDvd."%' ";
	}
	
	$mysql = new conexao;
	$listarDvds = $mysql->sql_query("SELECT DVD.dvd_id, DVD.dvd_nome, CLA.cla_descricao, DVD.dvd_data_lancamento, DVD.dvd_codigo_interno, DVD.dvd_situacao
									FROM dvds DVD, classificacao CLA
									WHERE DVD.dvd_cla_id = CLA.cla_id ".$busca."ORDER BY DVD.dvd_id DESC");
	$mysql->desconecta;
	
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DVD's - <?php echo $nomeSite;?></title>

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
					<span class="more-r10">DVD's</span>
					<a class="btn btn-success" href="cadastrar-dvd.php" role="button">Cadastrar DVD</a>
				</h2>
		  </div>
			
		  <div class="col-md-6">
				<form action="" method="POST" name="pesquisa-cliente">
				<h2>
					<div class="input-group pull-right"> 
					  <input type="text" class="form-control" name="pesquisar-dvd" id="pesquisar-dvd" value="<?php if (!empty($nomeDvd)) echo $nomeDvd;?>" placeholder="Pesquisar DVD...">
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
				<td><strong>Cód.</strong></td>
				<td><strong>DVD</strong></td>
				<td><strong>Classificação</strong></td>
				<td><strong>Data Lançamento</strong></td>
				<td><strong>Ativo</strong></td>
			</tr>
	  
			<?php
				while($dvd = mysql_fetch_object($listarDvds)){ 
				
					$dvd_id = $dvd->dvd_id;
					$dvd_nome = $dvd->dvd_nome;
					$cla_descricao = $dvd->cla_descricao;
					$dvd_data_lancamento = formataData($dvd->dvd_data_lancamento);
					$dvd_codigo_interno = $dvd->dvd_codigo_interno;
					$dvd_situacao = $dvd->dvd_situacao;
					
					if ($dvd_situacao == 1) {
						$dvd_situacao = "Sim";
					} else {
						$dvd_situacao = "Não";
					}
					
					echo "
					<tr>
						<td>".$dvd_codigo_interno."</td>
						<td><a href=\"editar-dvd.php?cod=".$dvd_codigo_interno."\">".$dvd_nome."</a></td>
						<td>".$cla_descricao."</td>
						<td>".$dvd_data_lancamento."</td>
						<td>".$dvd_situacao."</td>
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
