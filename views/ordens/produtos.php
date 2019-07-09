<?php
    if($total_produtos) {
        $total_produtos = $total_produtos;
    } else {
        $total_produtos = "0.00";
    }
    omodal('Atualizar Informações', 'altera_status');
        form_open('ordens/atualiza_status?id=' . get('id'));
        
        row();
            col(12);
            if($ordem->movimento == 'compra') {
                $tipos = [
                    #['value' => 'pedido', 'nome' => 'Pedido'],
                    ['value' => 'compra', 'nome' => 'Compra'],
                ];
            } else {
                $tipos = [
                    #['value' => 'pedido', 'nome' => 'Pedido'],
                    ['value' => 'venda', 'nome' => 'Venda'],
                    ['value' => 'venda', 'nome' => 'NFE'],
                ];
            }
            
            form_select2_data('Tipo:', 'tipo', $tipos, $ordem->tipo);
            cdiv();
        
        cdiv();
        row();
            col(12);
            if($ordem->movimento == 'compra') {
            form_select2('Fornecedor:', 'cliente_fornecedor', $cliente_fornecedor, 'razao_social', $ordem->cliente_fornecedor);
            } else {
            form_select2('Cliente:', 'cliente_fornecedor', $cliente_fornecedor, 'razao_social', $ordem->cliente_fornecedor);
            }
            cdiv();
        
        cdiv();
        row();
            div('','nf');
                col(6);
                    form_text_input('Nota Fiscal Eletrônica:', 'nota_fiscal', '','','', $ordem->nota_fiscal);
                cdiv();
                col(6);
                    form_text_input('Data da compra:', 'data2', '','','', data_br($ordem->data));
                cdiv();
            cdiv();
        cdiv();
        div('','cfo');
 	if($ordem->movimento == 'venda') {
	row();
        col(12);
            form_select2_blank('Natureza da operação:', 'cfop', $cfops, 'desc_sistema', $ordem->cfop);
        cdiv();
	cdiv();
	}
        cdiv();

        submit('Alterar', 'btn btn-success');

        form_close();
    cmodal();

    omodal('CONFIRMAR', 'concluir', 'modal-lg');
    
        form_open('ordens/concluir?id=' . get('id'));
        
        hidden('empresa', session('empresa'));
        hidden('movimento', $ordem->movimento);
       
        // Tipo financeiro para dizer que é uma despesa

        if($ordem->movimento == 'compra') {
            hidden('titulo', 'COMPRA NÚMERO: # ' . $ordem->id);
            hidden('tipo', 'compra');

        } else {
            hidden('titulo', 'VENDA NÚMERO: # ' . $ordem->id);
            hidden('tipo', 'venda');
        }

        row();
            col(4);
                dashboard_count_nota('TOTAL DOS PRODUTOS', 'R$ ' . moeda_real($total_produtos), 'fa fa-money', '', '#');
            cdiv();
            col(4);
                dashboard_count_nota('OUTROS VALORES', 'R$ ' . moeda_real('0.00'), 'fa fa-money', 'ov','#');
            cdiv();
            col(4);
                dashboard_count_nota('TOTAL DA NOTA', 'R$ ' . moeda_real('0.00'), 'fa fa-money', 'tn', '#');
            cdiv();
        cdiv();
    ?>
        <ul id="myTab1" class="nav nav-tabs">
            <li class="nav-item active">
                <a href="#ig" class="nav-link" id="iig" data-toggle="tab">Geral
                </a>
            </li>
            <li class="nav-item">
                <a href="#if" id="iif" class="nav-link" data-toggle="tab">Frete</a>
            </li>
            <li class="nav-item">
                <a href="#ih" id="iih" class="nav-link" data-toggle="tab">Financeiro</a>
            </li>
        </ul>
      
        <div id="myTab1Content" class="tab-content">
            <div class="tab-pane fade active in" id="ig">
                <?php
                     if($ordem->movimento == 'compra') {
                        row();
                            div('','nf');
                                col(6);
                                    form_text_input('Nota Fiscal Eletrônica:', 'nota_fiscal', '','','', $ordem->nota_fiscal);
                                cdiv();
                                col(6);
                                    form_text_input('Data da compra:', 'data', '','','', data_br($ordem->data));
                                cdiv();
                            cdiv();
                        cdiv();
                    }
                    row();
                    col(12);
                        form_textarea('Observação', 'descricao');
                    cdiv();
                    cdiv();
                    br();
                    /*
                    row();
                        div('new-bg');
                            col(3);
                                if($ordem->movimento == 'venda') {
                                    form_checkbox('Transmitir NFE?', 'transmitir_nfe', 1);
                                }
                            cdiv();
                            col(2);
                                if($ordem->movimento == 'venda') {
                                    form_checkbox('Emitir Boletos?', 'emitir_boletos', 1);
                                }
                            cdiv();
                        cdiv();
                    cdiv();*/
                ?>
            </div>
            <div class="tab-pane fade active in" id="if">
            <?php
                row();
                    col(6);
                        $e = [['value' => 'recebido', 'nome' => 'Concluída'], ['value' => 'pendente', 'nome' => 'Pendente']];
                        form_select2_data('Entrega', 'estoque', $e, 'nome');
                    cdiv();
                    div('', 'am');
                        col(6);
                            form_select2('Centro de distribuição', 'armazem', $armazens, 'nome');
                        cdiv();
                    cdiv();
                cdiv();
        
                row();
                    col(6);
                        $tf = [
                                ['value' => '9', 'nome' => 'Sem Frete'], 
                                ['value' => '0', 'nome' => 'Por conta do Emitente'],
                                ['value' => '1', 'nome' => 'Por conta do Destinatário ou remetente'],
                                ['value' => '2', 'nome' => 'Por conta de Terceiros'],
                            ];
                        form_select2_data('Tipo de frete', 'tipo_frete', $tf, 'nome');
                    cdiv();
                    div('', 'transp');
                        col(6);
                            form_select2('Transportadora', 'transportadora', $transportadoras, 'razao_social');
                        cdiv();
                    cdiv();
                cdiv();
               
            ?>
            </div>
            <div class="tab-pane fade active in" id="ih">
            <?php
                row();
                    col(2);
                        form_text_input('Frete:', 'frete', '','','', moeda_real($ordem->valor_frete));
                    cdiv();
                    col(2);
                        form_text_input('Desconto:', 'desconto', '','','', moeda_real($ordem->valor_desconto));
                    cdiv();
                    col(2);
                        form_text_input('Total', 'vtotal', '','','', moeda_real($total_produtos));
                    cdiv();
                    div('', 'parcelas');
                        col(2);
                            form_text_input('Parcelas', 'parcela', 'required','','',1);
                        cdiv();
                    cdiv();
                    div('','f');
                        col(4);
                            $p = [['value' => 'mensal', 'nome' => 'Mensal'], ['value' => 'anual', 'nome' => 'Anual']];
                            form_select2_data('Frequência', 'frequencia', $p, 'nome');
                        cdiv();
                    cdiv();
                cdiv();
                row();
                    col(3);
                        $status = [['value' => 'aberto', 'nome' => 'Aberto'], ['value' => 'pago', 'nome' => 'Pago']];
                        form_select2_data('Status', 'status', $status, 'nome');
                    cdiv();
                    col(3);
                        form_text_input('Vencimento', 'data_vencimento', 'required');
                    cdiv();
                    div('', 'pago');
                        col(3);
                            form_text_input('Valor pago', 'valor_pago', '');
                        cdiv();
                        col(3);
                            form_text_input('Data do pagamento', 'data_pagamento', '');
                        cdiv();
                    cdiv();
                cdiv();
                row();
                    col(3);
                        form_select2('Banco', 'banco', $bancos,'nome');
                    cdiv();
                    col(3);
                        form_select2('Conta contábil', 'conta_contabil', $contabeis,'nome');
                    cdiv();
                    col(3);
                        form_select2('Categoria', 'categoria', $categorias,'nome');
                    cdiv();
                    col(3);
                        form_select2('Espécie', 'forma_de_pagamento', $formas,'nome');
                    cdiv();
                cdiv();
            ?>
            </div>
        </div>

    <?php
	row();  
		 col(12);
			 submit('CONCLUIR', 'btn btn-success pull-right');
		 cdiv();
	 cdiv();
    form_close();
    cmodal();
        
    if($ordem->tipo == 'pedido') { 
        opanel('PEDIDO NÚMERO: #' . $ordem->id);
    } else {
        if($ordem->movimento == 'compra') {
            opanel('COMPRA NÚMERO: #' . $ordem->id);
        } else {
            opanel('VENDA NÚMERO: #' . $ordem->id);
        }
    }
        echo '<b> DATA: </b> ' . data_br($ordem->data) . '<br>';
        if($ordem->movimento == 'compra') {
        echo '<b> FORNECEDOR: </b> ' . $ordem->razao_social . '<br>';
        } else {
        echo '<b> CLIENTE: </b> ' . $ordem->razao_social . '<br>';
        }

        if($ordem->nota_fiscal) {
            echo '<b> NOTA FISCAL: </b> ' . $ordem->nota_fiscal . '<br>';
        }
    cpanel();

    if($ordem->tipo == 'pedido') { 
        p('<i><b>Obs: </b>Quando você clicar em concluir, seu pedido automaticamente se tornará uma '.$ordem->movimento.'.</i><br><br>');
    }

    opanel('MOVIMENTOS');
        if($ordem->status != "Concluído") {
        form_open('ordens/produtos?id=' . get('id'));
            row();
                col(4);
                    form_select2_blank('Produto', 'produto', $produtos, 'nome');
                cdiv();
                col(2);
                form_int_input('Qtd', 'quantidade', '');
                cdiv();
                col(2);
                form_text_input('Valor', 'valor', '');
                cdiv();
                col(2);
                form_text_input('Total', 'valor_total', '');
                cdiv();
                col(2);
                submit('Adicionar', 'btn btn-success', '28');
                cdiv();
            cdiv();

            hr();
        }
            table('ordens_produtos', ['Produto', 'Quantidade', 'Valor', 'Total'], ['nome_produto_ordem', 'quantidade', 'valor',  'valor_total'], $produtos_adicionados, ['deletar' => ($ordem->status != "Concluído") ? 'ordens/deletar_p?id' : '']);
            br();
            table('ordens_produtos2', ['Voo', 'Quantidade', 'Valor', 'Total'], ['voo', 'quantidade', 'valor',  'valor_total'], $voos, ['deletar' => ($ordem->status != "Concluído") ? 'ordens/deletar_p?id' : '']);
        form_close();

    cpanel();

    row();
    col(5);
    br();
    if($ordem->status == "Aberto") {
    modal_link('Atualizar', 'altera_status');
    }
    a("PDF", 'ordens/pdf?id=' .get('id'), 'btn btn-primary mg-r-4');
    
    modal_link('E-mail', 'email');
    
    
    
    omodal('Enviar descrição por e-mail','email');
        form_open('ordens/envia_email?id='. get('id'));
            form_text_input('Digite o e-mail para envio', 'email', 'required|email', '', '',$ordem->email);
            submit('Enviar', 'btn btn-success');
        form_close();
    cmodal();

    if($ordem->tipo == "pedido") {
        a("Salvar", 'ordens/'.$ordem->movimento.'s', 'btn btn-success');
    }
    if($ordem->status != "Concluído") {
        modal_link(' Concluir '.ucwords($ordem->movimento).'', 'concluir', 'btn btn-success');
    }
    cdiv();
    col(2);
    cdiv();
    col(2);
    cdiv();
    col(3);
        dashboard_count('Total', 'R$ ' . moeda_real($total_produtos), 'fa fa-money','financeiro/despesas');
    cdiv();
        // Em atraso
    cdiv();
    cdiv();
    
    $v_inicial_nota = (moeda_dollar($total_produtos) - $ordem->valor_desconto + $ordem->valor_frete);
    $v_inicial_ov = ($ordem->valor_frete - $ordem->valor_desconto);

    ?>
<script>

$(document).ready(function() {
    $("#if").hide();
    $("#ih").hide();
    $("#iig").click();
    
    $("#iif").click(function() {
        $("#if").show();
        $("#ig").hide();
        $("#ih").hide();
    });
    $("#iig").click(function() {
        $("#ig").show();
        $("#if").hide();
        $("#ih").hide();
    });
    $("#iih").click(function() {
        $("#ih").show();
        $("#if").hide();
        $("#ig").hide();
    });

    $("#nf").hide();
    $("#transp").hide();

    if ($("#tipo").val() == 'pedido') {
        $("#cfo").hide();
    }

    if ($("#tipo_frete").val() == '9') {
        $("#transp").hide();
    }

    let valor_inicial_nota = <?= $v_inicial_nota ?>;
    let valor_inicial_op = <?= $v_inicial_ov ?>;

    $("#tn").text('R$' + numeroParaMoeda(valor_inicial_nota));
    $("#ov").text('R$' + numeroParaMoeda(valor_inicial_op));

    function moedaParaNumero(valor) {
        return isNaN(valor) == false ? parseFloat(valor) : parseFloat(valor.replace("R$", "").replace(
                ".", "")
            .replace(",", "."));
    }

    function numeroParaMoeda(n, c, d, t) {
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t,
            s = n <
            0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ?
            j % 3 :
            0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (
            c ? d +
            Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    $('#data').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#data2').datepicker({
        autoclose: true,
        todayHighlight: true
    });



    $('#valor').mask('000.000.000.000.000,00', {
        reverse: true
    });
    $('#frete').mask('000.000.000.000.000,00', {
        reverse: true
    });
    $('#desconto').mask('000.000.000.000.000,00', {
        reverse: true
    });

    $("#produto").change(function() {
        let produto = $(this).val();
        $.ajax({
            method: "GET",
            url: "<?= BASE ?>ordens/lista_produto?id=" + produto,
        }).done(function(data) {
            var obj = JSON.parse(data);

            $("#quantidade").val(1);
            $("#valor").val(numeroParaMoeda(obj.valor));
            $("#valor_total").val(numeroParaMoeda(obj.valor * $("#quantidade").val()));
        });

    });

    $("#frete").change(function() {
        let f = moedaParaNumero($(this).val());
        let des = moedaParaNumero($("#desconto").val());
        let valor_nota = <?= $total_produtos ?>;

        if (des > 0) {
            d = des;
        } else {
            d = 0;
        }

        $("#ov").text('R$' + numeroParaMoeda(f - d));
        $("#tn").text('R$' + numeroParaMoeda(f - d + valor_nota));
        $("#vtotal").val(numeroParaMoeda(f - d + valor_nota));

    });

    $("#desconto").change(function() {
        let f = moedaParaNumero($(this).val());
        let des = moedaParaNumero($("#frete").val());
        let valor_nota = <?= $total_produtos ?>;

        if (des > 0) {
            d = des;
        } else {
            d = 0;
        }


        $("#ov").text('R$' + numeroParaMoeda(d - f));
        $("#tn").text('R$' + numeroParaMoeda(valor_nota - f + d));
        $("#vtotal").val(numeroParaMoeda(valor_nota - f + d));

    });



    $("#quantidade").change(function() {
        valor = moedaParaNumero($("#valor").val());
        $("#valor_total").val(numeroParaMoeda(valor * $("#quantidade").val()));
    });

    $("#valor").change(function() {
        valor = moedaParaNumero($("#valor").val());
        $("#valor_total").val(numeroParaMoeda(valor * $("#quantidade").val()));
    });


    if ($("#tipo").val() == 'compra') {
        $("#nf").show();
    }

    $("#tipo").change(function() {
        let status = $(this).val();
        if (status == 'compra') {
            $("#nf").show();
        } else {
            $("#nf").hide();
        }
    });


    $("#tipo_frete").change(function() {
        let transportadora = $(this).val();
        if (transportadora == '9') {
            $("#transp").hide();
        } else {
            $("#transp").show();
        }
    });

    $("#tipo").change(function() {
        let status = $(this).val();
        if (status == 'venda') {
            $("#cfo").show();
        } else {
            $("#cfo").hide();
        }
    });


    $("#pago").hide();
    $("#f").hide();
    $("#parcelas").show();

    $("#status").change(function() {
        let status = $(this).val();
        if (status == 'aberto') {
            $("#pago").hide();
        } else {
            $("#pago").show();
        }
    });

    $("#recorrente").change(function() {
        let r = $(this).val();
        if (r == '1') {
            $("#parcelas").hide();
        } else {
            $("#parcelas").show();
        }
    });

    $("#parcela").blur(function() {
        let vtotal = moedaParaNumero($("#vtotal").val());
        let vparcela = $("#parcela").val();
        $("#vtotal").val(numeroParaMoeda(vtotal / vparcela));

        if (vparcela > 1) {
            $("#f").show();
        }
    });

    $("#vtotal").blur(function() {
        let vtotal = moedaParaNumero($("#vtotal").val());
        let vparcela = $("#parcela").val();
        $("#vtotal").val(numeroParaMoeda(vtotal / vparcela));
    });

    function moedaParaNumero(valor) {
        return isNaN(valor) == false ? parseFloat(valor) : parseFloat(valor.replace("R$", "").replace(
            ".", "").replace(",", "."));
    }

    function numeroParaMoeda(n, c, d, t) {
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t,
            s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i
                .length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (
            c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    $('#data_vencimento').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#data_pagamento').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#fdata_inicial').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#fdata_final').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#fldata_inicial').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#fldata_final').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#valor').mask('000.000.000.000.000,00', {
        reverse: true
    });

    $('#valor_pago').mask('000.000.000.000.000,00', {
        reverse: true
    });

    $('#vtotal').mask('000.000.000.000.000,00', {
        reverse: true
    });


});
</script>
