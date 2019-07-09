<?php
// FUNÇÕES PARA DASHBOARD

function numero_prob_sev_1()
{ 
	$db = new db();
	$total_consulta=$db->table("select count(*) as total from relprev where classificacao_emergencia = '1A - Desprezível/Frequente'");
	return retorna_total($total_consulta);
}



function contas_bancarias() 
{	
	$valor = valor_total_contas();
	$color = ($valor >= 0) ? 'success' : 'danger';
	$db = new db();
	$contas = $db->table("SELECT * FROM contas_bancarias WHERE empresa = " . session('empresa'));

	$line = '';

	foreach($contas as $c)
	{
			$color = (valor_em_conta($c->id) >= 0) ? 'success' : 'danger';
			$line .= '<tr>
						<td class="kv-key">
						'.$c->nome.'
						</td>
						<td class="text-'.$color.'"><div class="pull-right"> R$ ' . moeda_real(valor_em_conta($c->id)) . '</div></td>
                	  </tr>';
		
	}

	echo '<a href="'.BASE.'financeiro/caixas" style="text-decoration:none;"><div class="portlet portlet-boxed">
	    	<div class="portlet-header text-center">
              <h4 class="portlet-title">SALDO</h4>
            </div>
            <div class="portlet-body">
              <table class="table keyvalue-table">
				<tbody>
					'.$line.'
                </tbody>
							</table>
							<div class="text-center" style="margin-top: 15px;">
								<h5 class="text-'.$color.'">Total: R$  '.moeda_real(valor_total_contas()).'</h5>
							</div>
            </div>
          </div></a>';

}

function previsao_financeira() 
{	
	$valor = previsao_financeira_mensal();
	$color = ($valor >= 0) ? 'success' : 'danger';
	$db = new db();
	$contas = $db->table("SELECT * FROM contas_bancarias WHERE empresa = " . session('empresa'));

	$line = '';

	foreach($contas as $c)
	{
			
			$color = (previsao_por_conta($c->id) >= 0) ? 'success' : 'danger';
		
			$line .= '<tr>
				    <td class="kv-key">
					'.$c->nome.'
				    </td>
		                    <td class="text-'.$color.'"><div class="pull-right"> R$ ' . moeda_real(previsao_por_conta($c->id)) . '</div></td>
                	  </tr>';
		
	}

	echo '<div class="portlet portlet-boxed">
	    <div class="portlet-header text-center">
              <h4 class="portlet-title center">
               PREVISÃO DE SALDO
              </h4>
            </div>
            <div class="portlet-body">
              <table class="table keyvalue-table">
		<tbody>
		'.$line.'
		
                </tbody>
							</table>
							<div class="text-center" style="margin-top: 15px;">
								<h5 class="text-'.$color.'">Total: R$  '.moeda_real(previsao_financeira_mensal()).'</h5>
							</div>
            </div>
          </div>';

}

function valor_em_conta($conta)
{
	$db = new db();
	$soma_receita = $db->table("SELECT sum(valor_pago) as total FROM movimentos WHERE tipo = 'receita' AND banco = " . $conta);
	
	foreach($soma_receita as $sm) 
	{
	  $receita = $sm->total;
	}

	
	$soma_despesa = $db->table("SELECT sum(valor_pago) as total FROM movimentos WHERE tipo ='despesa' AND banco = ". $conta);

	foreach($soma_despesa as $sd)
	{
		$despesa = $sd->total;
	}	
	
	return $receita - $despesa;
}

function previsao_por_conta($conta, $data_inicial = null, $data_final = null)
{
	$db = new db();

	if(empty($data_inicial)) 
	{
		$data_inicial = date("Y-m") . "-01";
	}
	
	if(empty($data_final)) 
	{
		$data_final = date("Y-m") . "-31";
	}



	$soma_receita = $db->table("SELECT sum(valor) as total FROM movimentos WHERE data_vencimento >= '".$data_inicial."' AND data_vencimento <= '".$data_final."'  AND tipo = 'receita' AND banco = " . $conta);
	
	foreach($soma_receita as $sm) 
	{
	  $receita = $sm->total;
	}

	
	$soma_despesa = $db->table("SELECT sum(valor) as total FROM movimentos WHERE data_vencimento >= '".$data_inicial."' AND data_vencimento <= '".$data_final."' AND tipo ='despesa' AND banco = ". $conta);


	foreach($soma_despesa as $sd)
	{
		$despesa = $sd->total;
	}	
	
	return $receita - $despesa;
}

function valor_total_contas()
{
	$db = new db();
	$total_despesa = $db->table("SELECT sum(valor_pago) as total FROM movimentos WHERE tipo= 'despesa' AND empresa = " .  session('empresa'));
	$total_receita = $db->table("SELECT sum(valor_pago) as total FROM movimentos WHERE tipo= 'receita' AND empresa = " .  session('empresa'));
	

	foreach($total_despesa as $td)
	{
		$saldo_despesa = $td->total;
	}

	foreach($total_receita as $t)
	{
		$saldo_receita = $t->total;
	}


	$saldo = $saldo_receita - $saldo_despesa;
	return $saldo;

}

function previsao_financeira_mensal($data_inicial = null, $data_final = null) 
{
	$db = new db();

	if(empty($data_inicial)) 
	{
		$data_inicial = date("Y-m") . "-01";
	}
	
	if(empty($data_final))
	{
		$data_final = date("Y-m") . "-31";
	}

	$total_despesa =  $db->table("SELECT SUM(valor) as total FROM movimentos WHERE data_vencimento >= '".$data_inicial."' AND data_vencimento <= '".$data_final."'  AND tipo = 'despesa' AND empresa = " .session('empresa'));
	$total_receita =  $db->table("SELECT SUM(valor) as total FROM movimentos WHERE data_vencimento >= '".$data_inicial."' AND data_vencimento <= '".$data_final."'  AND tipo = 'receita' AND empresa = " .session('empresa'));

	foreach($total_despesa as $td)
	{
		$total_despesa = $td->total;
	}

	foreach($total_receita as $tr)
	{
		$total_receita = $tr->total;
	}

	return $total_receita - $total_despesa;


}

function despesa_mensal($mes) 
{	
	$db = new db();

	$data_inicial = date("Y") . "-" . $mes. "-01";
	$data_final = date("Y") . "-" . $mes. "-31";
	$total =  $db->table("SELECT SUM(valor) as total FROM movimentos WHERE data_vencimento >= '".$data_inicial."' AND data_vencimento <= '".$data_final."'  AND tipo = 'despesa' AND empresa = " .session('empresa'));

	foreach($total as $t)
	{
		$total_final = $t->total;
	}

	if($total_final > 0) {
		return $total_final;

	}

	return 0.00;
}

function receita_mensal($mes) 
{	

	$db = new db();

	if(empty($data_inicial)) 
	{
		$data_inicial = date("Y") . "-" . $mes. "-01";
	}
	
	if(empty($data_final))
	{
		$data_final = date("Y") . "-" . $mes. "-31";
	}

	$total =  $db->table("SELECT SUM(valor) as total FROM movimentos WHERE data_vencimento >= '".$data_inicial."' AND data_vencimento <= '".$data_final."'  AND tipo = 'receita' AND empresa = " .session('empresa'));

	foreach($total as $t)
	{
		$total_final = $t->total;
	}

	if($total_final > 0) {
		return $total_final;

	}

	return 0.00;
}















