<?php

include_once("mysql_class.php");

/* Atualiza DVD
**/
function atualizaDvd($dvd_codigo_interno, $dvd_nome, $dvd_cla_id, $dvd_pro_id, $dvd_data_lancamento, $dvd_preco_custo, $dvd_preco_aluguel, $dvd_sinopse, $dvd_situacao){
	
	if ( (empty($dvd_nome)) || (empty($dvd_cla_id)) || (empty($dvd_pro_id)) || (empty($dvd_data_lancamento)) || (empty($dvd_preco_custo)) ||
		 (empty($dvd_preco_aluguel)) || (empty($dvd_sinopse)) ){
		return 0;
	} else {
		
		$dvd_situacao = (isset($_POST['dvd_situacao'])) ? 1 : 0;
		
		$mysql = new conexao;
		$atualizaDvd = $mysql->sql_query("UPDATE dvds SET 
												dvd_nome = '".$dvd_nome."', 
												dvd_cla_id = ".$dvd_cla_id.",
												dvd_pro_id = ".$dvd_pro_id.",
												dvd_data_lancamento = '".$dvd_data_lancamento."',
												dvd_preco_custo = ".$dvd_preco_custo.",
												dvd_preco_aluguel = ".$dvd_preco_aluguel.",
												dvd_sinopse = '".$dvd_sinopse."',
												dvd_situacao = '".$dvd_situacao."'
												WHERE dvd_codigo_interno = ".$dvd_codigo_interno) OR die(mysql_error());
		$mysql->desconecta;
		
		if($atualizaDvd) {
			return 1;
		} else {
			return 2;
		}
	}
}

/* Cadastrar DVD
**/
function cadastraDvd($dvd_nome, $dvd_cla_id, $dvd_pro_id, $dvd_data_lancamento, $dvd_preco_custo, $dvd_preco_aluguel, $dvd_situacao, $dvd_sinopse){

	if ( (empty($dvd_nome)) || (empty($dvd_cla_id)) || (empty($dvd_pro_id)) || (empty($dvd_data_lancamento)) || (empty($dvd_preco_custo)) ||
		 (empty($dvd_preco_aluguel)) || (empty($dvd_sinopse)) ){
		return 0;
	} else {
		
		$dvd_situacao = (isset($_POST['dvd_situacao'])) ? 1 : 0;
		$dvd_codigo_interno = geraRand(5);
		
		$mysql = new conexao;
		$cadastrarDvd = $mysql->sql_query("INSERT INTO dvds (
												dvd_nome, 
												dvd_cla_id, 
												dvd_pro_id, 
												dvd_situacao,
												dvd_data_lancamento,
												dvd_preco_custo,
												dvd_preco_aluguel,
												dvd_sinopse,
												dvd_codigo_interno) VALUES (
												'".$dvd_nome."',
												".$dvd_cla_id.",
												".$dvd_pro_id.",
												".$dvd_situacao.",
												'".$dvd_data_lancamento."',
												".$dvd_preco_custo.",
												".$dvd_preco_aluguel.",
												'".$dvd_sinopse."',
												".$dvd_codigo_interno.")") OR die(mysql_error());
		$mysql->desconecta;
		
		if($cadastrarDvd) {
			return 1;
		} else {
			return 2;
		}
	}
}


/* Função gera número randômico
**/
function geraRand($num){
	return substr(uniqid(rand(), true),-($num));
}

/* Atualizar cliente
**/
function atualizaCliente($id_cliente, $cli_nome, $cli_data_nascimento, $cli_situacao, $cli_percentual_desconto, $cli_numero_rg, $cli_numero_cpf){
	
	if ( (empty($cli_nome)) || (empty($cli_numero_rg)) || (empty($cli_numero_cpf)) ){
		return 0;
	} else {
		
		$cli_situacao = (isset($_POST['cli_situacao'])) ? 1 : 0;
		
		$mysql = new conexao;
		$atualizaCliente = $mysql->sql_query("UPDATE clientes SET 
												cli_nome = '".$cli_nome."', 
												cli_data_nascimento = '".$cli_data_nascimento."',
												cli_situacao = ".$cli_situacao.",
												cli_percentual_desconto = ".$cli_percentual_desconto.",
												cli_numero_rg = '".$cli_numero_rg."',
												cli_numero_cpf = ".$cli_numero_cpf." WHERE cli_id = ".$id_cliente) OR die(mysql_error());
		$mysql->desconecta;
		
		if($atualizaCliente) {
			return 1;
		} else {
			return 2;
		}
	}
}

/* Cadastrar cliente
**/
function cadastraCliente($cli_nome, $cli_data_nascimento, $cli_situacao, $cli_percentual_desconto, $cli_numero_rg, $cli_numero_cpf){
	
	if ( (empty($cli_nome)) || (empty($cli_numero_rg)) || (empty($cli_numero_cpf)) ){
		return 0;
	} else {
		
		$cli_data_cadastro = dataHoraAtual();
		$cli_situacao = (isset($_POST['cli_situacao'])) ? 1 : 0;
		
		$mysql = new conexao;
		$cadastraCliente = $mysql->sql_query("INSERT INTO clientes (
												cli_nome, 
												cli_data_nascimento, 
												cli_data_cadastro, 
												cli_situacao,
												cli_percentual_desconto,
												cli_numero_rg,
												cli_numero_cpf) VALUES (
												'".$cli_nome."',
												'".$cli_data_nascimento."',
												'".$cli_data_cadastro."',
												".$cli_situacao.",
												".$cli_percentual_desconto.",
												'".$cli_numero_rg."',
												".$cli_numero_cpf.")") OR die(mysql_error());
		$mysql->desconecta;
		
		if($cadastraCliente) {
			return 1;
		} else {
			return 2;
		}
	}
}

/* Retorna dataHora atual
**/
function dataHoraAtual() {
	return date ("Y-m-d H:i:s");
}

/* Criar Slug. Ex: Teste do João => teste-do-joao
** Parâmetros: $var = texto em questão
**/
function trataTxt2($var) {
	$var = strtolower( preg_replace( array( '/[`^~\'"]/', '/\W+/' ), array( null, '-' ), iconv( 'iso-8859-1', 'ASCII//TRANSLIT', $var ) ) );
	return $var;
}

/* Exibe o resumo de um texto
** Retorno: string
** Parâmetros: $str = TEXTO, $startPos = Posição inicial, $maxLength = Qtd de Caracteres do resumo
**/
function obterResumo($str, $startPos=0, $maxLength=100) {
	$str = ereg_replace("\n", " ", $str);
	$str = ereg_replace("<br>", " ", $str);
	$str = strip_tags($str);
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength-3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}
	
	return $excerpt;
}

/* Data: 22 de setembro de 2015
** Retorno: string
**/
function formataData($data){
	setlocale(LC_TIME, 'portuguese'); 
	date_default_timezone_set('America/Sao_Paulo');
	//return $data = strftime("%A, %d de %B de %Y", strtotime("$data")); //EXIBE o dia da semana
	return $data = strftime("%d de %B de %Y", strtotime("$data"));
}

/*  Data: 22/09/15
**  Retorno: string
**/
function formataData2($data){
	setlocale(LC_TIME, 'portuguese'); 
	date_default_timezone_set('America/Sao_Paulo');
	//return $data = strftime("%A, %d de %B de %Y", strtotime("$data")); //EXIBE o dia da semana
	return $data = strftime("%d/%m/%y", strtotime("$data"));
}

/*  Formata Data Completa: 22/09/15 - 14h23
**  Retorno: string
**/
function formataDataCompleta($data){
	setlocale(LC_TIME, 'portuguese'); 
	date_default_timezone_set('America/Sao_Paulo');
	
	$dt = strtotime($data);
	return date("d/m/Y - H\hi", $dt);
}

//retorna a data, a hora ou ambos
function dataHora($novadata, $novahora, $retorno){
	$novadata = substr($novadata,8,2) . "/" .substr($novadata,5,2) . "/" . substr($novadata,2,2);
	$novahora = substr($novahora,0,2) . ":" .substr($novahora,3,2);
	
	if ($retorno == "datahora"){
		return $novadata." ".$novahora;
	} else if ($retorno == "data"){
		return $novadata;
	} else if ($retorno == "hora"){
		return $novahora;
	}
}


/*  Pega número de string
**  Retorno: número
**/
function pegaNumero($val) { 
  if (is_numeric($val)) { 
    return $val + 0; 
  } 
  return 0; 
}

/*  Testa se é número
**  Retorno: true or false
**/
function testaNumero($val) { 
  if (is_numeric($val)) { 
    return true; 
  } 
  return false; 
} 

/*  Limpa string para realizar consulta no banco
**  Retorno: string
**/
function cleanString($string){
	return trim(addslashes(strip_tags($string)));
}

?>