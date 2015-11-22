import java.awt.BorderLayout;
import java.awt.FlowLayout;
import java.util.List;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.ListSelectionModel;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;
import javax.swing.JTable;
import javax.swing.JTextArea;

import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;


public class JanelaProdutora extends JDialog {

	private final JPanel contentPanel = new JPanel();
	private JTextArea txtListProdutora = new JTextArea();

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			JanelaProdutora dialog = new JanelaProdutora();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public JanelaProdutora() {
		setTitle("Produtoras");
		addWindowListener(new WindowAdapter() {
			@SuppressWarnings("static-access")
			@Override
			public void windowOpened(WindowEvent arg0) {
				
				txtListProdutora.append("   ID   |  NOME PRODUTORA\n");
				
				Conexao prod = new Conexao();			
				List<Produtora> listaProdutora =  prod.buscarTodosProdutoras();
				for (Produtora item : listaProdutora) {
					txtListProdutora.append("    " + item.getProId() + "    | " + item.getProNome() +" \n");
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
		btnAdicionar.setBounds(333, 11, 89, 23);
		contentPanel.add(btnAdicionar);
		
		JButton btnNewButton = new JButton("Alterar");
		btnNewButton.setBounds(333, 33, 89, 23);
		contentPanel.add(btnNewButton);
		
		JButton btnExcluir = new JButton("Excluir");
		btnExcluir.setBounds(333, 55, 89, 23);
		contentPanel.add(btnExcluir);
		
		txtListProdutora.setBounds(0, 0, 323, 229);
		contentPanel.add(txtListProdutora);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton Concluir = new JButton("Concluir");
				Concluir.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						
						dispose();
					}
				});
				Concluir.setActionCommand("Concluir");
				buttonPane.add(Concluir);
			}
		}
	}
}
