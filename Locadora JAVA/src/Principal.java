import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import javax.swing.JButton;

import javax.swing.SwingConstants;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.Desktop;
import java.awt.Font;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;

import javax.swing.ImageIcon;
import javax.swing.JLabel;

import java.awt.Toolkit;


@SuppressWarnings("serial")
public class Principal extends JFrame {

	private JPanel contentPane;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Principal frame = new Principal();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Principal() {
		setIconImage(Toolkit.getDefaultToolkit().getImage(Principal.class.getResource("/images/FilmeIcone.ico")));
		setTitle("Locadora ONLINE");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 725, 391);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		
		JButton btnProdutoras = new JButton("Produtoras");
		btnProdutoras.setIcon(new ImageIcon(Principal.class.getResource("/images/Partenon 128x128.png")));
		btnProdutoras.setFont(new Font("Tahoma", Font.BOLD, 25));
		btnProdutoras.setBounds(360, 182, 340, 160);
		btnProdutoras.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JanelaProdutora dialog = new JanelaProdutora();
				
				dialog.setModal(true);
				dialog.setVisible(true);
			}
		});
		
		JButton btnClassificacao = new JButton("Classifica\u00E7\u00E3o");
		btnClassificacao.setIcon(new ImageIcon(Principal.class.getResource("/images/Mascaras 128x128.png")));
		btnClassificacao.setFont(new Font("Tahoma", Font.BOLD, 25));
		btnClassificacao.setBounds(10, 182, 340, 160);
		btnClassificacao.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JanelaClassificacao dialog = new JanelaClassificacao();
				
				dialog.setModal(true);
				dialog.setVisible(true);
			}
		});
		contentPane.setLayout(null);
		contentPane.add(btnProdutoras);
		contentPane.add(btnClassificacao);
		
		JButton btnCadastro = new JButton("Modulo Web");
		btnCadastro.setIcon(new ImageIcon(Principal.class.getResource("/images/ModuloWeb 128x128.png")));
		btnCadastro.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				if(Desktop.isDesktopSupported())
				{
					  try {
						Desktop.getDesktop().browse(new URI("http://54.207.93.174/faculdade/minierplocadora/index.php"));
					} catch (IOException | URISyntaxException e) {
						e.printStackTrace();
					}
				}
			}
		});
		btnCadastro.setFont(new Font("Tahoma", Font.BOLD, 25));
		btnCadastro.setBounds(10, 11, 340, 160);
		contentPane.add(btnCadastro);
		
		JLabel lblFigura = new JLabel("");
		lblFigura.setHorizontalAlignment(SwingConstants.CENTER);
		lblFigura.setIcon(new ImageIcon(Principal.class.getResource("/images/Filme128x128.png")));
		lblFigura.setBounds(360, 11, 340, 160);
		contentPane.add(lblFigura);
	}
}
