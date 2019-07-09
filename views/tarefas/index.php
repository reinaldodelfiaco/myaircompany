<?php

    modal_link('Adicionar', 'add');
    omodal('Nova tarefa', 'add');
        form_open('tarefas');
        hidden('empresa', session('empresa'));
        hidden('status', 'aberta');
        form_text_input('Título', 'titulo', 'required');
        form_select2_blank('Projeto', 'projeto', $projetos, 'titulo');
        form_textarea('Descrição', 'texto');
        row();
        col(6);
        form_text_input('Data de início', 'data_inicial');
        cdiv();
        col(6);
        form_text_input('Data de término', 'data_final');
        cdiv();
        cdiv();
        submit('Salvar', 'btn btn-primary');
        form_close();
    cmodal();

    div('pull-right');
        modal_link('<i class="fa fa-filter"></i> Filtro', 'filtrar', 'btn btn-success');
        omodal('FILTRO DE TAREFAS', 'filtrar');
            form_open('tarefas/index', 'get');
            $status = [['value' => '', 'nome' => ' - '], ['value' => 'aberta', 'nome' => ' Abertas '], ['value' => 'fechada', 'nome' => ' Fechadas '],];
            form_select2_data('Status', 'fstatus', $status, get('fstatus'));
            form_select2_blank('Projeto', 'fprojeto', $projetos, 'titulo', get('fprojeto'));
            submit('FILTRAR', 'btn btn-success');
            form_close();
        cmodal();
    cdiv();

    br();

    ptable('Tarefas');
        table('tarefas', ['Titulo','Prazo','Status'], ['titulo','data_final','status'], $tarefas, [
                'editar' => 'tarefas/editar?id',
                'concluir' => 'tarefas/concluir?id',
        ]);
    cpanel();



    br();



?>


<script>
    $('#data_inicial').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#data_final').datepicker({
        autoclose: true,
        todayHighlight: true
    });

</script>

