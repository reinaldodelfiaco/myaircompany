<?php 
opanel('Editar');
    form_open('ordens/editar_ordens?id=' .get('id'));form_text_input('Tipo:', 'tipo', '','','', $ordens->tipo);
form_text_input('Titulo:', 'titulo', '','','', $ordens->titulo);
form_text_input('Descricao:', 'descricao', '','','', $ordens->descricao);
form_text_input('Data:', 'data', '','','', $ordens->data);
form_text_input('Status:', 'status', '','','', $ordens->status);
form_text_input('Cliente_fornecedor:', 'cliente_fornecedor', '','','', $ordens->cliente_fornecedor);
form_text_input('Nota_fiscal:', 'nota_fiscal', '','','', $ordens->nota_fiscal);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();