<?php
opanel('Documentos para análise e aprovação.');
table('categorias', ['Nome', 'Revisado?', 'Aprovado?'], ['nome', 'revisado', 'aprovado'], $documentos,  
	[	
		'detalhes' => 'documentos/detalhes?id',
		'revisar' =>  'documentos/revisar?id',
		'aprovar' =>  'documentos/aprovar?id',
		'cancelar' =>  'documentos/cancelar?id',
	]
);
cpanel();