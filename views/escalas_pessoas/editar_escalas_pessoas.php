<?php 
opanel('Editar');
    form_open('escalas_pessoas/editar_escalas_pessoas?id=' .get('id'));form_text_input('Data_incial:', 'data_incial', '','','', $escalas_pessoas->data_incial);
form_text_input('Data_final:', 'data_final', '','','', $escalas_pessoas->data_final);
form_text_input('Hora_inicial:', 'hora_inicial', '','','', $escalas_pessoas->hora_inicial);
form_text_input('Hora_final:', 'hora_final', '','','', $escalas_pessoas->hora_final);
form_text_input('Base:', 'base', '','','', $escalas_pessoas->base);
form_text_input('Funcionario:', 'funcionario', '','','', $escalas_pessoas->funcionario);
form_text_input('Status:', 'status', '','','', $escalas_pessoas->status);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();