<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Veiculos');
    datatable('veiculos', ['Tipo', 'Fornecedor', 'Categorias_cobranca', 'Fabricante', 'Modelo', 'Cor_marcas', 'Numero_passageiros', 'Vencimento_ipva', 'Preco_referencia', 'Extras', ], ['tipo', 'fornecedor', 'categorias_cobranca', 'fabricante', 'modelo', 'cor_marcas', 'numero_passageiros', 'vencimento_ipva', 'preco_referencia', 'extras', ], $veiculos, ['editar' => 'veiculos/editar_veiculos?id', 'deletar' => 'veiculos/deletar_veiculos?id']);
    cpanel();
    
    omodal('Adicionar veiculos', 'add');
    form_open('veiculos/veiculos');form_text_input('Tipo:', 'tipo', '');
form_text_input('Fornecedor:', 'fornecedor', '');
form_text_input('Categorias_cobranca:', 'categorias_cobranca', '');
form_text_input('Fabricante:', 'fabricante', '');
form_text_input('Modelo:', 'modelo', '');
form_text_input('Cor_marcas:', 'cor_marcas', '');
form_text_input('Numero_passageiros:', 'numero_passageiros', '');
form_text_input('Vencimento_ipva:', 'vencimento_ipva', '');
form_text_input('Preco_referencia:', 'preco_referencia', '');
form_text_input('Extras:', 'extras', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();