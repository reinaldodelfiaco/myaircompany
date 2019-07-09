<?php
	
	modal_link('+ Adicionar', 'add');
	br();

	ptable('Categorias');
	datatable('categorias', ['Nome'], ['nome'], $categorias, ['editar' => 'documentos/editar_categoria?id', 'deletar' =>  'documentos/deletar_categoria?id']);
	cpanel();

	omodal('Cadastrar categoria', 'add');
		form_open('documentos/categorias');
			form_text_input('Nome', 'nome', 'required');
			hidden('empresa', session('empresa'));
			hidden('chave', 'categorias');
			hidden('modulo', 'documentos');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>






