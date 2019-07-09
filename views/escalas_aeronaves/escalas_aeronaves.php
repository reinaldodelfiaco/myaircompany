<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Escalas_aeronaves');
    datatable('escalas_aeronaves', ['Aeronave', 'Escala', 'Data_chegada', 'Hora_chegada', 'Hora_partida', 'Data_partida', 'Troca', ], ['aeronave', 'escala', 'data_chegada', 'hora_chegada', 'hora_partida', 'data_partida', 'troca', ], $escalas_aeronaves, ['editar' => 'escalas_aeronaves/editar_escalas_aeronaves?id', 'deletar' => 'escalas_aeronaves/deletar_escalas_aeronaves?id']);
    cpanel();
    
    omodal('Adicionar escalas_aeronaves', 'add');
    form_open('escalas_aeronaves/escalas_aeronaves');form_text_input('Aeronave:', 'aeronave', '');
form_text_input('Escala:', 'escala', '');
form_text_input('Data_chegada:', 'data_chegada', '');
form_text_input('Hora_chegada:', 'hora_chegada', '');
form_text_input('Hora_partida:', 'hora_partida', '');
form_text_input('Data_partida:', 'data_partida', '');
form_text_input('Troca:', 'troca', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();