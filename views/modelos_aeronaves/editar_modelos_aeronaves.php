<?php 
opanel('Editar');
    form_open('modelos_aeronaves/editar_modelos_aeronaves?id=' .get('id'));
        form_text_input('Nome:', 'nome', 'required','','', $modelos_aeronaves->nome);
        form_textarea('Descrição:', 'descricao', '','','', $modelos_aeronaves->descricao);
        submit('Salvar', 'btn btn-success'); 
    form_close();
cpanel();