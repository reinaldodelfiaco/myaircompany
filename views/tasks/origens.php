<?php
	
	modal_link('+ Adicionar', 'add');
	br();

	ptable('Origens');
	datatable('categorias', ['Nome'], ['nome'], $origens, ['editar' => 'tasks/editar_origens?id', 'deletar' =>  'tasks/deletar_origens?id']);
	cpanel();

	omodal('Cadastrar Origens', 'add');
		form_open('tasks/origens');
			form_text_input('Nome', 'nome', 'required');
			hidden('empresa', session('empresa'));
			hidden('chave', 'origens');
			hidden('modulo', 'tasks');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>






