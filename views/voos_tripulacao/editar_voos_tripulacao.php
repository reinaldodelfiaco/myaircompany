<?php 
opanel('Editar');
    form_open('voos_tripulacao/editar_voos_tripulacao?id=' .get('id'));

    form_select2('Chefia:', 'chefia', $chefias, 'funcao', $voos_tripulacao->chefia);
        
        $cargos = [
            ['nome' => 'Comandante', 'value' => 'Comandante'],
            ['nome' => 'Co-Piloto', 'value' => 'Co-Piloto'],
            ['nome' => 'Comissário Chefe', 'value' => 'Comissário Chefe'],
            ['nome' => 'Comissário', 'value' => 'Comissário'],
            ['nome' => 'Mecânico', 'value' => 'Mecânico'],
        ];

        $status = [
            ['nome' => 'Confirmado', 'value' => 'Confirmado'],
            ['nome' => 'Pendente', 'value' => 'Pendente'],
            ['nome' => 'Cancelado', 'value' => 'Cancelar'],
        ];

        form_select2_data('Cargo:', 'cargo', $cargos, $voos_tripulacao->cargo);
        form_select2_data('Status:', 'status', $status, $voos_tripulacao->status);
        
        submit('Salvar', 'btn btn-success'); 

    form_close();
    cpanel();