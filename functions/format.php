<?php

function retorna_regra($regra)
{
    if ($regra == 'super-admin') {
        return 'Super Administrador';
    }
    if ($regra == 'super-usuario') {
        return 'Administrador';
    }
    if ($regra == 'usuario') {
        return 'Usuário';
    }
    return $regra;
}

function retorna_revisado($v)
{
    if ($v == 0) {
        return "NÃO";
    }
    if ($v == 1) {
        return 'SIM';
    }
    return $v;
}

function retorna_aprovado($v)
{
    if ($v == 0) {
        return "NÃO";
    }
    if ($v == 1) {
        return 'SIM';
    }
    return $v;
}

function retorna_autorizado($v)
{
    if ($v == 0) {
        return "NÃO";
    }
    if ($v == 1) {
        return 'SIM';
    }
    return $v;
}

function retorna_analizado($v)
{
    if ($v == 0) {
        return "NÃO";
    }
    if ($v == 1) {
        return 'SIM';
    }
    return $v;
}

function retorna_sim_nao($v)
{
    if ($v == 0) {
        return "<span class='label label-danger'> NÃO </span>";;
    }
    if ($v == 1) {
        return  "<span class='label label-success'> SIM </span>";
    }
    return $v;
}

function data_en($dateSql)
{

    if ($dateSql) {
        $ano = substr($dateSql, 6);
        $mes = substr($dateSql, 3, -5);
        $dia = substr($dateSql, 0, -8);
        return $ano . "-" . $mes . "-" . $dia;
    }

    return $dateSql;
}

function data_br($data)
{
    if ($data > '1970-01-01') {
        return date("d/m/Y", strtotime($data));
    }

}

function data_br_completa($data)
{
    return date("d/m/Y H:i:s", strtotime($data));
}


function nome_select($modulo, $chave, $id)
{
    $database = new db();
    $value = $database->row('SELECT * FROM selects WHERE modulo ="' . $modulo . '" and chave="' . $chave . '" AND id = ' . $id);
    return $value->nome;
}

function retorna_nome_usuario($id)
{
    $database = new db();
    $value = $database->row('SELECT *  FROM chefias WHERE id = ' . $id);
    return $value->nome;
}

function retorna_avaliacao($task)
{
    $db = new db();
    $result = $db->row('SELECT * FROM tasks_avaliacoes WHERE task = '. $task);

    if($result && $result->estrelas == 1) {
        echo '<img src="'.BASE.'public/imagens/triste.png" width="50">';
    }

    elseif($result && $result->estrelas == 2) {
        echo '<img src="'.BASE.'public/imagens/neutro.png" width="50">';
    }

    elseif($result && $result->estrelas == 3) {
        echo '<img src="'.BASE.'public/imagens/feliz.png" width="50">';
	} 
	
	else {
		return false;
	}
}


function retorna_status_orden($o)
{
    if ($o == 'solicitacao') {   return "Solicitação"; }
    if ($o == 'orcamento') {   return "Orçamento"; }
    if ($o == 'pedido') {   return "Pedido"; }
    if ($o == 'concluido') {   return "Concluído"; }
   
}

function retorna_tarefa_status($status)
{   
    
    if ($status == 'aberta') {
        return "<span class='label label-danger'> Aberta </span>";
    }
    if ($status == 'fechada') {
        return "<span class='label label-success'> Fechada </span>";
    }
    if ($status == 'aberto') {
        return "<span class='label label-danger'> Aberto </span>";
    }
    if ($status == 'pago') {
        return "<span class='label label-success'> Pago </span>";
    }

    if ($status == 'Aberto') {
        return "<span class='label label-primary'> Aberto </span>";
    }

    if ($status == 'Concluído') {
        return "<span class='label label-success'> Concluído </span>";
    }

    if ($status == 'recebido') {
        return "<span class='label label-success'> Recebido / Entregue </span>";
    } 

    if ($status == 'pendente') {
        return "<span class='label label-danger'> Pendente </span>";
    }

    if ($status == 'ativo') {
        return "<span class='label label-primary'> Ativo </span>";
    }

    if ($status == 'inativo') {
        return "<span class='label label-danger'> Inativo </span>";
    }

    if ($status == 'Confirmado') {
        return "<span class='label label-success'> Confirmado </span>";
    }
}

function retorna_tipo($status, $recorrente = null)
{   

    $recorrente_string = ($recorrente) ? ' recorrente' : '';
    if ($status == 'receita') {
        return "<span class='label label-success'> Receita ".$recorrente_string."</span>";
    }

    if ($status == 'despesa') {
        return "<span class='label label-danger'> Despesa ".$recorrente_string."</span>";
    }

    if ($status == 'Saída') {
        return "<span class='label label-danger'> Saída </span>";
    }

    if ($status == 'pedido') {
        return "<span class='label label-primary'> Pedido </span>";
    }

    if ($status == 'compra') {
        return "<span class='label label-success'> Compra </span>";
    }

    if ($status == 'orcamento') {
        return "<span class='label label-secondary'> Orçamento </span>";
    }

    if ($status == 'Entrada') {
        return "<span class='label label-success'> Entrada </span>";
    }

    if ($status == 'venda') {
        return "<span class='label label-success'> Venda </span>";
    } 

    if ($status == 'liquido') {
        return "<span class='label label-secondary'> Líquido </span>";
    } 

    if ($status == 'massa') {
        return "<span class='label label-secondary'> Massa </span>";
    } 

    if ($status == 'distancia') {
        return "<span class='label label-secondary'> Distância </span>";
    } 

    if ($status == 'metereologia') {
        return "<span class='label label-secondary'> Metereologia </span>";
    } 

    if ($status == 'moeda') {
        return "<span class='label label-secondary'> Moeda </span>";
    } 

  
}

function moeda_real($valor)
{
    if (!empty($valor)) {
        return number_format($valor, 2, ',', '.');
    }

    return '0';
}


function retorna_task_status ($status) 
{

	if($status == 'aberta') { return '<span class="label label-warning"> Aberta </span>';}
	if($status == 'fechada') { return '<span class="label label-success"> Fechada </span>';}
	if($status == 'reaberta') { return '<span class="label label-danger"> Reaberta </span>';}
}

function retorna_task_status_pdf ($status)
{

    if($status == 'aberta') { return 'Aberta';}
    if($status == 'fechada') { return 'Fechada';}
    if($status == 'reaberta') { return 'Reaberta';}
}

function moeda_real_virgula($valor)
{
    if ($valor) {
        return number_format($valor, 2, ',', '');
    }

    return '0,00';
}

function moeda_dollar($valor)
{

    if ($valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor;
    }
    return 0.00;
}

function ultimo_dia($data)
{
    $mes = date("m", strtotime($data));
    $ano = date("Y", strtotime($data));
    $ultimo_dia = date("t", mktime(0, 0, 0, $mes, '01', $ano));
    return $ultimo_dia;
}

function gera_parcelamento($f)
{
    if($f == "mensal") {
        $dt = explode("-", data_en(post('data_vencimento')));
        $DP = Array($dt[0], $dt[1], $dt[2]);
        $parcelas = post('parcela');
        $data_array = Array($DP[0], $DP[1], $DP[2]);
        $data_array2 = Array($DP[0], $DP[1], $DP[2]);
        $n = $data_array[1] - 1;
        $v_i = $n;

        for ($i = 0; $i < $parcelas; $i++) {
            $v_i++;

            $v = strtotime('+' . $i . ' month', strtotime(implode("-", $data_array)));
            $v2 = strtotime('+' . $i . ' month', strtotime(implode("-", $data_array2)));
            $nd = date('Y-m-d', $v);
            $nd2 = date('Y-m-d', $v2);
            $p = explode("-", $nd);

            $base_mes = date("Y-m-t", strtotime($nd));
            $forma_data = $p[0] . '-' . $v_i . '-01';
            $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
            $b1 = explode("-", $base_mes);
            $b2 = explode("-", $ultimo_dia_do_mes);
            if ($b1[2] != $b2[2]) {
                $vencimento =  "{$b2[0]}-{$b2[1]}-{$b2[2]}";
            } else {
                $vencimento = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
            }

            $db = new db();
            $mid = $db->insert('movimentos', copy_post());
            $update = [
                'valor_pago' => moeda_dollar(post('valor_pago')),
                'valor' => moeda_dollar(post('valor')),
                'data_vencimento' => $vencimento,
                'data_pagamento' => data_en(post('data_pagamento')),
                'parcela' => $i + 1,
            ];

            $db->update('movimentos', $update, ['id' => $mid]);
        }
    }

        if($f == "anual") {

            $dt = explode("-", data_en(post('data_vencimento'))); //2019-03-30
            $DP = Array($dt[0], $dt[1], $dt[2]); 
            $parcelas = post('parcela');
            $data_array = Array($DP[0], $DP[1], $DP[2]);
            $data_array2 = Array($DP[0], $DP[1], $DP[2]);
            $n = $data_array[1];
            $v_i = $n;
    
            for ($i = 0; $i < $parcelas; $i++) {
                
                $v = strtotime('+' . $i . ' year', strtotime(implode("-", $data_array)));
                $v2 = strtotime('+' . $i . ' year', strtotime(implode("-", $data_array2)));
                $nd = date('Y-m-d', $v);
                $nd2 = date('Y-m-d', $v2);
                $p = explode("-", $nd);
    
                $base_mes = date("Y-m-t", strtotime($nd));
                $forma_data = $p[0] . '-' . $v_i . '-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes);
                $b2 = explode("-", $ultimo_dia_do_mes);
                if ($b1[2] != $b2[2]) {
                    $vencimento =  "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $vencimento = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
                }
    
                $db = new db();
                $mid = $db->insert('movimentos', copy_post());
                $update = [
                    'valor_pago' => moeda_dollar(post('valor_pago')),
                    'valor' => moeda_dollar(post('valor')),
                    'data_vencimento' => $vencimento,
                    'data_pagamento' => data_en(post('data_pagamento')),
                    'parcela' => $i + 1,
                ];
    
                $db->update('movimentos', $update, ['id' => $mid]);
            }
        }
    }

    function gera_parcelamento_ordem($f, $idordem, $tp)
    {
        if($f == "mensal") {
            $dt = explode("-", data_en(post('data_vencimento')));
            $DP = Array($dt[0], $dt[1], $dt[2]);
            $parcelas = post('parcela');
            $data_array = Array($DP[0], $DP[1], $DP[2]);
            $data_array2 = Array($DP[0], $DP[1], $DP[2]);
            $n = $data_array[1] - 1;
            $v_i = $n;

            for ($i = 0; $i < $parcelas; $i++) {
                $v_i++;

                $v = strtotime('+' . $i . ' month', strtotime(implode("-", $data_array)));
                $v2 = strtotime('+' . $i . ' month', strtotime(implode("-", $data_array2)));
                $nd = date('Y-m-d', $v);
                $nd2 = date('Y-m-d', $v2);
                $p = explode("-", $nd);

                $base_mes = date("Y-m-t", strtotime($nd));
                $forma_data = $p[0] . '-' . $v_i . '-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes);
                $b2 = explode("-", $ultimo_dia_do_mes);
                if ($b1[2] != $b2[2]) {
                    $vencimento =  "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $vencimento = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
                }

                $db = new db();
                $mid = $db->insert('movimentos', copy_post());

                $update = [
                    'valor_pago' => moeda_dollar(post('valor_pago')),
                    'valor' => moeda_dollar(post('vtotal')),
                    'data_vencimento' => $vencimento,
                    'data_pagamento' => data_en(post('data_pagamento')),
                    'parcela' => $i + 1,
                    'ordem' => $idordem,
                    'tipo' => ($tp == 'compra') ? 'despesa' : 'receita',
                ];

                $db->update('movimentos', $update, ['id' => $mid]);
            }
        }

            if($f == "anual") {

                $dt = explode("-", data_en(post('data_vencimento'))); //2019-03-30
                $DP = Array($dt[0], $dt[1], $dt[2]); 
                $parcelas = post('parcela');
                $data_array = Array($DP[0], $DP[1], $DP[2]);
                $data_array2 = Array($DP[0], $DP[1], $DP[2]);
                $n = $data_array[1];
                $v_i = $n;
        
                for ($i = 0; $i < $parcelas; $i++) {
                    
                    $v = strtotime('+' . $i . ' year', strtotime(implode("-", $data_array)));
                    $v2 = strtotime('+' . $i . ' year', strtotime(implode("-", $data_array2)));
                    $nd = date('Y-m-d', $v);
                    $nd2 = date('Y-m-d', $v2);
                    $p = explode("-", $nd);
        
                    $base_mes = date("Y-m-t", strtotime($nd));
                    $forma_data = $p[0] . '-' . $v_i . '-01';
                    $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                    $b1 = explode("-", $base_mes);
                    $b2 = explode("-", $ultimo_dia_do_mes);
                    if ($b1[2] != $b2[2]) {
                        $vencimento =  "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                    } else {
                        $vencimento = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
                    }
        
                    $db = new db();
                    $mid = $db->insert('movimentos', copy_post());
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('vtotal')),
                        'data_vencimento' => $vencimento,
                        'data_pagamento' => data_en(post('data_pagamento')),
                        'parcela' => $i + 1,
                        'ordem' => $idordem,
                        'tipo' => ($tp == 'compra') ? 'despesa' : 'receita',
                    ];
        
                    $db->update('movimentos', $update, ['id' => $mid]);
            }
    }
}


function formatarCnpj($cnpj_cpf)
{
  if (strlen(preg_replace("/\D/", '', $cnpj_cpf)) === 11) {
    $response = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
  } else {
    $response = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
  }

  return $response;
}



