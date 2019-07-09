<?php 
    //modal_link('+ Adicionar', 'add');
    br();
    ptable('Plano de Voo');
    datatable('plano', ['Código Voo','Aeronave', 'Aerodromo Partida', 'Aerodromo Destino', 'Qtd. Pessoas Bordo'], ['id_voo', 'nome_aeronave', 'aerodromo_partida', 'aerodromo_destino', 'pessoas_bordo'], $planos, ['editar' => 'voos/editar_plano_voo?id', 'deletar' => 'voos/deletar_plano_voo?id']);
    cpanel();
    

    if ($vooSelected || $planoVooSelected) {

        if ($planoVooSelected->id != null) {
            omodal('Editar plano de voo', 'add', 'modal-lg'); 
            

        } else {
            omodal('Novo plano de voo', 'add', 'modal-lg');
        }

        form_open('voos/plano_de_voo');

        hidden('id_plano_voo', $planoVooSelected->id);
        hidden('id_voo',$vooSelected->id);
        hidden('acao',$acao);

        datalist( array(
            "id" => "aerodromos",
            "method" => 'GET',
            "link_api" => BASE  .  'api/aisweb_rotaer',
            "campoNome" => 'city',
            "campoId" => 'AeroCode',    
            "data_type" => "XML",      
        ));

        $adep = trim(explode("-",$vooSelected->origem)[0]);
        $ades = trim(explode("-",$vooSelected->destino)[0]);
        datalist( array(
            "id" => "rotas_sugeridas",
            "method" => 'GET',
            "link_api" => BASE  .  'api/aisweb_routesp?adep=' . $adep . "&ades=" . $ades,
            "campoNome" => 'route',
            "campoId" => '',    
            "data_type" => "XML",      
        ));
        hidden('notam_selecionadas','');
        hidden('cartas_selecionadas','');

        //armazena as mensagens de meteorologia
        //para aero partida
        hidden('met1_msg_metar','');
        hidden('met1_msg_taf','');

        //armazena as mensagens de meteorologia
        //para aero destino
        hidden('met2_msg_metar','');
        hidden('met2_msg_taf','');

        //armazena a informacao de nascer e por do sol
        hidden('tabNsPrSol1_msg','');
        hidden('tabNsPrSol2_msg','');


        row();
            col(4);           
                form_text_input_disabled('Id Voo:', 'id_voo', $vooSelected->id);  
            cdiv();      
            col(4);
                form_text_input_disabled('Origem:', 'origem_voo', $vooSelected->origem);              
            cdiv();
            col(4);
                form_text_input_disabled('Destino:', 'destino_voo', $vooSelected->destino);   
            cdiv();
        cdiv();
        row();
            col(4);           
                form_text_input_disabled('Data:', 'data_voo', data_br($vooSelected->data));  
            cdiv();      
            col(4);
                form_text_input_disabled('Hora Partida:', 'partida_voo', $vooSelected->hora_partida);              
            cdiv();
            col(4);
                form_text_input_disabled('Hora Chegada:', 'chegada_voo', $vooSelected->hora_chegada);   
            cdiv();
        cdiv();
        br();
    ?>

    <ul id="myTab1" class="nav nav-tabs">
        <li class="active">
            <a  href="#tpmsg" id="itpmsg" data-toggle="tab">Tipo de Mensagem</a>
        </li>

        <li class="">
            <a href="#info" id="iinfo" data-toggle="tab">Informações Complementares</a>
        </li>

        <li class="">
            <a href="#cartas" id="icartas" data-toggle="tab">Cartas Aeronáuticas</a>
        </li>
    
    </ul>
    <div id="myTab1Content" class="tab-content">


    <div class="tab-pane fade active in" id="tpmsg">
    <?php
        row();
            col(4);           
                form_text_input_disabled('Aeronave:', 'id_aeronave', $vooSelected->aeronave);  
            cdiv();      
            col(4);
                form_select2_data_blank('Regra Voo:', 'regra_voo', $regraVooOpts);              
            cdiv();
            col(4);
                $tipo_voo = [
                    ['value' => 'S - Transporte Regular', 'nome' => 'S - Transporte Regular'], 
                    ['value' => 'N - Transporte Não Regular', 'nome' => 'N - Transporte Não Regular'],
                    ['value' => 'G - Aviação Geral', 'nome' => 'G - Aviação Geral'],
                    ['value' => 'M - Aeronave Militar', 'nome' => 'M - Aeronave Militar'],
                    ['value' => 'X - Distinto', 'nome' => 'X - Distinto']
                ];
                form_select2_data_blank('Tipo Voo:', 'tipo_voo', $tipo_voo, '', '', $planoVooSelected->tipo_voo);
            cdiv();
        cdiv();

        row();
            col(2);            
                form_text_input_disabled ('Número:', 'numero', '');
            cdiv();
            col(2);
                form_text_input_disabled('Tipo Aeronave:', 'tipo_aeronave', '');
            cdiv();    
            col(3);
                $turbulencia = [
                        ['value' => 'L - Leve', 'nome' => 'L- Leve'], 
                        ['value' => 'M - Média', 'nome' => 'M - Média'],
                        ['value' => 'H - Pesada', 'nome' => 'H - Pesada'],
                        ['value' => 'J - Pesada', 'nome' => 'J - Pesada'],
                    ];
                form_select2_data_blank('Cat. Esteira Turbulência:', 'cat_esteira_turbulencia', $turbulencia, '', '', $planoVooSelected->cat_esteira_turbulencia);
            cdiv();
            col(5);
                form_text_input_disabled('Equipamento e Capacidades (S/):', 'equipamento_capacidades', '', '', '', $planoVooSelected->equipamento_capacidades);
            cdiv();
        cdiv();
                  
        row();
            col(6);            
                form_text_input_disabled('Aerodromo Partida:', 'aerodromo_partida', $vooSelected->origem);            
            cdiv();
            col(3);
                form_text_input_disabled('Hora de Partida:', 'hora_partida', $vooSelected->hora_partida);   
            cdiv();
            
            col(3);            
                dropdown(array(
                    "drop_id" => "partida_opt",
                    "drop_text" => "Informações Auxiliares",
                    "menu_itens" => array( 
                            array('id' => "met1" , "text" => "Meteorologia"), 
                            array("id" => "notam1", "text" => "NOTAM"), 
                            array( "id" => "tab1", "text" => "Tabela Nascer e Pôr do Sol") 
                    ),
                ));
            cdiv();
        cdiv();

        row();
            col(12);
                hidden('hora_partida_calculada','');
                meteorologia_table( array(
                    "id" => "met_aero_1",                       
                    "field_cod_icao" => 'aerodromo_partida',
                    "field_hr" => 'hora_partida_calculada',
                    "action" => 'met1',
                    "api_url" => BASE  .  'api/redemet_meteor',
                    "info" => 'Informações coletadas via API Redemet',
                    "msg_metar" => 'met1_msg_metar',
                    "msg_taf" => 'met1_msg_taf',
                ));

                notam_table(array(
                    "id" => "notam_tab_1",
                    "field_cod_icao" => 'aerodromo_partida',
                    "api_url" => BASE  .  'api/aisweb_notam',
                    "action" => 'notam1',
                ));

                porDoSol_table( array (
                    "id" => "prsol_tab_1",
                    "field_cod_icao" => 'aerodromo_partida',
                    "api_url" => BASE  .  'api/aisweb_sol',
                    "action" => 'tab1',
                    "tab_info" => "tabNsPrSol1_msg",
                ));
            cdiv();
        cdiv();

        row();
            col(6);        
                form_text_input_disabled('Aerodromo Destino:', 'aerodromo_destino', $vooSelected->destino);            
            cdiv();    
            col(3);
                form_text_input_disabled('EET Total:', 'eet_total', '');
            cdiv();

            col(3);            
                dropdown(array(
                    "drop_id" => "destino_opt",
                    "drop_text" => "Informações Auxiliares",
                    "menu_itens" => array( 
                            array('id' => "met2" , "text" => "Meteorologia"), 
                            array("id" => "notam2", "text" => "NOTAM"), 
                            array( "id" => "tab2", "text" => "Tabela Nascer e Pôr do Sol") 
                    ),
                ));
            cdiv();
        cdiv();

        row();
            col(12);
                hidden("hr_calculada", '');
                meteorologia_table( array(
                    "id" => "met_aero_2",                       
                    "field_cod_icao" => 'aerodromo_destino',
                    "field_hr" => 'hr_calculada',
                    "action" => 'met2',
                    "api_url" => BASE  .  'api/redemet_meteor',
                    "info" => 'Informações coletadas via API Redemet',
                    "msg_metar" => 'met2_msg_metar',
                    "msg_taf" => 'met2_msg_taf',
                ));

                notam_table(array(
                    "id" => "notam_tab_2",
                    "field_cod_icao" => 'aerodromo_destino',
                    "api_url" => BASE  .  'api/aisweb_notam',
                    "action" => 'notam2',
                ));

                porDoSol_table( array (
                    "id" => "prsol_tab_2",
                    "field_cod_icao" => 'aerodromo_destino',
                    "api_url" => BASE  .  'api/aisweb_sol',
                    "action" => 'tab2',
                    "tab_info" => "tabNsPrSol2_msg",
                ));

            cdiv();
        cdiv();

        row();
            col(3);
                form_int_input('Velocidade Cruzeiro:', 'velocidade_cruzeiro', '', '', '', $planoVooSelected->velocidade_cruzeiro);
            cdiv();
            col(3);
                form_text_input('Nível:', 'nivel', '', '', '', $planoVooSelected->nivel);
            cdiv();
            col(6);
                
                form_input_autocomplete( array(
                    "id" => "rota",                       
                    "label" => 'Rota:',
                    "placeholder" => 'Clique para ver a rota sugerida',                 
                    "disabled" => 'none',
                    "datalist" => 'rotas_sugeridas',
                    "value" => $planoVooSelected->rota,              
                ));
            cdiv();
        cdiv();

        row();
            col(6);
                //form_text_input('Aerodromo Alternativo:', 'aerodromo_altn', '');            
                form_input_autocomplete( array(
                    "id" => "aerodromo_altn",                       
                    "label" => 'Aerodromo Alternativo:',
                    "placeholder" => 'Nome cidade ou código ICAO',                 
                    "disabled" => 'none',
                    "datalist" => 'aerodromos',
                    "value" => $planoVooSelected->aerodromo_altn,
                ));
            cdiv();        
        
            col(6);
                //form_text_input('2º Aerodromo Alternativo:', '2_aerodromo_altn', ''); 
                form_input_autocomplete( array(
                    "id" => "segundo_aerodromo_altn",                       
                    "label" => '2º Aerodromo Alternativo:',
                    "placeholder" => 'Nome cidade ou código ICAO',                 
                    "disabled" => 'none',
                    "datalist" => 'aerodromos',
                    "value" => $planoVooSelected->segundo_aerodromo_altn,              
                ));
            cdiv();
        cdiv();   
            
        row();
            col(12);
                form_text_input('Outros Dados:', 'outros_dados', '', '','', $planoVooSelected->outros_dados);
            cdiv();        
        cdiv();
    ?>
    </div>


    <div class="tab-pane fade in" id="info">
    <?php

        row();
            col(3);
                form_text_input('Hora Autonomia:', 'hora_autonomia', '', '','', $planoVooSelected->hora_autonomia);
            cdiv();  
            col(3);
                form_int_input('Pessoas a Bordo:', 'pessoas_bordo', '', '','', $planoVooSelected->pessoas_bordo);
            cdiv();
            col(2); 
                form_checkbox_sup('Rádio UHF','radio_uhf', '1', ($aeronave->radio_uhf ? 'checked' : ''));
            cdiv();
            col(2);
                form_checkbox_sup('Rádio VHF','radio_vhf', '1', ($aeronave->radio_vhf ? 'checked' : ''));
            cdiv();
            col(2);
                form_checkbox_sup('Rádio ELT','radio_elt', '1', ($aeronave->radio_elt ? 'checked' : ''));
            cdiv();
        cdiv();

        row();
            col(3); 
                form_checkbox_sup('Equip. Sobrevivência Polar','survival_polar', '1', ($aeronave->survival_polar ? 'checked' : ''));
            cdiv();
            col(3); 
                form_checkbox_sup('Equip. Sobrevivência Deserto','survival_desert', '1', ($aeronave->survival_desert ? 'checked' : ''));
            cdiv();
            col(3); 
                form_checkbox_sup('Equip. Sobrevivência Marítimo','survival_maritime', '1', ($aeronave->survival_maritime ? 'checked' : ''));
            cdiv();
            col(3); 
                form_checkbox_sup('Equip. Sobrevivência Selva','survival_jungle', '1', ($aeronave->survival_jungle ? 'checked' : ''));
            cdiv();
        cdiv();

        row();
            col(3); 
                form_checkbox_sup('Colete Luz','colete_luz', '1', ($aeronave->colete_luz ? 'checked' : ''));
            cdiv();
            col(3); 
                form_checkbox_sup('Colete Fluor','colete_fluor', '1', ($aeronave->colete_fluor ? 'checked' : ''));
            cdiv();
            col(3); 
                form_checkbox_sup('Colete UHF','colete_uhf', '1', ($aeronave->colete_uhf ? 'checked' : ''));
            cdiv();
            col(3); 
                form_checkbox_sup('Colete VHF','colete_vhf', '1', ($aeronave->colete_vhf ? 'checked' : ''));
            cdiv();
        cdiv();


        row();
            col(4); 
                form_int_input('Botes Número:','botes_numero','', '','', $aeronave->botes_numero);
            cdiv();
            col(4); 
                form_int_input('Botes Capacidade:','botes_capacidade','', '','', $aeronave->botes_capacidade);
            cdiv();
            col(4); 
                form_text_input('Cor Abrigo:','abrigo_cor','', '','', $aeronave->abrigo_cor);
            cdiv();
        cdiv();

        row();
            col(4); 
                form_text_input('Cor e Marcas Aeronave:','cor_marca_aeronave','', '','', $aeronave->cor_marca_aeronave);
            cdiv();
            col(8); 
                form_text_input('Observações:','observacoes','', '','', $planoVooSelected->observacoes);
            cdiv();
        cdiv();

        row();
            col(12); 
                form_select2_data('Piloto em Comando:','id_piloto_comando',$pilotos);
            cdiv();
        cdiv();
        ?>
        </div>

        <div class="tab-pane fade in" id="cartas">
    <?php
        row();
            col(4); 
                form_input_autocomplete( array(
                    "id" => "opt_partida",                       
                    "label" => 'Aeródromo:',
                    "placeholder" => 'Nome cidade ou cod. ICAO',                 
                    "disabled" => 'none',
                    "datalist" => 'aerodromos'              
                ));
            cdiv();        
            col(6);
                button('btnCartas', 'Pesquisar Cartas', 'btn btn-primary', '25');
            cdiv();

        cdiv();

        row();
            col(12);
                carta_table( array(
                    "id" => "carta_tab_1",
                    "field_cod_icao" => 'opt_partida',
                    "api_url" => BASE  .  'api/aisweb_cartas',
                    "action" => 'btnCartas',
                ));
            cdiv();
        cdiv();

?>
    </div>
 </div>

 <?php      
        submit('Salvar', 'btn btn-success');

        form_close();
        cmodal();
}
?>

<script>
$(document).ready(function() {
    $("#hora_autonomia").mask("00:00");

    $('#regra_voo').val('<?= $planoVooSelected->regra_voo ?>');
    $('#regra_voo').trigger('change'); //notifica os componentes que o valor mudou
    
    $('#id_piloto_comando').val('<?= $planoVooSelected->id_piloto_comando ?>');
    $('#id_piloto_comando').trigger('change'); //notifica os componentes que o valor mudou
   
    if ($("#id_voo").val() != "") {
        $('#add').modal('show'); 
    
        var idAeronave = $("#id_aeronave").val();
        $.ajax({
            type: "GET",
            dataType: "json",
            url:"<?= BASE ?>aeronaves/recupera_dados_aeronave",
            data: { 
                id: idAeronave, 
            },
            success: function(data) {

                //console.log(data);                            
                if ( data != undefined) {
                    $("#id_aeronave").val(data.id + ' - Nr ' + data.numero + ' / Modelo ' + data.modelo );
                    $("#numero").val(data.numero);
                    $("#tipo_aeronave").val(data.tipo_icao);
                    $("#equipamento_capacidades").val(data.equipamento_capacidades);                                        
                }                     
            }
        });

   }
  

    var hrPartida = $("#hora_partida").val();
    var hrChegada = $("#chegada_voo").val();
    if (hrPartida != undefined && hrChegada != undefined) {
        var d = new Date();        
        
        calculaEET();     

        hrPartida = hrPartida.split(':');
        var partidaHour = leftPad(hrPartida[0], 2);

        hrChegada = hrChegada.split(':');
        var chegadaHour = leftPad(hrChegada[0], 2);

        //console.log( d.getFullYear() + "" +  leftPad(d.getMonth() + 1, 2) + "" + leftPad(d.getDate(), 2) + "" + partidaHour);
        $("#hora_partida_calculada").val(d.getFullYear() + "" +  leftPad(d.getMonth() + 1, 2) + "" + leftPad(d.getDate(), 2) + "" + partidaHour);
        $("#hr_calculada").val(d.getFullYear() + "" +  leftPad(d.getMonth() + 1, 2) + "" + leftPad(d.getDate(), 2) + "" +  chegadaHour);

    } else {
        $("#hr_calculada").val("");
        $("#hora_partida_calculada").val("");
    }


    //Cacula a hora de chegada no formato para
    //ser utilizado na pesquisa de meteorologia
    function calculaEET(value) {
        var eetTotal = '';
        var hrPartida = $("#hora_partida").val();
        var hrChegada = $("#chegada_voo").val();

        if (hrPartida != "" && hrChegada != "") {
            var d = new Date();
           
            hrPartida = hrPartida.split(':');
            var partidaHour = leftPad(hrPartida[0], 2);
            var partidaMin = leftPad(hrPartida[1], 2);

            hrChegada = hrChegada.split(':');
            var chegadaHour = leftPad(hrChegada[0], 2);
            var chegadaMin = leftPad(hrChegada[1], 2);

            var dtIni = new Date(d.getFullYear() , d.getMonth()  , d.getDate(), partidaHour,partidaMin);
            var dtFim = new Date(d.getFullYear() , d.getMonth()  , d.getDate(), chegadaHour,chegadaMin);
            
            var diff = dtFim.valueOf() - dtIni.valueOf();
            var diffInHours = convertMS(diff);
            $("#eet_total").val(diffInHours.hour + ":" + diffInHours.minute);

        } else {
            $("#hr_calculada").val("");
        }
    }

    //código referencia
    //https://gist.github.com/Erichain/6d2c2bf16fe01edfcffa
    function convertMS( milliseconds ) {
        var day, hour, minute, seconds;
        seconds = Math.floor(milliseconds / 1000);
        minute = Math.floor(seconds / 60);
        seconds = seconds % 60;
        hour = Math.floor(minute / 60);
        minute = minute % 60;
        day = Math.floor(hour / 24);
        hour = hour % 24;
        return {
            day: day,
            hour: hour,
            minute: minute,
            seconds: seconds
        };
    }

    /*function calculaHoraChegada(value) {
        var eetTotal = value;
        var hrPartida = $("#hora_partida").val();

        if (hrPartida != "") {
            var d = new Date();

            eetTotal = eetTotal.split(':');
            var eetHour = parseInt(eetTotal[0]) * 60;
            var eetMin = eetTotal[1] ? (parseInt(eetTotal[1]) + eetHour) : eetHour;

            hrPartida = hrPartida.split(':');
            var partidaHour = leftPad(hrPartida[0], 2);
            var partidaMin = leftPad(hrPartida[1], 2);

            var dtIni = new Date(d.getFullYear() , d.getMonth()  , d.getDate(), partidaHour,partidaMin);
            var dtFim = new Date(dtIni.getTime() + (eetMin * 60000));
            
            //console.log( dtFim.getFullYear() + "" +  leftPad(dtFim.getMonth() + 1, 2) + "" + leftPad(dtFim.getDate(), 2)+ "" + dtFim.getHours());
            $("#hr_calculada").val(dtFim.getFullYear() + "" +  leftPad(dtFim.getMonth() + 1, 2) + "" + leftPad(dtFim.getDate(), 2)+ "" + dtFim.getHours());
        } else {
            $("#hr_calculada").val("");
        }
   }*/
});

function leftPad(value, length) { 
    return ('0'.repeat(length) + value).slice(-length); 
}


$( "form" ).submit(function(e) {

    //as listas notamSelecionadas e cartasSelecionadas, são criadas pelos componentes
    if (notamSelecionadas.length > 0) {
        $("#notam_selecionadas").val(JSON.stringify(notamSelecionadas));
    }

    if (cartasSelecionadas.length > 0) {
        $("#cartas_selecionadas").val(JSON.stringify(cartasSelecionadas));
    }
        
    return;
});

</script>