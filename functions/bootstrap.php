<?php

function ptable($title)
{
    echo '<div class="portlet portlet-boxed portlet-table">
    <div class="portlet-header">
    <h4 class="portlet-title">
    <u>' . $title . '</u>
    </h4>
    </div>
    <div class="portlet-body">';

}

function opanel($title)
{
    echo '<div class="portlet portlet-boxed">
    <div class="portlet-header">
    <h4 class="portlet-title">
    ' . $title . '
    </h4>
    </div> 
    <div class="portlet-body" style="padding: 15px;">';
}

function cpanel()
{
    echo '</div> 
    </div>';
}

function div($class = null, $id = null)
{
    echo '<div class="' . $class . '" id="' . $id . '">';
}

function text_info($label, $text)
{
    echo '<div class="font-weight-bold mb-1">' . $label .  $text . '</div>';
}

function row()
{
    echo '<div class="row">';
}

function col($n)
{
    echo '<div class="col-md-' . $n . '">';
}

function cdiv()
{
    echo '</div>';
}

function img($src, $width = null, $class = null)
{
    $w = (isset($width)) ? 'width="' . $width . '"' : '';
    $c = (isset($class)) ? 'class="' . $class . '"' : '';
    echo '<img src="' . PUBLIC_URL . $src . '" '. $w . $c . '>';
}

function img_pub($src, $width = null, $class = null)
{
    $w = (isset($width)) ? 'width="' . $width . '"' : '';
    $c = (isset($class)) ? 'class="' . $class . '"' : '';
    echo '<img src="' . PUBLIC_UPLOAD . $src . '" '. $w . $c . '>';
}


function p($p, $class = null, $id = null, $style = null)
{
    echo "<p class='".$class."' style='".$style."' id='".$id."'>" . $p . "</p>";
}

function br()
{
    echo "<br><br>";
}

function hr()
{
    echo "<hr>";
}


function a($name, $link, $class = '')
{
    echo '<a href="' . BASE . $link . '" class="' . $class . '" id="'.$name.'" style="margin-right: 5px;">' . $name . '</a>';
}


function datatable($id, $header = [], $fields = [], $data = [], $buttons = true)
{
    $th = '';
    foreach ($header as $h) {
        $th .= "<th>" . $h . "</th>";
    }

    if ($buttons) {
        $th .= "<th> - </th>";
    }

    $tr = '';

    foreach ($data as $d) {
        $tr .= "[";
        foreach ($fields as $f) {
            if ($f == 'regra') {
                $tr .= '"' . retorna_regra($d->$f) . '",';
            } elseif ($f == 'revisado') {
                $tr .= '"' . retorna_revisado($d->$f) . '",';
            } elseif ($f == 'aprovado') {
                $tr .= '"' . retorna_aprovado($d->$f) . '",';
            } 
            
            elseif ($f == 'autorizado') {
                $tr .= '"' . retorna_autorizado($d->$f) . '",';
            } 
            
            elseif ($f == 'valor') {
                $tr .= '" R$ ' . moeda_real($d->$f) . '",';
            } 

            elseif ($f == 'pdv_nome') {
                $tr .= '"a",';
            } 
            
            elseif ($f == 'valor_padrao') {
                $tr .= '" R$ ' . moeda_real($d->$f) . '",';
            } 
            
            elseif ($f == 'preco') {
                $tr .= '" R$ ' . moeda_real($d->$f) . '",';
            }
            elseif ($f == 'valor_total') {
                $tr .= '" R$ ' . moeda_real($d->$f) . '",';
            } elseif ($f == 'valor_pago') {
                $tr .= '" R$ ' . moeda_real($d->$f) . '",';
            } elseif ($f == 'vtotal') {

                $db = new db();

                $calculo = $db->table("
                        SELECT sum(a.valor_total) / sum(a.quantidade) as valor_total FROM ordens_produtos a, ordens b WHERE b.movimento='compra' AND b.empresa= ".session('empresa')." AND a.orden = b.id AND a.produto = " . $d->id);

                foreach ($calculo as $c) {
                    $valor_total = $c->valor_total;
                }


                $tr .= '" R$ ' . moeda_real($valor_total) . '",';
            }

            elseif ($f == 'qtdcompra') {

                $db = new db();

                $calculo = $db->table("SELECT count(quantidade) as q FROM ordens_produtos INNER JOIN ordens ON ordens.id = ordens_produtos.orden AND ordens.movimento = 'compra' AND ordens.empresa = ".session('empresa')." WHERE produto = ". $d->id);

                foreach ($calculo as $c) {
                    $qtd = $c->q;
                }

                $tr .= '"' . $qtd . '",';

            } elseif ($f == 'qtdvenda') {

                $db = new db();

                $calculo = $db->table("SELECT count(quantidade) as q FROM ordens_produtos INNER JOIN ordens ON ordens.id = ordens_produtos.orden AND ordens.movimento = 'venda' AND ordens.empresa = ".session('empresa')." WHERE produto = ". $d->id);

                foreach ($calculo as $c) {
                    $qtd = $c->q;
                }

                $tr .= '"' . $qtd . '",';

            }
            elseif ($f == 'vtotalvenda') {

                $db = new db();

                $calculo = $db->table("
                        SELECT sum(a.valor_total) / sum(a.quantidade) as valor_total FROM ordens_produtos a, ordens b WHERE b.movimento='venda' AND b.empresa= ".session('empresa')." AND a.orden = b.id AND a.produto = " . $d->id);

                foreach ($calculo as $c) {
                    $valor_total = $c->valor_total;
                }


                $tr .= '" R$ ' . moeda_real($valor_total) . '",';
            } elseif ($f == 'plucro') {

                $db = new db();

                $calculo = $db->table("SELECT sum(a.valor_total) / sum(a.quantidade) as valor_total FROM ordens_produtos a, ordens b WHERE b.movimento='compra' AND b.empresa= ".session('empresa')." AND a.orden = b.id AND a.produto = " . $d->id);

                foreach ($calculo as $c) {
                    $valor_total = $c->valor_total;
                }

                $calculo2 = $db->table("SELECT sum(a.valor_total) / sum(a.quantidade) as valor_total FROM ordens_produtos a, ordens b WHERE b.movimento='venda' AND b.empresa= ".session('empresa')." AND a.orden = b.id AND a.produto = " . $d->id);

                foreach ($calculo2 as $c2) {
                    $valor_total2 = $c2->valor_total;
                }

                if($valor_total == 0 || $valor_total2 == 0) {
                    $lucro = 0.00;
                } else {
                    $gap = $valor_total2 / $valor_total;

                    // GAP PARA AJUSTE DE PORCENTAGEM
                    #if($gap < 2){
                        $gap = $gap -1;
                    #}
                    $lucro = $gap * 100;
                }



                $tr .= '"'.round($lucro,2).'%",';
            } elseif ($f == 'data_vencimento') {
                $tr .= '"' . data_br($d->$f) . '",';
            } elseif ($f == 'data') {
                $tr .= '"' . data_br($d->$f) . '",';
            } elseif ($f == 'tipo') {
                $tr .= '"' . retorna_tipo($d->$f, (!empty($d->recorrente)) ? $d->recorrente : '') . '",';
            } elseif ($f == 'data_criacao') {
                $tr .= '"' . data_br_completa($d->$f) . '",';
            } elseif ($f == 'data_final') {
                $tr .= '"' . data_br($d->$f) . '",';
            } elseif ($f == 'data_lancamento') {
                $tr .= '"' . data_br($d->$f) . '",';
            } elseif ($f == 'data_cadastro') {
                $tr .= '"' . data_br($d->$f) . '",';
            } elseif ($f == 'data_pagamento') {
                $tr .= '"' . data_br($d->$f) . '",';
            } elseif ($f == 'status') {
                $tr .= '"' . retorna_tarefa_status($d->$f) . '",';
            } elseif ($f == 'ativo') {
                    $tr .= '"' . retorna_sim_nao($d->$f) . '",';
            } else {
                $tr .= '"' . $d->$f . '",';
            }

        }

        if ($buttons) {
            $tr .= '"';
            if (!empty($buttons['draw'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['draw'] . "=" . $d->id . "' title='Configurar Desenho de Peso e Balanceamento'><i class='fa fa-paper-plane fa-lg'></i> </a>";
            }

            if (!empty($buttons['carteira'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['carteira'] . "=" . $d->id . "' title='Adicionar habilitação'><i class='fa fa-id-card-o fa-lg'></i> </a>";
            }

            if (!empty($buttons['plano_voo'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['plano_voo'] . "=" . $d->id . "' title='Adicionar Plano de Voo'><i class='fa fa-map-o fa-lg'></i> </a>";
            }

            if (!empty($buttons['passageiros'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['passageiros'] . "=" . $d->id . "' title='Gerenciar passageiros'><i class='fa fa-users fa-lg'></i> </a>";
            }

            if (!empty($buttons['tripulacao'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['tripulacao'] . "=" . $d->id . "' title='Gerenciar tripulação'><i class='fa fa-plane fa-lg'></i> </a>";
            }

            if (!empty($buttons['detalhes'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['detalhes'] . "=" . $d->id . "' title='Visualizar'><i class='fa fa-search fa-lg'></i> </a>";
            }
            if (!empty($buttons['download'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' target='_blank' href='" . $d->link . "' title='Baixar'><i class='fa fa-download fa-lg'></i> </a>";
            }
            if (!empty($buttons['editar'])) {
                if(isset($d->status) && $d->status == 'Concluído') {
                    $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['editar'] . "=" . $d->id . "' title='Visualizar'><i class='fa fa-search fa-lg'></i> </a>";
                } else {
                    $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['editar'] . "=" . $d->id . "' title='Editar'><i class='fa fa-edit fa-lg'></i> </a>";
                }
            }


            if (!empty($buttons['pdf'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['pdf'] . "=" . $d->id . "' title='Gerar PDF'><i class='fa fa-file fa-lg'></i> </a>";
            }

            if (!empty($buttons['email_modal'])) {
                $db = new Db;
                $email = $db->row("SELECT * FROM crm_empresas WHERE id = " . $d->cliente_fornecedor);
                $tr .= "<a style='text-decoration: none;margin-right: 2px;' data-email='" . $email->email . "' data-id='" . $d->id . "' id='mail' href='#email' data-toggle='modal' title='Enviar por e-mail'><i class='fa fa-envelope fa-lg'></i></a>";
            }

            if (!empty($buttons['deletar'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['deletar'] . "=" . $d->id . "' title='Excluir'><i class='fa fa-trash fa-lg'></i> </a>";
            }
          
            if (!empty($buttons['confirmar_pagamento'])) {
                if ($d->status == "aberto") {
                    $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['confirmar_pagamento'] . "=" . $d->id . "' title='Confirmar'><i class='fa fa-check fa-lg'></i> </a>";
                }
            }

            if (!empty($buttons['senha'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['senha'] . "=" . $d->id . "' title='Alterar senha'><i class='fa fa-key fa-lg'></i> </a>";
            }

            if (!empty($buttons['cancelar'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['cancelar'] . "=" . $d->id . "' title='Excluir'><i class='fa fa-ban fa-lg'></i> </a>";
            }


            if (!empty($buttons['inativar'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['inativar'] . "=" . $d->id . "' title='Inativar documento'><i class='fa fa-ban fa-lg'></i> </a>";
            }

          

            if (!empty($buttons['concluir'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['concluir'] . "=" . $d->id . "' title='Concluír'><i class='fa fa-check fa-lg'></i> </a>";
            }

           

            $tr .= '",';
        }
        $tr .= "],";
    }

    echo '<div class="table-responsive"><table id="' . $id . '" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>' . $th . '</tr>
    </thead>
    </table></div>';

    echo '<script type="text/javascript">
    var data = [
    ' . $tr . '
    ]

    $("#' . $id . '").DataTable( {
        data: data
        } );
        </script>';
}


function table($id, $header = [], $fields = [], $data = [], $buttons = true)
{
    $th = '';
    foreach ($header as $h) {
        $th .= "<th>" . $h . "</th>";
    }

    if ($buttons) {
        $th .= "<th> - </th>";
    }

    $tr = '';

    foreach ($data as $d) {
        $tr .= "<tr>";
        foreach ($fields as $f) {
            if ($f == 'regra') {
                $tr .= '' . retorna_regra($d->$f) . '</td>';
            } 
            
            elseif($f == 'saldo')
            {
                $db = new Db();

                $sql = ' ';
                $sql .= " AND status = 'pago'"; 
                if(get('fconta')) 
                {
                    $sql .= " AND banco = '".get('fconta')."'";
                }

                $sql .= " ORDER BY data_vencimento"; 
                
                $valor_total_receitas = $db->table("SELECT sum(valor_pago) as total FROM movimentos WHERE tipo='receita' AND  data_vencimento <= '".$d->data_vencimento."'"  . $sql);

                foreach($valor_total_receitas as $vt) 
                {
                    $saldo = $vt->total;
                }

                $valor_total_despesas = $db->table("SELECT sum(valor_pago) as total FROM movimentos WHERE tipo='despesa' AND  data_vencimento <= '".$d->data_vencimento."'"  . $sql);

                foreach($valor_total_despesas as $vd) 
                {
                    $saldod = $vd->total;
                }


                $tr .= '<td> R$ ' . moeda_real($saldo - $saldod) . '</td>';

            }

            
            elseif ($f == 'nome_produto_ordem') {
                $db = new db();
                $orden = $db->row("SELECT * FROM ordens WHERE id = ". $d->orden);
                $tr .= '<td>';
                $tr .= $d->nome . '<br>';
                if($orden->tipo != 'pedido') {
                    $tr.= '<a class="text-success" href="'.BASE.'ordens/vincular?id='.$d->orden.'&p='.$d->id.'&c='.$d->codigo_produto.'">Vincular à outro produto cadastrado? </a>';
                }
                $tr .='</td>';
            }
            
            elseif ($f == 'revisado') {
                $tr .= '<td>' . retorna_revisado($d->$f) . '</td>';
            } elseif ($f == 'tipo') {
                $tr .= '<td>' . retorna_tipo($d->$f, $d->recorrente) . '</td>';
            } elseif ($f == 'aprovado') {
                $tr .= '<td>' . retorna_aprovado($d->$f) . '</td>';
            } elseif ($f == 'autorizado') {
                $tr .= '<td>' . retorna_autorizado($d->$f) . '</td>';
            } elseif ($f == 'analizado') {
                $tr .= '<td>' . retorna_analizado($d->$f) . '</td>';
            } elseif ($f == 'status') {
                $tr .= '<td>' . retorna_tarefa_status($d->$f) . '</td>';
            } elseif ($f == 'data') {
                $tr .= '<td>' . data_br($d->$f) . '</td>';
            } elseif ($f == 'data_vencimento') {
                $tr .= '<td>' . data_br($d->$f) . '</td>';
            } elseif ($f == 'valor') {
                $tr .= '<td> R$ ' . moeda_real($d->$f) . '</td>';
            } 

            elseif ($f == 'url') {
                $tr .= '<td> <a target="_blank" href="' . BASE . 'pdv/checkin?id='.$d->token.'">' . BASE . 'pdv/checkin?id='.$d->token.'</a></td>';
            } 

            elseif ($f == 'valor_total') {
                $tr .= '<td> R$ ' . moeda_real($d->$f) . '</td>';
            }
            elseif ($f == 'valor_pago') {
                $tr .= '<td>' . moeda_real($d->$f) . '</td>';
            } elseif ($f == 'data_pagamento') {
                $tr .= '<td>' . data_br($d->$f) . '</td>';
            } elseif ($f == 'data_final') {
                $tr .= '<td>' . data_br($d->$f) . '</td>';
            } elseif ($f == 'pdv_nome') {
                $db = new db();
                $pro = $db->row("SELECT * FROM ordens_produtos WHERE id = " . $d->id);

                if($pro->produto > 0) {
                    $produto = $db->row("SELECT * FROM produtos WHERE id = " . $pro->produto);
                    $tr .= '<td>'.$produto->nome.'</td>';
                }

                if($pro->voo > 0) {
                    $voo = $db->row("SELECT * FROM voos WHERE id = " . $pro->voo);
                    $tr .= '<td> VOO: '.$voo->id.'</td>';
                }
                
                
            } else {
                $tr .= '<td>' . $d->$f . '</td>';
            }

        }
        if ($buttons) {
            $tr .= '<td>';
            if (!empty($buttons['detalhes'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['detalhes'] . "=" . $d->id . "' title='Visualizar'><i class='fa fa-search fa-lg'></i> </a>";
            }
            if (!empty($buttons['download'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' target='_blank' href='" . $d->link . "' title='Baixar'><i class='fa fa-download fa-lg'></i> </a>";
            }
            if (!empty($buttons['confirmar_pagamento'])) {
                if ($d->status == "aberto") {
                    $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['confirmar_pagamento'] . "=" . $d->id . "' title='Confirmar'><i class='fa fa-check fa-lg'></i> </a>";
                }
            }
            if (!empty($buttons['editar'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['editar'] . "=" . $d->id . "' title='Editar'><i class='fa fa-edit fa-lg'></i> </a>";
            }
            if (!empty($buttons['cancelar'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['cancelar'] . "=" . $d->id . "' title='Cancelar documento'><i class='fa fa-ban fa-lg'></i> </a>";
            }
            if (!empty($buttons['deletar'])) {
                $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['deletar'] . "=" . $d->id . "' title='Excluir'><i class='fa fa-trash fa-lg'></i> </a>";
            }
            if (!empty($buttons['concluir'])) {
                if ($d->status == "aberta") {
                    $tr .= "<a style='text-decoration: none; margin-right: 2px;' href='" . BASE . $buttons['concluir'] . "=" . $d->id . "' title='Concluir'><i class='fa fa-check fa-lg'></i> </a>";
                }
            }
            $tr .= '</td>';
        }
        $tr .= "</tr>";
    }

    echo '<div class="table-responsive"><table id="' . $id . '" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>' . $th . '</tr>
        </thead>
        <tbody>
        ' . $tr . '
        </tbody>
        </table></div>';
}

function modal_link($name, $modal, $class = "btn btn-primary")
{
    echo '<a style="margin-right: 5px;" data-toggle="modal" href="#' . $modal . '" class="' . $class . '">' . $name . '</a>';
}

function omodal($title, $id, $c = null)
{
    echo '<div id="' . $id . '" class="modal modal-styled">
        <div class="modal-dialog ' . $c . '">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">' . $title . '</h3>
        </div> 
        <div class="modal-body">';
}


function cmodal()
{
    echo '
        </div> 
        </div>
        </div>
        </div>';
}

function dashboard_count($name, $value, $ico, $link, $color = null)
{   

    $color = ($color) ? 'style="color: '.$color.'"' : '';


    echo '
        <a href="'.BASE.$link.'">
        <div class="icon-stat">
        <div class="row">
        <div class="col-xs-12 text-left">
        <span class="icon-stat-label text-center">'  . $name . '</span> 
        <span class="icon-stat-value text-center" '.$color.' >' . $value . '</span> 
        </div>
        </div>
        </div>
        </a>
        ';
}

function dashboard_count_nota($name, $value, $ico, $id, $link, $color = null)
{   

    $color = ($color) ? 'style="color: '.$color.'"' : '';


    echo '
        <a href="'.BASE.$link.'">
        <div class="icon-stat">
        <div class="row">
        <div class="col-xs-12 text-left">
        <span class="icon-stat-label text-center">'  . $name . '</span> 
        <span id="'.$id.'" class="icon-stat-value text-center" '.$color.' >' . $value . '</span> 
        </div>
        </div>
        </div>
        </a>
        ';
}

function render_profile()
{
    $db = new db();
    $logo = $db->row('SELECT * FROM uploads WHERE modulo = "usuarios" AND modulo_key = ' . session('id') . ' ORDER BY id DESC');
    if (is_object($logo))
        return $logo->link;
    
    return null;
}

function render_logo()
{
    $db = new db();
    $empresa = $db->row('SELECT * FROM empresas WHERE id = 1');
    if(!$empresa) {
	echo 'Create a company';
    } else { 
        $logo = $db->row('SELECT * FROM uploads WHERE id = ' . $empresa->logo . ' ORDER BY id DESC');
        if(isset($logo->link)) {
        echo '<img width="150" src="' . $logo->link . '">';
        }
    }
}

function render_admin_logo()
{
    $db = new db();
    $empresa = $db->row('SELECT * FROM empresas WHERE id = 1');
    $logo = $db->row('SELECT * FROM uploads WHERE id = ' . $empresa->admin_logo . ' ORDER BY id DESC');
    if(isset($logo->link)) {
    echo '<img style="margin-top: 7px;" width="125" src="' . $logo->link . '">';
    }
}

function render_favicon()
{
    $db = new db();
    $empresa = $db->row('SELECT * FROM empresas WHERE id = 1');
    $fv = $db->row('SELECT * FROM uploads WHERE id = ' . $empresa->favicon . ' ORDER BY id DESC');
    if(isset($fv->link)) {
        echo '<link rel="shortcut icon" href="' . $fv->link . '">';
    }

}


function alert($type, $message)
{
    echo "<script>toastr." . $type . "('" . $message . "');</script>";
}

function line_chart($title)
{
    echo '<div class="portlet portlet-boxed">
		   <div class="portlet-header">
		        <h4 class="portlet-title"><u>' . $title . '</u></h4>
                   </div>
	           <div class="portlet-body">
        	      <div id="line-chart" class="chart-holder"></div>
            	   </div>
          </div>';
}


/**
 * Cria tabela de apresentacao de dados de meteorologia 
 * 
 * @param Options   $options  Parametros de configuração da tabela, seguem o seguinte padrão
 *                            options = { id : <id do datalist>,                                        
 *                                        info (opcional) : <informacoes extras>,    
 *                                        field_cod_icao : <campo input text vinculado para recuperar o valor do codigo ICAO para realizar a pesquisa>,
 *                                        api_url : <url da api de pesquisa de meteorologia do REDEMET>    
 *                                        field_hr : <parametro de hora para consulta da meteorologia>
 *                                        action : <botao para executar a ação de pesquisa>                                
 *                                        msg_metar : <field para armazenar a mensagem METAR>
 *                                        msg_taf : <field para armazenar a mensagem TAF>                          
 *                             }
 *  
 * @return datalist
 */
function meteorologia_table($options) {

    if ($options && array_key_exists('id', $options) && array_key_exists('field_cod_icao', $options) 
            && array_key_exists('api_url', $options) && array_key_exists('action', $options)) { 

        $info = array_key_exists('info', $options) ? $options['info'] : "";

        echo '
            <div id="' . $options['id'] . '" class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Clima para a região - <span id="' . $options['id'] . '_cod_icao" ></span> <span id="' . $options['id'] . '_nome_cidade" ></span> 
                    <button type="button" class="close" aria-label="Close" onClick="$(\'#' . $options['id'] . '\').hide(400);" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="panel-body">
                    <p id="'. $options['id'] .'_info" >' . $info . '</p>

                    <div id="'. $options['id'] . '_loading" style="margin: auto;  width: 10%; padding: 10px;" >
                        <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
                    </div>
                    
                    <div id="' . $options['id'] . '_msg_metar" >
                        <div >Mensagem METAR: <span  id="' . $options['id'] . '_metar" class="text-info" ></span> </div>                       
                    </div> 

                    <div id="' . $options['id'] . '_msg_taf" >
                        <div >Mensagem TAF: <span  id="' . $options['id'] . '_taf" class="text-info" ></span> </div>                       
                    </div>

                </div>

            </div>


            <script type="text/javascript" >

                $(function () {
                    $("#'. $options['id'] . '").hide();  
                    $("#'. $options['id'] . '_data_panel").hide();
                });

                $("#' . $options['action'] . '").click(function () {
                    
                    var aero = $("#' . $options['field_cod_icao'] . '").val();
                    var hr = $("#' . $options['field_hr'] . '").val();
                    $("#'. $options['id'] . '_loading").show();   
                    $("#'. $options['id'] . '_metar").html("");
                    $("#'. $options['id'] . '_taf").html("");

                    if (aero != "" && hr != "" && hr.length > 8) {

                        $("#'. $options['id'] . '_info").html("'. $options['info'] . '");
                        
                        aero = aero.split("-");

                        $("#'. $options['id'] . '_cod_icao").html(aero[0]);
                        $("#'. $options['id'] . '_nome_cidade").html(aero[1]);

                        $("#'. $options['id'] . '").show(500);
                        $.ajax({
                            type: "GET",
                            dataType: "TEXT",
                            url:"'.  $options['api_url'] . '",
                            data: { 
                                dataPesquisa: hr, 
                                icao: aero,
                            },
                            success: function(data) {

                                                         
                                if ( data != "") {
                                    var info = data.split("%%");                               
                                    $("#'. $options['id'] . '_metar").html(info[0]);
                                    $("#'. $options['id'] . '_taf").html(info[1]);

                                    $("#'. $options['msg_metar'] . '").val(info[0]);
                                    $("#'. $options['msg_taf'] . '").val(info[1]);

                                    $("#'. $options['id'] . '_loading").hide();
                                    $("#'. $options['id'] . '_msg_metar").show(300);
                                    $("#'. $options['id'] . '_msg_taf").show(300);
                                }                     
                            }
                        });
                    } else {
                        $("#'. $options['id'] . '").show(500);
                        $("#'. $options['id'] . '_info").html("<span class=\'text-danger\'>Não foi possível realizar a consulta, favor informar parâmetros corretamente (aerodromo Partida, Aerodromo Destino, Hora de Partida e EET Total).<span>");
                        $("#'. $options['id'] . '_loading").hide();
                    }
                    
                });

            </script>
        ';
    } else {
        echo '<span class="text-danger"> Erro: Não foi possível criar o Meteorologia Data componente. Options não definido.</span> <br/>';
    }
}

/**
 * Cria tabela de apresentacao de dados de NOTAM 
 * 
 * @param Options   $options  Parametros de configuração da tabela, seguem o seguinte padrão
 *                            options = { id : <id da tabela>,                                        
 *                                        api_url : <url da api de pesquisa de NOTAM>           
 *                                        field_cod_icao : <field com o paramentro para pesquisar os dados da tabela>   
 *                                        action : <botao para executar a acao de pesquisa>     
 *                                        tab_info : <field para armazenar a info para enviar ao BD, a informacao fica no forma data#hora_nascer_sol#hora_por_sol >               
 *                             }
 *  
 * @return table
 */
function porDoSol_table($options) {


    if ($options && array_key_exists('id', $options)) {

        echo '
                <div id="' . $options['id'] . '_por_do_sol" class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        Tabela de Por e Nascer do Sol - <span id="' . $options['id'] . '_cod_icao" ></span> <span id="' . $options['id'] . '_nome_cidade" ></span> 
                        <button type="button" class="close" aria-label="Close" onClick="$(\'#' . $options['id'] . '_por_do_sol\').hide(400);" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="panel-body">
                        <p id="'. $options['id'] .'_info" ></p>

                        <div id="'. $options['id'] . '_loading" style="margin: auto;  width: 10%; padding: 10px;" >
                            <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
                        </div>

                        <span style="font-weight: bold;">Data Referência:&nbsp;</span><span id="'. $options['id'] . '_dt_ref"></span><br>
                        <span style="font-weight: bold;">Nascer do Sol:&nbsp;</span><span id="'. $options['id'] . '_ns_sol"></span><br>
                        <span style="font-weight: bold;">Pôr do Sol:&nbsp;</span><span id="'. $options['id'] . '_pr_sol"></span><br>
                        <span style="font-weight: bold;">Dia da Semana:&nbsp;</span><span id="'. $options['id'] . '_dia_semana"></span>                    
                    </div>
                </div>
                
                <script type="text/javascript" >                    

                    $(function () {
                        $("#'. $options['id'] . '_por_do_sol").hide();  
                    });
                   
                    $("#' . $options['action'] . '").click(function () {
                        var aero = $("#' . $options['field_cod_icao'] . '").val();

                        if (aero != "") {
                            aero = aero.split("-");
        
                            $("#'. $options['id'] . '_cod_icao").html(aero[0]);
                            $("#'. $options['id'] . '_nome_cidade").html(aero[1]);
        
                            $("#'. $options['id'] . '_por_do_sol").show(500);
                            $.ajax({
                                type: "GET",
                                dataType: "XML",
                                url:"'.  $options['api_url'] . '",
                                data: { 
                                    icao: aero[0],
                                },
                                success: function(data) {   
                                    
                                    $(data).find("aisweb").each(function(){                                                           
        
                                        $("#'. $options['id'] . '_dt_ref").html($(this).find("date").text());
                                        $("#'. $options['id'] . '_ns_sol").html($(this).find("sunrise").text());
                                        $("#'. $options['id'] . '_pr_sol").html($(this).find("sunset").text());
                                        $("#'. $options['id'] . '_dia_semana").html($(this).find("weekday").text());      
                                        
                                        $("#'. $options['tab_info'] . '").val($(this).find("date").text() + "#" + $(this).find("sunrise").text() + "#" + $(this).find("sunset").text());
                                    });
        
                                    $("#'. $options['id'] . '_loading").hide();
                                }
                            });
                        }
                    });
                </script>';

    } else {
        echo '<span class="text-danger"> Erro: Não foi possível criar o Tabela Nascer e Pôr do Sol componente. Options não definido.</span> <br/>';
    }
}


/**
 * Cria tabela de apresentacao de dados de Cartas Aeronáuticas 
 * 
 * Quando uma CARTA é selecionada, o valor é gravado em um array (cartasSelecionadas). Quando o form for submetido
 * este array deve ser enviado na requisição de submit.
 * 
 * @param Options   $options  Parametros de configuração da tabela, seguem o seguinte padrão
 *                            options = { id : <id da tabela>,                                        
 *                                        api_url : <url da api de pesquisa de NOTAM>,
 *                                        field_cod_icao : <campo input text vinculado para recuperar o valor do codigo ICAO para realizar a pesquisa>,   
 *                                        action: <id do botão para realizar a ação de pesquisa>
 *                             }
 *  
 * @return table
 */
function carta_table($options) {

    echo '
        <div id="' . $options['id'] . '_carta_tb" class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                Cartas Aeronáuticas - <span id="' . $options['id'] . '_cod_icao" ></span> <span id="' . $options['id'] . '_nome_cidade" ></span>                 
            </div>
            <div class="panel-body">
                <p id="'. $options['id'] .'_info" ></p>

                <div id="'. $options['id'] . '_loading" style="margin: auto;  width: 10%; padding: 10px;" >
                    <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
                </div>

                <div id="' . $options['id'] . '_table" class="table-responsive" style="overflow-y: scroll; height: 200px;">
                    <table  class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Adicionar</th>
                            <th scope="col">Espécie</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data do Ciclo AIRAC</th>
                            <th scope="col">Link Download</th>                            
                        </tr>
                        </thead>
                        <tbody id="' . $options['id'] . '_tbody" >
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript" >

            var cartaList = [];
            var cartasSelecionadas = [];

            $(function () {
                $("#'. $options['id'] . '_table").hide(); 
                $("#'. $options['id'] . '_loading").hide();
            });

            $("#' . $options['action'] . '").click(function () {
                $("#' . $options['id'] . '_tbody").empty();
                var aero = $("#' . $options['field_cod_icao'] . '").val();
                $("#'. $options['id'] . '_loading").show();   
                $("#'. $options['id'] . '_table").hide(); 
                
                if (aero != "") {
                    aero = aero.split("-");

                    $("#'. $options['id'] . '_cod_icao").html(aero[0]);
                    $("#'. $options['id'] . '_nome_cidade").html(aero[1]);

                    $.ajax({
                        type: "GET",
                        dataType: "XML",
                        url:"'.  $options['api_url'] . '",
                        data: { 
                            icao: aero[0],
                        },
                        success: function(data) {   
                                          
                            const inList =  cartaList.find(item => {
                                return item.loc === aero[0];
                            });

                            
                            $(data).find("item").each(function(){                                                           

                                var objCarta = {};
                                objCarta.id = $(this).find("id").text();
                                objCarta.especie = $(this).find("especie").text();  
                                objCarta.tipo = $(this).find("tipo").text();  
                                objCarta.tipo_descr = $(this).find("tipo_descr").text();  
                                objCarta.nome = $(this).find("nome").text();
                                objCarta.IcaoCode = $(this).find("IcaoCode").text();
                                objCarta.dt = $(this).find("dt").text();
                                objCarta.link = $(this).find("link").text();
                                objCarta.arquivo = $(this).find("arquivo").text();
                                objCarta.icp = $(this).find("icp").text();
                                objCarta.pe = $(this).find("pe").text();
                                objCarta.notam = $(this).find("notam").text();
                                objCarta.tabcode = $(this).find("tabcode").text();
                                
                                if (inList === undefined) {
                                    cartaList.push(objCarta);
                                }
                                
                                $("#' . $options['id'] . '_tbody").append("<tr><th scope=\"row\"> <input type=\"checkbox\" onClick=\"selecionaCarta(\'" + objCarta.id + "\', this );\" > </th><td >" + objCarta.especie + "</td><td>" + objCarta.tipo + "</td><td>" + objCarta.nome + "</td><td>" + objCarta.dt + "</td><td> <a href=\"" + objCarta.link +"\"> Download Arquivo</a></td></tr>");
                            });

                            $("#'. $options['id'] . '_table").show(400);
                            $("#'. $options['id'] . '_loading").hide();
                            $("#'. $options['id'] . '_info").html("");                  
                        }
                    });
                } else {
                    $("#'. $options['id'] . '_notam_tb").show(500);
                    $("#'. $options['id'] . '_info").html("<span class=\'text-danger\'>Não foi possível realizar a consulta, favor informar parâmetros corretamente (Aerodromo Partida e/ou Aerodromo Destino).<span>");
                    $("#'. $options['id'] . '_loading").hide();
                }
                
            });

            function selecionaCarta(idCarta, element) {
                if(element.checked)
                {
                  const index = cartasSelecionadas.findIndex(item => {
                    return item.id === idCarta;  
                  });

                  if (index < 0) {
                    const carta = cartaList.find(item => {
                        return item.id === idCarta;
                    });
                
                    cartasSelecionadas.push(carta);
                  } 

                } else {
                    const index = cartasSelecionadas.findIndex(item => {
                        return item.id === idCartas;  
                    });
                    cartasSelecionadas.splice(index,1);
                }
            }
            
        </script>';
}


/**
 * Cria tabela de apresentacao de dados de NOTAM 
 * 
 * Quando uma NOTAM é selecionada, o valor é gravado em um array (notamSelecionadas). Quando o form for submetido
 * este array deve ser enviado na requisição de submit.
 * 
 * @param Options   $options  Parametros de configuração da tabela, seguem o seguinte padrão
 *                            options = { id : <id da tabela>,                                        
 *                                        api_url : <url da api de pesquisa de NOTAM>,
 *                                        field_cod_icao : <campo input text vinculado para recuperar o valor do codigo ICAO para realizar a pesquisa>,      
 *                                        action: <id do botão para realizar a ação de pesquisa>
 *                             }
 *  
 * @return table
 */
function notam_table($options) {

    echo '
        <div id="' . $options['id'] . '_notam_tb" class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                NOTAM - <span id="' . $options['id'] . '_cod_icao" ></span> <span id="' . $options['id'] . '_nome_cidade" ></span> 
                <button type="button" class="close" aria-label="Close" onClick="$(\'#' . $options['id'] . '_notam_tb\').hide(400);" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="panel-body">
                <p id="'. $options['id'] .'_info" ></p>

                <div id="'. $options['id'] . '_loading" style="margin: auto;  width: 10%; padding: 10px;" >
                    <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
                </div>

                <div id="' . $options['id'] . '_table" class="table-responsive" style="overflow-y: scroll; height: 200px;">
                    <table  class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Adicionar</th>
                            <th scope="col">Data</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Informações</th>
                            <th scope="col">Detalhes</th>
                        </tr>
                        </thead>
                        <tbody id="' . $options['id'] . '_tbody" >
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div id="'. $options['id'] . '_modal" class="modal fade" style="position: fixed;top: 20%;" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                   
                    <div class="modal-body">
                        <span style="font-weight: bold;">Código:&nbsp;</span><span id="'. $options['id'] . '_cod"></span> <br>
                        <span style="font-weight: bold;">Status:&nbsp;</span><span id="'. $options['id'] . '_status"></span> <br>
                        <span style="font-weight: bold;">Categoria:&nbsp;</span><span id="'. $options['id'] . 'cat"></span> <br>
                        <span style="font-weight: bold;">Tipo:&nbsp;</span><span id="'. $options['id'] . '_tp"></span> <br>
                        <span style="font-weight: bold;">Data Início da Expedição/Validade:&nbsp;</span><span id="'. $options['id'] . '_dt"></span> <br>
                        <span style="font-weight: bold;">Número:&nbsp;</span><span id="'. $options['id'] . '_n"></span> <br>
                        <span style="font-weight: bold;">Referência:&nbsp;</span><span id="'. $options['id'] . '_ref"></span> <br>
                        <span style="font-weight: bold;">Localidade Aerodromo:&nbsp;</span><span id="'. $options['id'] . '_loc"></span> <br>

                        <span style="font-weight: bold;">Data Efetivação informação:&nbsp;</span><span id="'. $options['id'] . '_b"></span> <br>

                        <span style="font-weight: bold;">Data Validade informação:&nbsp;</span><span id="'. $options['id'] . '_c"></span> <br>
                        <span style="font-weight: bold;">Data Ativa:&nbsp;</span><span id="'. $options['id'] . '_d"></span> <br>
                        <span style="font-weight: bold;">Informação:&nbsp;</span><span id="'. $options['id'] . '_e"></span> <br>
                        <span style="font-weight: bold;">Limite Vertical Inferior:&nbsp;</span><span id="'. $options['id'] . '_f"></span> <br>
                        <span style="font-weight: bold;">Limite Vertical Superior:&nbsp;</span><span id="'. $options['id'] . '_g"></span> <br>
                        <span style="font-weight: bold;">Código ICAO da Localidade do NOF:&nbsp;</span><span id="'. $options['id'] . '_nof"></span> <br>
                        <span style="font-weight: bold;">Centro Expedidor:&nbsp;</span><span id="'. $options['id'] . '_s"></span> <br>
                        <span style="font-weight: bold;">Coordenadas Geográficas:&nbsp;</span><span id="'. $options['id'] . '_geo"></span> <br>
                        <span style="font-weight: bold;">Código do PRENOTAM origem:&nbsp;</span><span id="'. $options['id'] . '_origem"></span> <br><br>

                        <button type="button" class="btn btn-secondary" id="'. $options['id'] . '_btModal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <script type="text/javascript" >

            var notamList = [];
            var notamSelecionadas = [];

            $(function () {
                $("#'. $options['id'] . '_notam_tb").hide();  
                $("#'. $options['id'] . '_table").hide(); 
            });

            $("#'. $options['id'] . '_btModal").click(function(){
                $("#'. $options['id'] . '_modal").modal("hide");
            });

            $("#' . $options['action'] . '").click(function () {
               
                $("#' . $options['id'] . '_tbody").empty();
                var aero = $("#' . $options['field_cod_icao'] . '").val();
                $("#'. $options['id'] . '_notam_tb").show(500);  
                $("#'. $options['id'] . '_loading").show();   
                $("#'. $options['id'] . '_table").hide();
               
                if (aero != "") {
                    aero = aero.split("-");

                    $("#'. $options['id'] . '_cod_icao").html(aero[0]);
                    $("#'. $options['id'] . '_nome_cidade").html(aero[1]);

                    $("#'. $options['id'] . '_notam_tb").show(500);
                    $.ajax({
                        type: "GET",
                        dataType: "XML",
                        url:"'.  $options['api_url'] . '",
                        data: { 
                            icao: aero[0],
                        },
                        success: function(data) {   
                            
                            $("#'. $options['id'] . '_info").html(""); 
                            
                            const inList =  notamList.find(item => {
                                return item.loc === aero[0];
                            });

                            console.log(data);

                            if ($(data).find("item").length > 0) {
                                $(data).find("item").each(function(){                                                           

                                    var objNotam = {};
                                    objNotam.cod = $(this).find("cod").text();
                                    objNotam.status = $(this).find("status").text();  
                                    objNotam.cat = $(this).find("cat").text();  
                                    objNotam.tp = $(this).find("tp").text();  
                                    objNotam.dt = $(this).find("dt").text();
                                    objNotam.n = $(this).find("n").text();
                                    objNotam.ref = $(this).find("ref").text();
                                    objNotam.loc = $(this).find("loc").text();
                                    objNotam.b = $(this).find("b").text();
                                    objNotam.c = $(this).find("c").text();
                                    objNotam.d = $(this).find("d").text();
                                    objNotam.e = $(this).find("e").text();
                                    objNotam.f = $(this).find("f").text();
                                    objNotam.g = $(this).find("g").text();
                                    objNotam.nof = $(this).find("nof").text();
                                    objNotam.s = $(this).find("s").text();
                                    objNotam.geo = $(this).find("geo").text();
                                    objNotam.aero = $(this).find("aero").text();
                                    objNotam.cidade = $(this).find("cidade").text();
                                    objNotam.uf = $(this).find("uf").text();
                                    objNotam.origem = $(this).find("origem").text();

                                    if (inList === undefined) {
                                        notamList.push(objNotam);
                                    }
                                    
                                    
                                    $("#' . $options['id'] . '_tbody").append("<tr><th scope=\"row\"> <input type=\"checkbox\" onClick=\"selecionaNotam(\'" + objNotam.n + "\', this );\" > </th><td >" + objNotam.dt + "</td><td>" + objNotam.cat + "</td><td>" + objNotam.e + "</td><td> <input type=\"button\" class=\"btn btn-link\" onClick=\"showDetails(\'" + objNotam.n + "\');\" value=\"+ Informações\" ></td></tr>");
                                });

                                $("#'. $options['id'] . '_table").show(400);                                 
                            } else {
                                $("#'. $options['id'] . '_info").html("Informação não encontrada na pesquisa.");  

                            }
                            $("#'. $options['id'] . '_loading").hide();
                                            
                        }
                    });
                } else {
                    $("#'. $options['id'] . '_notam_tb").show(500);
                    $("#'. $options['id'] . '_info").html("<span class=\'text-danger\'>Não foi possível realizar a consulta, favor informar parâmetros corretamente (Aerodromo Partida e/ou Aerodromo Destino).<span>");
                    $("#'. $options['id'] . '_loading").hide();
                }
                
            });


            function selecionaNotam(numero, element) {
                if(element.checked)
                {
                  const index = notamSelecionadas.findIndex(item => {
                    return item.n === numero;  
                  });

                  if (index < 0) {
                    const notam = notamList.find(item => {
                        return item.n === numero;
                    });
                
                    notamSelecionadas.push(notam);
                  } 

                } else {
                    const index = notamSelecionadas.findIndex(item => {
                        return item.n === numero;  
                    });
                    notamSelecionadas.splice(index,1);
                }
            };


            function showDetails(numero) {
               
                const notam = notamList.find(item => {
                    return item.n === numero;
                });

                $("#'. $options['id'] . '_cod").html(notam.cod); 
                $("#'. $options['id'] . '_status").html(notam.status);
                $("#'. $options['id'] . '_cat").html(notam.cat);  
                $("#'. $options['id'] . '_tp").html(notam.tp); 
                $("#'. $options['id'] . '_dt").html(notam.dt); 
                $("#'. $options['id'] . '_n").html(notam.n); 
                $("#'. $options['id'] . '_ref").html(notam.ref); 
                $("#'. $options['id'] . '_loc").html(notam.loc); 
                $("#'. $options['id'] . '_b").html(notam.b); 
                $("#'. $options['id'] . '_c").html(notam.c); 
                $("#'. $options['id'] . '_d").html(notam.d); 
                $("#'. $options['id'] . '_e").html(notam.e); 
                $("#'. $options['id'] . '_f").html(notam.f); 
                $("#'. $options['id'] . '_g").html(notam.g); 
                $("#'. $options['id'] . '_nof").html(notam.nof); 
                $("#'. $options['id'] . '_s").html(notam.s); 
                $("#'. $options['id'] . '_geo").html(notam.geo); 
                $("#'. $options['id'] . '_origem").html(notam.origem); 

                $("#'. $options['id'] . '_modal").modal("show");
            }
        
        </script>';
}