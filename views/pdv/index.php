<?php
    $v_inicial_nota = '0';
    $v_inicial_ov = '0';

    row();
        col(6);
            if(!session('venda_cliente')):
                modal_link('BUSCAR CLIENTE', 'buscar_cliente', 'btn btn-secondary');
            else: 
                a('PRODUTOS / SERVIÇOS', 'pdv/index?produtos=1', 'btn btn-primary');
                a('VOOS', 'pdv/index?voos=1', 'btn btn-primary');
                a('CANCELAR VENDA',  'pdv/cancelar_venda', 'btn btn-danger');
            endif;
            
            omodal('BUSCAR CLIENTE', 'buscar_cliente');
            form_open('pdv/buscar_cliente');
            form_select2_blank('BUSCA', 'buscando', $clientes, 'busca_form');
            row();
                col(3);
                    submit('SELECIONAR', 'btn btn-primary');
                cdiv();
                col(2);
                    modal_link('NOVO CLIENTE', 'novo_cliente', 'btn btn-primary');
                cdiv();
            cdiv();
            form_close();
            cmodal();

            omodal('NOVO CLIENTE', 'novo_cliente', 'modal-lg');
            form_open('pdv/novo_cliente');
            hidden('empresa', session('empresa'));
            hidden('cliente', 1);
            $tipo = [['value' => 'Jurídica', 'nome' => 'Jurídica'], ['value' => 'Física', 'nome' => 'Física']];
        
            row();
            col(4);
            form_select2_data('Tipo', 'tipop', $tipo, 'nome');
            cdiv();
            col(8);
            form_text_input('CNPJ / CPF', 'cnpj_cpf', 'server', 'crm/valida_documento');
            cdiv();
            cdiv();
        
            row();
            col(12);
            form_text_input('Nome', 'nome_fantasia', 'required');
            cdiv();
            cdiv();
        
            div('', 'pjd');
            row();
            col(6);
            form_text_input('Razao Social', 'razao_social','');
            cdiv();
        
            col(3);
            form_text_input('Inscrição Municipal', 'inscricao_municipal');
            cdiv();
            col(3);
            form_text_input('Inscrição Estadual', 'inscricao_estadual');
            cdiv();
            cdiv();
            cdiv();
        
        
            row();
            col(4);
            form_text_input('Contato', 'contato', '');
            cdiv();
            col(4);
            form_text_input('E-mail', 'email', 'email');
            cdiv();
        
            col(4);
            form_text_input('Telefone', 'telefone', '');
            cdiv();
            cdiv();
            row();
            col(2);
            form_text_input('CEP', 'cep', '');
            cdiv();
            col(2);
            form_select2_ajax('crm/uf','Estado', 'estado');
            cdiv();
            col(4);
            form_select2_ajax('crm/municipios','Cidade', 'cidade');
            cdiv();
            col(4);
            form_text_input('Bairro', 'bairro', '');
            cdiv();
            cdiv();
            row();
        
            col(6);
            form_text_input('Endereço', 'endereco', '');
            cdiv();
            col(2);
            form_text_input('Número', 'numero', '');
            cdiv();
            col(4);
            form_text_input('Complemento', 'complemento', '');
            cdiv();
            cdiv();

            p('Em caso de estrangeiros');

            row();
                col(6);
                    form_text_input('País', 'pais', '','');
                cdiv();
                col(6);
                    form_text_input('PASSAPORT', 'passaport', '','');
                cdiv();
            cdiv();
        
        
            submit('Salvar', 'btn btn-success');
            form_close();
            cmodal();

            if(get('produtos') == 1) {
                br();
                row('mt-10');
                foreach ($produtos_pdv as $pdv) {
                    echo '<a href="'.BASE.'pdv/add_produto?id='.$pdv->id.'">';
                    col(6);
                        opanel($pdv->nome);
                            p('Valor: R$' . moeda_real($pdv->valor));
                        cpanel();
                    cdiv();
                    echo '</a>';
                }
                cdiv();
            }

            if(get('voos') == 1) {
                br();
                row('mt-10');
                foreach ($voos as $v) {
                    echo '<a href="'.BASE.'pdv/add_voo?id='.$v->id.'">';
                    col(12);
                        opanel($v->origem . ' > ' . $v->destino);
                            p('TIPO: <b>' . $v->tipo . '</b>');
                            p('DATA: <b class="text-danger">' . data_br($v->data) . ' </b> - PARTIDA: <b>' . $v->hora_partida . '</b> - CHEGADA PREVISTA: <b>' . $v->hora_chegada . '</b>');
                            p('VALOR: R$' . moeda_real($v->valor_padrao));
                            p('LUGARES DISPONÍVEIS: <b class="text-danger">' . $v->lugares_disponiveis . '</b>');
                        cpanel();
                    cdiv();
                    echo '</a>';
                }
                cdiv();
            }





        cdiv();
        col(6);
        br();
            opanel('Resumo da venda');
            if(session('venda_cliente')):
                echo '<b>Código: </b> ' . session('venda_cliente'); 
                echo ' - <b>Nome: </b>' . session('venda_nome');
                echo ' - <b>CNPJ / CPF: </b> ' . session('venda_doc');
                hr();
                if($produtos):
                    table('produtos', ['PRODUTO', 'VALOR', ], ['pdv_nome', 'valor'], $produtos, ['deletar' => 'pdv/excluir_produto?id']);
                endif;
                omodal('CONFIRMAR', 'concluir', 'modal-lg');
                form_open('pdv/concluir?id=' . session('venda_id'));
                hidden('empresa', session('empresa'));
                #hidden('movimento', $ordem->movimento);
                hidden('titulo', 'VENDA PDV NÚMERO: # ' . session('venda_id'));
                hidden('tipo', 'venda');
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
                        
                row();
                col(12);
                    form_textarea('Observação', 'descricao');
                cdiv();
                cdiv();
                    row();
                        col(3);
                            form_text_input('Desconto:', 'desconto', '','','', moeda_real($ordem->valor_desconto));
                        cdiv();
                        col(3);
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
                    hr();
                    p('FRETE?');
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
                    row();
                        col(12);
                            submit('CONCLUIR', 'btn btn-success pull-right');
                        cdiv();
                    cdiv();
            form_close();
            cmodal();
        
            $v_inicial_nota = (moeda_dollar($total_produtos) - $ordem->valor_desconto + $ordem->valor_frete);
            $v_inicial_ov = ($ordem->valor_frete - $ordem->valor_desconto);
            endif;
            cpanel();

            dashboard_count('Total', 'R$ ' . moeda_real($total_produtos), 'fa fa-money','voeava/pdv');

            modal_link(' Concluir', 'concluir', 'btn btn-success btn-block');
        cdiv();
    cdiv();

   
   
   

    


?>
    <script>
$(document).ready(function() {
    $('#cep').mask('00000-000');
    $('#cnpj_cpf').mask('00.000.000/0000-00');
    $('#pfd').hide();
    $("#tipop").change(function(){
            let status = $(this).val();
            if(status == 'Jurídica') {
                $('#cnpj_cpf').mask('00.000.000/0000-00');
                $('#pjd').show();
                $('#pfd').hide();
            } else {
                $('#cnpj_cpf').mask('000.000.000-00');
                $('#pjd').hide();
                $('#pfd').show();
            }
    });
    

    $("#razao_social").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });

    $("#nome_fantasia").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });



    $("#cnpj_cpf").change(function() {
        var cnpj = $("#cnpj_cpf").val().replace(/\D/g, '');
        if (cnpj != "") {
            var url = "<?= BASE ?>crm/busca_empresa?cnpj=http://receitaws.com.br/v1/cnpj/" + cnpj;
            $.ajax({
                url: url,
                crossDomain: true,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $("#razao_social").val(data.nome);
                    $("#nome_fantasia").val(data.fantasia);
                    $("#cep").val(data.cep);
                    $("#endereco").val(data.logradouro);
                    $("#numero").val(data.numero);
                    $("#bairro").val(data.bairro);
                    //$("#cidade").val([data.municipio]);
                    $("#cidade").append('<option value="'+ data.municipio +'" selected="selected">'+ data.municipio +'</option>');
                    $("#estado").append('<option value="'+ data.uf +'" selected="selected">'+ data.uf +'</option>');
                    //$("#estado").val(data.uf);
                    $("#complemento").val(data.complemento);
                    $("#email").val(data.email);
                    $("#capital_social").val(data.capital_social);
                    $("#telefone").val(data.telefone);
                },
                type: 'GET'
            });

        }
    });

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