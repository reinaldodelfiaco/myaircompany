<?php


opanel('EDITAR CONTA');
form_open('financeiro/editar_contas_contabeis?id=' . get('id'));

form_text_input('Nome:', 'nome', 'required','','',$conta_contabil->nome);
form_select2_blank('Sub conta de:', 'conta_pai', $contas_contabeis,'nome', $conta_contabil->conta_pai);
form_text_input('Código', 'codigo', 'required', '','',$conta_contabil->codigo);

submit('Salvar', 'btn btn-success');
form_close();

