<?php
	
	modal_link('+ Adicionar', 'add');
	br();

	ptable('Departamentos');
	datatable('Departamentos', ['Nome'], ['nome'], $departamentos, ['editar' => 'empresas/editar_departamento?id', 'deletar' =>  'empresas/deletar_departamento?id']);
	cpanel();

	omodal('Cadastrar departamento', 'add');
		form_open('empresas/departamentos');
			form_text_input('Nome', 'nome', 'required');
			hidden('empresa', session('empresa'));
			hidden('chave', 'departamentos');
			hidden('modulo', 'empresas');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>






