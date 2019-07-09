<?php

opanel('Filtro');
form_open('financeiro/caixas', 'get');
row();
    hidden('f', 1);
    col(4);
        form_select2_blank('CAIXA / BANCO', 'fconta', $bancos, 'nome', get('fconta'));
    cdiv();
    col(4);
    form_text_input('Data Inicial', 'fdata_inicial', '','','', get('fdata_inicial'));
    cdiv();
    col(4); 
        form_text_input('Data Final', 'fdata_final', '','','', get('fdata_final'));
    cdiv();
cdiv();

submit('FILTRAR', 'btn btn-success');
form_close();
cpanel();


row();
    col(4);
        //Despesas
        dashboard_count('RECEITAS', 'R$ ' . moeda_real($rec), 'fa fa-money','financeiro/receitas', 'green');
    
    cdiv();
    col(4);
        // Receitas
        dashboard_count('DESPESAS', 'R$ ' . moeda_real($desp), 'fa fa-money','financeiro/receitas', 'red');
    cdiv();
    col(4);
        // Saldo
        dashboard_count('SALDO ATUAL', 'R$ ' . moeda_real($totalgeralfinal), 'fa fa-money','financeiro/receitas', 'rgb(83, 0, 130)');
    cdiv();
   
cdiv();



if(get('f') == 1 && get('fconta') > 0) {
ptable('EXTRATO');
table('movimentos', ['Data', 'Tipo', 'Título', 'Valor', 'Saldo'], ['data_pagamento', 'tipo', 'titulo','valor_pago', 'saldo'], $movimentos, [
    #'editar' => 'financeiro/editar_movimento?id',
    #'confirmar_pagamento' => 'financeiro/confirmar_pagamento?id',
    #'deletar' => 'financeiro/deletar_movimento?id',
]);

cpanel();
}
?>


<script>
$(document).ready(function() {
   

    $('#fdata_inicial').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#fdata_final').datepicker({
        autoclose: true,
        todayHighlight: true
    });
   
});
</script>