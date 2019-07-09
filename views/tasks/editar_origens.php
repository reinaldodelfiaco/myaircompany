<?php
	opanel('Editar Origem');
		form_open('tasks/editar_origens');
			hidden('id', $origens->id);
			form_text_input('Nome', 'nome', 'required', '', '', $origens->nome);
			submit('Atualizar', 'btn btn-primary');
		form_close();
	cpanel();

		
