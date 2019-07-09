<?php

modal_link('+ Adicionar', 'add');

br();

row();
    col(4);
        dashboard_count('Quantidade de produtos cadastrados', $total_produtos, 'fa fa-money','#');
    cdiv();
    col(4);
        dashboard_count('Quantidade total de produtos', $quantidade_total_produtos, 'fa fa-money','#');
    cdiv();
    col(4);
        dashboard_count('Custo de estoque aproximado', 'R$ ' .  moeda_real($valor_total_produtos), 'fa fa-money','#');
    cdiv();
cdiv();


ptable('Produtos');
datatable('produtos', ['Código', 'Nome', 'Unidade', 'Preço de Venda', "Quantidade"], ['id', 'nome', 'unidade', 'valor', 'total'], $produtos, ['editar' => 'estoque/editar_produtos?id', 'deletar' => 'estoque/deletar_produtos?id']);
cpanel();

omodal('Adicionar produto', 'add','modal-lg');

form_open('estoque/produtos');

hidden('empresa', session('empresa'));

?>
<ul id="myTab1" class="nav nav-tabs">
    <li class="nav-item active">
        <a href="#ig" class="nav-link" id="iig" data-toggle="tab">Informaçõe Gerais</a>
    </li>

    <li class="nav-item">
        <a href="#if" class="nav-link" id="iif" data-toggle="tab">Informações Fiscais</a>
    </li>
</ul>
<div id="myTab1Content" class="tab-content">

    <div class="tab-pane fade active in" id="ig">
        <?php

row();
col(6);
form_text_input('Nome:', 'nome', 'required');
cdiv();
col(3);
form_text_input('Codigo de barras (EAN):', 'codigo_barras', '');
cdiv();
col(3);
$td = [              
    ['nome' => 'SIM', 'value' => 'S'],
    ['nome' => 'NÃO', 'value' => 'N'],
];
form_select2_data('Mostrar PDV', 'pdv', $td);
cdiv();
cdiv();

row();
col(6);
form_select2('Categoria', 'categoria', $produtos_categorias, 'nome');
cdiv();
col(6);
$tipos = [['nome' => 'Produto', 'value' => 'Produto'],['nome' => 'Serviço', 'value' => 'servico']];
form_select2_data('Tipo','tipo', $tipos, 'nome');
cdiv();
cdiv();

row();
col(4);
form_text_input('Valor:', 'valor', '');
cdiv();
col(4);
form_text_input('Valor da última compra:', 'valor_compra', '');
cdiv();
col(4);
form_int_input('Qtd Inicial:', 'qtd_inicial', '');
cdiv();
cdiv();

row();
    col(12);
        form_select2('Centro de Distribuição Inicial', 'armazem_inicial', $armazens,'nome');
    cdiv();
cdiv();

row();
col(4);
form_text_input('Peso Líquido:', 'peso_liquido', '');
cdiv();
col(4);
form_text_input('Peso Bruto:', 'peso_bruto', '');
cdiv();
col(4);
form_text_input('Unidade:', 'unidade', '');
cdiv();
cdiv();



    ?>

    </div>
    <div class="tab-pane fade active in" id="if">

        <?php

$o = [
    ['value' => '0', 'nome' => 'Nacional'], 
    ['value' => '1', 'nome' => 'Estrangeiro - Exportação direta'],
    ['value' => '2', 'nome' => 'Estrangeiro - Adquirido no mercado externo'],
];

form_select2_data('Origem', 'origem', $o);

form_select2_ajax('estoque/select_ncm','NCM', 'ncm', '');
form_select2_ajax('estoque/select_cest','CEST', 'cest');
form_select2_ajax('estoque/select_csosn','CSOSN', 'csosn');
?>
    </div>
</div>

<?php
submit('Salvar', 'btn btn-success');

form_close();

cmodal();


?>

<script>
$(document).ready(function() {
	$("#if").hide();
	$("#iig").click();
    $("#iif").click(function() {
        $("#if").show();
    });
    $("#iig").click(function() {
        $("#if").hide();
    });
    $("#csosn").append(
        '<option value="2" selected="selected">102 - Tributada pelo Simples Nacional sem permissão de crédito</option>'
    );
    $('#valor').mask('000.000.000.000.000,00', {
        reverse: true
    });
    $('#valor_compra').mask('000.000.000.000.000,00', {
        reverse: true
    });

});
</script>
