<?php
	include_once("_config/config.php");
	include_once("_config/functions.php");
	$pagina = "dvds";
	
	//obtem código do DVD
	if(!empty($_GET['cod'])){
		$cod = cleanString(pegaNumero($_GET['cod']));
	} else {
		header ("location: dvds.php");
	}
	
	//Busca no banco as informações do DVD
	$mysql = new conexao;
	$infoDvd = $mysql->sql_query("SELECT 
								   DVD.dvd_id,
								   DVD.dvd_nome,
								   CLA.cla_descricao,
								   PRO.pro_nome,
								   DVD.dvd_data_lancamento,
								   DVD.dvd_codigo_interno,
								   DVD.dvd_preco_custo,
								   DVD.dvd_preco_aluguel,
								   DVD.dvd_sinopse
							  FROM dvds DVD, classificacao CLA, produtoras PRO
							 WHERE DVD.dvd_cla_id = CLA.cla_id AND
								   DVD.dvd_pro_id = PRO.pro_id AND
								   DVD.dvd_codigo_interno = ".$cod." 
							 ORDER BY DVD.dvd_id DESC");
	$mysql->desconecta;
	
	//se não encontrar, redireciona para dvds
	if (mysql_num_rows($infoDvd) < 1) header("location: dvds.php");
	
	//Select para preencher a select classificação
	$mysql = new conexao;
	$listaClassificacao = $mysql->sql_query("SELECT cla_id, cla_descricao FROM classificacao") OR die(mysql_error());
	$mysql->desconecta;
	
	//Select para preencher a select produtoras
	$mysql = new conexao;
	$listaProdutoras = $mysql->sql_query("SELECT pro_id, pro_nome FROM produtoras WHERE pro_situacao = 1") OR die(mysql_error());
	$mysql->desconecta;
	
	//Atribui dados do DVD às variáveis
	while($dvd = mysql_fetch_object($infoDvd)){ 
		$dvd_id = $dvd->dvd_id;
		$dvd_nome = $dvd->dvd_nome;
		$cla_descricao_dvd = $dvd->cla_descricao;
		$pro_nome_dvd = $dvd->pro_nome;
		$dvd_data_lancamento = $dvd->dvd_data_lancamento;
		$dvd_codigo_interno = $dvd->dvd_codigo_interno;
		$dvd_preco_custo = $dvd->dvd_preco_custo;
		$dvd_preco_aluguel = $dvd->dvd_preco_aluguel;
		$dvd_sinopse = $dvd->dvd_sinopse;
	}
	
	//Atualiza DVD
	if ($_POST['atualizar-dvd'] == "Atualizar"){
		
		$dvd_nome_up = cleanString($_POST['dvd_nome']);
		$dvd_cla_id_up = cleanString($_POST['dvd_cla_id']);
		$dvd_pro_id_up = cleanString($_POST['dvd_pro_id']);
		$dvd_data_lancamento_up = cleanString($_POST['dvd_data_lancamento']);
		$dvd_preco_custo_up = cleanString($_POST['dvd_preco_custo']);
		$dvd_preco_aluguel_up = cleanString($_POST['dvd_preco_aluguel']);
		$dvd_sinopse_up = cleanString($_POST['dvd_sinopse']);

		$returnAtualizaDvd = atualizaDvd($cod, $dvd_nome_up, $dvd_cla_id_up, $dvd_pro_id_up, $dvd_data_lancamento_up, $dvd_preco_custo_up, $dvd_preco_aluguel_up, $dvd_sinopse_up);
			
		if ($returnAtualizaDvd == 1){
			echo "<script>alert('DVD atualizado com sucesso!');</script>";
			echo "<script>window.location.href = 'dvds.php';;</script>";
		} else if ($returnAtualizaDvd == 2){
			echo "<script>alert('Erro ao atualizar DVD');</script>";
		} else if ($returnAtualizaDvd == 0){
			echo "<script>alert('Preencha os campos obrigatórios marcados com *');</script>";
		}
	}
	
	//Se pressionado o botão excluir, exclui cliente
	if ($_POST['excluir-dvd'] == "Excluir"){
		
		$mysql = new conexao;
		$deletaCliente = $mysql->sql_query("DELETE FROM dvds WHERE dvd_codigo_interno = ".$cod);
		$mysql->desconecta;
		
		if($deletaCliente){
			echo "<script>alert('DVD deletado com sucesso!');</script>";
			echo "<script>window.location.href = 'dvds.php';</script>";
		}
	}
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Atualizar DVD's - <?php echo $nomeSite;?></title>

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
		<span class="more-r10">Atualizar DVD</span>
		<a class="btn btn-success" href="dvds.php" role="button"> ← Listar DVD's</a>
	  </h2>
	  
	  <p class="more-b20"><strong>Código interno:</strong> <?php echo $dvd_codigo_interno;?></p>
	  
	  <form action="" name="editar-dvd" method="POST">
	  
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
							
							if ($cla_descricao == $cla_descricao_dvd) $selected = " selected";
							
							echo '<option value="'.$cla_id.'"'.$selected.'>'.$cla_descricao.'</option>';
							$selected = "";
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
							
							if ($pro_nome == $pro_nome_dvd) $selected = " selected";
							
							echo '<option value="'.$pro_id.'"'.$selected.'>'.$pro_nome.'</option>';
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
		
		  <input type="submit" class="btn more-t20 more-r20btn-lg" role="button" name="atualizar-dvd" value="Atualizar">
		  <input class="btn btn-danger" type="submit" name="excluir-dvd" value="Excluir" style="margin-top: 20px;"/>
	  </form>
	
	<!-- footer -->
    <?php include_once("_footer.php");?>

    </div> <!-- /container -->
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo $dominio;?>js/jquery.min.js"></script>
    <script src="<?php echo $dominio;?>js/bootstrap.min.js"></script>
	
	
  </body>
</html>
