<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Escalas_passageiros');
    datatable('escalas_passageiros', ['Passageiro', 'Escala', 'Data_chegada', 'Hora_chegada', 'Data_partida', 'Hora_partida', 'Troca', ], ['passageiro', 'escala', 'data_chegada', 'hora_chegada', 'data_partida', 'hora_partida', 'troca', ], $escalas_passageiros, ['editar' => 'escalas_passageiros/editar_escalas_passageiros?id', 'deletar' => 'escalas_passageiros/deletar_escalas_passageiros?id']);
    cpanel();
    
    omodal('Adicionar escalas_passageiros', 'add');
    form_open('escalas_passageiros/escalas_passageiros');form_text_input('Passageiro:', 'passageiro', '');
form_text_input('Escala:', 'escala', '');
form_text_input('Data_chegada:', 'data_chegada', '');
form_text_input('Hora_chegada:', 'hora_chegada', '');
form_text_input('Data_partida:', 'data_partida', '');
form_text_input('Hora_partida:', 'hora_partida', '');
form_text_input('Troca:', 'troca', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();