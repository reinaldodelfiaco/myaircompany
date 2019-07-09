<?php

modal_link('+ Adicionar', 'add');

br();

ptable('Contas / Caixas');

datatable('contas_bancarias', ['Nome', 'Agência', 'Conta', 'Banco'], ['nome', 'agencia', 'conta', 'banco'], $contas_bancarias, ['editar' => 'financeiro/editar_contas_bancarias?id']);

cpanel();

omodal('Nova Conta / Caixa', 'add');
form_open('financeiro/contas_bancarias');

$tipos = [
            ['value' => 'conta_corrente', 'nome' => 'Conta corrente'], 
            ['value' => 'poupanca', 'nome' => 'Poupança'], 
            ['value' => 'conta_internacional', 'nome' => 'Conta internacional'],
            ['value' => 'caixa_fisico', 'nome' => 'Caixa Físico'],
      ];
$bancos = [
                ['value' => 'itau' , 'nome' => 'Itaú'],
                ['value' => 'santander', 'nome' => 'Santander'],
                ['value' => 'caixa', 'nome' => 'Caixa Econômica'],
                ['value' => 'banco_brasil', 'nome' => 'Banco do Brasil'],
                ['value' => 'bradesco', 'nome' => 'Bradesco'],
                ['value' => 'inter', 'nome' => 'Inter'],
                ['value' => 'caixa', 'nome' => 'Caixa Econômica Federal'],
                ['value' => 'carteira', 'nome' => 'Carteira'],
          ];

hidden('empresa', session('empresa'));
form_text_input('Nome', 'nome', 'required');
form_text_input('Agência', 'agencia', 'required');
form_text_input('Conta', 'conta', 'required');
form_select2_data('Banco', 'banco', $bancos, 'nome');
form_select2_data('Tipo', 'tipo', $tipos, 'nome');
form_text_input('Saldo Inicial', 'saldo');

submit('Salvar', 'btn btn-success');
form_close();

?>

<script>
$(document).ready(function() {
    $('#saldo').mask('000.000.000.000.000,00', {
        reverse: true
    });

});
</script>