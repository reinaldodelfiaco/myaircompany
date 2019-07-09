<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Aeronaves');
    datatable('aeronaves', ['Mátricula', 'ICAO', 'Gerenciamento','Operador'], ['matricula', 'tipo_icao', 'tipo_gerenciamento', 'operador'], $aeronaves, ['editar' => 'aeronaves/editar_aeronaves?id', 'deletar' => 'aeronaves/deletar_aeronaves?id']);
    cpanel();
    
    omodal('Adicionar aeronaves', 'add', 'modal-lg');
    form_open('aeronaves/aeronaves');
?>

<ul id="myTab1" class="nav nav-tabs">
    <li class="active">
        <a  href="#rab" id="irab" data-toggle="tab">RAB</a>
    </li>
    <li class="">
        <a  href="#fan" id="ifan" data-toggle="tab">Informações Complementares</a>
    </li>

    <li class="">
        <a href="#man" id="iman" data-toggle="tab">Manutenção</a>
    </li>

    <li class="">
        <a  href="#param" id="iparam" data-toggle="tab">Parâmetros de Voo</a>
    </li>
</ul>
<div id="myTab1Content" class="tab-content">


<div class="tab-pane fade active in" id="rab">
<?php
    
    row();
        col(3);
            $gerencia = [
            ['nome' => 'Administração', 'value' => 'Administração'],
            ['nome' => 'Arrendamento', 'value' => 'Arrendamento'],
            ['nome' => 'Própria', 'value' => 'Própria'],
        ];
            form_select2_data('Tipo do Gerenciamento:', 'tipo_gerenciamento', $gerencia);
        cdiv();
        col(2);
            $categoria = [
            ['nome' => 'AAD', 'value' => 'ADD'],
            ['nome' => 'ADE', 'value' => 'ADE'],
            ['nome' => 'ADF', 'value' => 'ADF'],
            ['nome' => 'ADM', 'value' => 'ADM'],
            ['nome' => 'AID', 'value' => 'AID'],
            ['nome' => 'AIE', 'value' => 'AIE'],
            ['nome' => 'AIF', 'value' => 'AIF'],
            ['nome' => 'AIM', 'value' => 'AIM'],
            ['nome' => 'PET', 'value' => 'PET'],
            ['nome' => 'PEX', 'value' => 'PEX'],
            ['nome' => 'PIN', 'value' => 'PIN'],
            ['nome' => 'PRH', 'value' => 'PRH'],
            ['nome' => 'PRI', 'value' => 'PRI'],
            ['nome' => 'PUH', 'value' => 'PUH'],
            ['nome' => 'SAE', 'value' => 'SAE'],
            ['nome' => 'TPN', 'value' => 'TPN'],
            ['nome' => 'TPP', 'value' => 'TPP'],
            ['nome' => 'TPR', 'value' => 'TPR'],
            ['nome' => 'TPX', 'value' => 'TPX'],
            ];
            form_select2_data('Categoria:', 'categoria', $categoria);
        cdiv();
        col(3);
            form_text_input('Mátricula:', 'matricula', '');
        cdiv();
    cdiv();

    row();
        col(3);
            form_text_input('Número (Série):', 'numero_serie', '');
        cdiv();
        col(5);
            form_text_input('Fabricante:', 'fabricante', '');
        cdiv();
    cdiv();
    
    row();
        col(2);
            form_text_input('ICAO:', 'tipo_icao', '');
        cdiv();
        col(2);
            form_select2('Modelo:', 'modelo', $modelos,'nome');
        cdiv();
        col(2);
            form_text_input('Ano:', 'ano_fabricacao', '');
        cdiv();
        col(5);
            form_text_input('Cor / Marcas:', 'cor_marca', '');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Proprietário:', 'proprietario', '');
        cdiv();
        col(6);
            form_text_input('Outros Proprietários:', 'outros_proprietarios', '');
        cdiv();
    cdiv();
    
    row();
        col(12);
            form_text_input('Operador:', 'operador', '');
        cdiv();
    cdiv();

    row();
        col(3);
            form_int_input('Tripulação Mínima:', 'trip_min', '');
        cdiv();
        col(3);
            form_int_input('Passageiros Máximos:', 'passageiros_max', '');
        cdiv();
        col(3);
            form_int_input('Assentos totais:', 'assentos','');
        cdiv();
    cdiv();
cdiv();
    
?>
</div>

<div class="tab-pane fade active in" id="fan">
<?php
    
    row();
       col(4);
        $esteira = [
            ['nome' => 'Leve', 'value' => 'Leve'],
            ['nome' => 'Moderada', 'value' => 'Moderada'],
            ['nome' => 'Pesada', 'value' => 'Pesada'],
        ];
            form_select2_data('Esteira de turbulência:', 'cat_esteira_turbulencia', $esteira);
        cdiv();
        col(4);
        $equipamento = [
            ['nome' => 'A', 'value' => 'A'],
            ['nome' => 'B', 'value' => 'B'],
            ['nome' => 'C', 'value' => 'C'],
            ['nome' => 'D', 'value' => 'D'],
            ['nome' => 'E1', 'value' => 'E1'],
            ['nome' => 'E2', 'value' => 'E2'],
            ['nome' => 'E3', 'value' => 'E3'],
            ['nome' => 'F', 'value' => 'F'],
            ['nome' => 'G', 'value' => 'G'],
            ['nome' => 'H', 'value' => 'H'],
            ['nome' => 'I', 'value' => 'I'],
            ['nome' => 'J1', 'value' => 'J1'],
            ['nome' => 'J2', 'value' => 'J2'],
            ['nome' => 'J3', 'value' => 'J3'],
            ['nome' => 'J4', 'value' => 'J4'],
            ['nome' => 'J5', 'value' => 'J5'],
            ['nome' => 'J6', 'value' => 'J6'],
            ['nome' => 'J7', 'value' => 'J7'],
            ['nome' => 'K', 'value' => 'K'],
            ['nome' => 'L', 'value' => 'L'],
            ['nome' => 'M1', 'value' => 'M1'],
            ['nome' => 'M2', 'value' => 'M2'],
            ['nome' => 'M3', 'value' => 'M3'],
            ['nome' => 'O', 'value' => 'O'],
            ['nome' => 'P1', 'value' => 'P1'],
            ['nome' => 'P2', 'value' => 'P2'],
            ['nome' => 'P3', 'value' => 'P3'],
            ['nome' => 'P4-P9', 'value' => 'P4-P9'],
            ['nome' => 'R', 'value' => 'R'],
            ['nome' => 'T', 'value' => 'T'],
            ['nome' => 'U', 'value' => 'U'],
            ['nome' => 'V6', 'value' => 'V6'],
            ['nome' => 'W', 'value' => 'W'],
            ['nome' => 'X', 'value' => 'X'],
            ['nome' => 'Y', 'value' => 'Y'],
            ['nome' => 'Z', 'value' => 'Z'],
            ];
            form_select2_data_multiple('Equipamento e Capacidades (S/):', 'equipamento_capacidade', $equipamento);
        cdiv();
    cdiv();

    row();
        col(2);
            form_checkbox_sup('Rádio UHF','radio_uhf', '1');
        cdiv();
        col(2);
            form_checkbox_sup('Rádio VHF','radio_vhf', '1');
        cdiv();
        col(2);
            form_checkbox_sup('Rádio ELT','radio_elt', '1');
        cdiv();
    cdiv();

    row();
        col(3); 
            form_checkbox_sup('Equip. Sobrevivência Polar','survival_polar', '1');
        cdiv();
        col(3); 
            form_checkbox_sup('Equip. Sobrevivência Deserto','survival_desert', '1');
        cdiv();
        col(3); 
            form_checkbox_sup('Equip. Sobrevivência Marítimo','survival_maritime', '1');
        cdiv();
        col(3); 
            form_checkbox_sup('Equip. Sobrevivência Selva','survival_jungle', '1');
        cdiv();
    cdiv();

    row();
        col(4); 
            form_int_input('Botes Número:','botes_numero', '');
        cdiv();
        col(4); 
            form_int_input('Botes Capacidade:','botes_capacidade', '');
        cdiv();
        col(4); 
            form_text_input('Cor Abrigo:','abrigo_cor', '');
        cdiv();
    cdiv();
            
?>
</div>


<div class="tab-pane fade in" id="man">
<?php
    row();
        col(4);
            form_text_input('Extintor (validade):', 'extintor', '');
        cdiv();
        col(4);
            form_text_input('Seguro (validade):', 'seguro', '');
        cdiv();
        col(4);
            form_text_input('Aeronavegabilidade (C.A. validade):', 'certificado_aeronavegabilidade', '');
        cdiv();
    cdiv();

    row();
        col(4);
            form_text_input('Matrícula: (validade)', 'certificado_matricula', '');
        cdiv();   
        col(4);
            form_text_input('IAM (validade):', 'inspecao_anual_manutencao', '');
        cdiv();
        col(4);
            form_text_input('Rádio (validade):', 'estacao_radio', '');
        cdiv();
    cdiv();
    
    row();
        col(4);
            form_text_input('Horas iniciais:', 'horas_inicial', '');
        cdiv();
        col(4);
            form_text_input('Pousos iniciais:', 'n_pouso_inicial', '');
        cdiv();
        col(4);
            $status =[['value' => 'ativo', 'nome' => 'Ativo'],['value' => 'inativo', 'nome' => 'Inativo']];
            form_select2_data('Status:', 'status', $status);
        cdiv();
    cdiv();
    
    row();
        col(12);
            form_text_input('Extras:', 'extras', '');
        cdiv();        
    cdiv();
?>
</div>
    
<div class="tab-pane fade in" id="param">
<?php
    row();
        col(4);
            form_text_input('Crew (mínimo):', 'trip_min', '');
        cdiv();    
    cdiv();
    
    row();
        col(4);
            form_text_input('Braço do Peso Básico Vazio:', 'braco_peso_basico_vazio', '');
        cdiv();   
        col(4);
            form_text_input('Braço dos Assentos Dianteiros:', 'braco_ass_dianteiros', '');
        cdiv();
        col(4);
            form_text_input('Braço dos Assentos Centrais:', 'braco_ass_centrais', '');
        cdiv();
    cdiv();
    
    row();
        col(4);
            form_text_input('Braço dos Assentos Traseiros:', 'braco_ass_traseiros', '');
        cdiv();    
        col(4);
            form_text_input('Braços do Bagageiro Dianteiro:', 'braco_bagageiro_dianteiro', '');
        cdiv();
        col(4);
            form_text_input('Braços do Bagageiro Traseiro:', 'braco_bagageiro_traseiro', '');
        cdiv();
    cdiv();
    
    row();
        col(4);
            form_text_input('Braço do peso zero combustível:', 'braco_peso_zero_combustivel', '');
        cdiv();    
        col(4);
            form_text_input('Braço do peso máximo de decolagem:', 'braco_peso_decolagem', '');
        cdiv();
        col(4);
            form_text_input('Braço do combustível da etapa:', 'braco_comb_etapa', '');
        cdiv();
    cdiv();
    
    row();
        col(4);
            form_text_input('Braço do peso máximo de pouso:', 'braco_peso_pouso', '');
        cdiv();    
        col(4);
            form_text_input('Autonomia Máxima:', 'autonomia_max', '');
        cdiv();
    cdiv();
    ?>
    </div>
 </div>

    <?php
          
    submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();
?>

<script>
$(document).ready(function() {
    
    $('#extintor').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#seguro').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#certificado_aeronavegabilidade').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#certificado_matricula').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#inspecao_anual_manutencao').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#estacao_radio').datepicker({
        autoclose: true,
        todayHighlight: true
    });


});
</script>