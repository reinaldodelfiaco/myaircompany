<?php
opanel('Editar');
form_open('estoque/editar_produtos?id=' . get('id'));

hidden('empresa', session('empresa'));

?>
<ul id="myTab1" class="nav nav-tabs">
    <li class="nav-item active">
        <a href="#ig" id="iig" class="nav-link" data-toggle="tab">Informaçõe Gerais</a>
    </li>

    <li class="nav-item">
        <a href="#if" class= "nav-link" id="iif" data-toggle="tab">Informações Fiscais</a>
    </li>
</ul>
<div id="myTab1Content" class="tab-content">

    <div class="tab-pane fade active in" id="ig">

        <?php
row();
col(6);
form_text_input('Nome:', 'nome', 'required', '', '', $produtos->nome);
cdiv();
col(3);
form_text_input('Codigo de barras (EAN):', 'codigo_barras', '', '', '', $produtos->codigo_barras);
cdiv();
col(3);
$td = [              
    ['nome' => 'SIM', 'value' => 'S'],
    ['nome' => 'NÃO', 'value' => 'N'],
];
form_select2_data('Mostrar PDV', 'pdv', $td, $produtos->pdv);
cdiv();
cdiv();

row();
col(6);
form_select2('Categoria', 'categoria', $produtos_categorias, 'nome', $produtos->categoria);
cdiv();
col(6);
$tipos = [['nome' => 'Serviço', 'value' => 'servico'], ['nome' => 'Produto', 'value' => 'Produto']];
form_select2_data('Tipo', 'tipo', $tipos, $produtos->tipo);
cdiv();
cdiv();

row();
col(6);
form_text_input('Valor:', 'valor', '', '', '', moeda_real($produtos->valor));
cdiv();
col(6);
form_text_input('Valor da última compra:', 'valor_compra', '', '', '', moeda_real($produtos->valor_compra));
cdiv();
cdiv();

row();
col(4);
form_text_input('Peso Líquido:', 'peso_liquido', '', '', '', $produtos->peso_liquido);
cdiv();
col(4);
form_text_input('Peso Bruto:', 'peso_bruto', '', '', '', $produtos->peso_bruto);
cdiv();
col(4);
form_text_input('Unidade:', 'unidade', '', '', '', $produtos->unidade);
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

form_select2_data('Origem', 'origem', $o, $produtos->origem);


form_select2_ajaxs('estoque/select_ncm', 'NCM', 'ncm', $produtos->ncm, 'produtos_ncm', 'codigo', 'nome');
form_select2_ajaxs('estoque/select_cest', 'CEST', 'cest', $produtos->cest,'produtos_cest', 'codigo','nome');
form_select2_ajaxs('estoque/select_csosn', 'CSOSN', 'csosn', $produtos->csosn, 'produtos_csosn', 'codigo','nome');
?>
    </div>
</div>
<?php
submit('Salvar', 'btn btn-success');

form_close();


cpanel();

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
    $('#valor').mask('000.000.000.000.000,00', {
        reverse: true
    });
    $('#valor_compra').mask('000.000.000.000.000,00', {
        reverse: true
    });

});
</script>