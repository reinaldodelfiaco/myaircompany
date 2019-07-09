<?php 
opanel('Editar');
    form_open('unidades/editar_unidades?id=' .get('id'));form_text_input('Nome:', 'nome', '','','', $unidades->nome);
    form_text_input('Sigla:', 'sigla', '','','', $unidades->sigla);
    $tipos = [
        ['nome'=> 'Massa', 'value' => 'massa'],
        ['nome'=> 'Líquido', 'value' => 'liquido'],
        ['nome'=> 'Distância', 'value' => 'distancia'],
        ['nome'=> 'Metereologia', 'value' => 'metereologia'],
        ['nome'=> 'Moeda', 'value' => 'moeda'],
    ];
    form_select2_data('Tipo:', 'tipo', $tipos, $unidades->tipo);
    submit('Salvar', 'btn btn-success'); 
form_close();
cpanel();