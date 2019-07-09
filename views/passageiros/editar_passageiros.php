<?php 
opanel('Editar');
    form_open('passageiros/editar_passageiros?id=' .get('id'));form_text_input('Voo:', 'voo', '','','', $passageiros->voo);
form_text_input('Origem:', 'origem', '','','', $passageiros->origem);
form_text_input('Destino:', 'destino', '','','', $passageiros->destino);
form_text_input('Cliente:', 'cliente', '','','', $passageiros->cliente);
form_text_input('Nome:', 'nome', '','','', $passageiros->nome);
form_text_input('Sobrenome:', 'sobrenome', '','','', $passageiros->sobrenome);
form_text_input('Tipo_documento:', 'tipo_documento', '','','', $passageiros->tipo_documento);
form_text_input('Telefone:', 'telefone', '','','', $passageiros->telefone);
form_text_input('Email:', 'email', '','','', $passageiros->email);
form_text_input('Contato_emergencia:', 'contato_emergencia', '','','', $passageiros->contato_emergencia);
form_text_input('Numero_contato_emergencia:', 'numero_contato_emergencia', '','','', $passageiros->numero_contato_emergencia);
form_text_input('Vendedor:', 'vendedor', '','','', $passageiros->vendedor);
form_text_input('Agencia:', 'agencia', '','','', $passageiros->agencia);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();