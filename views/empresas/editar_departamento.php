<?php
	opanel('Editar Departamento');
		form_open('empresas/editar_departamento?id=' . get('id'));
			form_text_input('Nome', 'nome', 'required', '', '',$departamento->nome);
			submit('Atualizar', 'btn btn-primary');
		form_close();
	cpanel();

		
