<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Chefias');
    datatable('chefias', ['Nome', 'Telefone', 'Email', 'Status'], ['nome', 'telefone', 'email', 'status'], $chefias, ['editar' => 'chefias/editar_chefias?id', 'deletar' => 'chefias/deletar_chefias?id']);
    cpanel();
    
    omodal('Novo cadastro', 'add', 'modal-lg');
    
    form_open('chefias/funcionarios');
    hidden('empresa', session('empresa'));
    row();
        col(8);
            form_text_input('Nome:', 'nome', 'required');
        cdiv();
        col(4);
            form_text_input('Nascimento:', 'data_nascimento', '');
        cdiv();
    cdiv();
    
    form_text_input('Tipo_documento:', 'tipo_documento', '');
    form_text_input('Numero_documento:', 'numero_documento', '');
    form_text_input('Telefone:', 'telefone', '');
    form_text_input('Email:', 'email', '');
    form_text_input('Senha:', 'senha', '');
    form_text_input('Endereco:', 'endereco', '');
    form_text_input('Cidade:', 'cidade', '');
    form_text_input('Estado:', 'estado', '');
    form_text_input('Pais:', 'pais', '');
    form_text_input('Canac:', 'canac', '');
    form_text_input('Salario:', 'salario', '');
    form_text_input('Cma:', 'cma', '');
    form_text_input('Cma_validade:', 'cma_validade', '');
    form_text_input('Icao:', 'icao', '');
    form_text_input('Cargo:', 'cargo', '');
    form_text_input('Empresa_terceira:', 'empresa_terceira', '');
    form_text_input('Regra:', 'regra', '');
    form_text_input('Status:', 'status', '');
    form_text_input('Cnh:', 'cnh', '');
    form_text_input('Classe_cnh:', 'classe_cnh', '');
    form_text_input('Pc:', 'pc', '');
    form_text_input('Pla:', 'pla', '');
    form_text_input('Mono_string:', 'mono_string', '');
    form_text_input('Multi:', 'multi', '');
    form_text_input('Ifr:', 'ifr', '');
    form_text_input('Inva:', 'inva', '');
    form_text_input('Validade_mono:', 'validade_mono', '');
    form_text_input('Validade_multi:', 'validade_multi', '');
    form_text_input('Validade_ifr:', 'validade_ifr', '');
    form_text_input('Validade_inva:', 'validade_inva', '');
    form_text_input('Validade_cnh:', 'validade_cnh', '');
    submit('Salvar', 'btn btn-success');

    form_close();
    cmodal();