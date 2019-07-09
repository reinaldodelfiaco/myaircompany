<?php

modal_link('+ Adicionar', 'add');
br();
ptable('Centro de Distribuições');
datatable('armazens', ['Nome'], ['nome'], $armazens, ['editar' => 'estoque/editar_armazens?id', 'deletar' => 'estoque/deletar_armazens?id']);
cpanel();

omodal('Adicionar armazens', 'add');
form_open('estoque/armazens');
hidden('empresa', session('empresa'));
form_text_input('Nome:', 'nome', '');
submit('Salvar', 'btn btn-success');
form_close();
cmodal();