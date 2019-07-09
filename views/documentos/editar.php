<?php
	opanel('Editar Documento');
		form_open('documentos/editar?id=' . get('id'),'POST', true);
			if(super()) {
				form_select2('Empresa', 'empresa', $empresas, 'razao_social', $documento->empresa);
			} else {
				hidden('empresa', session('empresa'));
			}
			form_text_input('Nome', 'nome', 'required', '','', $documento->nome);
			row();
				col(6);
					form_select2('Departamento', 'departamento', $departamentos, 'nome', $documento->departamento);
				cdiv();
				col(6);
					form_select2('Categoria', 'categoria', $categorias, 'nome', $documento->categoria);
				cdiv();
			cdiv();
			row();
				col(4);
					form_text_input('Autor', 'autor', 'required', '','', $documento->autor);
				cdiv();
				col(2);
					form_text_input('Data para revisar', 'data_revisao', 'required','','', data_br($documento->data_revisao));
				cdiv();
				col(2);
					form_text_input('Validade (meses)', 'validade', 'required', '','', $documento->validade);
				cdiv();
				col(1);
					form_text_input('Revisão', 'revisao', 'required', '','', (empty($documento->revisao)) ? " 0 " : $documento->revisao);
				cdiv();
				col(3);
					form_text_input('Retenção Mínima (anos)', 'retencao_minima', '','','', $documento->retencao_minima);
				cdiv();
			cdiv();
			$tipo = [
			        ['nome' => 'Interno', 'value' => 'Interno'],
			        ['nome' => 'Externo', 'value' => 'Externo'],
			        
			   ];
			form_select2_data('Tipo', 'tipo', $tipo, $documento->tipo);
			form_text_input('Local', 'local', '', '','', $documento->local);
			form_text_input('Identificação', 'identificacao', '', '','', $documento->identificacao);
			form_text_input('Proteção', 'protecao', '', '','', $documento->protecao);
			form_text_input('Recuperação', 'recuperacao', '', '','', $documento->recuperacao);
			form_text_input('Disposição', 'disposicao', '', '','', $documento->disposicao);
			form_textarea('Descrição', 'descricao', 'required', '','', $documento->descricao);
			submit('ENVIAR ', 'btn btn-primary');
		form_close();
	cpanel();
	cmodal();

?>


<script>
	$('#data_revisao').datepicker({
		autoclose: true,
		todayHighlight: true
	})
</script>


