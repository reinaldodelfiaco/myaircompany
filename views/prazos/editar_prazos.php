<?php 
opanel('Editar');
    form_open('prazos/editar_prazos?id=' .get('id'));form_text_input('Nome:', 'nome', '','','', $prazos->nome);
form_text_input('Prazo:', 'prazo', '','','', $prazos->prazo);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();