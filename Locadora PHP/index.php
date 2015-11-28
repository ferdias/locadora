<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "index";
	
	$mysql = new conexao;
	$listarDvds = $mysql->sql_query("SELECT DVD.dvd_nome, CLA.cla_descricao, DVD.dvd_sinopse, DVD.dvd_data_lancamento, DVD.dvd_codigo_interno
									FROM dvds DVD, classificacao CLA
									WHERE DVD.dvd_cla_id = CLA.cla_id AND DVD.dvd_situacao = 1 ORDER BY DVD.dvd_id DESC LIMIT 0,3");
	$mysql->desconecta;
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $nomeSite;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $dominio;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link href="<?php echo $dominio;?>css/style.css" rel="stylesheet">
  </head>

  <body>
	
	<div class="container">
	  
	  <!-- header -->
      <?php include_once("_header.php");?>

      <div class="jumbotron">
        <h1>Locacação de DVD's</h1>
        <p class="lead">Clique no botão abaixo para locar um filme.</p>
        <p><a class="btn btn-lg btn-success" href="alugar.php" role="button">ALUGAR DVD</a></p>
      </div>

	  <h1 class="chamada-texto">Alguns de nossos filmes disponíveis</h1>

      <div class="row">
        
			<?php
				while($dvd = mysql_fetch_object($listarDvds)){ 
				
					$dvd_id = $dvd->dvd_id;
					$dvd_nome = obterResumo($dvd->dvd_nome, 0, 28);
					$dvd_sinopse = obterResumo($dvd->dvd_sinopse, 0, 100);
					$cla_descricao = $dvd->cla_descricao;
					$dvd_data_lancamento = formataData($dvd->dvd_data_lancamento);
					$dvd_codigo_interno = $dvd->dvd_codigo_interno;
					
					echo '
						<div class="col-lg-4">
						  <h2><a href="editar-dvd.php?cod='.$dvd_codigo_interno.'">'.$dvd_nome.'</a></h2>
						  <p>'.$dvd_sinopse.'</p>
						  <p><a class="btn btn-primary" href="editar-dvd.php?cod='.$dvd_codigo_interno.'" role="button">Ver DVD &raquo;</a></p>
						</div>
					';
					
				}
			?>
		
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
