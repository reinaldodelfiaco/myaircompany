<?php
opanel('CONFIRMAR PAGAMENTO:  ' . $movimento->titulo);
    form_open('financeiro/confirmar_recorrente?id=' . $movimento->id, 'POST');
        
        hidden('status', 'pago');
        hidden('titulo', $movimento->titulo);
        hidden('parcela', 1);
        hidden('tipo', $movimento->tipo);
        hidden('valor', $movimento->valor);
        hidden('data_vencimento', $movimento->data_vencimento);
        hidden('descricao', $movimento->descricao);
        hidden('recorrente_paga', $movimento->id);
        hidden('empresa', $movimento->empresa);
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
                form_select2('Forma de pagamento', 'forma_de_pagamento', $formas,'nome', $movimento->forma_de_pagamento);
            cdiv();
            col(4);
                form_text_input('Valor pago', 'valor_pago', 'required','','', moeda_real($movimento->valor));
            cdiv();
            col(4);
                form_text_input('Data do pagamento', 'data_pagamento', 'required', '','', data_br($movimento->data_vencimento));
            cdiv();
        cdiv();
	submit('Salvar', 'btn btn-success');
    form_close();
cpanel();
?>


<script>
    $( document ).ready(function() {

        $('#data_pagamento').mask('00/00/0000');
        $('#valor_pago').mask('000.000.000.000.000,00', {reverse: true});

    });
</script>
