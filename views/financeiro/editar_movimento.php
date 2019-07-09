<?php
opanel('Editar Movimento');

    form_open('financeiro/editar_movimento?id=' . get('id'), 'POST');
    row();
        col(4);
            $tipo = [['value' => 'receita', 'nome' => 'Receita'], ['value' => 'despesa', 'nome' => 'Despesa']];
            form_select2_data('Tipo', 'tipo', $tipo, $movimento->tipo);
        cdiv();
        col(8);
            form_text_input('Título', 'titulo', 'required','','',$movimento->titulo);
        cdiv();
    cdiv();
    row();
        col(4);
            $status = [['value' => 'aberto', 'nome' => 'Aberto'], ['value' => 'pago', 'nome' => 'Pago']];
            form_select2_data('Status', 'status', $status, $movimento->status);
        cdiv();
        col(4);
            form_text_input('Valor', 'valor', 'required','','', moeda_real($movimento->valor));
        cdiv();
        col(4);
            form_text_input('Vencimento', 'data_vencimento', 'required','','',data_br($movimento->data_vencimento));
        cdiv();
    cdiv();
    div('', 'pago');
        row();
            col(4);
                form_text_input('Valor pago', 'valor_pago', '','','', moeda_real($movimento->valor_pago));
            cdiv();
            col(4);
                form_text_input('Data do pagamento', 'data_pagamento', '', '','', data_br($movimento->data_pagamento));
            cdiv();
        cdiv();
    cdiv();
    row();
        col(4);
            form_select2('Banco', 'banco', $bancos,'nome', $movimento->banco);
        cdiv();
        col(4);
            form_select2('Conta contábil', 'conta_contabil', $contabeis,'nome', $movimento->conta_contabil);
        cdiv();
        col(4);
            form_select2('Categoria', 'categoria', $categorias,'nome', $movimento->categoria);
        cdiv();
    cdiv();
    row();
        col(4);
            form_select2('Espécie', 'forma_de_pagamento', $formas,'nome', $movimento->forma_de_pagamento);
        cdiv();
        col(8);
            form_select2_blank('Cliente / Fornecedor', 'cliente_fornecedor', $cf,'razao_social', $movimento->cliente_fornecedor);
        cdiv();
    cdiv();
    form_textarea('Descrição', 'descricao','','','', $movimento->descricao);

    submit('Salvar', 'btn btn-success');
    form_close();
    cpanel();
?>


<script>
    $( document ).ready(function() {
        let load_status = $("#status").val();
        if(load_status == 'aberto') {
                $("#pago").hide();
            } else {
                $("#pago").show();
        }
        $("#status").change(function(){
            let status = $(this).val();
            if(status == 'aberto') {
                $("#pago").hide();
            } else {
                $("#pago").show();
            }
        });

        $('#data_vencimento').mask('00/00/0000');
        $('#data_pagamento').mask('00/00/0000');
        $('#valor').mask('000.000.000.000.000,00', {reverse: true});
        $('#valor_pago').mask('000.000.000.000.000,00', {reverse: true});

    });
</script>
