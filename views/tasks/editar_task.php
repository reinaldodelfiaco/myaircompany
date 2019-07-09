<?php

	$status = [
		['value' => 'aberta', 'nome' => 'Aberta'],
		['value' => 'fechada', 'nome' => 'Fechada'],
	];
	
	
	opanel('Editar Task');
		form_open('tasks/editar?id=' .  $task->id,'POST', true);
			if(super()) {
				form_select2('Empresa', 'empresa', $empresas, 'razao_social', $task->empresa);
			} else {
				hidden('empresa', session('empresa'));
			}
			row();
				col(8);
					form_text_input('Título', 'titulo', 'required','','', $task->titulo);
				cdiv();
				col(4);
					form_select2_data('Status', 'status', $status, 'nome', $task->status);
				cdiv();
			cdiv();
			row();

				col(4);
					form_text_input('Previsão', 'data_previsao','','','', data_br($task->data_previsao));
				cdiv();
				col(4);
					form_select2('Departamento', 'departamento', $departamentos, 'nome', $task->departamento);
				cdiv();
				col(4);
					form_select2('Origem', 'origem', $origens, 'nome', $task->origem);
				cdiv();
			cdiv();
			row();
				col(6);
					form_select2('Tipo', 'tipo', $tipos, 'nome', $task->tipo);
				cdiv();
				col(6);
					form_select2('Classificação', 'classificacao', $classificacoes, 'nome', $task->classificacao);
				cdiv();
			cdiv();
			form_textarea('Descrição', 'descricao', 'required', '', '', $task->descricao);
			submit('ENVIAR ', 'btn btn-primary');
		form_close();
	cpanel();

		

?>


