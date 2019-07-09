<?php

modal_link('+ Adicionar', 'add');

br();

ptable('Contas Contábeis');

datatable('contas_contabeis', ['Nome', 'Conta Pai', 'Código'], ['nome', 'conta_pai', 'codigo'], $contas_contabeis, ['editar' => 'financeiro/editar_contas_contabeis?id']);

cpanel();

omodal('Nova conta', 'add');
form_open('financeiro/contas_contabeis');

hidden('empresa', session('empresa'));
form_text_input('Nome:', 'nome', 'required');
form_select2_blank('Sub conta de:', 'conta_pai', $contas_contabeis,'nome');
form_text_input('Código', 'codigo', 'required');

submit('Salvar', 'btn btn-success');
form_close();

