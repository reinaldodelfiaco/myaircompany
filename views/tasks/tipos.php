<?php
	
	modal_link('+ Adicionar', 'add');
	br();

	ptable('Tipos');
	datatable('categorias', ['Nome'], ['nome'], $tipos, ['editar' => 'tasks/editar_tipos?id', 'deletar' =>  'tasks/deletar_origens?id']);
	cpanel();

	omodal('Cadastrar Tipos', 'add');
		form_open('tasks/tipos');
			form_text_input('Nome', 'nome', 'required');
			hidden('empresa', session('empresa'));
			hidden('chave', 'tipos');
			hidden('modulo', 'tasks');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>






