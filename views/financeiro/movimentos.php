<?php

modal_link('+ ADICIONAR', 'add');

omodal('Novo movimento', 'add', 'modal-lg');
    form_open('financeiro/movimentos', 'POST');
    hidden('empresa', session('empresa'));
    row();
        col(4);
            form_text_input('Valor Total', 'vtotal', '','','');
        cdiv();
        div('', 'parcelas');
        col(4);
            form_text_input('Parcelas', 'parcela', 'required','','',1);
        cdiv();
        cdiv();
        div('','f');
            col(4);
            $p = [['value' => 'mensal', 'nome' => 'Mensal'], ['value' => 'anual', 'nome' => 'Anual']];
            form_select2_data('Frequência', 'frequencia', $p, 'nome');
            cdiv();
        cdiv();
        cdiv();
        hr();
    
    row();
        col(4);
            $tipo = [['value' => 'receita', 'nome' => 'Receita'], ['value' => 'despesa', 'nome' => 'Despesa']];
            form_select2_data('Tipo', 'tipo', $tipo, 'nome');
        cdiv();
        col(8);
            form_text_input('Título', 'titulo', 'required');
        cdiv();
    cdiv();
    row();
        col(4);
            $status = [['value' => 'aberto', 'nome' => 'Aberto'], ['value' => 'pago', 'nome' => 'Pago']];
            form_select2_data('Status', 'status', $status, 'nome');
        cdiv();
        col(4);
            form_text_input('Valor', 'valor', 'required');
        cdiv();
        col(4);
            form_text_input('Vencimento', 'data_vencimento', 'required');
        cdiv();
    cdiv();
    div('', 'pago');
        row();
            col(4);
                form_text_input('Valor pago', 'valor_pago', '');
            cdiv();
            col(4);
                form_text_input('Data do pagamento', 'data_pagamento', '');
            cdiv();
        cdiv();
    cdiv();
    row();
        col(4);
            form_select2('Banco', 'banco', $bancos,'nome');
        cdiv();
        col(4);
            form_select2('Conta contábil', 'conta_contabil', $contabeis,'nome');
        cdiv();
        col(4);
            form_select2('Categoria', 'categoria', $categorias,'nome');
        cdiv();
    cdiv();
    row();
        col(4);
            form_select2('Espécie', 'forma_de_pagamento', $formas,'nome');
        cdiv();
        col(8);
            form_select2_blank('Cliente / Fornecedor', 'cliente_fornecedor', $cf,'razao_social');
        cdiv();
    cdiv();
    form_textarea('Descrição', 'descricao');

    submit('Salvar', 'btn btn-success');
    form_close();
   cmodal();


    // MODAL DE FILTRO FINANCEIRO
    div('pull-right');
        modal_link('<i class="fa fa-filter"></i> FILTRAR', 'filtrar', 'btn btn-success');
        
        omodal('FILTRO FINANCEIRO', 'filtrar');
            form_open('financeiro/movimentos', 'get');
                row();
                    col(6);
                        $status = [['value' => 'aberto', 'nome' => 'Aberto'], ['value' => 'pago', 'nome' => 'Pago']];
                        form_select2_data_blank('Status', 'fstatus', $status, get('fstatus'));
                    cdiv();
                    col(6);
                        $tipo = [['value' => 'receita', 'nome' => 'Receita'], ['value' => 'despesa', 'nome' => 'Despesa']];
                        form_select2_data_blank('Tipo', 'ftipo', $tipo, 'nome');
                    cdiv();
                cdiv();
                row();
                col(6);
                    form_text_input('Data Inicial', 'fdata_inicial', '','','', get('fdata_inicial'));
                cdiv();
                col(6); 
                    form_text_input('Data Final', 'fdata_final', '','','', get('fdata_final'));
                cdiv();
            cdiv();
            row();
                col(6);
                    form_text_input('Data lançamento inicial', 'fldata_inicial', '','','', get('fldata_inicial'));
                cdiv();
                col(6); 
                    form_text_input('Data lançamento final', 'fldata_final', '','','', get('fldata_final'));
                cdiv();
            cdiv();
            submit('FILTRAR', 'btn btn-success');
            form_close();
        cmodal();
    cdiv();

br();

ptable('Todas as movimentações');

datatable('movimentos', ['Tipo', 'Data de Inclusão', 'Título', 'Vencimento', 'Valor', 'Status'], ['tipo', 'data_lancamento','titulo','data_vencimento','valor','status'], $movimentos, [
    'editar' => 'financeiro/editar_movimento?id',
    'confirmar_pagamento' => 'financeiro/confirmar_pagamento?id',
    'deletar' => 'financeiro/deletar_movimento?id',
]);

cpanel();
?>

<script>
$(document).ready(function() {
    $("#pago").hide();
    $("#f").hide();
    $("#parcelas").show();
    $("#status").change(function() {
        let status = $(this).val();
        if (status == 'aberto') {
            $("#pago").hide();
        } else {
            $("#pago").show();
        }
    });

    $("#recorrente").change(function() {
        let r = $(this).val();
        if (r == '1') {
            $("#parcelas").hide();
        } else {
            $("#parcelas").show();
        }
    });

    $("#parcela").blur(function() {
        let vtotal = moedaParaNumero($("#vtotal").val());
        let vparcela = $("#parcela").val();
        $("#valor").val(numeroParaMoeda(vtotal / vparcela));

        if(vparcela > 1) {
            $("#f").show();
        }
    });

    $("#vtotal").blur(function() {
        let vtotal = moedaParaNumero($("#vtotal").val());
        let vparcela = $("#parcela").val();
        $("#valor").val(numeroParaMoeda(vtotal / vparcela));
    });

    function moedaParaNumero(valor)
    {
        return isNaN(valor) == false ? parseFloat(valor) :   parseFloat(valor.replace("R$","").replace(".","").replace(",","."));
    }

    function numeroParaMoeda(n, c, d, t)
    {
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    $('#data_vencimento').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#data_pagamento').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#fdata_inicial').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#fdata_final').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#fldata_inicial').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#fldata_final').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#valor').mask('000.000.000.000.000,00', {
        reverse: true
    });

    $('#valor_pago').mask('000.000.000.000.000,00', {
        reverse: true
    });

    $('#vtotal').mask('000.000.000.000.000,00', {
        reverse: true
    });

});
</script>