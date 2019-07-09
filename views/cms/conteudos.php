<?php
	a(' + ADICIONAR CONTEÚDO', 'cms/adicionar_conteudo', 'btn btn-primary');
	br();

	ptable('CONTEÚDOS CADASTRADOS');
	datatable('conteudos', ['Título',  'Link' , 'Tipo', 'Status'], ['titulo',  'seo', 'tipo', 'status'], $conteudos, [
		'editar' => 'cms/editar_conteudo?id',
	]);
	cpanel();

