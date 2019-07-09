<?php class pdv { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    public function index()
    {      
        $data = date("Y-m-d");

        $ordem = [];
        $sql = " WHERE data >= '$data'";
        $sql .= " AND lugares_disponiveis > 0";

        echo $sql;
        $clientes = $this->db->table("SELECT id, CONCAT('#', id, ' - ', nome_fantasia, ' - ', cnpj_cpf) as busca_form FROM crm_empresas WHERE empresa = '" . session('empresa') . "' and cliente = 1");
        $produtos_pdv = $this->db->table("SELECT * FROM produtos WHERE pdv = 'S'");
        $voos = $this->db->table("SELECT * FROM voos $sql LIMIT 20");

        $total_produtos = 0;

        $produtos = [];
        if(session('venda_id') > 0 ) {
           
            $produtos = $this->db->table("SELECT * FROM ordens_produtos WHERE orden = " . session('venda_id'));
            $ordem = $this->db->row("SELECT * FROM ordens WHERE id = " . session('venda_id'));
            $produtos_adicionados_vt = $this->db->table("SELECT sum(valor_total) as total FROM  ordens_produtos WHERE orden = " .session('venda_id'));
            foreach($produtos_adicionados_vt as $vt) {
                $total_produtos = $vt->total;
            }

        }

        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = '" . session('empresa')."'");
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = '" . session('empresa')."'");
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = '" . session('empresa')."'");
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = '" . session('empresa')."'");
        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE empresa  = '" . session('empresa')."'");
        $transportadoras = $this->db->table("SELECT * FROM crm_empresas WHERE transportadora = 1 AND  empresa  = '" . session('empresa')."'");

        return view('pdv/index', [
            'produtos_pdv' => $produtos_pdv,
            'clientes' => $clientes,
            'produtos' => $produtos,
            'voos' => $voos,
            'total_produtos' => $total_produtos,
            'ordem' => $ordem,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'armazens' => $armazens,
            'transportadoras' => $transportadoras
        ]); 
    }

    public function novo_cliente()
    {   
        $data = date("Y-m-d");
        $data_hora = date("Y-m-d H:i");
        if (is_post()) {
            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();
            if ($this->val->isSuccess()) {
                $id = $this->db->insert('crm_empresas', copy_post());
                session_set('venda_cliente', $id);
                session_set('venda_nome', post('nome_fantasia'));
                session_set('venda_doc', post('cnpj_cpf'));
                $venda = $this->db->insert('ordens', 
                [
                    'movimento' => 'venda', 
                    'tipo' => 'venda',
                    'status' => 'Aberto', 
                    'titulo' => 
                    'Venda pelo PDV às: ' . $data_hora, 
                    'cliente_fornecedor' => $id, 
                    'empresa' => session('empresa'),
                    'data' => $data,
                ]);
                session_set('venda_id', $venda);
                flash('success', 'Cliente cadastrado(a) com sucesso');
                return redirect('pdv');
            } else {
                flash('error', 'Erro ao salvar empresa');
            }
        }
    }

    public function cancelar_venda()
    {
        flash('success', 'Venda cancelada!');
        session_set('venda_cliente', null);
        session_set('venda_nome', null);
        session_set('venda_doc', null);
        session_set('venda_id', null);
        return redirect('pdv');
    }

    public function buscar_cliente()
    {   
        $data = date("Y-m-d");
        $data_hora = date("Y-m-d H:i");
        if(is_post())
        {   
            echo post('buscando');

            $cliente = $this->db->row("SELECT * FROM crm_empresas WHERE id =  " . post('buscando'));
            if($cliente->id > 0) {
                $venda = $this->db->insert('ordens', 
                    [
                        'movimento' => 'venda', 
                        'tipo' => 'venda',
                        'status' => 'Aberto', 
                        'titulo' => 
                        'Venda pelo PDV às: ' . $data_hora, 
                        'cliente_fornecedor' => $cliente->id, 
                        'empresa' => session('empresa'),
                        'data' => $data,
                    ]);
                session_set('venda_cliente', $cliente->id);
                session_set('venda_nome', $cliente->nome_fantasia);
                session_set('venda_doc', $cliente->cnpj_cpf);
                session_set('venda_id', $venda);
                return redirect("pdv");
            } else {
                flash('error', 'Erro ao buscar cliente, tente novamente.');
                return redirect("pdv");
            }
        }
    }

    public function add_produto()
    {
        $produto = $this->db->row('SELECT * FROM produtos WHERE id = ' . get('id'));
        $this->db->insert('ordens_produtos',[
            'produto' => get('id'),
            'orden' => session('venda_id'),
            'valor' => $produto->valor,
            'valor_total' => $produto->valor,
            'quantidade' => 1
        ]);
        return redirect("pdv");
    }

    public function add_voo()
    {
        $voo = $this->db->row('SELECT * FROM voos WHERE id = ' . get('id'));
        $this->db->insert('ordens_produtos',[
            'voo' => get('id'),
            'orden' => session('venda_id'),
            'valor' => $voo->valor_padrao,
            'valor_total' => $voo->valor_padrao,
            'quantidade' => 1
        ]);
        return redirect("pdv");
    }

    function excluir_produto()
    {
        $this->db->delete('ordens_produtos', ['id' => get('id')]);
        return redirect("pdv");
    }


    function concluir()
    {

        if(is_post())
        {
            // ATUALIZA ORDEM
            $this->db->update('ordens',[
                'data' => date("Y-m-d"),
                'status' => 'Concluído',
                'data' => data_en(post('data')),
                'tipo' => 'venda',
                'valor_desconto' => moeda_dollar(post('desconto')),
                'valor_total' => moeda_dollar(post('vtotal'))  * post('parcela'),
            ], ['id' => session('venda_id')]);


            $produtos = $this->db->table("SELECT * FROM ordens_produtos WHERE orden = " . session('venda_id'));

            foreach($produtos as $p)
            {   
                // ATUALIZA ESTOQUE
                if($p->produto > 0) {
                    $produto = $this->db->row("SELECT * FROM produtos WHERE id = " . $p->produto);
                    if($produto->tipo == 'Produto') {
                        $this->db->insert('estoque_movimentos', [
                            'ordem' => get('id'),
                            'produto' => $p->produto,
                            'quantidade' => $p->quantidade,
                            'tipo' => 'Saída',
                            'empresa' => session('empresa'),
                            'armazem' => post('armazem'),
                            'status' => post('estoque'),
                        ]);
                    }
                }


                if($p->voo > 0) {
                    $voo = $this->db->row("SELECT * FROM voos WHERE id = " . $p->voo);
                    $this->db->insert('voos_passageiros', [
                        'id_voo' => $p->voo,
                        'token' => date("d") . date("m") . date("h") . $p->id .  '-' . session('venda_cliente'),
                        'id_cliente' => session('venda_cliente'),
                        'id_ordem' => session('venda_id'),
                    ]);

                    $this->db->update("voos", ['lugares_disponiveis' => $voo->lugares_disponiveis - 1], ['id' => $p->voo]);
                }
            }   


            $redir = session('venda_id');

            // GERA FINANCEIRO
            gera_parcelamento_ordem(post('frequencia'), session('venda_id'), 'venda');
            session_set('venda_cliente', null);
            session_set('venda_nome', null);
            session_set('venda_doc', null);
            session_set('venda_id', null);
            flash('success', 'Venda concluída com sucesso');
            return redirect('pdv/imprimir?id='. $redir);

        }

    }


    public function imprimir()
    {
        $tokens = $this->db->table("SELECT voos_passageiros.*, voos.id as idvoo, voos.data FROM voos_passageiros LEFT JOIN voos ON voos.id = voos_passageiros.id_voo WHERE id_ordem = " . get('id'));
        view('pdv/imprimir', [
            'tokens' => $tokens
        ]);
    }


    public function checkin()
    {

        $voos_passageiros = [];
        if(get('id')) {
            $voos_passageiros =  $this->db->row('SELECT * FROM voos_passageiros WHERE token = "' . get('id') . '"');
            if(!$voos_passageiros) {
                flash('error', 'CÓDIGO DE CHECK IN NÃO ENCONTRADO, ENTRE EM CONTATO COM NOSSA EQUIPE DE VENDAS');
                return redirect('pdv/checkin');
            }
            
        }


        if(is_post()) {

            $this->db->update('voos_passageiros', copy_post(), ['token' => get('id')]);
            $this->db->update('voos_passageiros', ['data_checkin' => date("Y-m-d H:i:s")], ['token' => get('id')]);
            flash('success', 'CHECK IN realizado com sucesso');
            return redirect('pdv/checkin');
        }

        view('pdv/checkin', [
            'voos_passageiros' => $voos_passageiros,
        ]);
    }


}