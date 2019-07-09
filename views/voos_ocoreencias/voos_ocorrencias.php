<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Voos_ocorrencias');
    datatable('voos_ocorrencias', ['Hora', 'Data', 'Local', 'Classificacao', 'Qualificacao', 'Descricao_fatos', 'Discrepancia_tecnica', 'Acoes_corretivas', 'Data_uim', 'Data_pmp', 'Tipo_uim', 'Tipo_pmp', 'Horas_pi', 'Responsavel_aprovacao', ], ['hora', 'data', 'local', 'classificacao', 'qualificacao', 'descricao_fatos', 'discrepancia_tecnica', 'acoes_corretivas', 'data_uim', 'data_pmp', 'tipo_uim', 'tipo_pmp', 'horas_pi', 'responsavel_aprovacao', ], $voos_ocorrencias, ['editar' => 'voos_ocoreencias/editar_voos_ocorrencias?id', 'deletar' => 'voos_ocoreencias/deletar_voos_ocorrencias?id']);
    cpanel();
    
    omodal('Adicionar voos_ocorrencias', 'add');
    form_open('voos_ocoreencias/voos_ocorrencias');form_text_input('Hora:', 'hora', '');
form_text_input('Data:', 'data', '');
form_text_input('Local:', 'local', '');
form_text_input('Classificacao:', 'classificacao', '');
form_text_input('Qualificacao:', 'qualificacao', '');
form_text_input('Descricao_fatos:', 'descricao_fatos', '');
form_text_input('Discrepancia_tecnica:', 'discrepancia_tecnica', '');
form_text_input('Acoes_corretivas:', 'acoes_corretivas', '');
form_text_input('Data_uim:', 'data_uim', '');
form_text_input('Data_pmp:', 'data_pmp', '');
form_text_input('Tipo_uim:', 'tipo_uim', '');
form_text_input('Tipo_pmp:', 'tipo_pmp', '');
form_text_input('Horas_pi:', 'horas_pi', '');
form_text_input('Responsavel_aprovacao:', 'responsavel_aprovacao', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();