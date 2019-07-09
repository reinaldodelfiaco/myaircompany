<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Cargos');
    datatable('cargos', ['Id', 'Nome' ], ['id','nome' ], $cargos, ['editar' => 'cargos/editar_cargos?id', 'deletar' => 'cargos/deletar_cargos?id']);
    cpanel();
    
    omodal('Adicionar cargos', 'add');
    form_open('cargos/cargos');
    form_text_input('Nome:', 'nome', '');  

    submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();