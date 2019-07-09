<?php

modal_link('+ Adicionar', 'add');

br();

ptable('Categorias de Produtos');

datatable('produtos_categorias', ['Nome'], ['nome'], $produtos_categorias, ['editar' => 'estoque/editar_produtos_categorias?id', 'deletar' => 'estoque/deletar_produtos_categorias?id']);

cpanel();


omodal('Adicionar categoria', 'add');

form_open('estoque/produtos_categorias');

hidden('empresa', session('empresa'));
form_text_input('Nome:', 'nome', 'required');

submit('Salvar', 'btn btn-success');

form_close();
cmodal();