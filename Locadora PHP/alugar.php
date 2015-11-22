<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "alugar";
	
	
	$mysql = new conexao;
	$listaClassificacao = $mysql->sql_query("SELECT * FROM classificacao");
	$mysql->desconecta;
	
	
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
  </head>

  <body>
	
	<div class="container">
	  
	  <!-- header -->
      <?php include_once("_header.php");?>

		
	  <h2 class="more-t50 more-b30">
		<span class="more-r10">Alugar DVD</span>
	  </h2>
	  
	  <table class="table">
			<tr>
				<td></td>
				<td></td>
			</tr>
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
