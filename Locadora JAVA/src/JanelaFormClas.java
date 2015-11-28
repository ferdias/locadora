import java.awt.BorderLayout;
import java.awt.Component;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;


@SuppressWarnings("serial")
public class JanelaFormClas extends JDialog {

	private final JPanel contentPanel = new JPanel();
	private JTextField txtClassifica;
	private Classificacao objSaida = new Classificacao();

	public Classificacao getObjSaida() {
		return objSaida;
	}

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			JanelaFormClas dialog = new JanelaFormClas();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public JanelaFormClas() {
		setResizable(false);
		getContentPane().setMaximumSize(new Dimension(20, 2147483647));
		setTitle("Classifica\u00E7\u00E3o");
		setBounds(100, 100, 469, 143);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setPreferredSize(new Dimension(5, 10));
		contentPanel.setMaximumSize(new Dimension(20, 32767));
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		GridBagLayout gbl_contentPanel = new GridBagLayout();
		gbl_contentPanel.columnWidths = new int[] {110, 320, 0};
		gbl_contentPanel.rowHeights = new int[] {18, 18};
		gbl_contentPanel.columnWeights = new double[]{0.0, 0.0, Double.MIN_VALUE};
		gbl_contentPanel.rowWeights = new double[]{0.0, 0.0};
		contentPanel.setLayout(gbl_contentPanel);
		{
			JLabel lblDescricao = new JLabel("Descri\u00E7\u00E3o:");
			lblDescricao.setAlignmentX(Component.CENTER_ALIGNMENT);
			GridBagConstraints gbc_lblDescricao = new GridBagConstraints();
			gbc_lblDescricao.fill = GridBagConstraints.BOTH;
			gbc_lblDescricao.insets = new Insets(0, 0, 5, 5);
			gbc_lblDescricao.gridx = 0;
			gbc_lblDescricao.gridy = 1;
			contentPanel.add(lblDescricao, gbc_lblDescricao);
		}
		{
			txtClassifica = new JTextField();
			txtClassifica.setAlignmentX(Component.RIGHT_ALIGNMENT);
			GridBagConstraints gbc_txtProdutora = new GridBagConstraints();
			gbc_txtProdutora.fill = GridBagConstraints.BOTH;
			gbc_txtProdutora.insets = new Insets(0, 0, 5, 0);
			gbc_txtProdutora.gridx = 1;
			gbc_txtProdutora.gridy = 1;
			contentPanel.add(txtClassifica, gbc_txtProdutora);
			txtClassifica.setColumns(60);
		}
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("OK");
				okButton.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						objSaida.setClaDescricao(txtClassifica.getText());
						dispose();
					}
				});
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						dispose();
					}
				});
				cancelButton.setActionCommand("Cancel");
				buttonPane.add(cancelButton);
			}
		}
	}
	
	@SuppressWarnings("static-access")
	public JanelaFormClas(Integer IdItem) {
		Conexao prod = new Conexao();
		Classificacao alteraItem = prod.buscarPorClassificacaoId(IdItem);
		prod.FecharConexao();
		
		getContentPane().setMaximumSize(new Dimension(20, 2147483647));
		setTitle("Classifica\u00E7\u00E3o");
		setBounds(100, 100, 469, 143);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setPreferredSize(new Dimension(5, 10));
		contentPanel.setMaximumSize(new Dimension(20, 32767));
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		GridBagLayout gbl_contentPanel = new GridBagLayout();
		gbl_contentPanel.columnWidths = new int[] {110, 320, 0};
		gbl_contentPanel.rowHeights = new int[] {18, 18};
		gbl_contentPanel.columnWeights = new double[]{0.0, 0.0, Double.MIN_VALUE};
		gbl_contentPanel.rowWeights = new double[]{0.0, 0.0};
		contentPanel.setLayout(gbl_contentPanel);
		{
			JLabel lblId = new JLabel("ID: ");
			lblId.setAlignmentX(Component.CENTER_ALIGNMENT);
			GridBagConstraints gbc_lblId = new GridBagConstraints();
			gbc_lblId.fill = GridBagConstraints.BOTH;
			gbc_lblId.insets = new Insets(0, 0, 5, 5);
			gbc_lblId.gridx = 0;
			gbc_lblId.gridy = 0;
			contentPanel.add(lblId, gbc_lblId);
		}
		{
			JLabel lblID = new JLabel(alteraItem.getClaId().toString());
			lblID.setAlignmentX(Component.CENTER_ALIGNMENT);
			GridBagConstraints gbc_lblID = new GridBagConstraints();
			gbc_lblID.fill = GridBagConstraints.BOTH;
			gbc_lblID.insets = new Insets(0, 0, 5, 0);
			gbc_lblID.gridx = 1;
			gbc_lblID.gridy = 0;
			contentPanel.add(lblID, gbc_lblID);
		}
		{
			JLabel lblDescricao = new JLabel("Descri\u00E7\u00E3o:");
			lblDescricao.setAlignmentX(Component.CENTER_ALIGNMENT);
			GridBagConstraints gbc_lblDescricao = new GridBagConstraints();
			gbc_lblDescricao.fill = GridBagConstraints.BOTH;
			gbc_lblDescricao.insets = new Insets(0, 0, 5, 5);
			gbc_lblDescricao.gridx = 0;
			gbc_lblDescricao.gridy = 1;
			contentPanel.add(lblDescricao, gbc_lblDescricao);
		}
		{
			txtClassifica = new JTextField(alteraItem.getClaDescricao());
			txtClassifica.setAlignmentX(Component.RIGHT_ALIGNMENT);
			GridBagConstraints gbc_txtProdutora = new GridBagConstraints();
			gbc_txtProdutora.fill = GridBagConstraints.BOTH;
			gbc_txtProdutora.insets = new Insets(0, 0, 5, 0);
			gbc_txtProdutora.gridx = 1;
			gbc_txtProdutora.gridy = 1;
			contentPanel.add(txtClassifica, gbc_txtProdutora);
			txtClassifica.setColumns(60);
		}
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("OK");
				okButton.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						objSaida.setClaId(alteraItem.getClaId());
						objSaida.setClaDescricao(txtClassifica.getText());
						dispose();
					}
				});
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						dispose();
					}
				});
				cancelButton.setActionCommand("Cancel");
				buttonPane.add(cancelButton);
			}
		}
	}
}
