<?php

class estoque
{
    public $val;
    public $db;

    public function __construct()
    {
        $this->val = new validator();
        $this->db = new db();
    }


    // PRODUTOS
    public function deletar_produtos()
    {
        $this->db->delete("produtos", [id => get('id')]);
        flash("success", "produtos removido com sucesso.");
        return redirect("estoque/produtos");
    }


    public function editar_produtos()
    {
        if (is_post()) {
            $this->val->name('tipo')->value(post('tipo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('produtos', copy_post(), ['id' => get('id')]);
                $data = [
                    'valor' => moeda_dollar(post('valor')),
                    'valor_compra' => moeda_dollar(post('valor_compra')),
                ];

                $this->db->update('produtos', $data, ['id' => get('id')]);
                flash("success", "produtos atualizado com sucesso.");
                return redirect("estoque/produtos");
            }
        }

        $produtos = $this->db->row("SELECT * FROM produtos WHERE id = " . get('id'));
        $produtos_categorias = $this->db->table("SELECT * FROM produtos_categorias WHERE empresa = " . session('empresa'));
        return view("estoque/editar_produtos", [
            'produtos' => $produtos,
            'produtos_categorias' => $produtos_categorias,
        ]);
    }

    public function editar_servicos()
    {
        if (is_post()) {
            $this->val->name('tipo')->value(post('tipo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('produtos', copy_post(), ['id' => get('id')]);
                $data = [
                    'valor' => moeda_dollar(post('valor')),
                    'valor_compra' => moeda_dollar(post('valor_compra')),
                ];

                $this->db->update('produtos', $data, ['id' => get('id')]);
                flash("success", "produtos atualizado com sucesso.");
                return redirect("estoque/servicos");
            }
        }

        $produtos = $this->db->row("SELECT * FROM produtos WHERE id = " . get('id'));
        $produtos_categorias = $this->db->table("SELECT * FROM produtos_categorias WHERE empresa = " . session('empresa'));
        return view("estoque/editar_produtos", [
            'produtos' => $produtos,
            'produtos_categorias' => $produtos_categorias,
        ]);
    }

    public function produtos()
    {
        if (is_post()) {
            $this->val->name('tipo')->value(post('tipo'))->required();
            if ($this->val->isSuccess()) {
                $produto = $this->db->insert("produtos", copy_post());
                $data = [
                    'valor' => moeda_dollar(post('valor')),
                    'valor_compra' => moeda_dollar(post('valor_compra')),
                ];

                $this->db->update('produtos', $data, ['id' => $produto]);

                $this->db->insert('estoque_movimentos', [
                    'empresa' => session('empresa'),
                    'produto' => $produto,
                    'quantidade' => (post('qtd_inicial') > 0) ? post('qtd_inicial') : 0,
                    'tipo' => 'Entrada',
                    'armazem' => post('armazem_inicial'),
                    'usuario' => session('id'),
                    'status' => 'recebido',
                ]);

                flash("success", "produtos adicionado com sucesso.");
                return redirect("estoque/produtos");

            }
        }

	    $produtos_categorias = $this->db->table("SELECT * FROM produtos_categorias WHERE empresa = " . session('empresa'));


        $produtos = $this->db->table("SELECT  SUM(IF(a.tipo = 'Entrada' AND a.status='recebido', a.quantidade, 0) - IF(a.tipo = 'Saida' AND a.status='recebido', a.quantidade, 0)) as total, b.* FROM estoque_movimentos a, produtos b WHERE b.tipo != 'Ferramentas' AND b.id = a.produto AND a.empresa = " . session('empresa') . " GROUP BY b.id");
        #$produtos = $this->db->table("SELECT * FROM produtos WHERE empresa = " . session('empresa'));

        $quantidade_produtos = $this->db->table("SELECT COUNT(*) as total FROM produtos WHERE empresa = " . session('empresa'));
        $quantidade_total_produtos = $this->db->table("SELECT  SUM(IF(a.tipo = 'Entrada' AND a.status='recebido', a.quantidade, 0) - IF(a.tipo = 'Saida' AND a.status='recebido', a.quantidade, 0)) as total, b.* FROM estoque_movimentos a, produtos b WHERE b.tipo <> 'Ferramentas' AND b.id = a.produto AND a.empresa = " . session('empresa'));


        $valor_total_produtos = $this->db->table("SELECT    
                                                        SUM(
                                                            IF(b.movimento = 'compra', a.valor_total, 0)
                                                        ) 
                                                        /  
                                                        SUM(
                                                                IF(b.movimento = 'compra', a.quantidade, 0)
                                                        )
                                                            as total, b.* 
                                                FROM ordens_produtos a, ordens b 
                                                WHERE b.id = a.orden AND b.empresa = " . session('empresa'));

        foreach ($quantidade_produtos as $qp) {
            $total_produtos = $qp->total;
        }

        foreach ($quantidade_total_produtos as $qp) {
            $quantidade_total_produtos = $qp->total;
        }

        foreach ($valor_total_produtos as $qp) {
            $valor_total_produtos = $qp->total * $quantidade_total_produtos;
        }


        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE  empresa = " . session('empresa'));

        return view("estoque/produtos", [
            'produtos' => $produtos,
            'produtos_categorias' => $produtos_categorias,
            'total_produtos' => $total_produtos,
            'quantidade_total_produtos' => $quantidade_total_produtos,
            'valor_total_produtos' => $valor_total_produtos,
            'armazens' => $armazens,
        ]);
    }


    public function servicos()
    {
        if (is_post()) {
            $this->val->name('tipo')->value(post('tipo'))->required();
            if ($this->val->isSuccess()) {
                $produto = $this->db->insert("produtos", copy_post());
                $data = [
                    'valor' => moeda_dollar(post('valor')),
                    'valor_compra' => moeda_dollar(post('valor_compra')),
                ];

                $this->db->update('produtos', $data, ['id' => $produto]);

                $this->db->insert('estoque_movimentos', [
                    'empresa' => session('empresa'),
                    'produto' => $produto,
                    'quantidade' => (post('qtd_inicial') > 0) ? post('qtd_inicial') : 0,
                    'tipo' => 'Entrada',
                    'armazem' => post('armazem_inicial'),
                    'usuario' => session('id'),
                    'status' => 'recebido',
                ]);

                flash("success", "produtos adicionado com sucesso.");
                return redirect("estoque/servicos");

            }
        }

	    $produtos_categorias = $this->db->table("SELECT * FROM produtos_categorias WHERE empresa = " . session('empresa'));


        $produtos = $this->db->table("SELECT  SUM(IF(a.tipo = 'Entrada' AND a.status='recebido', a.quantidade, 0) - IF(a.tipo = 'Saida' AND a.status='recebido', a.quantidade, 0)) as total, b.* FROM estoque_movimentos a, produtos b WHERE b.tipo != 'Ferramentas' AND b.id = a.produto AND a.empresa = " . session('empresa') . " GROUP BY b.id");
        #$produtos = $this->db->table("SELECT * FROM produtos WHERE empresa = " . session('empresa'));

        $quantidade_produtos = $this->db->table("SELECT COUNT(*) as total FROM produtos WHERE empresa = " . session('empresa'));
        $quantidade_total_produtos = $this->db->table("SELECT  SUM(IF(a.tipo = 'Entrada' AND a.status='recebido', a.quantidade, 0) - IF(a.tipo = 'Saida' AND a.status='recebido', a.quantidade, 0)) as total, b.* FROM estoque_movimentos a, produtos b WHERE b.tipo <> 'Ferramentas' AND b.id = a.produto AND a.empresa = " . session('empresa'));


        $valor_total_produtos = $this->db->table("SELECT    
                                                        SUM(
                                                            IF(b.movimento = 'compra', a.valor_total, 0)
                                                        ) 
                                                        /  
                                                        SUM(
                                                                IF(b.movimento = 'compra', a.quantidade, 0)
                                                        )
                                                            as total, b.* 
                                                FROM ordens_produtos a, ordens b 
                                                WHERE b.id = a.orden AND b.empresa = " . session('empresa'));

        foreach ($quantidade_produtos as $qp) {
            $total_produtos = $qp->total;
        }

        foreach ($quantidade_total_produtos as $qp) {
            $quantidade_total_produtos = $qp->total;
        }

        foreach ($valor_total_produtos as $qp) {
            $valor_total_produtos = $qp->total * $quantidade_total_produtos;
        }


        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE  empresa = " . session('empresa'));

        return view("estoque/servicos", [
            'produtos' => $produtos,
            'produtos_categorias' => $produtos_categorias,
            'total_produtos' => $total_produtos,
            'quantidade_total_produtos' => $quantidade_total_produtos,
            'valor_total_produtos' => $valor_total_produtos,
            'armazens' => $armazens,
        ]);
    }


 
    public function ferramentas()
    {
        if (is_post()) {
            $this->val->name('tipo')->value(post('tipo'))->required();
            if ($this->val->isSuccess()) {
                $produto = $this->db->insert("produtos", copy_post());
                $data = [
                    'valor' => moeda_dollar(post('valor')),
                    'valor_compra' => moeda_dollar(post('valor_compra')),
                ];

                $this->db->update('produtos', $data, ['id' => $produto]);

                $this->db->insert('estoque_movimentos', [
                    'empresa' => session('empresa'),
                    'produto' => $produto,
                    'quantidade' => (post('qtd_inicial') > 0) ? post('qtd_inicial') : 0,
                    'tipo' => 'Entrada',
                    'armazem' => post('armazem_inicial'),
                    'usuario' => session('id'),
                    'status' => 'recebido',
                ]);

                flash("success", "produtos adicionado com sucesso.");
                return redirect("estoque/ferramentas");

            }
        }

	    $produtos_categorias = $this->db->table("SELECT * FROM produtos_categorias WHERE empresa = " . session('empresa'));


        $produtos = $this->db->table("SELECT  SUM(IF(a.tipo = 'Entrada' AND a.status='recebido', a.quantidade, 0) - IF(a.tipo = 'Saida' AND a.status='recebido', a.quantidade, 0)) as total, b.* FROM estoque_movimentos a, produtos b WHERE b.tipo= 'Ferramentas' AND b.id = a.produto AND a.empresa = " . session('empresa') . " GROUP BY b.id");
        

        
        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE  empresa = " . session('empresa'));

        return view("estoque/ferramentas", [
            'produtos' => $produtos,
            'produtos_categorias' => $produtos_categorias,
            'total_produtos' => $total_produtos,
            'quantidade_total_produtos' => $quantidade_total_produtos,
            'valor_total_produtos' => $valor_total_produtos,
            'armazens' => $armazens,
        ]);
    }  
	
	public function deletar_estoque()
    {
        $this->db->delete("estoque", [id => get('id')]);
        flash("success", "estoque removido com sucesso.");
        return redirect("estoque");
    }


    public function editar_estoque()
    {
        if (is_post()) {
            if ($this->val->isSuccess()) {
                $this->db->update("estoque", copy_post(), ['id' => get('id')]);
                flash("success", "estoque atualizado com sucesso.");
                return redirect("estoque");
            }
        }

        $estoque = $this->db->row("SELECT * FROM estoque WHERE id = " . get('id'));

        return view("estoque/editar_estoque", [
            "estoque" => $estoque,
        ]);
    }


    public function index()
    {
        if (is_post()) {
            $this->val->name('estoque')->value(post('estoque'))->required();
            $this->val->name('produto')->value(post('produto'))->required();

            if ($this->val->isSuccess()) {
                $this->db->insert("estoque", copy_post());
                flash("success", "estoque adicionado com sucesso.");
                return redirect("estoque");
            }
        }

        $estoques = $this->db->table("SELECT * FROM estoque WHERE empresa = " . session('empresa'));
        $produtos = $this->db->table("SELECT * FROM produtos WHERE empresa = " . session('empresa'));
        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE empresa = " . session('empresa'));


        return view("estoque/estoque", [
            "estoques" => $estoques,
            "produtos" => $produtos,
            "armazens" => $armazens,
        ]);
    }


    // CATEGORIAS DE PRODUTOS
    public function deletar_produtos_categorias()
    {
        $this->db->delete("produtos_categorias", [id => get('id')]);
        flash("success", "produtos_categorias removido com sucesso.");
        return redirect("estoque/produtos_categorias");
    }


    public function editar_produtos_categorias()
    {
        if (is_post()) {
            if ($this->val->isSuccess()) {
                $this->db->update("produtos_categorias", copy_post(), ['id' => get('id')]);
                flash("success", "produtos_categorias atualizado com sucesso.");
                return redirect("estoque/produtos_categorias");
            }
        }
        $produtos_categorias = $this->db->row("SELECT * FROM produtos_categorias WHERE id = " . get('id'));

        return view("estoque/editar_produtos_categorias", [
            "produtos_categorias" => $produtos_categorias,
        ]);
    }

    public function produtos_categorias()
    {
        if (is_post()) {
            if ($this->val->isSuccess()) {
                $this->db->insert("produtos_categorias", copy_post());
                flash("success", "produtos_categorias adicionado com sucesso.");
                return redirect("estoque/produtos_categorias");
            }
        }

        $produtos_categorias = $this->db->table("SELECT * FROM produtos_categorias");

        return view("estoque/produtos_categorias", [
            "produtos_categorias" => $produtos_categorias,
        ]);
    }

    public function select_ncm()
    {
        $search = (isset($_POST['searchTerm'])) ? $_POST['searchTerm'] : '';
        $ncms = $this->db->table("SELECT * FROM produtos_ncm WHERE (nome like '%" . $search . "%' OR codigo like '%" . $search . "%') limit 5");
        foreach ($ncms as $n) {
            $data[] = array("id" => $n->codigo, "text" => $n->codigo . " - " . $n->nome);
        }
        echo json_encode($data);
    }

    public function select_cest()
    {
        $search = (isset($_POST['searchTerm'])) ? $_POST['searchTerm'] : '';
        $cest = $this->db->table("SELECT * FROM produtos_cest WHERE nome like '%" . $search . "%' or codigo like '%" . $search . "%' limit 5");
        foreach ($cest as $n) {
            $data[] = array("id" => $n->codigo, "text" => $n->codigo . " - " . $n->nome);
        }
        echo json_encode($data);
    }

    public function select_csosn()
    {
        $search = (isset($_POST['searchTerm'])) ? $_POST['searchTerm'] : '';
        $csosn = $this->db->table("SELECT * FROM produtos_csosn WHERE nome like '%" . $search . "%' or codigo like '%" . $search . "%' limit 5");
        foreach ($csosn as $n) {
            $data[] = array("id" => $n->codigo, "text" => $n->codigo . " - " . $n->nome);
        }
        echo json_encode($data);
    }


    // ARMAZENS
    public function deletar_armazens()
    {
        $this->db->delete("estoque_armazens", [id => get('id')]);
        flash("success", "armazens removido com sucesso.");
        return redirect("estoque/armazens");
    }


    public function editar_armazens()
    {
        if (is_post()) {

            if ($this->val->isSuccess()) {
                $this->db->update("estoque_armazens", copy_post(), ['id' => get('id')]);
                flash("success", "armazens atualizado com sucesso.");
                return redirect("estoque/armazens");
            }
        }

        $armazens = $this->db->row("SELECT * FROM estoque_armazens WHERE id = " . get('id'));

        return view("estoque/editar_armazens", [
            'armazens' => $armazens,
        ]);
    }

    public function armazens()
    {
        if (is_post()) {

            if ($this->val->isSuccess()) {
                $this->db->insert("estoque_armazens", copy_post());
                flash("success", "armazens adicionado com sucesso.");
                return redirect("estoque/armazens");
            }
        }

        $armazens = $this->db->table("SELECT * FROM estoque_armazens WHERE empresa = " . session('empresa'));

        return view("estoque/armazens", [
            'armazens' => $armazens,
        ]);
    }


    // MOVIMENTAÇÃO DE ESTOQUE


    public function resumido()
    {

        $sql = '';

        if (get('farmazem') > 0) {
            $sql .= ' AND estoque_movimentos.armazem = ' . get('farmazem');
        }

        if (get('f2armazem') > 0) {
            $sql .= ' AND estoque_movimentos.armazem = ' . get('f2armazem');
        }

        if (get('fdata_inicial')) {
            $sql .= ' AND estoque_movimentos.data > "' . date('Y-m-d', (strtotime('-1 day', strtotime(data_en(get('fdata_inicial')))))) . '"';
        }

        if (get('fdata_final')) {
            $sql .= ' AND estoque_movimentos.data < "' . date('Y-m-d', (strtotime('+1 day', strtotime(data_en(get('fdata_final')))))) . '"';
        }


        $estoque = $this->db->table("SELECT estoque_movimentos.*, ordens.data as od, ordens.status as od, crm_empresas.status as crms, crm_empresas.razao_social, produtos.nome as nome_produto, produtos.id as id_produto FROM estoque_movimentos 
                                    LEFT JOIN ordens ON estoque_movimentos.ordem = ordens.id
                                    LEFT JOIN produtos ON estoque_movimentos.produto = produtos.id
                                    LEFT JOIN crm_empresas ON crm_empresas.id = ordens.cliente_fornecedor WHERE estoque_movimentos.empresa = " . session('empresa') . $sql);

        $produtos = $this->db->table("SELECT produtos.*, 
                                                             SUM(IF(estoque_movimentos.tipo = 'Entrada' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0) - 
                                                             IF(estoque_movimentos.tipo = 'Saida' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0))  as total 
                                                             
                                        FROM produtos 
                                        LEFT JOIN estoque_movimentos ON estoque_movimentos.produto = produtos.id
                                        WHERE estoque_movimentos.empresa = " . session('empresa') . $sql . " GROUP BY produtos.id");

        $estoque2 = $this->db->table("SELECT produtos.*, 
                                             (SUM(IF(estoque_movimentos.tipo = 'Entrada' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0)) - 
                                             SUM(IF(estoque_movimentos.tipo = 'Saida' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0))) 
                                                as qtd
                                                
                                    FROM produtos 
                                    LEFT JOIN estoque_movimentos ON estoque_movimentos.produto = produtos.id
                                    GROUP BY produtos.id");


        return view("estoque/resumido", [
            'estoque' => $estoque,
            'estoque2' => $estoque2,
            'produtos' => $produtos,
            'armazens' => $this->db->table("SELECT * FROM estoque_armazens WHERE  empresa = " . session('empresa')),
        ]);


    }

    public function resumido_ferramentas()
    {

        $sql = '';

        if (get('farmazem') > 0) {
            $sql .= ' AND estoque_movimentos.armazem = ' . get('farmazem');
        }

        if (get('f2armazem') > 0) {
            $sql .= ' AND estoque_movimentos.armazem = ' . get('f2armazem');
        }

        if (get('fdata_inicial')) {
            $sql .= ' AND estoque_movimentos.data > "' . date('Y-m-d', (strtotime('-1 day', strtotime(data_en(get('fdata_inicial')))))) . '"';
        }

        if (get('fdata_final')) {
            $sql .= ' AND estoque_movimentos.data < "' . date('Y-m-d', (strtotime('+1 day', strtotime(data_en(get('fdata_final')))))) . '"';
        }


        $estoque = $this->db->table("SELECT estoque_movimentos.*, ordens.data as od, ordens.status as od, crm_empresas.status as crms, crm_empresas.razao_social, produtos.nome as nome_produto, produtos.id as id_produto FROM estoque_movimentos 
                                    LEFT JOIN ordens ON estoque_movimentos.ordem = ordens.id
                                    LEFT JOIN produtos ON estoque_movimentos.produto = produtos.id
                                    LEFT JOIN crm_empresas ON crm_empresas.id = ordens.cliente_fornecedor WHERE produtos.tipo = 'Ferramentas' AND  estoque_movimentos.empresa = " . session('empresa') . $sql);

        $produtos = $this->db->table("SELECT produtos.*, 
                                                             SUM(IF(estoque_movimentos.tipo = 'Entrada' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0) - 
                                                             IF(estoque_movimentos.tipo = 'Saida' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0))  as total 
                                                             
                                        FROM produtos 
                                        LEFT JOIN estoque_movimentos ON estoque_movimentos.produto = produtos.id
                                        WHERE produtos.tipo = 'Ferramentas' AND  estoque_movimentos.empresa = " . session('empresa') . $sql . " GROUP BY produtos.id");

        $estoque2 = $this->db->table("SELECT produtos.*, 
                                             (SUM(IF(estoque_movimentos.tipo = 'Entrada' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0)) - 
                                             SUM(IF(estoque_movimentos.tipo = 'Saida' AND estoque_movimentos.status='recebido', estoque_movimentos.quantidade, 0))) 
                                                as qtd
                                                
                                    FROM produtos 
                                    LEFT JOIN estoque_movimentos ON estoque_movimentos.produto = produtos.id
                                    WHERE produtos.tipo = 'Ferramentas'
                                    GROUP BY produtos.id");


        return view("estoque/resumido", [
            'estoque' => $estoque,
            'estoque2' => $estoque2,
            'produtos' => $produtos,
            'armazens' => $this->db->table("SELECT * FROM estoque_armazens WHERE  empresa = " . session('empresa')),
        ]);


    }

}
