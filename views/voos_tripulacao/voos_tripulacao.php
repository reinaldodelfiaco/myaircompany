<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Voos_tripulacao');
    datatable('voos_tripulacao', ['Voo', 'Chefia', 'Cargo', 'Status', ], ['voo', 'nome', 'ncargo', 'nstatus', ], $voos_tripulacao, ['editar' => 'voos_tripulacao/editar_voos_tripulacao?id', 'deletar' => 'voos_tripulacao/deletar_voos_tripulacao?id']);
    cpanel();
    
    omodal('Adicionar voos_tripulacao', 'add');
    form_open('voos_tripulacao/voos_tripulacao');
    hidden('voo', get('id'));
    form_select2('Chefia:', 'chefia', $chefias, 'funcao');
    
    $cargos = [
        ['nome' => 'Comandante', 'value' => 'Comandante'],
        ['nome' => 'Co-Piloto', 'value' => 'Co-Piloto'],
        ['nome' => 'Comissário Chefe', 'value' => 'Comissário Chefe'],
        ['nome' => 'Comissário', 'value' => 'Comissário'],
        ['nome' => 'Mecânico', 'value' => 'Mecânico'],
    ];

    $status = [
        ['nome' => 'Confirmidado', 'value' => 'Confirmado'],
        ['nome' => 'Pendente', 'value' => 'Pendente'],
        ['nome' => 'Cancelado', 'value' => 'Cancelar'],
    ];

    form_select2_data('Cargo:', 'cargo', $cargos);
    form_select2_data('Status:', 'status', $status);
    submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();