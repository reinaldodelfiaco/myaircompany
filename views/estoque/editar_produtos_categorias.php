<?php
opanel('Editar');

form_open('estoque/editar_produtos_categorias?id=' . get('id'));
form_text_input('Nome:', 'nome', 'required', '', '', $produtos_categorias->nome);
submit('Salvar', 'btn btn-success');
form_close();

cpanel();