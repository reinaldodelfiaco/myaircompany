<?php

opanel('Editar forma de pagamento: '. $forma_pagamento->nome);
form_open('financeiro/editar_formas_pagamento?id=' .get('id'));


form_text_input('Nome', 'nome', 'required', '','', $forma_pagamento->nome);

submit('Salvar', 'btn btn-success');
form_close();

cpanel();


?>






