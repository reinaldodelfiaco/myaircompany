<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Modelos');
    datatable('modelos_aeronaves', ['Nome', 'Descrição', ], ['nome', 'descricao', ], $modelos_aeronaves, [ 'draw' => 'modelos_aeronaves/draw?id', 'editar' => 'modelos_aeronaves/editar_modelos_aeronaves?id', 'deletar' => 'modelos_aeronaves/deletar_modelos_aeronaves?id']);
    cpanel();
    
    omodal('Adicionar modelo', 'add');
    form_open('modelos_aeronaves/modelos_aeronaves');
        form_text_input('Nome:', 'nome', 'required');
        form_textarea('Descrição:', 'descricao', '');
        submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();