<?php 

    modal_link('+ Adicionar', 'add');
    br();

    row();
    col(3);
        // Total geral
        dashboard_count('LUGARES PREENCHIDOS', $tca, 'fa fa-money','#');
    
    cdiv();
    col(3);
        // Total em pago
        dashboard_count('LUGARES DISPONÍVEIS', $voo->lugares - $tca, 'fa fa-money','#');
    cdiv();
cdiv();


    ptable('Passsageiros');
    datatable('voos_passageiros', ['Cliente', 'Nome', 'Sobrenome', 'Documento', 'Número',  'Valor', 'Status', ], 
                                  ['id_cliente','nome_passageiro', 'sobrenome_passageiro', 'tipo_documento_passageiro', 'documento_passageiro', 'preco','status_pagamento',  ], $voos_passageiros, ['editar' => 'voos_passageiros/editar_voos_passageiros?id', 'deletar' => 'voos_passageiros/deletar_voos_passageiros?id']);
    cpanel();
    
    omodal('Cadastrar passageiros', 'add', 'modal-lg');
    form_open('voos_passageiros/voos_passageiros');

    hidden('id_voo', get('id'));

    p('Comercial:');
    row();
        col(4);
            form_select2_blank('Cliente', 'id_cliente', $clientes,'nome_fantasia');
        cdiv();
        col(4);
            form_select2_blank('Vendedor:', 'id_vendedor', $vendedores, 'nome');
        cdiv();
        col(4);
            form_select2_blank('Agência:', 'id_agencia', $agencias,'nome_fantasia');
        cdiv();
    cdiv();
    row();
        col(3);
            form_select2('Forma de pagamento:', 'tipo_pagamento', $formas_pagamentos, 'nome');
        cdiv();
        col(3);
            form_select2('Moeda:', 'moeda_pagamento', $moedas, 'nome');
        cdiv();
        col(3);
            $status = [
                ['nome' => 'Aberto', 'value' => 'Aberto'],
                ['nome' => 'Pago', 'value' => 'Pago'],
            ];
            form_select2_data('Status', 'status_pagamento', $status);
        cdiv();
        col(3);
            form_text_input('Valor:', 'preco', '');
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
            form_text_input('Nome', 'nome_passageiro', 'required');
        cdiv();
        col(4);
            form_text_input('Sobrenome', 'sobrenome_passageiro', 'required');
        cdiv();
        col(4);
            form_text_input('Telefone:', 'telefone_passageiro', '');
        cdiv();
    cdiv();
    row();
        col(4);
            form_text_input('E-mail', 'email_passageiro', 'email');
        cdiv();
        col(4);
            form_select2_data('Documento', 'tipo_documento_passageiro', $documentos);
        cdiv();
        col(4);
            form_text_input('Número:', 'documento_passageiro', '');
        cdiv();
    cdiv();
    row();
        col(6);
            form_select2_data_blank('Documento Apresentado:', 'tipo_documento_apresentado', $documentos);
        cdiv();
        col(6);
            form_text_input('Número Documento Apresentado:', 'documento_apresentado', '');
        cdiv();
    cdiv();
    row();
        col(6);
            form_text_input('Contato de Emergência:', 'nome_contato_emergencia', '');
        cdiv();
        col(6);
            form_text_input('Número (Contato de Emergência):', 'numero_contato_emergencia', '');
        cdiv();
    cdiv();

    
    


    


    
    


    submit('Salvar', 'btn btn-success');

    form_close();
    cmodal();

?>


<script>
    $(document).ready(function(){
        $('#preco').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
</script>

