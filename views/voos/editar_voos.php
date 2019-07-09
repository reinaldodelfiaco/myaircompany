<?php 
opanel('Editar');
    form_open('voos/editar_voos?id=' .get('id'));
        form_select2_blank('Aeronave:', 'aeronave', $aeronaves, 'matricula', $voos->aeronave);
        $tipos = [
            ['nome' => 'Assentos', 'value' => 'Assentos'],
            ['nome' => 'Fretamento', 'value' => 'Fretamento'],

        ];
        form_select2_data('Tipo','tipo', $tipos, $voos->tipo);
        form_int_input('Lugares:', 'lugares', '','','', $voos->lugares);
        form_text_input('Valor da passagem (Padrão)):', 'valor_padrao', '', '','', moeda_real($voos->valor_padrao));
        form_text_input('Origem:', 'origem', '','','', $voos->origem);
        form_text_input('Destino:', 'destino', '','','', $voos->destino);
        form_text_input('Data:', 'data', '','','', $voos->data);
        form_text_input('Hora de partida:', 'hora_partida', '','','', $voos->hora_partida);
        form_text_input('Hora de Chegada:', 'hora_chegada', '','','', $voos->hora_chegada);
        submit('Salvar', 'btn btn-success'); 
    form_close();
cpanel();

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