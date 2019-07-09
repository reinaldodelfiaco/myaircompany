<?php 
opanel('Editar');
    form_open('rire/editar_rire?id=' .get('id'));form_text_input('Id:', 'id', '','','', $rire->id);

    row();
        col(4);
            form_select2('Matrícula:', 'matricula', $aeronaves, 'matricula', 'required', $rire->matricula);
        cdiv();
        col(4);
            //puxar o tipo ICAO da aeronave
            //form_text('Tipo:', 'tipo_icao', $aeronaves, 'tipo_icao', $rire->nome_emergencia_informante);
        cdiv();
    cdiv();

    row();
        col(8);
            form_text_input('Quem informou à emergência?', 'nome_emergencia_informante', 'required', $rire->nome_emergencia_informante);
        cdiv();
        col(4);
            form_text_input('Contato', 'numero_informante', 'required', $rire->numero_informante);
        cdiv();
    cdiv();

    row();
        col(3);
            form_text_input('Dia da ocorrência', 'data_emergencia_comunicada', 'required', $rire->data_emergencia_comunicada);
        cdiv();
        col(8);
            form_text_input('Hora que à emergência foi comunicada', 'hora_emergencia_comunicada', 'required', $rire->hora_emergencia_comunicada);
        cdiv();
    cdiv();
    
    row();
        col(12);
            form_textarea('Tipo da Situação Informada', 'tipo_situacao_informada', 'required', $rire->tipo_situacao_informada);
        cdiv();
    cdiv();

    row();
        col(12);
            form_textarea('Em que condições o PRE foi ativado?', 'condicoes_ativacao_pre', 'required', $rire->condicoes_ativacao_pre);
        cdiv();
    cdiv();

    row();
        col(12);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                    ['nome' => 'Não', 'value' => 'Não'],
                ];
                form_select2_data('Existia exemplar do PRE à disposição de todos os envolvidos?', 'pre_disponivel_envolvidos', $td, 'required', $rire->pre_disponivel_envolvidos);
        cdiv();
    cdiv();

    row();
        col(12);
        $td = [
            ['nome' => 'Sim', 'value' => 'Sim'],
            ['nome' => 'Não', 'value' => 'Não'],
            ];
            form_select2_data('O exemploar do PRE à disposição estava atualizado?', 'pre_disponivel_atualizado', $td, 'required', $rire->pre_disponivel_atualizado);
    cdiv();

    row();
        col(12);
            form_textarea('Como foi acionado o Gestor de Segurança Operacional?', 'acionado_gestor_sgso', 'required', $rire->acionado_gestor_sgso);
        cdiv();
    cdiv();

    row();
        col(12);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                ['nome' => 'Não', 'value' => 'Não'],
                ];
                    form_select2_data('As informações e os meios disponíveis atenderam às necessidades?', 'infos_atenderam_necessidade', $td, 'required', $rire->infos_atenderam_necessidade);
        cdiv();
    cdiv();

    //aparecer se a resposta anterior for não
    row();
        col(12);
            form_textarea('Em caso negativo, comentar deficiência indentificadas', 'infos_negativo_atenderam_necessidade', $rire->infos_negativo_atenderam_necessidade);
        cdiv();
    cdiv();
    
    row();
        col(12);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                ['nome' => 'Não', 'value' => 'Não'],
                ];
                        form_select2_data('Houve acionamento dos órgãos externos componentes do PRE?', 'acionamento_orgaos_externos', $td, 'required', $rire->acionamento_orgaos_externos);
        cdiv();
    cdiv();

    //aparecer se a aresposta anterior for não
    row();
        col(12);
            form_select2_multiple('Órgãos externos envolvidos', 'quais_orgaos', $contatos_emergencias, 'instituicao', 'required', $rire->quais_orgaos);
        cdiv();
    cdiv();

    row();
        col(12);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                ['nome' => 'Não', 'value' => 'Não'],                
                ];        
                form_select2_data('Houve derramamento de combustível, ou óleo, na pista, ou local da ocorrência?', 'houve_vazamento_fuel', $td, 'required', $rire->houve_vazamento_fuel);                        
        cdiv();
    cdiv();

    row();
        col(5);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                ['nome' => 'Não', 'value' => 'Não'],
                ];
                form_select2_data('A pista foi interditada?', 'pista_interditada', $td, 'required', $rire->pista_interditada);
        cdiv();
        col(7);
            form_text_input('Por quanto tempo a pista foi interditada?', 'tempo_pista_interditada', $rire->tempo_pista_interditada);
        cdiv();
    cdiv();

    row();
        col(4);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                ['nome' => 'Não', 'value' => 'Não'],
                ];        
                form_select2_data('Houve a paralisação das operações?', 'paralisacao_operacoes', $td, 'required', $rire->paralisacao_operacoes);
        cdiv();
        col(8);
                form_text_input('Em quanto tempo as operações voltaram à normalidade?', 'tempo_resiliencia', $rire->tempo_resiliencia);
        cdiv();
    cdiv();
    
    row();
        col(12);
            $td = [
                ['nome' => 'Sim', 'value' => 'Sim'],
                ['nome' => 'Não', 'value' => 'Não'],
                ];
                form_select2_data('Os recursos disponíveis no PRE foram adequados e suficientes para a desinterdição da pista?', 'recursos_pre_adequados', $td, $rire->recursos_pre_adequados);
        cdiv();
    cdiv();

    row();
        col(12);
            form_textarea('Quais foram as deficiências identificadas?', 'deficiencias_identificadas', $rire->deficiencias_identificadas);
        cdiv();
    cdiv();

    row();
        col(12);
            form_textarea('Como foi feita a evacuação dos tripulantes/passageiros?', 'como_evacuacao_feita', $rire->como_evacuacao_feita);
        cdiv();
    cdiv();

    row();
        col(12);
        $td = [
            ['nome' => 'Sim', 'value' => 'Sim'],
            ['nome' => 'Não', 'value' => 'Não'],
            ];
            form_select2_data('Houve a disponibilização de acomodações aos familiares e ao público em geral?', 'acomodacao_familiares', $td, 'required', $rire->acomodacao_familiares);
        cdiv();
    cdiv();

    row();
        col(12);
            form_textarea('Outros informações pertinentes', 'outros', $rire->outros);
        cdiv();
    cdiv();

    row();
        col(4);
        submit('Salvar', 'btn btn-success'); 
        form_close();
        cpanel();
    cdiv();
?>

<script>
$(document).ready(function(){
    $("#numero_informante").mask("00 00 0 0000-0000");
    $("#hora_emergencia_comunicada").mask("00:00");
    $("#tempo_pista_interditada").mask("00:00");
    $("#tempo_resiliencia").mask("00:00");
    $('#data_emergencia_comunicada').datepicker({
        autoclose: true,
        todayHighlight: true
        });
});
</script>