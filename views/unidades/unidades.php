<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Unidades');
    datatable('unidades', ['Nome', 'Sigla', 'Tipo', ], ['nome', 'sigla', 'tipo', ], $unidades, ['editar' => 'unidades/editar_unidades?id', 'deletar' => 'unidades/deletar_unidades?id']);
    cpanel();
    
    omodal('Adicionar unidades', 'add');
    form_open('unidades/unidades');form_text_input('Nome:', 'nome', '');
    form_text_input('Sigla:', 'sigla', '');

    $tipos = [
        ['nome'=> 'Massa', 'value' => 'massa'],
        ['nome'=> 'Líquido', 'value' => 'liquido'],
        ['nome'=> 'Distância', 'value' => 'distancia'],
        ['nome'=> 'Metereologia', 'value' => 'metereologia'],
        ['nome'=> 'Moeda', 'value' => 'moeda'],
    ];

    form_select2_data('Tipo:', 'tipo', $tipos);

    submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();