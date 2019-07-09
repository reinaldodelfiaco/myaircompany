<?php 
opanel('Editar');
    form_open('contato_midia/editar_contato_midia?id=' .get('id'));form_text_input('Id:', 'id', '','','', $contato_midia->id);
    
    row();
        col(4);
            form_text_input('Data do Cadastro:', 'data_cad', 'required', $contato_midia->data_cad);
        cdiv();
        col(4);
            form_text_input('Voo:', 'voo_id', $voo_id, 'required', $contato_midia->voo);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Veículo:', 'veiculo', $contato_midia->veiculo);
        cdiv();
        col(6);
            form_text_input('Nome do Produtor:', 'nome_produtor', 'required',  $contato_midia->nome_produtor);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Número do Produtor:', 'numero_produtor', 'required', $contato_midia->numero_produtor);
        cdiv();
        col(6);
            form_text_input('E-mail do Produtor:', 'email_produtor', 'required', $contato_midia->email_produtor);
        cdiv();
    cdiv();

    row();
        col(12);
            form_text_input('Solicitação:', 'solicitacao', 'required', $contato_midia->solicitacao);
        cdiv();
    cdiv();

    row();
        col(12);
            form_text_input('Resposta:', 'resposta', $contato_midia->resposta);
        cdiv();
    cdiv();

    row();
        col(4);
            form_text_input('Data da Resposta:', 'data_resposta', $contato_midia->data_resposta);
        cdiv();
        col(4);
        $status = [
            ['nome'=>'Aberto', 'value'=>'Aberto'],
            ['nome'=>'Fechado', 'value'=>'Fechado'],
        ];    
            form_select2_data('Status:', 'status', $status, $contato_midia->status);
        cdiv();
    cdiv();

    row();
        col(4);
            submit('Salvar', 'btn btn-success'); 
            form_close();
            cpanel();
        cdiv();
    cdiv();
?>

<script>
$(document).ready(function(){
    $("#data_cad").datepicker({
        autoclose: true,
        todayHighlight: true
        });
    $("#numero_produtor").mask("00 00 0 0000-0000");
    $('#data_resposta').datepicker({
        autoclose: true,
        todayHighlight: true
        });
});
</script>
