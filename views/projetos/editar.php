<?php




opanel('Editar projeto');
form_open('projetos/editar?id=' . get('id'));
hidden('empresa', session('empresa'));
form_text_input('Título', 'titulo', 'required','', '', $projeto->titulo);
form_select2('Cliente', 'cliente', $clientes, 'razao_social',$projeto->cliente);
form_textarea('Descrição', 'texto','','','',$projeto->texto);
$status = [['nome' => 'Iniciado', 'value' => 'iniciado'],['nome' => 'Parado', 'value' => 'parado'], ['nome' => 'Finalizado', 'value' => 'finalizado']];
form_select2_data('Status', 'status', $status, $projeto->status);
row();
col(6);
form_text_input('Data de início', 'data_inicial','','','', data_br($projeto->data_inicial));
cdiv();
col(6);
form_text_input('Data de térmnino', 'data_final', '', '', '', data_br($projeto->data_final));
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

