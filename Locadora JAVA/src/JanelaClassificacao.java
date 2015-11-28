import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.border.EmptyBorder;

import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.List;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;


@SuppressWarnings("serial")
public class JanelaClassificacao extends JDialog {

	private final JPanel contentPanel = new JPanel();
	private JTextArea txtListClassifica = new JTextArea();

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			JanelaClassificacao dialog = new JanelaClassificacao();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public JanelaClassificacao() {
		setResizable(false);
		setTitle("Classifica\u00E7\u00E3o");
		addWindowListener(new WindowAdapter() {
			@SuppressWarnings("static-access")
			@Override
			public void windowOpened(WindowEvent arg0) {
				
				txtListClassifica.append("    ID     |  DESCRIÇÃO\n");
				
				Conexao prod = new Conexao();			
				List<Classificacao> listaClassificacao =  prod.buscarTodosClassificacao();
				for (Classificacao item : listaClassificacao) {
					txtListClassifica.append("    " + item.getClaId() + "    | " + item.getClaDescricao() +" \n");
				}
				prod.FecharConexao();
				
			}
		});
		setBounds(100, 100, 450, 300);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JButton btnAdicionar = new JButton("Adicionar");
		btnAdicionar.addActionListener(new ActionListener() {
			@SuppressWarnings("static-access")
			public void actionPerformed(ActionEvent e) {
				 JanelaFormClas form = new JanelaFormClas();
				 form.setModal(true);
				 form.setVisible(true);
				 
				 if (form.getObjSaida().getClaDescricao() != "" &&
				     form.getObjSaida().getClaDescricao() != null) {
					 Conexao prod = new Conexao();
					 prod.cadastrarClassificacao(form.getObjSaida());
					 
					 txtListClassifica.setText("");
					 txtListClassifica.append("    ID     |  DESCRIÇÃO\n");				
					 List<Classificacao> listaClassificacao =  prod.buscarTodosClassificacao();
				 	 for (Classificacao item : listaClassificacao) {
				 	 	 txtListClassifica.append("    " + item.getClaId() + "    | " + item.getClaDescricao() +" \n");
					 }
					 
					 prod.FecharConexao();
				 }
			}
		});
		btnAdicionar.setBounds(333, 11, 89, 23);
		contentPanel.add(btnAdicionar);
		
		JButton btnNewButton = new JButton("Alterar");
		btnNewButton.addActionListener(new ActionListener() {
			@SuppressWarnings("static-access")
			public void actionPerformed(ActionEvent e) {
				String nome = null;
				nome = JOptionPane.showInputDialog("Entre a ID para alteração");	
				
				if (nome != null){
					JanelaFormClas form = new JanelaFormClas(Integer.parseInt(nome));
					form.setModal(true);
					form.setVisible(true);
					 
					if (form.getObjSaida().getClaDescricao() != "" &&
						form.getObjSaida().getClaDescricao() != null) {
						Conexao prod = new Conexao();
						prod.alterarClassificacao(form.getObjSaida());
					 
						txtListClassifica.setText("");
						txtListClassifica.append("    ID     |  DESCRIÇÃO\n");				
						List<Classificacao> listaClassificacao =  prod.buscarTodosClassificacao();
						for (Classificacao item : listaClassificacao) {
							txtListClassifica.append("    " + item.getClaId() + "    | " + item.getClaDescricao() +" \n");
						 	}
						 
						prod.FecharConexao();
					 }
				}
			}
		});
		btnNewButton.setBounds(333, 34, 89, 23);
		contentPanel.add(btnNewButton);
		
		JButton btnExcluir = new JButton("Excluir");
		btnExcluir.addActionListener(new ActionListener() {
			@SuppressWarnings("static-access")
			public void actionPerformed(ActionEvent e) {
				String nome = null;
				nome = JOptionPane.showInputDialog("Entre a ID para alteração");	
				
				if (nome != null && 
					JOptionPane.showConfirmDialog(null,"Você realmente quer excluir o ID" + nome,"Excluir",JOptionPane.YES_NO_OPTION) == 0){
		
					Conexao prod = new Conexao();
					if (prod.deletarClassicacao(Integer.parseInt(nome))) {
						txtListClassifica.setText("");
						txtListClassifica.append("    ID     |  DESCRIÇÃO\n");			
						List<Classificacao> listaClassificacao =  prod.buscarTodosClassificacao();
						for (Classificacao item : listaClassificacao) {
							txtListClassifica.append("    " + item.getClaId() + "    | " + item.getClaDescricao() +" \n");
						 	}
					}
					else{
						JOptionPane.showMessageDialog(null,"Não foi possível a exclusão pelo registro ainda estar em uso");
					}
					prod.FecharConexao();					 
				}				
			}
		});
		btnExcluir.setBounds(333, 57, 89, 23);
		contentPanel.add(btnExcluir);
		
		JButton btnFiltrar = new JButton("Filtrar");
		btnFiltrar.addActionListener(new ActionListener() {
			@SuppressWarnings("static-access")
			public void actionPerformed(ActionEvent e) {
				String pesq = null;
				pesq = JOptionPane.showInputDialog("Entre com os dados para filtragem.");
				
				Conexao prod = new Conexao();
				
				if (pesq == null || pesq.equals("")){
					txtListClassifica.setText("");
					txtListClassifica.append("    ID     |  DESCRIÇÃO\n");			
					List<Classificacao> listaClassificacao =  prod.buscarTodosClassificacao();
					for (Classificacao item : listaClassificacao) {
						txtListClassifica.append("    " + item.getClaId() + "    | " + item.getClaDescricao() +" \n");
					 	}
				}
				else{		
					txtListClassifica.setText("");
					txtListClassifica.append("    ID     |  DESCRIÇÃO\n");			
					List<Classificacao> listaClassificacao =  prod.buscarPorClassificacao(pesq);
					for (Classificacao item : listaClassificacao) {
						txtListClassifica.append("    " + item.getClaId() + "    | " + item.getClaDescricao() +" \n");
					 	}
									 
				}
				
				prod.FecharConexao();	
			}
		});
		btnFiltrar.setBounds(333, 80, 89, 23);
		contentPanel.add(btnFiltrar);
		JScrollPane scroll = new JScrollPane(txtListClassifica);
		scroll.setBounds(0, 0, 323, 229);
		contentPanel.add(scroll);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton Concluir = new JButton("Concluir");
				Concluir.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent arg0) {
						dispose();
					}
				});
				Concluir.setActionCommand("Concluir");
				buttonPane.add(Concluir);
			}
		}
	}
}
