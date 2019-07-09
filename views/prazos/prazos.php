<?php 

modal_link('+ Adicionar', 'add');
br();
ptable('Prazos');
datatable('prazos', ['Nome', 'Prazo', ], ['nome', 'prazo', ], $prazos, ['editar' => 'prazos/editar_prazos?id', 'deletar' => 'prazos/deletar_prazos?id']);
cpanel();

omodal('Adicionar prazos', 'add');
form_open('prazos/prazos');form_text_input('Nome:', 'nome', '');
hidden('empresa', session('empresa'));
form_text_input('Prazo:', 'prazo', '');
submit('Salvar', 'btn btn-success');
form_close();
cmodal();