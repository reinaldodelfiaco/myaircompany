
<!--<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart'], 'language': 'pt'});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['MÊS', 'RECEITAS', 'DESPESAS'],
          ['JANEIRO',  <?= receita_mensal('01') ?>, <?= despesa_mensal('01') ?>],
          ['FEVEREIRO',  <?= receita_mensal('02') ?>, <?= despesa_mensal('02') ?>],
          ['MARÇO',  <?= receita_mensal('03') ?>, <?= despesa_mensal('03') ?>],
          ['ABRIL',  <?= receita_mensal('04') ?>, <?= despesa_mensal('04') ?>],
          ['MAIO',  <?= receita_mensal('05') ?>, <?= despesa_mensal('05') ?>],
          ['JUNHO',  <?= receita_mensal('06') ?>, <?= despesa_mensal('06') ?>],
          ['JULHO',  <?= receita_mensal('07') ?>, <?= despesa_mensal('07') ?>],
          ['AGOSTO',  <?= receita_mensal('08') ?>, <?= despesa_mensal('08') ?>],
          ['SETEMBRO',  <?= receita_mensal('09') ?>, <?= despesa_mensal('09') ?>],
          ['OUTUBRO',  <?= receita_mensal('10') ?>, <?= despesa_mensal('10') ?>],
          ['NOVEMBRO',  <?= receita_mensal('11') ?>, <?= despesa_mensal('11') ?>],
          ['DEZEMBRO',  <?= receita_mensal('12') ?>, <?= despesa_mensal('12') ?>],
        ]);

        var options = {
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>-->
<?php

/*
	row();
		col(3);
			contas_bancarias();
		cdiv();
		col(3);
			previsao_financeira();
		cdiv();
		col(6);
	  		row();
	  			col(6);
					a('NOVA RECEITA', 'financeiro/nova_receita', 'btn btn-success btn-block');
					br();
					$dateless = data_br(date('Y-m-d', strtotime('-1 day', strtotime(date("Y-m-d")))));
					
					$l = 'financeiro/receitas?filter=1&fdata_inicial=' . date("d/m/Y") . '&fdata_final=' . date("d/m/Y");
					dashboard_count('À RECEBER HOJE', 'R$ ' . $valor_receita_hoje, 'fa fa-money',$l);
					$l = 'financeiro/receitas?filter=1&fstatus=aberto&fdata_final=' . $dateless;
					dashboard_count('À RECEBER ATRASADO', 'R$ ' . $valor_receita_atrasada, 'fa fa-money', $l);
	  			cdiv();
				col(6);
					a('NOVA DESPESA', 'financeiro/nova_despesa', 'btn btn-danger btn-block');
					br();
					$l = 'financeiro/despesas?filter=1&fdata_inicial=' . date("d/m/Y") . '&fdata_final=' . date("d/m/Y");
					dashboard_count('À PAGAR HOJE', 'R$ ' . $valor_despesa_hoje, 'fa fa-money', $l);
					$l = 'financeiro/despesas?filter=1&fstatus=aberto&fdata_final=' . $dateless;
					dashboard_count('À PAGAR ATRASADO', 'R$ ' . $valor_despesa_atrasada, 'fa fa-money',$l);
				cdiv();
			cdiv();
		cdiv();
	cdiv(); 	
	row();
		col(12);
			// CHART
			opanel('Gráfico Receitas x Despesas Anual');
				div('chart_div','chart_div');
			cpanel();
		cdiv();
	cdiv();
?>
*/

