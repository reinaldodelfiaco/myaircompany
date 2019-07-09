<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Clientes');
    datatable('clientes', ['Nome', 'Sobrenome', 'Numero_documento', 'Tipo_documento', 'Data_nascimento', 'Telefone', 'Email', 'Endereco', 'Bairro', 'Cep', 'Cidade', 'Pais', 'Status', ], ['nome', 'sobrenome', 'numero_documento', 'tipo_documento', 'data_nascimento', 'telefone', 'email', 'endereco', 'bairro', 'cep', 'cidade', 'pais', 'status', ], $clientes, ['editar' => 'clientes/editar_clientes?id', 'deletar' => 'clientes/deletar_clientes?id']);
    cpanel();
    
    omodal('Adicionar clientes', 'add');
    form_open('clientes/clientes');form_text_input('Nome:', 'nome', '');
form_text_input('Sobrenome:', 'sobrenome', '');
form_text_input('Numero_documento:', 'numero_documento', '');
form_text_input('Tipo_documento:', 'tipo_documento', '');
form_text_input('Data_nascimento:', 'data_nascimento', '');
form_text_input('Telefone:', 'telefone', '');
form_text_input('Email:', 'email', '');
form_text_input('Endereco:', 'endereco', '');
form_text_input('Bairro:', 'bairro', '');
form_text_input('Cep:', 'cep', '');
form_text_input('Cidade:', 'cidade', '');
form_text_input('Pais:', 'pais', '');
form_text_input('Status:', 'status', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();