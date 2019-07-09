<?php

    modal_link('Adicionar', 'add');

    br();

    ptable('Projetos');
        datatable('projetos', ['Empresa','Titulo'], ['razao_social', 'titulo'], $projetos, ['editar' => 'projetos/editar?id']);
    cpanel();

    omodal('Novo projeto', 'add');
    form_open('projetos');
        hidden('empresa', session('empresa'));
        form_text_input('Título', 'titulo', 'required');
        form_select2('Cliente', 'cliente', $clientes, 'razao_social');
        form_textarea('Descrição', 'texto');
        $status = [['nome' => 'Iniciado', 'value' => 'iniciado'],['nome' => 'Parado', 'value' => 'parado'], ['nome' => 'Finalizado', 'value' => 'finalizado']];
        form_select2_data('Status', 'status', $status);
        row();
            col(6);
                form_text_input('Data de início', 'data_inicial');
            cdiv();
            col(6);
                form_text_input('Data de térmnino', 'data_final');
            cdiv();
        cdiv();
        submit('Salvar', 'btn btn-primary');
    form_close();
    cmodal();

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

