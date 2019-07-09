<?php
	
	modal_link('+ Adicionar', 'add');
	br();

	ptable('Funções');
	datatable('Funções', ['Nome'], ['nome'], $funcoes, [
		'editar' => 'empresas/editar_funcao?id', 
		'deletar' =>  'empresas/deletar_funcao?id',
		'treinamentos' =>  'empresas/cargos_treinamentos?id'
	]);

	cpanel();

	omodal('Cadastrar função', 'add');
		form_open('empresas/funcoes');
			form_text_input('Nome', 'nome', 'required');
			hidden('empresa', session('empresa'));
			hidden('chave', 'funcoes');
			hidden('modulo', 'empresas');
			submit('Salvar', 'btn btn-primary');
		form_close();
	cmodal();

?>






