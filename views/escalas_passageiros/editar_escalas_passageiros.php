<?php 
opanel('Editar');
    form_open('escalas_passageiros/editar_escalas_passageiros?id=' .get('id'));form_text_input('Passageiro:', 'passageiro', '','','', $escalas_passageiros->passageiro);
form_text_input('Escala:', 'escala', '','','', $escalas_passageiros->escala);
form_text_input('Data_chegada:', 'data_chegada', '','','', $escalas_passageiros->data_chegada);
form_text_input('Hora_chegada:', 'hora_chegada', '','','', $escalas_passageiros->hora_chegada);
form_text_input('Data_partida:', 'data_partida', '','','', $escalas_passageiros->data_partida);
form_text_input('Hora_partida:', 'hora_partida', '','','', $escalas_passageiros->hora_partida);
form_text_input('Troca:', 'troca', '','','', $escalas_passageiros->troca);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();