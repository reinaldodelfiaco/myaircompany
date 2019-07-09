<?php

modal_link('+ Adicionar', 'add');

br();



ptable('Serviços');
datatable('servicos', ['Código', 'Nome', 'Preço de Venda'], ['id', 'nome',  'valor'], $produtos, ['editar' => 'estoque/editar_servicos?id', 'deletar' => 'estoque/deletar_servicos?id']);
cpanel();

omodal('Adicionar serviço', 'add','modal-lg');

form_open('estoque/servicos');

hidden('empresa', session('empresa'));
hidden('tipo', 'servico');

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
form_text_input('Serviço:', 'nome', 'required');
cdiv();
col(3);
form_select2('Categoria', 'categoria', $produtos_categorias, 'nome');
cdiv();
col(3);
form_text_input('Valor:', 'valor', '');
cdiv();
cdiv();

row();

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
