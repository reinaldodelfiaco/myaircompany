<?php 
opanel('Editar');
    form_open('escalas_aeronaves/editar_escalas_aeronaves?id=' .get('id'));form_text_input('Aeronave:', 'aeronave', '','','', $escalas_aeronaves->aeronave);
form_text_input('Escala:', 'escala', '','','', $escalas_aeronaves->escala);
form_text_input('Data_chegada:', 'data_chegada', '','','', $escalas_aeronaves->data_chegada);
form_text_input('Hora_chegada:', 'hora_chegada', '','','', $escalas_aeronaves->hora_chegada);
form_text_input('Hora_partida:', 'hora_partida', '','','', $escalas_aeronaves->hora_partida);
form_text_input('Data_partida:', 'data_partida', '','','', $escalas_aeronaves->data_partida);
form_text_input('Troca:', 'troca', '','','', $escalas_aeronaves->troca);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();