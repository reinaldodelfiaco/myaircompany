<?php 
opanel('Editar');
    form_open('cargos/editar_cargos?id=' .get('id'));
    form_text_input('Nome:', 'nome', '','','', $cargos->nome);
    submit('Salvar', 'btn btn-success'); 
form_close();
cpanel();