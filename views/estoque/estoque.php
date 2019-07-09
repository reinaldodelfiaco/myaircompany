<?php

modal_link('+ Adicionar', 'add');

br();

ptable('Estoque');

datatable('estoque', ['Estoque', 'Produto', 'Qtd'], ['estoque', 'produto', 'qtd'], $estoques, ['editar' => 'estoque/editar_estoque?id', 'deletar' => 'estoque/deletar_estoque?id']);

omodal('Ajuste de Estoque', 'add');

form_open('estoque/index');
form_text_input('Estoque:', 'estoque', '');
form_text_input('Produto:', 'produto', '');
form_text_input('Quantidade:', 'qtd', '');

hidden('empresa', session('empresa'));

submit('Salvar', 'btn btn-success');

form_close();