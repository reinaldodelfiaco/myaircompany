<?php

modal_link('+ Adicionar', 'add');

br();

ptable('Categorias de Despesas e Receitas');

datatable('categorias_financeiras', ['Nome', 'Tipo'], ['nome',  'tipo'], $categorias_financeiras, ['editar' => 'financeiro/editar_categorias_financeiras?id']);

cpanel();

omodal('Nova categoria de despesa ou receita', 'add');
form_open('financeiro/categorias_financeiras');

$tipo = [['value' => 'receita', 'nome' => 'Receita'], ['value' => 'despesa', 'nome' => 'Despesa']];

hidden('empresa', session('empresa'));

form_text_input('Nome', 'nome', 'required');
form_select2_data('Tipo', 'tipo', $tipo, 'nome');

submit('Salvar', 'btn btn-success');
form_close();

