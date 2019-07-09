<?php
opanel('Editar'); 

    form_open('estoque/editar_estoque?id=' .get('id'));
form_text_input('Estoque:', 'estoque', '','','', $estoque->estoque);
form_text_input('Produto:', 'produto', '','','', $estoque->produto);
form_text_input('Qtd:', 'qtd', '','','', $estoque->qtd);
form_text_input('Empresa:', 'empresa', '','','', $estoque->empresa);
submit('Salvar', 'btn btn-success'); 

    form_close(); 

    
    cpanel();