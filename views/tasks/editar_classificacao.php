<?php
	opanel('Editar Classficação');
		form_open('tasks/editar_classificacao');
			hidden('id', $classificacao->id);
			form_text_input('Nome', 'nome', 'required', '', '', $classificacao->nome);
			submit('Atualizar', 'btn btn-primary');
		form_close();
	cpanel();

		
