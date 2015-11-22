import java.awt.Desktop;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.List;


public class Main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		Conexao teste = new Conexao();
		Produtora produtora = new Produtora();
		produtora.setProId(3);
		produtora.setProNome("MGM");
		produtora.setProSituacao(1);
		teste.alterarProdutora(produtora);
		List<Produtora> listaProdutora =  teste.buscarTodosProdutoras();
		for (Produtora item : listaProdutora) {
			System.out.println(item.getProId() + " " + item.getProNome() + " " + item.getProSituacao() +" \n");
		}
		teste.FecharConexao();
		
		
//		if(Desktop.isDesktopSupported())
//		{
//		  try {
//			Desktop.getDesktop().browse(new URI("http://54.207.93.174/phpmyadmin/"));
//		} catch (IOException | URISyntaxException e) {
//			e.printStackTrace();
//		}
//		}
	}

}
