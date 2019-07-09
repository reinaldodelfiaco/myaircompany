<?php
	opanel('Editar Função');
		form_open('empresas/editar_funcao?id=' . get('id'));
			form_text_input('Nome', 'nome', 'required', '', '',$funcao->nome);
			submit('Atualizar', 'btn btn-primary');
		form_close();
	cpanel();

		
