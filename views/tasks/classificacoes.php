<?php
	
	modal_link('+ Adicionar', 'add');
	br();

	ptable('Classificações');
	datatable('categorias', ['Nome'], ['nome'], $classificacoes, ['editar' => 'tasks/editar_classificacao?id', 'deletar' =>  'documentos/deletar_categoria?id']);
	cpanel();

	omodal('Cadastrar classificações', 'add');
		form_open('tasks/classificacoes');
			form_text_input('Nome', 'nome', 'required');
			hidden('empresa', session('empresa'));
			hidden('chave', 'classificacoes');
			hidden('modulo', 'tasks');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>






