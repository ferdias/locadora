import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.FlowLayout;
import javax.swing.JButton;
import java.awt.CardLayout;
import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import javax.swing.BoxLayout;
import javax.swing.SwingConstants;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;


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
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		
		JButton btnProdutoras = new JButton("Produtoras");
		btnProdutoras.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JanelaProdutora dialog = new JanelaProdutora();
				
				dialog.setModal(true);
				dialog.setVisible(true);
			}
		});
		
		JButton btnClassificacao = new JButton("Classifica\u00E7\u00E3o");
		btnClassificacao.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JanelaClassificacao dialog = new JanelaClassificacao();
				
				dialog.setModal(true);
				dialog.setVisible(true);
			}
		});
		contentPane.setLayout(new BoxLayout(contentPane, BoxLayout.Y_AXIS));
		contentPane.add(btnProdutoras);
		contentPane.add(btnClassificacao);
	}

}
