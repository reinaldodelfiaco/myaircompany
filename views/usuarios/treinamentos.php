<?php

if(adm()){
	modal_link('+ Adicionar Treinamento', 'add');
  $menu = [
			'editar' => 'usuarios/editar_treinamento?id',
			'deletar' => 'usuarios/deletar_treinamento?id',
			'download' => 'documentos/download?link',
		];
	br();
} else {
  $menu = [
			'download' => 'documentos/download?link',
	];
}
	ptable('Treinamentos');
	datatable('treinamentos', ['Treinamento', 'Validade (meses)', 'Data' ], ['nome_treinamento', 'validade', 'data'], $treinamentos, $menu	);
	cpanel();

	omodal('Adicionar Treinamento', 'add');
	form_open('usuarios/treinamentos?id=' . get('id'));
	form_select2('Treinamento', 'treinamento', $treinamentos_form, 'nome'); 
	form_text_input('Data de realização', 'data', '');
	submit('Adicionar', 'btn btn-primary btn-block');
	form_close();
	cmodal();
?>

<script>
	$('#data').datepicker({
		autoclose: true,
		todayHighlight: true
	})
</script>
