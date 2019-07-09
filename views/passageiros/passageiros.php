<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Passageiros');
    datatable('passageiros', ['Voo', 'Origem', 'Destino', 'Cliente', 'Nome', 'Sobrenome', 'Tipo_documento', 'Telefone', 'Email', 'Contato_emergencia', 'Numero_contato_emergencia', 'Vendedor', 'Agencia', ], ['voo', 'origem', 'destino', 'cliente', 'nome', 'sobrenome', 'tipo_documento', 'telefone', 'email', 'contato_emergencia', 'numero_contato_emergencia', 'vendedor', 'agencia', ], $passageiros, ['editar' => 'passageiros/editar_passageiros?id', 'deletar' => 'passageiros/deletar_passageiros?id']);
    cpanel();
    
    omodal('Adicionar passageiros', 'add');
    form_open('passageiros/passageiros');form_text_input('Voo:', 'voo', '');
form_text_input('Origem:', 'origem', '');
form_text_input('Destino:', 'destino', '');
form_text_input('Cliente:', 'cliente', '');
form_text_input('Nome:', 'nome', '');
form_text_input('Sobrenome:', 'sobrenome', '');
form_text_input('Tipo_documento:', 'tipo_documento', '');
form_text_input('Telefone:', 'telefone', '');
form_text_input('Email:', 'email', '');
form_text_input('Contato_emergencia:', 'contato_emergencia', '');
form_text_input('Numero_contato_emergencia:', 'numero_contato_emergencia', '');
form_text_input('Vendedor:', 'vendedor', '');
form_text_input('Agencia:', 'agencia', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();