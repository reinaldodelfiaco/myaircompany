<?php
	modal_link('+ Adicionar Treinamento', 'add');
	br();	
	ptable('Treinamentos relacionados ao cargo: '. $cargo->nome);
	datatable('treinamentos', ['Treinamento'], ['nome'], $treinamentos, ['deletar' => 'empresas/deletar_treinamento?id']);
	cpanel();


	omodal('Adicionar Treinamento', 'add');
	form_open('empresas/cargos_treinamentos?id=' . get('id'));
	hidden('funcao', get('id'));
	form_select2('Selecionar Treinamento', 'treinamento', $treinamentos_form, 'nome');
	submit('Adicionar', 'btn btn-primary btn-block');
	form_close();	
	cmodal();
	
