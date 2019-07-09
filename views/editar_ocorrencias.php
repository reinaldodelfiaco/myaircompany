<?php 
opanel('Editar');
    form_open('/editar_ocorrencias?id=' .get('id'));form_text_input('Nome:', 'nome', '','','', $ocorrencias->nome);
form_text_input('Data_ocorrencia:', 'data_ocorrencia', '','','', $ocorrencias->data_ocorrencia);
form_text_input('Tipo:', 'tipo', '','','', $ocorrencias->tipo);
form_text_input('Funcionario:', 'funcionario', '','','', $ocorrencias->funcionario);
form_text_input('Email:', 'email', '','','', $ocorrencias->email);
form_text_input('Descricao:', 'descricao', '','','', $ocorrencias->descricao);
form_text_input('Sugestao:', 'sugestao', '','','', $ocorrencias->sugestao);
form_text_input('Resposta:', 'resposta', '','','', $ocorrencias->resposta);
form_text_input('Resposta:', 'resposta', '','','', $ocorrencias->resposta);
form_text_input('Atendente:', 'atendente', '','','', $ocorrencias->atendente);
form_text_input('Data_resposta:', 'data_resposta', '','','', $ocorrencias->data_resposta);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();