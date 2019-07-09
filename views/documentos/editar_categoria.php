<?php
	opanel('Categorias');
		form_open('documentos/editar_categoria');
			hidden('id', $categoria->id);
			form_text_input('Nome', 'nome', 'required', '', '', $categoria->nome);
			submit('Atualizar', 'btn btn-primary');
		form_close();
	cpanel();

		
