<?php

  modal_link('FILTROS','#', 'btn btn-success');
  br();

  opanel('HORÁRIOS DE VOOS: ' . date ("d/m/Y"));
  div('', 'timeline');
  cpanel();


?>
  
  <script type="text/javascript">
  google.charts.load("current", {packages:["timeline"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    
    var container = document.getElementById('timeline');
    var chart = new google.visualization.Timeline(container);
    var dataTable = new google.visualization.DataTable();
    dataTable.addColumn({ type: 'string', id: 'Matrícula' });
    dataTable.addColumn({ type: 'string', id: 'Voo' });
    dataTable.addColumn({ type: 'date', id: 'Partida' });
    dataTable.addColumn({ type: 'date', id: 'Chegada' });
    dataTable.addRows([
      <?= $values ?>
    ]);

    var options = {
      timeline: { colorByRowLabel: true },
      
    };

    chart.draw(dataTable, options);
  }

</script>
