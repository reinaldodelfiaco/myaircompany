<?php 


modal_link('+ Adicionar', 'add');

if($movimento == 'compra') {
    modal_link(' Importar XML', 'importar', 'btn btn-success');
    $_campo = 'Fornecedor';
} else {
    $_campo = 'Cliente';
}

br();
if($movimento == 'compra') {
row();
    col(3);
        // Total geral
        dashboard_count('Total de pedidos', 'R$ ' . moeda_real($v_total_pedidos), 'fa fa-money','#');
    cdiv();
    col(3);
        // Total em pago
        dashboard_count('Total de ' . $movimento .'s', 'R$ ' . moeda_real($v_total_compras), 'fa fa-money','financeiro/despesas');
    cdiv();
    col(3);
        // Em atraso
        dashboard_count('Número de pedidos', $num_pedidos, 'fa fa-money','financeiro/despesas');
    cdiv();
    col(3);
        // Em atraso
        dashboard_count('Número de compras', $num_compras, 'fa fa-money','financeiro/despesas');
    cdiv();
cdiv();
}


if($movimento == 'venda') {
    row();
        col(3);
            // Total geral
            dashboard_count('Total de pedidos', 'R$ ' . moeda_real($v_total_pedidos), 'fa fa-money','#');
        cdiv();
        col(3);
            // Total em pago
            dashboard_count('Total de ' . $movimento .'s', 'R$ ' . moeda_real($v_total_vendas), 'fa fa-money','financeiro/despesas');
        cdiv();
        col(3);
            // Em atraso
            dashboard_count('Número de pedidos', $num_pedidos, 'fa fa-money','financeiro/despesas');
        cdiv();
        col(3);
            // Em atraso
            dashboard_count('Número de vendas', $num_vendas, 'fa fa-money','financeiro/despesas');
        cdiv();
    cdiv();
    }

omodal('SELECIONE O XML', 'importar');
    form_open('ordens/importar', 'POST', true);
        form_file_input('SELECIONE O ARQUIVO', 'xml');
        submit('Salvar', 'btn btn-primary');
    form_close();
cmodal();

br();

if($movimento == 'compra') {
    ptable('PEDIDOS / COMPRAS');
    $tipos = [
        ['value' => 'orcamento', 'nome' => 'Orçamento'],
        ['value' => 'pedido', 'nome' => 'Pedido'],
        ['value' => 'compra', 'nome' => 'Compra'],
    ];
} else {
    ptable('PEDIDOS / VENDAS');   
    $tipos = [
        ['value' => 'pedido', 'nome' => 'Orçamento'],
        ['value' => 'venda', 'nome' => 'Venda'],
    ];
}



datatable('ordens', ['Data', 'Status', 'Tipo', 'Cliente',  'Pedido', 'Valor' ], ['data', 'status','tipo', 'nome_fantasia',  'id', 'valor_total' ], $ordens, 
    [
        'editar' => 'ordens/produtos?id', 
        'pdf' => 'ordens/pdf?id',
        'email_modal' => 'ordens/envia_email?id',
        'deletar' => 'ordens/deletar_ordens?tipo='.$movimento.'&id',
        
    ]);
cpanel();

   
    if($movimento == 'compra') {
        omodal('Adicionar pedido / compra', 'add', 'modal-lg');
        form_open('ordens/compras');
    } else {
        omodal('Adicionar venda', 'add', 'modal-lg');
        form_open('ordens/vendas');
    }
    
    
    hidden('movimento', $movimento);
    hidden('empresa', session('empresa'));

    row();
        col(6);
           
            form_select2_data('Tipo:', 'tipo', $tipos);
        cdiv();
        col(6);
                form_text_input('Data da '.$movimento.':', 'data', '','','', date("d/m/Y"));
            cdiv();
        cdiv();
    row();
        col(12);
        if($movimento == 'compra') {
           form_select2('Fornecedor:', 'cliente_fornecedor', $cliente_fornecedor, 'nome_fantasia');
        } else {
           form_select2('Cliente:', 'cliente_fornecedor', $cliente_fornecedor, 'nome_fantasia');
        }
        cdiv();
    cdiv();

    row();
        div('','nf');
            col(6);
                form_text_input('Nota Fiscal Eletrônica:', 'nota_fiscal', '');
            cdiv();
        cdiv();
    cdiv();
    row();
    div('','cfo','width: 100%;');
        col(12);
            form_select2('Natureza da operação:', 'cfop', $cfops, 'desc_sistema');
        cdiv();
    cdiv();
cdiv();


    submit('PRÓXIMO PASSO', 'btn btn-success');
    form_close();
cmodal();


omodal('Enviar descrição por e-mail','email');
	form_open('', 'post','', '', 'm');
            form_text_input('Digite o e-mail para envio', 'email', 'required|email', '', '');
            submit('Enviar', 'btn btn-success');
        form_close();
 cmodal();



?>

<script>
$(document).ready(function() {


    $("#nf").hide();
    $("#cfo").hide();

    $('#email').on('show.bs.modal', function(e) {

        var id = $(e.relatedTarget).data('id');
        var email = $(e.relatedTarget).data('email');
        $(e.currentTarget).find('input[name="email"]').val(email);
        //$('#m').attr('action').val($('#m').attr('action') + id);
        $('#m').attr('action', '<?= BASE ?>ordens/envia_email?id=' + id); 
    });

    function moedaParaNumero(valor) {
        return isNaN(valor) == false ? parseFloat(valor) : parseFloat(valor.replace("R$", "").replace(".", "")
            .replace(",", "."));
    }

    function numeroParaMoeda(n, c, d, t) {
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n <
            0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 :
            0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d +
            Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    $('#data').datepicker({
        autoclose: true,
        todayHighlight: true
    });



    $('#valor').mask('000.000.000.000.000,00', {
        reverse: true
    });


    $("#tipo").change(function() {
        let status = $(this).val();
        if (status == 'compra') {
            $("#nf").show();
        } else {
            $("#nf").hide();
        }

        if(status == 'venda')
        {
            $("#cfo").show();
        } else {
            $("#cfo").hide();
        }
    });


});
</script>
