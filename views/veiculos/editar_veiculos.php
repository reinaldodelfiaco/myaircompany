<?php 
opanel('Editar');
    form_open('veiculos/editar_veiculos?id=' .get('id'));form_text_input('Tipo:', 'tipo', '','','', $veiculos->tipo);
form_text_input('Fornecedor:', 'fornecedor', '','','', $veiculos->fornecedor);
form_text_input('Categorias_cobranca:', 'categorias_cobranca', '','','', $veiculos->categorias_cobranca);
form_text_input('Fabricante:', 'fabricante', '','','', $veiculos->fabricante);
form_text_input('Modelo:', 'modelo', '','','', $veiculos->modelo);
form_text_input('Cor_marcas:', 'cor_marcas', '','','', $veiculos->cor_marcas);
form_text_input('Numero_passageiros:', 'numero_passageiros', '','','', $veiculos->numero_passageiros);
form_text_input('Vencimento_ipva:', 'vencimento_ipva', '','','', $veiculos->vencimento_ipva);
form_text_input('Preco_referencia:', 'preco_referencia', '','','', $veiculos->preco_referencia);
form_text_input('Extras:', 'extras', '','','', $veiculos->extras);
submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();