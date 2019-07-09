<?php

opanel('Editar');
form_open('estoque/editar_armazens?id=' . get('id'));
form_text_input('Nome:', 'nome', '', '', '', $armazens->nome);
submit('Salvar', 'btn btn-success');
form_close();
cpanel();