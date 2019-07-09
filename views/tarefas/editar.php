<?php

opanel('Editar Tarefa');
    form_open('tarefas/editar?id=' . get('id'));
    hidden('empresa', session('empresa'));
    hidden('status', 'aberta');
    form_text_input('Título', 'titulo', 'required','','', $tarefa->titulo);
    form_textarea('Descrição', 'texto','','','', $tarefa->texto);
    row();
    col(6);
    form_text_input('Data de início', 'data_inicial', '','', '', data_br($tarefa->data_inicial));
    cdiv();
    col(6);
    form_text_input('Data de término', 'data_final', '','', '', data_br($tarefa->data_final));
    cdiv();
    cdiv();
    submit('Salvar', 'btn btn-primary');
    form_close();
cpanel();

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

