<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Relatório de Prevenção - RELPREV');
    datatable('relprev', ['Voo id','Matrícula', 'Origem', 'Destino', 'Data da Ocorrencia', 'Regra de Voo', 'Fase do Voo', 'Data_resposta'], ['id', 'matricula', 'origem', 'destino', 'data_ocorrencia', 'regra_voo', 'fase_voo', 'data_resposta'], $relprev, ['editar' => 'relprev/editar_relprev?id', 'deletar' => 'relprev/deletar_relprev?id']);
    cpanel();
    
    omodal('Adicionar relprev', 'add', 'modal-lg');
    form_open('relprev/relprev');
    row();
        col(3);
            form_select2('Voo', 'voo_id', $voos, 'id');
        cdiv();
        col(3);
            form_text_input('Data da Ocorrência:', 'data_ocorrencia');
        cdiv();
        col(3);
            form_text_input('Frequência:', 'frequencia');
        cdiv();
        col(3);                
            form_text_input('Local da Ocorrência:', 'local');
        cdiv();
    cdiv();
    
    row();
        col(12); 
            form_textarea('Complemento:', 'complemento');
        cdiv();
    cdiv();
    
    row();
        col(4);    
            form_text_input('Latitude (graus decimais):', 'latitude');
        cdiv();
        col(4);    
            form_text_input('Longitude (graus decimais):', 'longitude');
        cdiv();
        col(4);
        $td = [
            ['nome' => 'A', 'value' => 'A'],
            ['nome' => 'B', 'value' => 'B'],
            ['nome' => 'C', 'value' => 'C'],
            ['nome' => 'D', 'value' => 'D'],
            ['nome' => 'E', 'value' => 'E'],
            ['nome' => 'F', 'value' => 'F'],
            ['nome' => 'G', 'value' => 'G'],
            ['nome' => 'Outro', 'value' => 'Outro'],
        ];
        form_select2_data('Classe do Espaço Aéreo:', 'espaco_aereo', $td);   
    cdiv();
    cdiv();
    row();
        col(4);
            $td = [
                ['nome' => 'I - IFR', 'value' => 'I - IFR'],
                ['nome' => 'V - VFR', 'value' => 'V - VFR'],
                ['nome' => 'Y - IFR/VFR', 'value' => 'Y - IFR/VFR'],
                ['nome' => 'Z - VFR/IFR', 'value' => 'Z - VFR/IFR'],
            ];
            form_select2_data('Regra de Voo:', 'regra_voo', $td);
        cdiv();    
        col(4);
            $td = [
                ['nome' => 'Arremetida', 'value' => 'Arremetida'],
                ['nome' => 'Circuito de Tráfego', 'value' => 'Circuito de Tráfego'],
                ['nome' => 'Cruzeiro', 'value' => 'Cruzeiro'],
                ['nome' => 'Decolagem', 'value' => 'Decolagem'],
                ['nome' => 'Descida', 'value' => 'Descida'],
                ['nome' => 'IAC', 'value' => 'IAC'],
                ['nome' => 'Outro', 'value' => 'Outro'],
                ['nome' => 'Pouso', 'value' => 'Pouso'],
                ['nome' => 'SID', 'value' => 'SID'],
                ['nome' => 'STAR', 'value' => 'STAR'],
                ['nome' => 'Subida', 'value' => 'Subida'],
                ['nome' => 'Táxi', 'value' => 'Táxi'],
            ];
            form_select2_data('Fase do Voo:', 'fase_voo', $td);
        cdiv();
        col(4);
            $td = [
                ['nome' => 'IMC', 'value' => 'IMC'],
                ['nome' => 'VMC', 'value' => 'VMC'],
                ['nome' => 'Não Determinado', 'value' => 'Não Determinado'],
            ];
            form_select2_data('Condições do Voo:', 'condicoes_voo', $td);    
        cdiv();
    cdiv();
    
    row();
        col(4);    
            form_text_input('Distância horizontal (nm):', 'distancia_horizontal');
        cdiv();
        col(4);
            form_text_input('Distância vertical (ft):', 'distancia_vertical');
        cdiv();
        col(4);    
            $td = [
                ['nome' => 'Não houve', 'value' => 'Não houve'],
                ['nome' => 'RA', 'value' => 'RA'],
                ['nome' => 'TA', 'value' => 'TA'],
            ];
            form_select2_data('ACAS:', 'acas', $td);
        cdiv();
      
    cdiv();
    
    row();
        col(12);    
            form_textarea('Descrição:', 'descricao');
        cdiv();
    cdiv();
    
    row();
        col(6);
            form_text_input('Relator (Nome completo):', 'nome');
        cdiv();
        col(6);
            form_text_input('E-mail:', 'email');
        cdiv();
    cdiv();
    
    row();
        col(12);    
            $classificacao = [
                ['nome'=>'1A - Desprezível/Frequente', 'value'=>'1A - Desprezível/Frequente'],
                ['nome'=>'2A - Baixo/Frequente', 'value'=>'2A - Baixo/Frequente'],
                ['nome'=>'3A - Alto/Frequente', 'value'=>'3A - Alto/Frequente'],
                ['nome'=>'4A - Perigoso/Frequente', 'value'=>'4A - Perigoso/Frequente'],
                ['nome'=>'5A - Catastrófico/Frequente', 'value'=>'5A - Catastrófico/Frequente'],
                ['nome'=>'1B - Desprezível/Ocasional', 'value'=>'1B - Desprezível/Ocasional'],
                ['nome'=>'2B - Baixo/Ocasional', 'value'=>'2B - Baixo/Ocasional'],
                ['nome'=>'3B - Alto/Ocasional', 'value'=>'3B - Alto/Ocasional'],
                ['nome'=>'4B - Perigoso/Ocasional', 'value'=>'4B - Perigoso/Ocasional'],
                ['nome'=>'5B - Catastrófico/Ocasional', 'value'=>'5B - Catastrófico/Ocasional'],
                ['nome'=>'1C - Desprezível/Remota', 'value'=>'1C - Desprezível/Remota'],
                ['nome'=>'2C - Baixo/Remota', 'value'=>'2C - Baixo/Remota'],
                ['nome'=>'3C - Alto/Remota', 'value'=>'3C - Alto/Remota'],
                ['nome'=>'4C - Perigoso/Remota', 'value'=>'4C - Perigoso/Remota'],
                ['nome'=>'5C - Catastrófico/Remota', 'value'=>'5C - Catastrófico/Remota'],
                ['nome'=>'1D - Desprezível/Improvável', 'value'=>'1D - Desprezível/Improvável'],
                ['nome'=>'2D - Baixo/Improvável', 'value'=>'2D - Baixo/Improvável'],
                ['nome'=>'3D - Alto/Improvável', 'value'=>'3D - Alto/Improvável'],
                ['nome'=>'4D - Perigoso/Improvável', 'value'=>'4D - Perigoso/Improvável'],
                ['nome'=>'5D - Catastrófico/Improvável', 'value'=>'5D - Catastrófico/Improvável'],
            ];
            form_select2_data('Classificacao do risco:', 'classificacao_emergencia', $classificacao);
        cdiv();
    cdiv();
    
    row();
        col(12);    
            form_textarea('Resposta:', 'resposta');
        cdiv();
    cdiv();
    
    row();
        col(8);    
            form_text_input('Designado da resposta à prevenção:', 'usuario_resposta');
        cdiv();
        col(4);
            form_text_input('Data da Resposta:', 'data_resposta');
        cdiv();
            //a resposta é enviada para o e-mail do relator e dar a opção para que a mesma seja enviada para o e-mail de todos os funcionários
    cdiv();
    
    row();
        col(4);
        submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();

?>

<script>
$(document).ready(function(){
    $("#frequencia").mask("000.00");
    $("#latitude").mask('00.0000');
    $("#longitde").mask('000.0000');
    $('#data_ocorrencia').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#data_resposta').datepicker({
            autoclose: true,
            todayHighlight: true
        });
});
</script>