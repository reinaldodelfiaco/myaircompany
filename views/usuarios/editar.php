<?php
	opanel('Editar usuario: ' . $usuario->nome);
		form_open('usuarios/editar?id='.get('id'));

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
			form_text_input('Nome', 'nome', 'required','','', $usuario->nome);
			form_text_input('Telefone', 'telefone','','','', $usuario->telefone);
			form_select2_data('Regra', 'regra', $regra, $usuario->regra);
			form_select2_data('Status', 'status', $status, $usuario->status);
			
			submit('Salvar', 'btn btn-primary');

		form_close();

	cpanel();


?>
