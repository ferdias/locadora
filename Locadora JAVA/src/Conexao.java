//Classes necessárias para uso de Banco de dados //

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import com.mysql.fabric.xmlrpc.base.Array;
import com.mysql.jdbc.exceptions.jdbc4.MySQLIntegrityConstraintViolationException;

//Início da classe de conexão//

public class Conexao {

	public static String status = "Não conectou...";

	// Método Construtor da Classe//

	public Conexao() {

	}

	// Método de Conexão//

	public static java.sql.Connection getConexaoMySQL() {

		Connection connection = null; // atributo do tipo Connection

		try {

			// Carregando o JDBC Driver padrão

			String driverName = "com.mysql.jdbc.Driver";

			Class.forName(driverName);

			// Configurando a nossa conexão com um banco de dados//

			String serverName = "54.207.93.174:3306"; // caminho do servidor do
														// BD

			String mydatabase = "locadora"; // nome do seu banco de dados

			String url = "jdbc:mysql://" + serverName + "/" + mydatabase;

			String username = "root"; // nome de um usuário de seu BD

			String password = "sql123"; // sua senha de acesso

			connection = DriverManager.getConnection(url, username, password);

			// Testa sua conexão//

			if (connection != null) {

				status = ("STATUS--->Conectado com sucesso!");

			} else {

				status = ("STATUS--->Não foi possivel realizar conexão");

			}

			return connection;

		} catch (ClassNotFoundException e) { // Driver não encontrado

			System.out.println("O driver expecificado nao foi encontrado.");

			return null;

		} catch (SQLException e) {

			// Não conseguindo se conectar ao banco

			System.out
					.println("Nao foi possivel conectar ao Banco de Dados. Deu Merda!");

			return null;

		}

	}

	// Método que retorna o status da sua conexão//

	public static String statusConection() {

		return status;

	}

	// Método que fecha sua conexão//

	public static boolean FecharConexao() {

		try {

			Conexao.getConexaoMySQL().close();

			return true;

		} catch (SQLException e) {

			return false;

		}
	}

	// Método que reinicia sua conexão//

	public static java.sql.Connection ReiniciarConexao() {

		FecharConexao();

		return Conexao.getConexaoMySQL();

	}
	

	public List<Classificacao> buscarTodosClassificacao() {
		try {
			Connection conn;
			Statement st;
			ResultSet rs;
			String comando = "select * from classificacao";
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			rs = st.executeQuery(comando);
			List<Classificacao> listaClassificacao = new ArrayList<Classificacao>();
			Classificacao classificacao;
			while (rs.next()) {
				classificacao = new Classificacao();
				classificacao.setClaId(rs.getInt(1));
				classificacao.setClaDescricao(rs.getString(2));
				listaClassificacao.add(classificacao);
			}
			return listaClassificacao;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new ArrayList<Classificacao>();
	};

	public List<Produtora> buscarTodosProdutoras() {
		try {
			Connection conn;
			Statement st;
			ResultSet rs;
			String comando = "select * from produtoras";
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			rs = st.executeQuery(comando);
			List<Produtora> listaProdutora = new ArrayList<Produtora>();
			Produtora produtora;
			while (rs.next()) {
				produtora = new Produtora();
				produtora.setProId(rs.getInt(1));
				produtora.setProNome(rs.getString(2));
				produtora.setProSituacao(rs.getInt(3));
				listaProdutora.add(produtora);
			}
			return listaProdutora;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new ArrayList<Produtora>();
	};

	public Classificacao buscarPorClassificacaoId(Integer id) {
		try {
			Connection conn;
			Statement st;
			ResultSet rs;
			String comando = "select * from classificacao where cla_id = " + id;
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			rs = st.executeQuery(comando);
			Classificacao classificacao = new Classificacao();
			while (rs.next()) {
				classificacao.setClaId(rs.getInt(1));
				classificacao.setClaDescricao(rs.getString(2));
			}
			return classificacao;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new Classificacao();
	};

	public Produtora buscarPorProdutoraId(Integer id) {
		try {
			Connection conn;
			Statement st;
			ResultSet rs;
			String comando = "select * from produtoras where pro_id = " + id;
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			rs = st.executeQuery(comando);
			Produtora produtora = new Produtora();
			while (rs.next()) {
				produtora.setProId(rs.getInt(1));
				produtora.setProNome(rs.getString(2));
				produtora.setProSituacao(rs.getInt(3));
			}
			return produtora;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new Produtora();

	};

	public Boolean deletarClassicacao(Integer id) {
		Connection conn;
		Statement st;
		StringBuilder stb = new StringBuilder();
		try {
			stb.append("delete from classificacao ");
			stb.append(" where cla_id = " + id);

			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			st.executeUpdate(stb.toString());
			return true;
		}catch (MySQLIntegrityConstraintViolationException ex) {
				return false;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return true;
	};

	public Boolean deletarProdutora(Integer id) {
		Connection conn;
		Statement st;
		StringBuilder stb = new StringBuilder();
		try {
			stb.append("delete from produtoras ");
			stb.append(" where pro_id = " + id);

			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			st.executeUpdate(stb.toString());
			return true;
		}catch (MySQLIntegrityConstraintViolationException ex) {
				return false;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return true;
	};

	public void cadastrarProdutora(Produtora produtora) {
		Connection conn;
		Statement st;
		StringBuilder stb = new StringBuilder();

		try {

			if (!produtora.getProNome().isEmpty() && produtora.getProSituacao() != null) {
				stb.append("insert into  produtoras");
				stb.append("  (pro_nome, pro_situacao)");
				stb.append("values ");
				stb.append("  ( '" + produtora.getProNome() + "' , " + produtora.getProSituacao() + ")");
			}
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			st.executeUpdate(stb.toString());

		} catch (Exception e) {
			e.printStackTrace();
		}		
	};

	public void cadastrarClassificacao(Classificacao classificacao) {
		Connection conn;
		Statement st;
		StringBuilder stb = new StringBuilder();

		try {

			if (!classificacao.getClaDescricao().isEmpty()) {
				stb.append("insert into  classificacao");
				stb.append("  (cla_descricao)");
				stb.append("values ");
				stb.append("  ( '" + classificacao.getClaDescricao() + "')");
			}
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			st.executeUpdate(stb.toString());

		} catch (Exception e) {
			e.printStackTrace();
		}
	};

	public void alterarClassificacao(Classificacao classificacao) {
		Connection conn;
		Statement st;
		StringBuilder stb = new StringBuilder();

		try {
			stb.append("update classificacao ");
			stb.append("   set cla_descricao = '" + classificacao.getClaDescricao() + "' ");
			stb.append(" where cla_id = " + classificacao.getClaId());
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			st.executeUpdate(stb.toString());

		} catch (Exception e) {
			e.printStackTrace();
		}
	};

	public void alterarProdutora(Produtora produtora) {
		Connection conn;
		Statement st;
		StringBuilder stb = new StringBuilder();

		try {
			stb.append("update produtoras ");
			stb.append("   set pro_nome = '" + produtora.getProNome() + "', ");
			stb.append("   pro_situacao = " + produtora.getProSituacao());
			stb.append(" where pro_id = " + produtora.getProId());
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			st.executeUpdate(stb.toString());

		} catch (Exception e) {
			e.printStackTrace();
		}
	};

	public Produtora buscarPorProdutora(String nomeProdutora) {
		try {
			Connection conn;
			Statement st;
			ResultSet rs;
			String comando = "select * from produtoras where pro_nome like '% " + nomeProdutora + "%'";
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			rs = st.executeQuery(comando);
			Produtora produtora = new Produtora();
			while (rs.next()) {
				produtora.setProId(rs.getInt(1));
				produtora.setProNome(rs.getString(2));
				produtora.setProSituacao(rs.getInt(3));
			}
			return produtora;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new Produtora();
	};

	public Classificacao buscarPorClassificacao(String claDescricao) {
		try {
			Connection conn;
			Statement st;
			ResultSet rs;
			String comando = "select * from classificacao where cla_descricao like '% " + claDescricao + "%'";;
			conn = Conexao.getConexaoMySQL();
			st = conn.createStatement();
			rs = st.executeQuery(comando);
			Classificacao classificacao = new Classificacao();
			while (rs.next()) {
				classificacao.setClaId(rs.getInt(1));
				classificacao.setClaDescricao(rs.getString(2));
			}
			return classificacao;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new Classificacao();

	};

}
