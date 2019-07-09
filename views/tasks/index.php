<?php
	$status = [
		['value' => 'aberta', 'nome' => 'Aberta'],
		['value' => 'fechada', 'nome' => 'Fechada'],
	];
	

       
    form_open('tasks/index', 'get','','', 'filtro');
    hidden('filter', 1);
    row();
        col(3);
        ?><div style="margin-top: 27px"></div><?php 
            	modal_link('+ Adicionar', 'add');
        cdiv();
        col(3);
            form_select2_blank('Origem', 'forigem', $origens, 'nome', get('forigem'));
        cdiv();
        col(3);
            form_select2_blank('Classificação', 'fclassificacao', $classificacoes, 'nome', get('fclassificacao'));
        cdiv();
        col(3);
            form_select2_blank('Tipo', 'ftipo', $tipos, 'nome', get('ftipo'));
        cdiv();
    cdiv();
        
    
    form_close();
    
	    
	ptable('Tasks');
 
	datatable('categorias', ['Código', 'Título', 'Origem', 'Classificação', 'Tipo', 'Aberto em:', 'Status'], ['id','titulo','origem', 'classificacao', 'tipo', 'data_criacao', 'status'], $tasks, [
		'detalhes' => 'tasks/detalhes?id',
		'editar' => 'tasks/editar?id', 
		'deletar' =>  'tasks/deletar?id'
	]);

	cpanel();

	omodal('Nova Task', 'add', 'modal-lg');
		form_open('tasks','POST', true);
			if(super()) {
				form_select2('Empresa', 'empresa', $empresas, 'razao_social');
			} else {
				hidden('empresa', session('empresa'));
			}
			row();
				col(8);
					form_text_input('Título', 'titulo', 'required');
				cdiv();
				col(4);
					form_select2_data('Status', 'status', $status, 'nome');
				cdiv();
			cdiv();
			form_file_input('Anexo', 'documento');
			row();

				col(4);
					form_text_input('Previsão', 'data_previsao');
				cdiv();
				col(4);
					form_select2('Departamento', 'departamento', $departamentos, 'nome');
				cdiv();
				col(4);
					form_select2('Origem', 'origem', $origens, 'nome');
				cdiv();
			cdiv();
			row();
				col(6);
					form_select2('Tipo', 'tipo', $tipos, 'nome');
				cdiv();
				col(6);
					form_select2('Classificação', 'classificacao', $classificacoes, 'nome');
				cdiv();
			cdiv();
			form_textarea('Descrição', 'descricao', 'required');
			submit('ENVIAR ', 'btn btn-primary');
		form_close();
	cmodal();

?>


<script>
	$('#data_previsao').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    
    $('#ftipo').change(function(){
        $('#filtro').submit();
    });
    $('#forigem').change(function(){
        $('#filtro').submit();
    });
    $('#fclassificacao').change(function(){
        $('#filtro').submit();
    });
  
</script>