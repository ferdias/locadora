import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

import javax.swing.JLabel;

import javax.swing.JTextField;
import javax.swing.JCheckBox;

import java.awt.Component;
import java.awt.Dimension;
import java.awt.GridBagLayout;
import java.awt.GridBagConstraints;
import java.awt.Insets;


public class JanelaFormProd extends JDialog {

	private final JPanel contentPanel = new JPanel();
	private JTextField txtProdutora;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			JanelaFormProd dialog = new JanelaFormProd();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public JanelaFormProd() {
		getContentPane().setMaximumSize(new Dimension(20, 2147483647));
		setTitle("Produtora");
		setBounds(100, 100, 469, 143);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setPreferredSize(new Dimension(5, 10));
		contentPanel.setMaximumSize(new Dimension(20, 32767));
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		GridBagLayout gbl_contentPanel = new GridBagLayout();
		gbl_contentPanel.columnWidths = new int[] {110, 320, 0};
		gbl_contentPanel.rowHeights = new int[]{18, 18, 18, 0};
		gbl_contentPanel.columnWeights = new double[]{0.0, 0.0, Double.MIN_VALUE};
		gbl_contentPanel.rowWeights = new double[]{0.0, 0.0, 0.0, Double.MIN_VALUE};
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
			JLabel lblID = new JLabel("");
			lblID.setAlignmentX(Component.CENTER_ALIGNMENT);
			GridBagConstraints gbc_lblID = new GridBagConstraints();
			gbc_lblID.fill = GridBagConstraints.BOTH;
			gbc_lblID.insets = new Insets(0, 0, 5, 0);
			gbc_lblID.gridx = 1;
			gbc_lblID.gridy = 0;
			contentPanel.add(lblID, gbc_lblID);
		}
		{
			JLabel lblNomeProdutora = new JLabel("Nome Produtora:");
			lblNomeProdutora.setAlignmentX(Component.CENTER_ALIGNMENT);
			GridBagConstraints gbc_lblNomeProdutora = new GridBagConstraints();
			gbc_lblNomeProdutora.fill = GridBagConstraints.BOTH;
			gbc_lblNomeProdutora.insets = new Insets(0, 0, 5, 5);
			gbc_lblNomeProdutora.gridx = 0;
			gbc_lblNomeProdutora.gridy = 1;
			contentPanel.add(lblNomeProdutora, gbc_lblNomeProdutora);
		}
		{
			txtProdutora = new JTextField();
			txtProdutora.setAlignmentX(Component.RIGHT_ALIGNMENT);
			GridBagConstraints gbc_txtProdutora = new GridBagConstraints();
			gbc_txtProdutora.fill = GridBagConstraints.BOTH;
			gbc_txtProdutora.insets = new Insets(0, 0, 5, 0);
			gbc_txtProdutora.gridx = 1;
			gbc_txtProdutora.gridy = 1;
			contentPanel.add(txtProdutora, gbc_txtProdutora);
			txtProdutora.setColumns(60);
		}
		{
			JLabel lblSituao = new JLabel("Situa\u00E7\u00E3o: ");
			GridBagConstraints gbc_lblSituao = new GridBagConstraints();
			gbc_lblSituao.fill = GridBagConstraints.BOTH;
			gbc_lblSituao.insets = new Insets(0, 0, 0, 5);
			gbc_lblSituao.gridx = 0;
			gbc_lblSituao.gridy = 2;
			contentPanel.add(lblSituao, gbc_lblSituao);
		}
		{
			JCheckBox chckbxAtiva = new JCheckBox("ATIVA");
			chckbxAtiva.setSelected(true);
			GridBagConstraints gbc_chckbxAtiva = new GridBagConstraints();
			gbc_chckbxAtiva.fill = GridBagConstraints.BOTH;
			gbc_chckbxAtiva.gridx = 1;
			gbc_chckbxAtiva.gridy = 2;
			contentPanel.add(chckbxAtiva, gbc_chckbxAtiva);
		}
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("OK");
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
