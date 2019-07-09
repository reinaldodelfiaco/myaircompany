<?php 
opanel('Editar');
    form_open('clientes/editar_clientes?id=' .get('id'));form_text_input('Nome:', 'nome', '','','', $clientes->nome);
form_text_input('Sobrenome:', 'sobrenome', '','','', $clientes->sobrenome);
form_text_input('Numero_documento:', 'numero_documento', '','','', $clientes->numero_documento);
form_text_input('Tipo_documento:', 'tipo_documento', '','','', $clientes->tipo_documento);
form_text_input('Data_nascimento:', 'data_nascimento', '','','', $clientes->data_nascimento);
form_text_input('Telefone:', 'telefone', '','','', $clientes->telefone);
form_text_input('Email:', 'email', '','','', $clientes->email);
form_text_input('Endereco:', 'endereco', '','','', $clientes->endereco);
form_text_input('Bairro:', 'bairro', '','','', $clientes->bairro);
form_text_input('Cep:', 'cep', '','','', $clientes->cep);
form_text_input('Cidade:', 'cidade', '','','', $clientes->cidade);
form_text_input('Pais:', 'pais', '','','', $clientes->pais);
form_text_input('Status:', 'status', '','','', $clientes->status);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();