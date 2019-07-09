<?php

opanel('Editar categoria: '. $categoria_financeira->nome);
form_open('financeiro/editar_categorias_financeiras?id=' .get('id'));

$tipo = [['value' => 'receita', 'nome' => 'Receita'], ['value' => 'despesa', 'nome' => 'despesa']];


form_text_input('Nome', 'nome', 'required', '','', $categoria_financeira->nome);
form_select2_data('Tipo', 'tipo', $tipo, $categoria_financeira->tipo);

submit('Salvar', 'btn btn-success');
form_close();

cpanel();


?>






