<?php

ptable('Controle de estoque');
br();
?>
<ul id="myTab1" class="nav nav-tabs">
    <li class="nav-itm active">
        <a href="#ig" class="nav-link" id="iig" data-toggle="tab">Extrato de movimentações
        </a>
    </li>
    <li class="nav-item">
        <a href="#if" id="iif" class="nav-link" data-toggle="tab">Gestão do Centro de Distribuição</a>
    </li>
    <li class="nav-item">
        <a href="#ih" class="nav-link"  id="iih" data-toggle="tab">Custos e Lucratividade</a>
    </li>
</ul>
<div id="myTab1Content" class="tab-content">
    <div class="tab-pane fade active in" id="ig">
        <?php

	form_open('estoque/resumido', 'get', '', 'form account-form', 'filtro');
		        col(3);
			        form_text_input('Data Inicial', 'fdata_inicial', '', '', '', get('fdata_inicial'));
		        cdiv();
		        col(3);
			        form_text_input('Data Final', 'fdata_final', '', '', '', get('fdata_final'));
		        cdiv();
		        col(6);
			        form_select2_blank('Centro de Distribuição', 'farmazem', $armazens, 'nome', get('farmazem'));
		        cdiv();
	form_close();

        datatable('armazens', ['Data Movimentação', 'Produto', 'Tipo', 'Ordem', 'Fornecedor / Cliente', 'Quantidade', 'Status'], ['data', 'nome_produto', 'tipo', 'ordem', 'razao_social', 'quantidade', 'status'], $estoque, []);


        ?>
    </div>
    <div class="tab-pane fade active in" id="if">
        <?php
        
        form_open('estoque/resumido', 'get', '', 'form account-form', 'filtro2');
        form_select2_blank('Centro de Distribuição', 'f2armazem', $armazens, 'nome', get('f2armazem'));
        form_close();


        datatable('produtos', ['Código', 'Nome', 'Quantidade'], ['id', 'nome', 'total'], $produtos, []);
        ?>
    </div>
    <div class="tab-pane fade active in" id="ih">
        <?php
        datatable('armazens3', ['Código', 'Nome', 'Unidade', 'Quantidade em estoque', 'Quantidade total de compra', 'Quantidade total de venda', 'Preço médio de compra', 'Preço médio de venda', '% Lucro'], ['id', 'nome', 'unidade', 'qtd', 'qtdcompra','qtdvenda', 'vtotal', 'vtotalvenda', 'plucro'], $estoque2, []);
        ?>
    </div>
</div>

<?php
cpanel();


?>
<script>
    $(document).ready(function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

        $("#if").hide();
        $("#ih").hide();
	$("#iig").click();

        if (getUrlParameter('f2armazem') > 0) {
            $("#iif").click();
            $("#if").show();
        }

        if (getUrlParameter('f3') > 0) {
            $("#iih").click();
            $("#ih").show();
        }


        $("#iif").click(function () {
            $("#if").show();
            $("#ig").hide();
            $("#ih").hide();
        });

        $("#iig").click(function () {
            $("#ig").show();
            $("#if").hide();
            $("#ih").hide();
        });
        $("#iih").click(function () {
            $("#ih").show();
            $("#if").hide();
            $("#ig").hide();
        });

        $('#fdata_final').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fdata_inicial').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#f3data_final').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#f3data_inicial').datepicker({
            autoclose: true,
            todayHighlight: true
        });


        $("#farmazem").change(function () {
            $("#filtro").submit();

        });

        $("#f2armazem").change(function () {
            $("#filtro2").submit();
        });

        $("#fdata_final").change(function () {
            $("#filtro").submit();
        });

        $("#fdata_inicial").change(function () {
            $("#filtro").submit();
        });

        $("#f3armazem").change(function () {
            $("#filtro3").submit();

        });

        $("#3fdata_final").change(function () {
            $("#filtro3").submit();
        });

        $("#f3data_inicial").change(function () {
            $("#filtro3").submit();
        });


    });
</script>
