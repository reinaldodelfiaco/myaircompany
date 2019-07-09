<?php
	opanel('Editar Tipo');
		form_open('tasks/editar_tipos');
			hidden('id', $tipos->id);
			form_text_input('Nome', 'nome', 'required', '', '', $tipos->nome);
			submit('Atualizar', 'btn btn-primary');
		form_close();
	cpanel();

		
