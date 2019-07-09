<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Escalas_pessoas');
    datatable('escalas_pessoas', ['Data_incial', 'Data_final', 'Hora_inicial', 'Hora_final', 'Base', 'Funcionario', 'Status', ], ['data_incial', 'data_final', 'hora_inicial', 'hora_final', 'base', 'funcionario', 'status', ], $escalas_pessoas, ['editar' => 'escalas_pessoas/editar_escalas_pessoas?id', 'deletar' => 'escalas_pessoas/deletar_escalas_pessoas?id']);
    cpanel();
    
    omodal('Adicionar escalas_pessoas', 'add');
    form_open('escalas_pessoas/escalas_pessoas');form_text_input('Data_incial:', 'data_incial', '');
form_text_input('Data_final:', 'data_final', '');
form_text_input('Hora_inicial:', 'hora_inicial', '');
form_text_input('Hora_final:', 'hora_final', '');
form_text_input('Base:', 'base', '');
form_text_input('Funcionario:', 'funcionario', '');
form_text_input('Status:', 'status', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();