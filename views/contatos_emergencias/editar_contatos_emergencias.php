<?php 
opanel('Editar');
    form_open('contatos_emergencias/editar_contatos_emergencias?id=' .get('id'));

    row();
        col(5);
            $tipo = [
                ['nome'=>'Administrador Aeroportuário', 'value'=>'Administrador Aeroportuário'],
                ['nome'=>'Corpo de Bombeiro', 'value'=>'Corpo de Bombeiro'],
                ['nome'=>'Hospital', 'value'=>'Hospital'],
                ['nome'=>'Plano de Saúde', 'value'=>'Plano de Saúde'],
                ['nome'=>'Polícia Militar', 'value'=>'Polícia Militar'],
                ['nome'=>'Prefeitura', 'value'=>'Prefeitura'],
                ['nome'=>'Seguradora', 'value'=>'Seguradora'],
                ['nome'=>'SERIPA', 'value'=>'SERIPA'],
            ];
            form_select2_data('Tipo do Contato:', 'tipo_contato', $tipo,'required', $contatos_emergencias->tipo_contato);
        cdiv();
        col(4);
            form_text_input('Cidade:', 'cidade', 'required', $contatos_emergencias->cidade);
        cdiv();
        col(3);
            form_text_input('AD:', 'aerodromo', 'required',$contatos_emergencias->aerodromo);
        cdiv();
    cdiv();

    row();
        col(12);
            form_text_input('Instituição:', 'instituicao', 'required', $contatos_emergencias->instituicao);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Nome do Contato ResponsÁvel:', 'nome_contato_responsavel', $contatos_emergencias->nome_contato_responsavel);
        cdiv();
        col(6);
            form_text_input('Cargo do Responsável:', 'cargo_responsavel', $contatos_emergencias->cargo_responsavel);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Telefone do Responsável:', 'telefone_responsavel', $contatos_emergencias->telefone_responsavel);
        cdiv();
        col(6);
            form_text_input('Email do Responsável:', 'email_responsavel', $contatos_emergencias->email_responsavel);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Nome do Contato Imediato:', 'nome_contato_imediato', $contatos_emergencias->nome_contato_imediato);
        cdiv();
        col(6);
            form_text_input('Cargo do Imediato:', 'cargo_imediato', $contatos_emergencias->cargo_imediato);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Telefone do Imediato:', 'cargo_imediato', $contatos_emergencias->cargo_imediato);
        cdiv();
        col(6);
        form_text_input('Email_imediato:', 'email_imediato', $contatos_emergencias->email_imediato);
        cdiv();
    cdiv();

    row();
    cdiv(4);
        submit('Salvar', 'btn btn-success'); 
        form_close();
        cpanel();
?>

<script>
$(document).ready(function(){
    $("#telefone_responsavel").mask("00 00 0 0000-0000");
    $("#telefone_imediato").mask("00 00 0 0000-0000");
    $('#data_prox_update').datepicker({
        autoclose: true,
        todayHighlight: true
        });
});
</script>
