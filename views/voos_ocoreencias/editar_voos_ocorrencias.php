<?php 
opanel('Editar');
    form_open('voos_ocoreencias/editar_voos_ocorrencias?id=' .get('id'));form_text_input('Hora:', 'hora', '','','', $voos_ocorrencias->hora);
form_text_input('Data:', 'data', '','','', $voos_ocorrencias->data);
form_text_input('Local:', 'local', '','','', $voos_ocorrencias->local);
form_text_input('Classificacao:', 'classificacao', '','','', $voos_ocorrencias->classificacao);
form_text_input('Qualificacao:', 'qualificacao', '','','', $voos_ocorrencias->qualificacao);
form_text_input('Descricao_fatos:', 'descricao_fatos', '','','', $voos_ocorrencias->descricao_fatos);
form_text_input('Discrepancia_tecnica:', 'discrepancia_tecnica', '','','', $voos_ocorrencias->discrepancia_tecnica);
form_text_input('Acoes_corretivas:', 'acoes_corretivas', '','','', $voos_ocorrencias->acoes_corretivas);
form_text_input('Data_uim:', 'data_uim', '','','', $voos_ocorrencias->data_uim);
form_text_input('Data_pmp:', 'data_pmp', '','','', $voos_ocorrencias->data_pmp);
form_text_input('Tipo_uim:', 'tipo_uim', '','','', $voos_ocorrencias->tipo_uim);
form_text_input('Tipo_pmp:', 'tipo_pmp', '','','', $voos_ocorrencias->tipo_pmp);
form_text_input('Horas_pi:', 'horas_pi', '','','', $voos_ocorrencias->horas_pi);
form_text_input('Responsavel_aprovacao:', 'responsavel_aprovacao', '','','', $voos_ocorrencias->responsavel_aprovacao);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();