<?php 
opanel('Editar');
    form_open('voos_passageiros/editar_voos_passageiros?id=' .get('id'));
    p('Comercial:');
    row();
        col(4);
            form_select2_blank('Cliente', 'id_cliente', $clientes,'nome_fantasia', $voos_passageiros->id_cliente);
        cdiv();
        col(4);
            form_select2_blank('Vendedor:', 'id_vendedor', $vendedores, 'nome', $voos_passageiros->id_vendedor);
        cdiv();
        col(4);
            form_select2_blank('Agência:', 'id_agencia', $agencias,'nome_fantasia', $voos_passageiros->id_agencia);
        cdiv();
    cdiv();
    row();
        col(3);
            form_select2('Forma de pagamento:', 'tipo_pagamento', $formas_pagamentos, 'nome', $voos_passageiros->tipo_pagamento);
        cdiv();
        col(3);
            form_select2('Moeda:', 'moeda_pagamento', $moedas, 'nome', $voos_passageiros->moeda_pagamento);
        cdiv();
        col(3);
            $status = [
                ['nome' => 'Aberto', 'value' => 'Aberto'],
                ['nome' => 'Pago', 'value' => 'Pago'],
            ];
            form_select2_data('Status', 'status_pagamento', $status, $voos_passageiros->status_pagamento);
        cdiv();
        col(3);
            form_text_input('Valor:', 'preco', '','','', moeda_real($voos_passageiros->preco));
        cdiv();
    cdiv();
    

    
    hr();

    p('Passageiro:');
    
    $documentos = [
        ['nome' => 'RG', 'value' => 'RG'],
        ['nome' => 'CPF', 'value' => 'CPF'],
        ['nome' => 'Passaport', 'value' => 'Passaport'],
    ];

    row();
        col(4);
            form_text_input('Nome', 'nome_passageiro', 'required','','', $voos_passageiros->nome_passageiro);
        cdiv();
        col(4);
            form_text_input('Sobrenome', 'sobrenome_passageiro', 'required','','', $voos_passageiros->sobrenome_passageiro);
        cdiv();
        col(4);
            form_text_input('Telefone:', 'telefone_passageiro', '','','', $voos_passageiros->telefone_passageiro);
        cdiv();
    cdiv();
    row();
        col(4);
            form_text_input('E-mail', 'email_passageiro', 'email','','', $voos_passageiros->email_passageiro);
        cdiv();
        col(4);
            form_select2_data('Documento', 'tipo_documento_passageiro', $documentos, $voos_passageiros->tipo_documento_passageiro);
        cdiv();
        col(4);
            form_text_input('Número:', 'documento_passageiro', '','','', $voos_passageiros->documento_passageiro);
        cdiv();
    cdiv();
    row();
        col(6);
            form_select2_data_blank('Documento Apresentado:', 'tipo_documento_apresentado', $documentos, $voos_passageiros->tipo_documento_apresentado);
        cdiv();
        col(6);
            form_text_input('Número Documento Apresentado:', 'documento_apresentado', '','','', $voos_passageiros->documento_apresentado);
        cdiv();
    cdiv();
    row();
        col(6);
            form_text_input('Contato de Emergência:', 'nome_contato_emergencia', '','','', $voos_passageiros->nome_contato_emergencia);
        cdiv();
        col(6);
            form_text_input('Número (Contato de Emergência):', 'numero_contato_emergencia', '','','', $voos_passageiros->numero_contato_emergencia);
        cdiv();
    cdiv();

submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();