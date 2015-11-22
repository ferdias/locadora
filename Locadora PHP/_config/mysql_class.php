<?php
class conexao {
    // Coloque aqui as Informações do Banco de Dados
    var $host = "54.207.93.174";
    var $user = "root"; # Usuário no Host/Servidor
    var $senha = "sql123"; # Senha no Host/Servidor
    var $dbase = "locadora"; # Nome do seu Banco de Dados

    // Cria as variáveis que Utilizaremos
    var $query;
    var $link;
    var $resultado;
    
    function MySQL(){
		// Instancia o Objeto para usarmos
    }
	
	// Cria a função para Conectar ao Banco MySQL
    function conecta(){
        $this->link = @mysql_connect($this->host,$this->user,$this->senha);
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		// Conecta ao Banco de Dados
        if(!$this->link){
			// Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro na conexão com o Banco de Dados:";
			print "<b>".mysql_error()."</b>";
			die();
        }elseif(!mysql_select_db($this->dbase,$this->link)){
			// Seleciona o banco após a conexão
			// Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro em selecionar o Banco:";
			print "<b>".mysql_error()."</b>";
			die();
        }
    }

	// Cria a função para query no Banco de Dados
    function sql_query($query){
        $this->conecta();
        $this->query = $query;
		// Conecta e faz a query no MySQL
        if($this->resultado = mysql_query($this->query)){
            $this->desconecta();
            return $this->resultado;
        }else{
			// Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro: <b>$query</b>";
			print "<br><br>";
			print "Erro no MySQL: <b>".mysql_error()."</b>";
			die();
            $this->desconecta();
        }        
    }

	// Cria a função para Desconectar ao Banco MySQL
    function desconecta(){
        return mysql_close($this->link);
    }
	
}
?>