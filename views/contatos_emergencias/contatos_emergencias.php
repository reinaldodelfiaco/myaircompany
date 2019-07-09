<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Contatos de Emergências');
    datatable('contatos_emergencias', ['Tipo do Contato', 'Cidade', 'Aeródromo', 'Instituição', 'Nome do Contato Imediato', 'Cargo', 'E-mail', 'Prox. Atualização'], ['tipo_contato', 'cidade', 'aerodromo', 'instituicao', 'nome_contato_imediato', 'cargo_imediato', 'email_imediato', 'data_prox_update'], $contatos_emergencias, ['editar' => 'contatos_emergencias/editar_contatos_emergencias?id', 'deletar' => 'contatos_emergencias/deletar_contatos_emergencias?id']);
    cpanel();
    
    omodal('Adicionar contatos_emergencias', 'add', 'modal-lg');
    form_open('contatos_emergencias/contatos_emergencias');
    
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
            form_select2_data('Tipo do Contato:', 'tipo_contato', $tipo, 'required');
        cdiv();
        col(4);
            form_text_input('Cidade:', 'cidade', 'required');
        cdiv();
        col(3);
            form_text_input('AD:', 'aerodromo', 'required');
        cdiv();
    cdiv();
    
    row();
        col(12);
            form_text_input('Instituição:', 'instituicao', 'required');
        cdiv();
    cdiv();
    
    row();
        col(6);
            form_text_input('Nome do Contato Responsável:', 'nome_contato_responsavel');
        cdiv();
        col(6);
            form_text_input('Cargo do Responsável:', 'cargo_responsavel');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Telefone do Responsável:', 'telefone_responsavel');
        cdiv();
        col(6);
            form_text_input('Email do Responsável:', 'email_responsavel');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Nome do Contato Imediato:', 'nome_contato_imediato');
        cdiv();
        col(6);
            form_text_input('Cargo do Imediato:', 'cargo_imediato');
        cdiv();
    cdiv();
    
    row();
        col(6);
            form_text_input('Telefone do Imediato:', 'telefone_imediato');
        cdiv();
        col(6);
            form_text_input('Email do Imediato:', 'email_imediato');
        cdiv();
    cdiv();

    row();
        col(4);
            form_text_input('Próxima Atualização', 'data_prox_update', 'required');
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
    $("#telefone_responsavel").mask("00 00 0 0000-0000");
    $("#telefone_imediato").mask("00 00 0 0000-0000");
    $('#data_prox_update').datepicker({
        autoclose: true,
        todayHighlight: true
        });
});
</script>