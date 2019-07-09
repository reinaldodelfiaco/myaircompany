<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Ocorrencias');
    datatable('ocorrencias', ['Nome', 'Data_ocorrencia', 'Tipo', 'Funcionario', 'Email', 'Descricao', 'Sugestao', 'Resposta', 'Resposta', 'Atendente', 'Data_resposta', ], ['nome', 'data_ocorrencia', 'tipo', 'funcionario', 'email', 'descricao', 'sugestao', 'resposta', 'resposta', 'atendente', 'data_resposta', ], $ocorrencias, ['editar' => 'ocoreencias/editar_ocorrencias?id', 'deletar' => 'ocoreencias/deletar_ocorrencias?id']);
    cpanel();
    
    omodal('Adicionar ocorrencias', 'add');
    form_open('ocoreencias/ocorrencias');form_text_input('Nome:', 'nome', '');
form_text_input('Data_ocorrencia:', 'data_ocorrencia', '');
form_text_input('Tipo:', 'tipo', '');
form_text_input('Funcionario:', 'funcionario', '');
form_text_input('Email:', 'email', '');
form_text_input('Descricao:', 'descricao', '');
form_text_input('Sugestao:', 'sugestao', '');
form_text_input('Resposta:', 'resposta', '');
form_text_input('Resposta:', 'resposta', '');
form_text_input('Atendente:', 'atendente', '');
form_text_input('Data_resposta:', 'data_resposta', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();