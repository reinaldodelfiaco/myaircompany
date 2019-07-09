<?php
	opanel('Treinamentos');
	form_open('usuarios/editar_treinamento?id=' . get('id'),'', true);
	form_text_input('Data de realização', 'data', '','', '', data_br($treinamento->data));
	form_file_input('Certificado', 'certificado');
	submit('Adicionar', 'btn btn-primary btn-block');
	form_close();
	cpanel();
?>

<script>
	$('#data').datepicker({
		autoclose: true,
		todayHighlight: true
	})
</script>
