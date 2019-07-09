<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Contato_midia');
    datatable('contato_midia', [ 'Data de Cadastro', 'Voo', 'Veículo', 'Nome do Produtor', 'Numero do Produtor', 'E-mail', 'Data_resposta', 'status', ], ['data_cad', 'voo', 'veiculo', 'nome_produtor', 'numero_produtor', 'email_produtor', 'data_resposta', 'status', ], $contato_midia, ['editar' => 'contato_midia/editar_contato_midia?id', 'deletar' => 'contato_midia/deletar_contato_midia?id']);
    cpanel();
    
    omodal('Adicionar contato_midia', 'add', 'modal-lg');

    row();
        col(4);
            form_text_input('Data do Cadastro:', 'data_cad', 'required');
        cdiv();
        col(4);
            form_select2('Voo:', 'voo_id', $voos, 'voos_id', 'required');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Veiculo:', 'veiculo','required');
        cdiv();
        col(6);
            form_text_input('Nome do Produtor:', 'nome_produtor','required');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Número do Produtor:', 'numero_produtor', 'required');
        cdiv();
        col(6);
            form_text_input('E-mail do Produtor:', 'email_produtor', 'required');
        cdiv();
    cdiv();
    
    row();
        col(12);
        form_text_input('Solicitação:', 'solicitacao', 'required');
        cdiv();
    cdiv();

    row();
        col(12);
            form_text_input('Resposta:', 'resposta');
        cdiv();
    cdiv();

    row();
        col(4);
            form_text_input('Data da Resposta:', 'data_resposta', '');
        cdiv();
        col(4);
        $status = [
            ['nome'=>'Aberto', 'value'=>'Aberto'],
            ['nome'=>'Fechado', 'value'=>'Fechado'],
        ];
        form_select2_data('Status:', 'status', $status);
        cdiv();
    cdiv();

    row();
        col(4);
            submit('Salvar', 'btn btn-success');
            form_close();
            cmodal();
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
