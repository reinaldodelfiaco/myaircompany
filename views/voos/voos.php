<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Voos');
    datatable('voos', ['Código','Aeronave', 'Lugares', 'Origem', 'Destino', 'Data', 'Partida', 'Chegada', 'Valor' ], ['id','matricula', 'lugares', 'origem', 'destino', 'data', 'hora_partida', 'hora_chegada',  'valor_padrao'], $voos, 
                        [
                            'editar' => 'voos/editar_voos?id', 
                            'deletar' => 'voos/deletar_voos?id',
                            'passageiros' => 'voos_passageiros/voos_passageiros?id',
                            'tripulacao' => 'voos_tripulacao/voos_tripulacao?id',
                            'plano_voo' => 'voos/plano_de_voo?id', 
                        ]);
    cpanel();
    
    datalist( array(
        "id" => "aerodromos",
        "method" => 'GET',
        "link_api" => BASE  .  'api/aisweb_rotaer',
        "campoNome" => 'city',
        "campoId" => 'AeroCode',    
        "data_type" => "XML",      
    ));

    omodal('Adicionar voos', 'add');
    form_open('voos/voos');
        form_select2_blank('Aeronave:', 'aeronave', $aeronaves, 'matricula');
        $tipos = [
            ['nome' => 'Assentos', 'value' => 'Assentos'],
            ['nome' => 'Fretamento', 'value' => 'Fretamento'],

        ];
        form_select2_data('Tipo','tipo', $tipos);
        form_int_input('Lugares:', 'lugares', 'server', '');
        form_text_input('Valor da passagem (Padrão)):', 'valor_padrao', '', '');
        //form_text_input('Origem:', 'origem', 'required');
        //form_text_input('Destino:', 'destino', 'required');
        form_input_autocomplete( array(
            "id" => "origem",                       
            "label" => 'Origem:',
            "placeholder" => 'Nome cidade ou cod. ICAO',                 
            "disabled" => 'none',
            "datalist" => 'aerodromos',
        )); 
        form_input_autocomplete( array(
            "id" => "destino",                       
            "label" => 'Destino:',
            "placeholder" => 'Nome cidade ou cod. ICAO',                 
            "disabled" => 'none',
            "datalist" => 'aerodromos',
        ));                            

        
       
        //form_text_input('Origem:', 'origem', 'required');
        //form_text_input('Destino:', 'destino', 'required');
        form_text_input('Data:', 'data', 'required');
        form_text_input('Hora (Partida):', 'hora_partida', 'required');
        form_text_input('Hora (Chegada):', 'hora_chegada', 'required');
        submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();


    ?>

<script>
    $(document).ready(function(){
        $("#hora_partida").mask("00:00");
        $("#hora_chegada").mask("00:00");
        
        $('#data').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $("#aeronave").change(function(){
            $('#lugares').attr('data-validation-url', '<?= BASE ?>voos/total_assentos?aeronave=' + $(this).val());
        });

        $('#valor_padrao').mask('000.000.000.000.000,00', {
            reverse: true
        });

    });

</script>