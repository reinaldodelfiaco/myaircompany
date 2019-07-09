<?php 

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

class ordens { 
    
   
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }


    public function deletar_ordens() 
    {
        $o = $this->db->row('SELECT * FROM ordens WHERE id = ' . get('id'));
        $this->db->delete("ordens", [id=> get('id')]);
        flash("success", "Ordem excluída com sucesso.");

        //DELETAR MOVIMENTAÇÃO FINANCEIRA
        $this->db->delete('movimentos', ['ordem' => $o->id ]);
        $this->db->delete('estoque_movimentos', ['ordem' => $o->id ]);
        $this->db->delete('ordens_produtos', ['orden' => $o->id ]);


        if(get('tipo') == 'compra') {
            return redirect("ordens/compras"); 
        } else {
            return redirect("ordens/vendas"); 
        }
    }


    public function editar_ordens() 
    {
        if(is_post()) 
        {
            if($this->val->isSuccess())
            {
                $this->db->update("ordens",copy_post(), ['id'=> get('id')]);
                flash("success", "ordens atualizado com sucesso.");
                return redirect("ordens/ordens"); 
            }
        }

        $ordens = $this->db->row("SELECT * FROM ordens WHERE id = " . get('id')); 

        return view("ordens/editar_ordens", [
            'ordens' => $ordens,
        ]);
    }
    
    public function ordens()
    {   
        if(is_post()) 
        {
            if($this->val->isSuccess())
            {
                $this->db->insert("ordens",copy_post());
                flash("success", "Ordem adicionado com sucesso.");
                return redirect("ordens/ordens"); 
            }
        }
        $ordens = $this->db->table("SELECT * FROM ordens WHERE empresa = '" . session('empresa')."'");
        return view("ordens/ordens", [
            'ordens' => $ordens,
        ]);
    }

    public function compras()
    {   

        if(is_post()) 
        {   
            if($this->val->isSuccess())
            {
                $id = $this->db->insert("ordens",copy_post());
                $this->db->update('ordens',[
                    'status' => 'Aberto',
                    'data' => data_en(post('data')),
                ], ['id' => $id]);

                flash("success", "Ordem adicionado com sucesso, agora informe os ítens referente à esta compra.");
                return redirect("ordens/produtos?id=" . $id); 
            }
        }

        $ordens = $this->db->table("SELECT * FROM crm_empresas b, ordens a WHERE a.cliente_fornecedor = b.id AND  a.movimento = 'compra' AND a.empresa = '" . session('empresa')."'");
        $cliente_fornecedor = $this->db->table("SELECT * FROM crm_empresas WHERE empresa = ".session('empresa')." AND fornecedor = 1");

        
        $valor_total_pedidos = $this->db->table("SELECT sum(valor_total) as total FROM ordens WHERE tipo='pedido' AND movimento = 'compra' AND empresa = '" . session('empresa')."'");
        foreach($valor_total_pedidos as $vtp) {
            $v_total_pedidos = $vtp->total;
        }
        
        $valor_total_compras = $this->db->table("SELECT sum(valor_total) as total FROM ordens WHERE tipo='compra' AND movimento = 'compra' AND empresa = '" . session('empresa')."'");
        foreach($valor_total_compras as $vtc) {
            $v_total_compras = $vtc->total;
        }

        $num_total_compras = $this->db->table("SELECT count(id) as total FROM ordens WHERE tipo='compra' AND movimento = 'compra' AND empresa = '" . session('empresa')."'");
        foreach($num_total_compras as $vtc) {
            $num_compras = $vtc->total;
        }

        $num_total_pedidos = $this->db->table("SELECT count(id) as total FROM ordens WHERE tipo='pedido' AND movimento = 'compra' AND empresa = '" . session('empresa')."'");
        foreach($num_total_pedidos as $vtc) {
            $num_pedidos = $vtc->total;
        }

        return view("ordens/ordens", [
            'ordens' => $ordens,
            'movimento' => 'compra',
            'cliente_fornecedor' => $cliente_fornecedor,
            'v_total_pedidos' => $v_total_pedidos,
            'v_total_compras' => $v_total_compras,
            'num_compras' => $num_compras,
            'num_pedidos' => $num_pedidos,

        ]);
    }

    public function vendas()
    {   

        if(is_post()) 
        {
            
            if($this->val->isSuccess())
            {
                $id = $this->db->insert("ordens",copy_post());
                $this->db->update('ordens',[
                    'status' => 'Aberto',
                ], ['id' => $id]);

                flash("success", "Ordem adicionado com sucesso, agora informe os ítens referente à esta venda.");
                return redirect("ordens/produtos?id=" . $id); 
            }
        }

        $ordens = $this->db->table("SELECT * FROM crm_empresas b, ordens a WHERE a.cliente_fornecedor = b.id AND a.movimento = 'venda' AND a.empresa = '" . session('empresa')."'");
        $cliente_fornecedor = $this->db->table("SELECT * FROM crm_empresas WHERE empresa =  '" . session('empresa')."'");
        $cfops = $this->db->table("SELECT * FROM cfop");

        $valor_total_pedidos = $this->db->table("SELECT sum(valor_total) as total FROM ordens WHERE tipo='pedido' AND movimento = 'venda' AND empresa = '" . session('empresa')."'");
        
        $v_total_pedidos = retorna_total($valor_total_pedidos);
        
        $valor_total_vendas = $this->db->table("SELECT sum(valor_total) as total FROM ordens WHERE tipo='venda' AND movimento = 'venda' AND empresa = '" . session('empresa')."'");
        foreach($valor_total_vendas as $vtc) {
            $v_total_vendas = $vtc->total;
        }

        $num_total_vendas = $this->db->table("SELECT count(id) as total FROM ordens WHERE tipo='venda' AND movimento = 'venda' AND empresa = '" . session('empresa')."'");
        foreach($num_total_vendas as $vtc) {
            $num_vendas = $vtc->total;
        }

        $num_total_pedidos = $this->db->table("SELECT count(id) as total FROM ordens WHERE tipo='pedido' AND movimento = 'venda' AND empresa = '" . session('empresa')."'");
        foreach($num_total_pedidos as $vtc) {
            $num_pedidos = $vtc->total;
        }


        return view("ordens/ordens", [
            'ordens' => $ordens,
            'movimento' => 'venda',
            'cliente_fornecedor' => $cliente_fornecedor,
            'v_total_pedidos' => $v_total_pedidos,
            'v_total_vendas' => $v_total_vendas,
            'num_vendas' => $num_vendas,
            'num_pedidos' => $num_pedidos,
            'cfops' => $cfops,
        ]);
    }


    public function produtos()
    {   

        if(is_post())
        {

            $this->db->insert('ordens_produtos', [
                'produto' => post('produto'),
                'quantidade' => post('quantidade'),
                'valor' => moeda_dollar(post('valor')),
                'valor_total' => moeda_dollar(post('valor_total')),
                'orden' => get('id'),
            ]);
            
            
            $produtos_adicionados_vt = $this->db->table("SELECT sum(valor_total) as total FROM  ordens_produtos WHERE orden = " .get('id'));
            foreach($produtos_adicionados_vt as $vt) {
                $total_produtos = $vt->total;
            }

            $this->db->update('ordens', ['valor_total' => $total_produtos], ['id' => get('id')]);
            return redirect('ordens/produtos?id=' . get('id'));
        }

        $ordem = $this->db->row('SELECT * FROM crm_empresas a, ordens b WHERE a.id = b.cliente_fornecedor AND b.id = ' . get('id') . ' AND b.empresa = ' . session('empresa'));
        $produtos = $this->db->table("SELECT * FROM produtos WHERE empresa = '" . session('empresa')."' AND tipo != 'Ferramentas'");

        $produtos_adicionados = $this->db->table("SELECT * FROM produtos a,  ordens_produtos b WHERE a.id = b.produto AND  b.orden = " .get('id'));
        $voos = $this->db->table("SELECT * FROM ordens_produtos  WHERE voo > 0 AND  orden = " .get('id'));
        
        $produtos_adicionados_vt = $this->db->table("SELECT sum(valor_total) as total FROM  ordens_produtos WHERE orden = " .get('id'));
        foreach($produtos_adicionados_vt as $vt) {
            $total_produtos = $vt->total;
        }

        $produtos_adicionados_pl = $this->db->table("SELECT sum(peso_liquido * quantidade) as total FROM  produtos p, ordens_produtos op WHERE op.produto = p.id AND op.orden = " .get('id'));
        foreach($produtos_adicionados_pl as $vt) {
            $total_produtos_pl = $vt->total;
        }

        $produtos_adicionados_pb = $this->db->table("SELECT sum(peso_bruto * quantidade) as total FROM  produtos p, ordens_produtos op WHERE op.produto = p.id AND op.orden = " .get('id'));
        foreach($produtos_adicionados_pb as $vt) {
            $total_produtos_pb = $vt->total;
        }

        $cfops = $this->db->table("SELECT * FROM cfop");
       

        $cliente_fornecedor = $this->db->table("SELECT * FROM crm_empresas WHERE empresa = ".session('empresa')." AND fornecedor = 1");

        if($ordem->movimento == 'compra') {
            $cgap = 'despesa';
        } else {
            $cgap = 'receita';
        }

        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa') ." AND tipo = '" . $cgap ."'");
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = '" . session('empresa')."'");
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = '" . session('empresa')."'");
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = '" . session('empresa')."'");
        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE empresa  = '" . session('empresa')."'");
        $transportadoras = $this->db->table("SELECT * FROM crm_empresas WHERE transportadora = 1 AND  empresa  = '" . session('empresa')."'");


        return view('ordens/produtos',[
            'ordem' => $ordem,
            'produtos' => $produtos,
            'produtos_adicionados' => $produtos_adicionados,
            'total_produtos' => $total_produtos,
            'total_produtos_pb' => $total_produtos_pb,
            'total_produtos_pl' => $total_produtos_pl,
            'cliente_fornecedor' => $cliente_fornecedor,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'armazens' => $armazens,
            'cfops' => $cfops,
            'transportadoras' => $transportadoras,
            'voos' => $voos,
        ]);
    }

    public function atualiza_status()
    {   

        $this->db->update('ordens', Copy_post(), ['id' => get('id')]);
        $this->db->update('ordens', ['data' => data_en(post('data2'))], ['id' => get('id')]);
        flash('success', 'Status da ordem atualizado com sucesso');
        return redirect('ordens/produtos?id=' . get('id'));
    }

    public function salvar()
    {   

        // ATUALIZA NOTA
        $this->db->update('ordens',[
            'status' => 'Concluído',
            'tipo' => 'compra',
            'valor_frete' => moeda_dollar(post('frete')),
            'valor_desconto' => moeda_dollar(post('desconto')),
            'valor_total' => moeda_dollar(post('vtotal'))  * post('parcela'),
        ], ['id' => get('id')]);

        return redirect('ordens/compras');


    }

    public function concluir()
    {   

        // ATUALIZA NOTA
        $this->db->update('ordens',[
            'status' => 'Concluído',
            'data' => data_en(post('data')),
            'nota_fiscal' => post('nota_fiscal'),
            'tipo' => post('tipo'),
            'valor_frete' => moeda_dollar(post('frete')),
            'valor_desconto' => moeda_dollar(post('desconto')),
            'valor_total' => moeda_dollar(post('vtotal'))  * post('parcela'),
        ], ['id' => get('id')]);


        $produtos = $this->db->table("SELECT * FROM ordens_produtos WHERE orden = " . get('id'));

        foreach($produtos as $p)
        {   
            $produto = $this->db->row("SELECT * FROM produtos WHERE id = " . $p->produto);

            if($produto->tipo == 'Produto') {
                $this->db->insert('estoque_movimentos', [
                    'ordem' => get('id'),
                    'produto' => $p->produto,
                    'quantidade' => $p->quantidade,
                    'tipo' => (post('tipo') == 'compra') ? 'Entrada' : 'Saída',
                    'empresa' => session('empresa'),
                    'armazem' => post('armazem'),
                    'status' => post('estoque'),
                    'usuario' => session('id'),
                ]);
            }
        }   

        
        // ATUALIZA FINANCEIRO
        gera_parcelamento_ordem(post('frequencia'), get('id'), post('tipo'));

        flash('success', 'Ordem concluída com sucesso');
        return redirect('ordens/' . post('movimento') .'s');
    }


    
    public function deletar_p()
    {   
        $orden = $this->db->row('SELECT * FROM ordens_produtos WHERE id = ' . get('id'));
        $this->db->delete('ordens_produtos', ['id' => get('id')]);
        return redirect('ordens/produtos?id=' . $orden->orden);
    }


    public function lista_produto()
    {
        $produto = $this->db->row('SELECT * FROM produtos WHERE id=' . get('id'));
        echo json_encode($produto);
    }

    public function importar()
    {
        if (!empty($_FILES['xml'])) {


            $path = "uploads/xmls/";
            $documento = basename(sha1(date("H:i:s")) . "-" . $_FILES['xml']['name']);
            $path = $path . $documento;
            move_uploaded_file($_FILES['xml']['tmp_name'], $path);

            $docxml = file_get_contents($path);
            
            $dados = importaNFe($docxml);

            if($dados['versao'] < 4.0)
            {
                Flash('error', 'Versão da NF antiga');
                return redirect("ordens/compras");
            }

            if($dados['dataEmissaoH']) {
                $data = $dados['dataEmissaoH'];
            } else {
                $data = $dados['dataEmissao'];
            }

           
            // BUSCA E CADASTRA FORNECEDOR
            $cnpj =  $dados['emitenteCnpjFormatado'];

            $verifica_fornecedor = $this->db->row("SELECT * FROM crm_empresas WHERE empresa = ".session('empresa')." AND cnpj_cpf = '".$cnpj."'");

            if($verifica_fornecedor) {
                $id_fornecedor = $verifica_fornecedor->id;

                flash('success', 'Fornecedor encontrado em seu cadastro.');
            } else {
                // CADASTRAR NOVO FORNECEDOR
                $id_fornecedor = $this->db->insert('crm_empresas', [
                    'cnpj_cpf' => $cnpj,
                    'tipop' => 'Jurídica', 
                    'fornecedor' => 1,
                    'razao_social' => $dados['emitenteRazaoSocial'],
                    'nome_fantasia' => $dados['emitenteNome'],
                    'inscricao_estadual' => $dados['emitenteInscricaoEstadual'],
                    'inscricao_municipal' => $dados['emitenteInscricaoMunicipal'],
                    'endereco' => $dados['emitenteEndereco'],
                    'numero' => $dados['emitenteNumero'],
                    'bairro' => $dados['emitenteBairro'],
                    'cidade' => $dados['emitenteMunicipio'],
                    'estado' => $dados['emitenteUF'],
                    'cep' => $dados['emitenteCep'],
                    'telefone' => $dados['emitenteTelefone'],
                    'status' => 'ativa',
                    'empresa' => session('empresa'),
                ] );

                flash('success', 'Fornecedor não encontrado, mas já cadastramos em seu sistema.');
            }




            $valor_total_produtos = $dados['totalprodutos'];
            $valor_total_nota = $dados['valortotalnf'];
            $valor_total_frete = $dados['valorfrete'];
            $valor_total_desconto = $dados['valordesconto'];
            $valor_total_outro = $dados['valoroutro'];
            

            // CADASTRO DA ORDEM
            $verifica_ordem = $this->db->row("SELECT * FROM ordens WHERE empresa = ".session('empresa')." AND chave =  '".$dados['chave']."'");

            if($verifica_ordem){
                Flash('error', 'Nota fiscal já importada no sistema.');
                return redirect("ordens/compras");
            } else {
               $id_ordem = $this->db->insert('ordens',[
                    'empresa' => session('empresa'),
                    'movimento' => 'compra',
                    'status' => 'Aberto',
                    'tipo' => 'compra',
                    'valor_total' => $valor_total_nota,
                    'valor_frete' => $valor_total_frete,
                    'valor_desconto' => $valor_total_desconto,
                    'data' => $data,
                    'cliente_fornecedor' => $id_fornecedor,
                    'chave' => $dados['chave'],
                    'path' => $path,
                    'nota_fiscal' => $dados['numero'],

                ]);

            }
            
            //INSERE OS PRODUTOS
            foreach($dados['itens'] as $p) {
               
                $verifica_vinculo = $this->db->row("SELECT * FROM produtos_v WHERE codigo_fornecedor = " . $p['codigo'] . " AND empresa = '" . session('empresa')."'");

                if(!$verifica_vinculo) {
                    $verificar_produto = $this->db->row("SELECT * FROM produtos WHERE empresa = ".session('empresa')." AND nome = '".$p['nome']."'");
                   
                    if($verificar_produto) {
                        $id_produto = $verificar_produto->id;
                    } else {
                        $id_produto = $this->db->insert('produtos',[
                            'nome' => str_replace('"', '', $p['nome']),
                            'codigo_barras' => $p['ean'],
                            'tipo' => ($p['unidade'] == "H") ? "Serviço" : "Produto",
                            'valor' => 0.00,
                            'valor_compra' => $p['valor'],
                            'ncm' => $p['ncm'],
                            'empresa' => session('empresa'),
                        ]);
                    }

                    $this->db->insert('produtos_v',[
                        'produto' => $id_produto,
                        'fornecedor' => $id_fornecedor,
                        'codigo_fornecedor' => $p['codigo'],
                        'empresa' => session('empresa')
                    ]);

                    
                } else {
                    $produto = $this->db->row("SELECT * FROM produtos WHERE  id = " . $verifica_vinculo->produto);
                    $id_produto = $produto->id;
                }


                $this->db->insert('ordens_produtos',[
                    'orden' => $id_ordem,
                    'codigo_produto' => $p['codigo'],
                    'produto' => $id_produto,
                    'valor' => $p['valor'],
                    'valor_total' => $p['valor'] * $p['quantidade'],
                    'quantidade' => $p['quantidade'],
                ]);

            }

            
            Flash('sucess', 'XML inportado com sucesso');
            return redirect("ordens/produtos?id=" . $id_ordem);

        } 
        
        
        else {
            return redirect('ordens/compras');
        }
    }


    public function vincular()
    {

        if(is_post())
        {
            // SELECIONA PRODUTOS NA ORDEM
            $seleciona_produto_orden = $this->db->row("SELECT * FROM ordens_produtos WHERE id = " . get('p'));

            //SELECIONA  A ORDEM
            $seleciona_fornecedor_orden = $this->db->row("SELECT * FROM ordens WHERE id = " . get('id'));

            //VERIFICA SE EXISTEM VÍNCULO
            $verifica_vinculo_existente = $this->db->row("SELECT * FROM produtos_v WHERE produto = " . $seleciona_produto_orden->produto ." AND fornecedor = " . $seleciona_fornecedor_orden->cliente_fornecedor);
      

            // REMOVE O VINCULO
            $this->db->delete('produtos_v', ['produto' => $seleciona_produto_orden->produto, 'fornecedor' => $seleciona_fornecedor_orden->cliente_fornecedor]);


            //ADICIONA O NOVO VÍNCULO
            $this->db->insert('produtos_v',[
                'fornecedor' => $seleciona_fornecedor_orden->cliente_fornecedor,
                'produto' => post('produto'),
                'empresa' => session('empresa'),
                'codigo_fornecedor' => get('c'),
            ]);



            // ALTERA PRODUTO NA ORDEM
            $this->db->update('ordens_produtos', ['produto' => post('produto')], ['id' => get('p')]);
            

            //DELETA PRODUTO CASO SEJA PEDIDO
            if(post('exluir') == 1) 
            {
                $this->db->delete('produtos', ['id' => $seleciona_produto_orden->produto]);
            }

            return redirect('ordens/produtos?id=' . get('id'));
        }

        $produtos = $this->db->table("SELECT * FROM produtos WHERE empresa = '" . session('empresa')."'");
        
        view('ordens/vincular', [
            'produtos' => $produtos,
        ]);
    }

    public function pdf()
    {
        
        $orden = $this->db->row("SELECT * FROM ordens WHERE id = " . get('id'));
        $produtos = $this->db->table("SELECT * FROM produtos b, ordens_produtos a WHERE a.produto = b.id AND a.orden = " . get('id'));
        $produtost = $this->db->table("SELECT sum(valor_total) as total FROM produtos b, ordens_produtos a WHERE a.produto = b.id AND a.orden = " . get('id'));

        foreach($produtost as $pt) {
            $vtotal = $pt->total;
        }


        $fornecedor = $this->db->row('SELECT * FROM crm_empresas WHERE id = ' . $orden->cliente_fornecedor);
        $info = $this->db->row('SELECT * FROM empresas WHERE id = ' . session('empresa'));
        
        $dompdf = new Dompdf(array('enable_remote' => true));
        
        $html = '<style>
        @page {
            margin: 2cm;
        }
    
        body {
            margin: 0px 0px 0px 0px;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        table tr {
            border:1px solid #000;
        }
        .footer .page-number:after { 
            content: counter(page); 
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: right;
        }

        table td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #000;
            border: 1px solid #000;
            
        }

        .icon-stat-value {
            display: block;
            font-size: 18px;
            font-weight: 600;
            box-sizing: border-box;
        }


        </style>';

        if($orden->movimento == 'venda') {
            $cf = 'Cliente';
        } else {
            $cf = 'Fornecedor';
        }

        $html .='
                <table>
                    <tr>
                        <td> <img src="public/logonovont.png" width="100" alt="Logo"> </td>
                        <td width="200"> Código: #'.$orden->id.'  |
                            Data: '.data_br($orden->data_cadastro).' <br>
                            Status: '.$orden->status.'  
                            Tipo: '.$orden->tipo.' <br>  </td>
                        <td width="197"> Emitido em '.date("d/m/Y H:i:s").' </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td width="250">
                            <h3> Dados do Emitente</h3>
                            <b> Razão Social: </b> '.$info->razao_social.' <br>
                            <b> CNPJ / CPF: </b> '.$info->cnpj.' <br>
                            <b> Telefone: </b> '.$info->telefone.' <br>
                            <b> Endereço: </b> '.$info->endereco .', '.$info->numero.' -  '.$info->cidade.' / '.$info->estado.'
                        </td>
                        <td width="235">
                        <h3> Dados do '.$cf.' </h3>
                            <b> Razão Social: </b> '.$fornecedor->razao_social.' <br>
                            <b> CNPJ / CPF: </b> '.$fornecedor->cnpj_cpf.' <br>
                            <b> TIPO: </b> '.$fornecedor->tipop.' <br>
                            <b> Telefone: </b> '.$fornecedor->telefone.' <br>
                            <b> Endereço: </b> '.$fornecedor->endereco .', '.$fornecedor->numero.' -  '.$fornecedor->cidade.' / '.$fornecedor->estado.'
                        </td>
                    </tr>
                </table>
                <br>
                <center><h3> Lista de produtos </h3><center>
        ';

        $html.='<table style="border-width:1px;border-color:black">';
        $html .= '<tr>';
        $html .= '<td width="280"><b>Nome do produto</b></td>';
        $html .= '<td width="40"><center><b>Quantidade</b></center></td>';
        $html .= '<td width="60"><center><b>Valor</b></center></td>';
        $html .= '<td width="60"><center><b>Subtotal</b></center></td>';
        $html .= '</tr>';

        foreach($produtos as $p) {
            $html .= '<tr>';
            $html .= '<td>'.$p->nome.'</td>';
            $html .= '<td><center>'.$p->quantidade.'</center></td>';
            $html .= '<td><center> R$ '.moeda_real($p->valor).'</center></td>';
            $html .= '<td><center> R$ '.moeda_real($p->valor_total).'</center></td>';
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= '<td width="280"><b>Total da '. $orden->movimento.'</b></td>';
        $html .= '<td width="61"> </td>';
        $html .= '<td width="60"> </td>';
        $html .= '<td width="60"><center><b> R$ '.moeda_real($vtotal).'</b></center></td>';
        $html .= '</tr>';
        $html.='</table>';


        $html.='<div class="footer fixed-section">
                <div class="right">
                    <span class="page-number"> </span>
                </div>
                </div>';


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->set_option('defaultFont', 'Times New Roman’');
        $dompdf->render();
        $dompdf->stream('relatorio_agregar_' . date("d-m-Y"));
    }

    public function envia_email()
    {
        $orden = $this->db->row("SELECT * FROM ordens WHERE id = " . get('id'));
        $produtos = $this->db->table("SELECT * FROM produtos b, ordens_produtos a WHERE a.produto = b.id AND a.orden = " . get('id'));
        $produtost = $this->db->table("SELECT sum(valor_total) as total FROM produtos b, ordens_produtos a WHERE a.produto = b.id AND a.orden = " . get('id'));

        foreach($produtost as $pt) {
            $vtotal = $pt->total;
        }


        $fornecedor = $this->db->row('SELECT * FROM crm_empresas WHERE id = ' . $orden->cliente_fornecedor);
         $info = $this->db->row('SELECT * FROM empresas WHERE id = ' . session('empresa'));

        $dompdf = new Dompdf(array('enable_remote' => true));
        $html = '<style>
        @page {
            margin: 2cm;
        }
    
        body {
            margin: 0px 10px 0px 40px;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        table tr {
            border:1px solid #000;
            

        }
        .footer .page-number:after { 
            content: counter(page); 
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: right;
        }

        table td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #000;
            border: 1px solid #000;
        }

        .icon-stat-value {
            display: block;
            font-size: 18px;
            font-weight: 600;
            box-sizing: border-box;
        }


        </style>';

        
        if($orden->movimento == 'venda') {
            $cf = 'Cliente';
        } else {
            $cf = 'Fornecedor';
        }


        $html .='
            <table>
                <tr>
                    <td> <img src="public/logonovont.png" width="100" alt="Logo"> </td>
                    <td width="200"> Código: #'.$orden->id.'  |
                        Data: '.data_br($orden->data_cadastro).' <br>
                        Status: '.$orden->status.'  
                        Tipo: '.$orden->tipo.' <br>  </td>
                    <td width="197"> Emitido em '.date("d/m/Y H:i:s").' </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td width="250">
                        <h3> Dados do Emitente</h3>
                        <b> Razão Social: </b> '.$info->razao_social.' <br>
                        <b> CNPJ / CPF: </b> '.$info->cnpj.' <br>
                        <b> Telefone: </b> '.$info->telefone.' <br>
                        <b> Endereço: </b> '.$info->endereco .', '.$info->numero.' -  '.$info->cidade.' / '.$info->estado.'
                    </td>
                    <td width="265">
                    <h3> Dados do '.$cf.' </h3>
                        <b> Razão Social: </b> '.$fornecedor->razao_social.' <br>
                        <b> CNPJ / CPF: </b> '.$fornecedor->cnpj_cpf.' <br>
                        <b> TIPO: </b> '.$fornecedor->tipop.' <br>
                        <b> Telefone: </b> '.$fornecedor->telefone.' <br>
                        <b> Endereço: </b> '.$fornecedor->endereco .', '.$fornecedor->numero.' -  '.$fornecedor->cidade.' / '.$fornecedor->estado.'
                    </td>
                </tr>
            </table>
            <br>
            <h3> Lista de produtos </h3>
    ';

            $html.='<table style="border-width:1px;border-color:black">';
            $html .= '<tr>';
            $html .= '<td width="280"><b>Nome do produto</b></td>';
            $html .= '<td width="40"><center><b>Quantidade</b></center></td>';
            $html .= '<td width="60"><center><b>Valor</b></center></td>';
            $html .= '<td width="60"><center><b>Subtotal</b></center></td>';
            $html .= '</tr>';

        foreach($produtos as $p) {
            $html .= '<tr>';
            $html .= '<td>'.$p->nome.'</td>';
            $html .= '<td><center>'.$p->quantidade.'</center></td>';
            $html .= '<td><center> R$ '.moeda_real($p->valor).'</center></td>';
            $html .= '<td><center> R$ '.moeda_real($p->valor_total).'</center></td>';
            $html .= '</tr>';
        }
            $html .= '<tr>';
            $html .= '<td width="280"><b>Total da '. $orden->movimento.'</b></td>';
            $html .= '<td width="61"> </td>';
            $html .= '<td width="60"> </td>';
            $html .= '<td width="60"><center><b> R$ '.moeda_real($vtotal).'</b></center></td>';
            $html .= '</tr>';
            $html.='</table>';


            $html.='<div class="footer fixed-section">
                <div class="right">
                    <span class="page-number"> </span>
                </div>
                </div>';

        echo $html;

        $ass = "Relatório de ordem de ". $orden->movimento;

        envia_email(post('email'), $ass , $html);
        flash('success', 'E-mail enviado com sucesso');
        return redirect('ordens/produtos?id=' . get('id'));

    }

    
}
