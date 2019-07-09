<?php

    if(!get('id')) {
        opanel('INFORME O CÓDIGO DO CHECKIN');
            form_open('pdv/checkin', 'get');
                form_text_input('CÓDIGO', 'id', 'required');
                submit('BUSCAR', 'btn btn-success btn-block');
            form_close();
        cpanel();
    } 
    
    else {
        opanel('Editar');
        form_open('pdv/checkin?id=' .get('id'));
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
    }