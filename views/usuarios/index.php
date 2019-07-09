<?php
	modal_link('+ Adicionar', 'add');
	br();
	ptable('Usuários');
	datatable('categorias', ['Nome', 'E-mail', 'Regra'], ['nome', 'email', 'regra'], $usuarios,
		[
			'editar' => 'usuarios/editar?id',
			'treinamentos' => 'usuarios/treinamentos?id',
			'senha' => 'usuarios/senha?id',
			'cancelar' => 'usuarios/cancelar?id',
		]);
	cpanel();

	omodal('Novo usuário', 'add', 'modal-lg');
		form_open('usuarios/index');

			$regra = [
				['value' => 'Administrativo', 'nome' => 'Administrativo'], 
				['value' => 'Financeiro', 'nome' => 'Financeiro'],
				['value' => 'Comercial', 'nome' => 'Comercial'],
				['value' => 'Operacional', 'nome' => 'Operacional'],
				['value' => 'Tripulante', 'nome' => 'Tripulante'],
				['value' => 'Manutenção', 'nome' => 'Manutenção'],
				['value' => 'SGSO', 'nome' => 'SGSO'],
				['value' => 'Treinamento', 'nome' => 'Treinamento'],
				['value' => 'Passageiro', 'nome' => 'Passageiro'],
				['value' => 'Master', 'nome' => 'Master'],
			];
			$status =[['value' => 'ativo', 'nome' => 'Ativo'],['value' => 'inativo', 'nome' => 'Inativo']];
			$vendedor = [['value' => '0', 'nome' => 'Não'],['value' => '1', 'nome' => 'Sim']];

			form_text_input('Nome', 'nome', 'required');
			form_text_input('E-mail', 'email', 'server', 'usuarios/valida_email');
			form_password_input('Senha', 'senha', 'required');
			form_text_input('Telefone', 'telefone');
			form_select2_data('Regra', 'regra', $regra, 'nome');
			form_select2_data('Status', 'status', $status, 'nome');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>
