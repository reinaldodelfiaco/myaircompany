<?php
	

if(adm()) {
	modal_link('+ Adicionar', 'add');
	br();
}

	
	ptable('Documentos cadastrados');

	datatable('categorias', ['Código', 'Categoria', 'Nome', 'Revisão','Tipo','Dono','Local','Identificação','Proteção','Recuperação','Retenção Mínima', 'Disposição'], 
	                        ['id','nome_categoria','nome', 'revisao', 'tipo','dono','local','identificacao','protecao','recuperacao','retencao_minima','disposicao'], $documentos, 
    [
		'detalhes' => 'documentos/detalhes?id',
		'download' => 'documentos/download?link',
		'editar' => (adm()) ? 'documentos/editar?id' : '', 
		'inativar' => (adm()) ? 'documentos/inativar?id' : '', 
		#'deletar' =>  'documentos/deletar?id'
	]);

	cpanel();

	omodal('Inserir Documento', 'add', 'modal-lg');
		form_open('documentos','POST', true);
			if(super()) {
				form_select2('Empresa', 'empresa', $empresas, 'razao_social');
			} else {
				hidden('empresa', session('empresa'));
			}
			form_text_input('Nome', 'nome', 'required');
			form_file_input('Documento', 'documento', 'required');
			row();
				col(6);
					form_select2('Departamento', 'departamento', $departamentos, 'nome');
				cdiv();
				col(6);
					form_select2('Categoria', 'categoria', $categorias, 'nome');
				cdiv();
			cdiv();
			row();
				col(4);
					form_text_input('Autor', 'autor', 'required');
				cdiv();
				col(2);
					form_text_input('Data para revisar', 'data_revisao', '');
				cdiv();
				col(2);
					form_text_input('Validade (meses)', 'validade', 'required');
				cdiv();
				col(1);
					form_text_input('Revisão', 'revisao', 'required');
				cdiv();
				col(3);
					form_text_input('Retenção Mínima (anos)', 'retencao_minima', '');
				cdiv();
			cdiv();
			hidden('dono', session('id'));
			$tipo = [
			        ['nome' => 'Interno', 'value' => 'Interno'],
			        ['nome' => 'Externo', 'value' => 'Externo'],
			        
			   ];
			   
		    form_select2_data('Tipo', 'tipo', $tipo);
			form_text_input('Local', 'local', '');
			form_text_input('Identificação', 'identificacao', '');
			form_text_input('Proteção', 'protecao', '');
			form_text_input('Recuperação', 'recuperacao', '');
			form_text_input('Disposição', 'disposicao', '');
		
			
			form_textarea('Descrição', 'descricao', 'required');
			submit('ENVIAR ', 'btn btn-primary');
		form_close();
	cmodal();

?>


<script>
	$('#data_revisao').datepicker({
    autoclose: true,
    todayHighlight: true
  })
</script>