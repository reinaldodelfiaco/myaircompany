<?php 

                        modal_link('+ Adicionar', 'add');
                        br();
                        ptable('Ordens_produtos');
                        datatable('ordens_produtos', ['Orden', 'Produto', 'Valor', 'Valor_total', 'Quantidade', ], ['orden', 'produto', 'valor', 'valor_total', 'quantidade', ], $ordens_produtos, ['editar' => 'ordens_produtos/editar_ordens_produtos?id', 'deletar' => 'ordens_produtos/deletar_ordens_produtos?id']);
                        cpanel();
                        
                        omodal('Adicionar ordens_produtos', 'add');
                        form_open('ordens_produtos/ordens_produtos');form_text_input('Orden:', 'orden', '');
form_text_input('Produto:', 'produto', '');
form_text_input('Valor:', 'valor', '');
form_text_input('Valor_total:', 'valor_total', '');
form_text_input('Quantidade:', 'quantidade', '');
submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();