<?php
    row();
        col(6);
            voos_diarios();
        cdiv();
    cdiv();


?>


<!--<div class="row">
    <div class="col-md-6">
        <div class="portlet portlet-boxed">

            <div class="portlet-header">
                <h4 class="portlet-title">
                    Matriz de Risco
                </h4>
            </div> 

            <div class="portlet-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#Probabilidade/Severidade</th>
                            <th>Desprezível</th>
                            <th>Baixo</th>
                            <th>Alto</th>
                            <th>Perigoso</th>
                            <th>Catastrófico</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td scope="row">Frequente</td>
                            <?php
							$total_ps1=numero_prob_sev_1();
							if($total_ps1<10){$c="bg-success";} else{$c="bg-danger";}
						?>
                            <td class="<?=$c?>"><?=$total_ps1?></td>
                            <td>Ocasional</td>
                            <?php
							$total_ps1=numero_prob_sev_1	();
							if($total_ps1<10){$c="bg-success";} else{$c="bg-danger";}
						?>
                            <td>Remota/td>
                                <?php
							$total_ps1=numero_prob_sev_1();
							if($total_ps1<10){$c="bg-success";} else{$c="bg-danger";}
						?>
                            <td>Improvável/td>
                                <?php
							$total_ps1=numero_prob_sev_1();
							if($total_ps1<10){$c="bg-success";} else{$c="bg-danger";}
						?>
                        </tr>

                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>

                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>

            </div> 

        </div> 
    </div> -->