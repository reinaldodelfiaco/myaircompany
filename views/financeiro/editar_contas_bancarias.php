<?php

opanel('Editar conta: '. $conta_bancaria->nome);
form_open('financeiro/editar_contas_bancarias?id=' .get('id'));


$tipos = [
    ['value' => 'conta_corrente', 'nome' => 'Conta corrente'], 
    ['value' => 'poupanca', 'nome' => 'Poupança'], 
    ['value' => 'conta_internacional', 'nome' => 'Conta internacional'],
    ['value' => 'caixa_fisico', 'nome' => 'Caixa Físico'],
];

$banco = [['value' => 'itau' , 'nome' => 'Itaú'], ['value' => 'santander', 'nome' => 'Santander'], ['value' => 'caixa', 'nome' => 'Caixa Econômica'], ['value' => 'banco_brasil', 'nome' => 'Banco do Brasil'], ['value' => 'bradesco', 'nome' => 'Bradesco']];

hidden('empresa', session('empresa'));

form_text_input('Nome', 'nome', 'required', '','', $conta_bancaria->nome);
form_text_input('Agência', 'agencia', 'required', '', '', $conta_bancaria->agencia);
form_text_input('Conta', 'conta', 'required', '', '', $conta_bancaria->conta);
form_select2_data('Banco','banco', $banco, $conta_bancaria->banco);
form_select2_data('Tipo', 'tipo', $tipos, $conta_bancaria->tipo);

submit('Salvar', 'btn btn-success');
form_close();

cpanel();


?>






