<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "dvds";
	
	$mysql = new conexao;
	$listaClassificacao = $mysql->sql_query("SELECT cla_id, cla_descricao FROM classificacao") OR die(mysql_error());
	$mysql->desconecta;
	
	$mysql = new conexao;
	$listaProdutoras = $mysql->sql_query("SELECT pro_id, pro_nome FROM produtoras WHERE pro_situacao = 1") OR die(mysql_error());
	$mysql->desconecta;
	
	if ($_POST['cadastrar-dvd'] == "Cadastrar"){
		
		$dvd_nome = cleanString($_POST['dvd_nome']);
		$dvd_cla_id = cleanString($_POST['dvd_cla_id']);
		$dvd_pro_id = cleanString($_POST['dvd_pro_id']);
		$dvd_data_lancamento = cleanString($_POST['dvd_data_lancamento']);
		$dvd_preco_custo = cleanString($_POST['dvd_preco_custo']);
		$dvd_preco_aluguel = cleanString($_POST['dvd_preco_aluguel']);
		$dvd_situacao = cleanString($_POST['dvd_situacao']);
		$dvd_sinopse = cleanString($_POST['dvd_sinopse']);
		
		$returnCadastraDvd = cadastraDvd($dvd_nome, $dvd_cla_id, $dvd_pro_id, $dvd_data_lancamento, $dvd_preco_custo, $dvd_preco_aluguel, $dvd_situacao, $dvd_sinopse);
		
		if ($returnCadastraDvd == 1){
			echo "<script>alert('DVD cadastrado com sucesso!');</script>";
			echo "<script>window.location.href = 'dvds.php';;</script>";
		} else if ($returnCadastraDvd == 2){
			echo "<script>alert('Erro ao cadastrar DVD');</script>";
		} else if ($returnCadastraDvd == 0){
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
	
    <title>Cadastrar DVD's - <?php echo $nomeSite;?></title>

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
		<span class="more-r10">Cadastrar DVD</span>
		<a class="btn btn-success" href="dvds.php" role="button"> ← Listar DVD's</a>
	  </h2>
	  
	  <form action="" name="cadastro-dvd" method="POST">
	  
	  <div class="row">
	  
		<div class="col-md-6">
			<div class="input-group more-b10">
				<label style="float: left;">Título *</label>
				<input type="text" class="form-control" name="dvd_nome" id="dvd_nome" maxlength="255" value="<?php if (!empty($dvd_nome)) echo $dvd_nome; ?>" style="max-width: 300px;">
			</div>
			
			
			<div class="input-group more-b10">
				<label style="float: left;">Classificação *</label>
				<select class="form-control" name="dvd_cla_id" id="dvd_cla_id">
					<option value="">Selecione..</option>
					
					<?php
					while($classificacao = mysql_fetch_object($listaClassificacao)){ 
						$cla_id = $classificacao->cla_id;
						$cla_descricao = $classificacao->cla_descricao;
						
						echo '<option value="'.$cla_id.'">'.$cla_descricao.'</option>';
					}
					?>
					
				</select>
			</div>
			
			<div class="input-group more-b10">
				<label style="float: left;">Produtora *</label>
				<select class="form-control" name="dvd_pro_id" id="dvd_pro_id">
					<option value="">Selecione..</option>
					
					<?php
					while($produtora = mysql_fetch_object($listaProdutoras)){ 
						$pro_id = $produtora->pro_id;
						$pro_nome = $produtora->pro_nome;
						
						echo '<option value="'.$pro_id.'">'.$pro_nome.'</option>';
					}
					?>
				</select>
			</div>
			
			<div class="input-group more-b10">
			  <label style="float: left;">Data de Lançamento *</label><br>
			  <input type="date" class="form-control" name="dvd_data_lancamento" id="dvd_data_lancamento" value="<?php if (!empty($dvd_data_lancamento)) echo $dvd_data_lancamento; ?>" style="max-width: 170px;">
			</div>
			
		</div> <!-- /col-md-6 -->
		
		<div class="col-md-6">
		
			<div class="input-group more-b10 more-t30">
				<input type="checkbox" name="dvd_situacao" id="dvd_situacao" value="1" checked>
				<label>Ativo</label>
			</div>
			
			<div class="input-group more-b10">
			  <label>Preço de custo *</label>
			  <input type="text" class="form-control" name="dvd_preco_custo"  id="dvd_preco_custo" value="<?php if (!empty($dvd_preco_custo)) echo $dvd_preco_custo; ?>" maxlength="10">
			</div>
			
			<div class="input-group more-b10">
			  <label>Preço de aluguel *</label>
			  <input type="text" class="form-control" name="dvd_preco_aluguel"  id="dvd_preco_aluguel" value="<?php if (!empty($dvd_preco_aluguel)) echo $dvd_preco_aluguel; ?>" maxlength="10">
			</div>
		
		</div> <!-- /col-md-6 -->
		
	  </div> <!-- /row -->
	
	  <div class="row">
		<div class="col-md-12">
			<div class="input-group more-b10">
				<label>Sinopse</label><br>
				<textarea class="form-control" name="dvd_sinopse" id="dvd_sinopse" rows="3" style="width: 800px;"><?php if (!empty($dvd_sinopse)) echo $dvd_sinopse; ?></textarea>
			</div>
		</div>
	  </div>
	
	  <em>Campos marcados com (*) são obrigatórios!</em><br>
	
	  <input type="submit" class="btn more-t20 btn-lg" role="button" name="cadastrar-dvd" value="Cadastrar">
	  </form>
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
