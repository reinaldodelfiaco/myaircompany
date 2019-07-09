<?php 
opanel('Editar');
    form_open('ordens_produtos/editar_ordens_produtos?id=' .get('id'));form_text_input('Orden:', 'orden', '','','', $ordens_produtos->orden);
form_text_input('Produto:', 'produto', '','','', $ordens_produtos->produto);
form_text_input('Valor:', 'valor', '','','', $ordens_produtos->valor);
form_text_input('Valor_total:', 'valor_total', '','','', $ordens_produtos->valor_total);
form_text_input('Quantidade:', 'quantidade', '','','', $ordens_produtos->quantidade);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();