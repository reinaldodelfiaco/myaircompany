<?php

class financeiro
{

    public $val;
    public $db;
    public function __construct()
    {
        $this->val = new validator();
        $this->db = new db();

    }

    public function contas_bancarias()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('agencia')->value(post('agencia'))->required();
            $this->val->name('conta')->value(post('conta'))->required();
            $this->val->name('banco')->value(post('banco'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();

            if ($this->val->isSuccess()) {

                $id = $this->db->insert('contas_bancarias', copy_post());

                $data = [
                    'titulo' => 'Lançamento de saldo: ' .  post('nome'),
                    'status' => 'pago',
                    'valor' => moeda_dollar(post('saldo')),
                    'valor_pago' => moeda_dollar(post('saldo')),
                    'tipo' => 'receita',
                    'data_vencimento' => date("Y-m-d"),
                    'data_pagamento' => date("Y-m-d"),
                    'banco' => $id,
                    'empresa' => session('empresa')
                ];

                $this->db->insert('movimentos', $data);

                flash('success', 'Conta adicionada com sucesso.');
                redirect('financeiro/contas_bancarias');

            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }

        }

        $contas_bancarias = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa = '" . session('empresa') ."'");
        return view('financeiro/contas_bancarias', ['contas_bancarias' => $contas_bancarias]);


    }


    public function editar_contas_bancarias()
    {


        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('agencia')->value(post('agencia'))->required();
            $this->val->name('conta')->value(post('conta'))->required();
            $this->val->name('banco')->value(post('banco'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();


            if ($this->val->isSuccess()) {

                $this->db->update('contas_bancarias', copy_post(), ['id' => get('id')]);
                flash('success', 'Conta editada com sucesso.');
                return redirect('financeiro/contas_bancarias');

            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }

        }

        $conta_bancaria = $this->db->row('SELECT * FROM contas_bancarias WHERE id=' . get('id'));
        view('financeiro/editar_contas_bancarias', ['conta_bancaria' => $conta_bancaria]);


    }

    public function categorias_financeiras()
    {

        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();

            if ($this->val->isSuccess()) {

                $this->db->insert('categorias_financeiras', copy_post());

                flash('success', 'Categoria adicionada com sucesso.');

                return redirect('financeiro/categorias_financeiras');

            } else {

                echo "Validation Error!";
                var_dump($this->val->getErrors());

            }

        }

        $categorias_financeiras = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa = " . session('empresa'));

        view('financeiro/categorias_financeiras', ['categorias_financeiras' => $categorias_financeiras]);

    }

    public function editar_categorias_financeiras()
    {
        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();

            if ($this->val->isSuccess()) {

                $this->db->update('categorias_financeiras', copy_post(), ['id' => get('id')]);

                flash('success', 'Categoria atualizada com sucesso.');

                return redirect('financeiro/categorias_financeiras');

            } else {

                echo "Validation Error!";
                var_dump($this->val->getErrors());

            }


        }

        $categoria_financeira = $this->db->row("SELECT * FROM categorias_financeiras WHERE id = " . get('id'));

        view('financeiro/editar_categorias_financeiras', ['categoria_financeira' => $categoria_financeira]);


    }

    public function contas_contabeis()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('codigo')->value(post('codigo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->insert('contas_contabeis', copy_post());
                flash('success', 'Conta adicionada com sucesso.');
                return redirect('financeiro/contas_contabeis');
            } else {
                echo "Validation Error!";
                var_dump($this->val->getErrors());
            }
        }
        $contas_contabeis = $this->db->table('SELECT * FROM contas_contabeis WHERE empresa = ' . session('empresa'));
        view('financeiro/contas_contabeis', ['contas_contabeis' => $contas_contabeis]);
    }

    public function editar_contas_contabeis()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('codigo')->value(post('codigo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('contas_contabeis', copy_post(), ['id' => get('id')]);
                flash('success', 'Conta editada com sucesso.');
                return redirect('financeiro/contas_contabeis');
            } else {

                echo "Validation Error!";
                var_dump($this->val->getErrors());
            }
        }
        $contas_contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE id != " . get('id') . " AND empresa = " . session('empresa'));
        $conta_contabil = $this->db->row('SELECT * FROM contas_contabeis WHERE id = ' . get('id'));
        view('financeiro/editar_contas_contabeis', ['contas_contabeis' => $contas_contabeis, 'conta_contabil' => $conta_contabil]);
    }


    // Formas de Pagamento - Humberto 27/01/2019

    public function formas_pagamento()
    {

        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            if ($this->val->isSuccess()) {
                $this->db->insert('formas_pagamento', copy_post());
                flash('success', 'Forma de pagamento adicionada com sucesso');
                return redirect('financeiro/formas_pagamento');

            }
        }

        $formas_pagamento = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa = " . session('empresa'));
        view('financeiro/formas_pagamento', [
            'formas_pagamento' => $formas_pagamento,
        ]);
    }


    public function editar_formas_pagamento()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('formas_pagamento', copy_post(), ['id' => get('id')]);
                flash('success', 'Forma de pagamento atualizada com sucesso');
                return redirect('financeiro/formas_pagamento');

            }
        }

        $forma_pagamento = $this->db->row("SELECT * FROM formas_pagamento WHERE id = " . get('id'));
        view('financeiro/editar_formas_pagamento', [
            'forma_pagamento' => $forma_pagamento,
        ]);


    }


    public function caixas()
    {

        
       
        $sql = " AND status = 'pago'";
        $sql2 = " AND status = 'pago'";

      
        if(get('fconta')) 
        {
            $sql .= " AND banco = '".get('fconta')."'";
            $sql2 .= " AND banco = '".get('fconta')."'";
        }

        /*if(empty(get('fdata_incial')) && empty(get('fdata_final')))
        {
            $sql .= " AND data_vencimento >= '".date("Y-m")."-01' AND data_vencimento <= '".date("Y-m")."-31'";
        }*/

        if(get('fdata_inicial')) 
        {
            $sql .= " AND data_vencimento >= '".data_en(get('fdata_inicial')). "'";
        }

        if(get('fdata_final')) 
        {
            $sql .= " AND data_vencimento <= '" . data_en(get('fdata_final')) . "'";
            $sql2 .= " AND data_vencimento <= '" . data_en(get('fdata_final')) . "'";
        }


        $movimentos = $this->db->table('SELECT * FROM movimentos  WHERE empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');

        $total_geral = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="despesa" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral as $v) {
            $desp = $v->total;
        }

        $total_geral = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="receita" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral as $v) {
            $rec = $v->total;
        }

        $total_geral = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="receita" AND empresa = ' . session('empresa') . $sql2 . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral as $v) {
            $totalgeralr = $v->total;
        }   

        
        $total_geral = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="despesa" AND empresa = ' . session('empresa') . $sql2 . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral as $v) {
            $totalgerald = $v->total;
        }


        $totalgeralfinal = $totalgeralr - $totalgerald;


        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/caixas', [
            'movimentos' => $movimentos,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf,
            'desp' => $desp,
            'rec' => $rec,
            'totalgeralfinal' => $totalgeralfinal,
        ]);
    }



    //MOVIMENTOS FINANCEIROS
    public function movimentos()
    {

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('valor')->value(post('valor'))->required();
            $this->val->name('data_vencimento')->value(post('data_vencimento'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();
            $this->val->name('status')->value(post('status'))->required();

            if ($this->val->isSuccess()) {

                if (post('recorrente') == 1 || post('parcela') < 2) {
                    $mid = $this->db->insert('movimentos', copy_post());
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('valor')),
                        'data_vencimento' => data_en(post('data_vencimento')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => $mid]);
                    flash('success','Movimento adicionado com sucesso');
                    return redirect('financeiro/movimentos');
                } else {
                    gera_parcelamento(post('frequencia'));
                    flash('success', 'Movimento adicionado com sucesso');
                    return redirect('financeiro/movimentos');
                }
            }

        }

	    $sql = "";
        
        if(get('fstatus')) 
        {
            $sql .= " AND status = '".get('fstatus')."'";
        }

        if(get('ftipo')) 
        {
            $sql .= " AND tipo = '".get('ftipo')."'";
        }

        /*if(empty(get('fdata_incial')) && empty(get('fdata_final')))
        {
            $sql .= " AND data_vencimento >= '".date("Y-m")."-01' AND data_vencimento <= '".date("Y-m")."-31'";
        }*/

        if(get('fdata_inicial')) 
        {
            $sql .= " AND data_vencimento >= '".data_en(get('fdata_inicial')). "'";
        }

        if(get('fdata_final')) 
        {
            $sql .= " AND data_vencimento <= '" . data_en(get('fdata_final')) . "'";
        }

        if(get('fldata_inicial')) 
        {
            $sql .= " AND data_lancamento >= '".data_en(get('fldata_inicial')). "'";
        }

        if(get('fldata_final')) 
        {
            $sql .= " AND data_lancamento <= '" . data_en(get('fldata_final')) . "'";
        }

        $movimentos = $this->db->table('SELECT * FROM movimentos  WHERE empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');

        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/movimentos', [
            'movimentos' => $movimentos,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf
        ]);
    }

    public function despesas()
    {

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('valor')->value(post('valor'))->required();
            $this->val->name('data_vencimento')->value(post('data_vencimento'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();
            $this->val->name('status')->value(post('status'))->required();

            if ($this->val->isSuccess()) {

                if (post('recorrente') == 1 || post('parcela') < 2) {
                    $mid = $this->db->insert('movimentos', copy_post());
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('valor')),
                        'data_vencimento' => data_en(post('data_vencimento')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => $mid]);

                    
                    flash('success','Movimento adicionado com sucesso');
                    return redirect('financeiro/despesas');
                } else {
                    gera_parcelamento(post('frequencia'));
                    flash('success', 'Movimento adicionado com sucesso');
                    return redirect('financeiro/despesas');
                }
            }

        }

        $sql = "";
        $idempresa = session('empresa');
        
        if(get('fstatus')) 
        {
            $sql .= " AND status = '".get('fstatus')."'";
        }


        if(empty(get('fdata_incial')) && empty(get('fdata_final')))
        {   
            $sql .= ' AND data_vencimento >= "' . date("Y-m") . '-01" AND data_vencimento <= "' .date("Y-m").'-31"';
        }

        if(get('fdata_inicial')) 
        {
            $sql .= " AND data_vencimento >= '".data_en(get('fdata_inicial')). "'";
        }

        if(get('fdata_final')) 
        {
            $sql .= " AND data_vencimento <= '" . data_en(get('fdata_final')) . "'";
        }

        if(get('fldata_inicial')) 
        {
            $sql .= " AND data_lancamento >= '".data_en(get('fldata_inicial')). "'";
        }

        if(get('fldata_final')) 
        {
            $sql .= " AND data_lancamento <= '" . data_en(get('fldata_final')) . "'";
        }


        $movimentos = $this->db->table("SELECT * FROM movimentos  WHERE tipo='despesa' AND empresa = $idempresa " . $sql . " ORDER BY data_vencimento ASC");
        $total_geral = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="despesa" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral as $v) {
            $tgeral = $v->total;
        }

        $total_geral_pago = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="despesa" AND status="pago" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral_pago as $tgp) {
            $tpago = $tgp->total;
        }

        $total_atraso = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="despesa" AND data_vencimento < "'.date("Y-m-d").'" AND status="aberto" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_atraso as $ta) {
            $tatraso = $ta->total;
        }


        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/despesas', [
            'movimentos' => $movimentos,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf,
            'tgeral' => $tgeral,
            'tpago' => $tpago,
            'tatraso' => $tatraso,
        ]);
    }
    

    public function receitas()
    {


        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('valor')->value(post('valor'))->required();
            $this->val->name('data_vencimento')->value(post('data_vencimento'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();
            $this->val->name('status')->value(post('status'))->required();

            if ($this->val->isSuccess()) {

                if (post('recorrente') == 1 || post('parcela') < 2) {
                    $mid = $this->db->insert('movimentos', copy_post());
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('valor')),
                        'data_vencimento' => data_en(post('data_vencimento')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => $mid]);
                    flash('success','Movimento adicionado com sucesso');
                    return redirect('financeiro/receitas');
                } 
                
                else {
                    gera_parcelamento(post('frequencia'));
                    flash('success', 'Movimento adicionado com sucesso');
                    return redirect('financeiro/receitas');
                }
            }

        }

        $sql = "";
        
        if(get('fstatus')) 
        {
            $sql .= " AND status = '".get('fstatus')."'";
        }


        if(empty(get('fdata_incial')) && empty(get('fdata_final')))
        {
            $sql .= " AND data_vencimento >= '".date("Y-m")."-01' AND data_vencimento <= '".date("Y-m")."-31'";
        }

        if(get('fdata_inicial')) 
        {
            $sql .= " AND data_vencimento >= '".data_en(get('fdata_inicial')). "'";
        }
        

        if(get('fdata_final')) 
        {
            $sql .= " AND data_vencimento <= '" . data_en(get('fdata_final')) . "'";
        }

        if(get('fldata_inicial')) 
        {
            $sql .= " AND data_lancamento >= '".data_en(get('fldata_inicial')). "'";
        }

        if(get('fldata_final')) 
        {
            $sql .= " AND data_lancamento <= '" . data_en(get('fldata_final')) . "'";
        }


        $movimentos = $this->db->table('SELECT * FROM movimentos  WHERE tipo="receita" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');
        $total_geral = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="receita" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral as $v) {
            $tgeral = $v->total;
        }

        $total_geral_pago = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="receita" AND status="pago" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_geral_pago as $tgp) {
            $tpago = $tgp->total;
        }

        $total_atraso = $this->db->table('SELECT sum(VALOR) as total FROM movimentos  WHERE tipo="receita" AND data_vencimento < "'.date("Y-m-d").'" AND status="aberto" AND empresa = ' . session('empresa') . $sql . ' ORDER BY data_vencimento ASC');


        foreach ($total_atraso as $ta) {
            $tatraso = $ta->total;
        }

        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/receitas', [
            'movimentos' => $movimentos,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf,
            'tgeral' => $tgeral,
            'tpago' => $tpago,
            'tatraso' => $tatraso,
        ]);
    }
    

    public function nova_despesa()
    {

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('valor')->value(post('valor'))->required();
            $this->val->name('data_vencimento')->value(post('data_vencimento'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();
            $this->val->name('status')->value(post('status'))->required();

            if ($this->val->isSuccess()) {

                if (post('recorrente') == 1 || post('parcela') < 2) {
                    $mid = $this->db->insert('movimentos', copy_post());
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('valor')),
                        'data_vencimento' => data_en(post('data_vencimento')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => $mid]);
                    flash('success','Movimento adicionado com sucesso');
                    return redirect('financeiro/movimentos');
                } else {
                    gera_parcelamento();

                    flash('sucess', 'Movimento adicionado com sucesso');
                    return redirect('financeiro/movimentos');
                }
            }

        }


        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/nova_despesa', [
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf
        ]);
    }

    public function nova_receita()
    {

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('valor')->value(post('valor'))->required();
            $this->val->name('data_vencimento')->value(post('data_vencimento'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();
            $this->val->name('status')->value(post('status'))->required();

            if ($this->val->isSuccess()) {

                if (post('recorrente') == 1 || post('parcela') < 2) {
                    $mid = $this->db->insert('movimentos', copy_post());
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('valor')),
                        'data_vencimento' => data_en(post('data_vencimento')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => $mid]);
                    flash('success', 'Movimento adicionado com sucesso');
                    return redirect('financeiro/movimentos');
                } else {
                    gera_parcelamento();

                    flash('success', 'Movimento adicionado com sucesso');
                    return redirect('financeiro/movimentos');
                }
            }

        }


        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/nova_receita', [
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf
        ]);
    }
    
    public function editar_movimento()
    {

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('valor')->value(post('valor'))->required();
            $this->val->name('data_vencimento')->value(post('data_vencimento'))->required();
            $this->val->name('tipo')->value(post('tipo'))->required();
            $this->val->name('status')->value(post('status'))->required();

            if ($this->val->isSuccess()) {

                    $this->db->update('movimentos', copy_post(), ['id' => get('id')]);
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'valor' => moeda_dollar(post('valor')),
                        'data_vencimento' => data_en(post('data_vencimento')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => get('id')]);
                    flash('success','Movimento alterado com sucesso');
                    return redirect('financeiro/movimentos');
            }

        }

        $movimento = $this->db->row('SELECT * FROM movimentos WHERE id = ' . get('id'));

        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        view('financeiro/editar_movimento', [
            'movimento' => $movimento,
            'categorias' => $categorias,
            'bancos' => $bancos,
            'contabeis' => $contabeis,
            'formas' => $formas,
            'cf' => $cf
        ]);
    }
	
    public function confirmar_pagamento()
    {

        if (is_post()) {

            $this->val->name('data_pagamento')->value(post('data_pagamento'))->required();
            $this->val->name('valor_pago')->value(post('valor_pago'))->required();

            if ($this->val->isSuccess()) {

                    $this->db->update('movimentos', copy_post(), ['id' => get('id')]);
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];
                    $this->db->update('movimentos', $update, ['id' => get('id')]);
                    flash('success','Movimento alterado com sucesso');
                    return redirect('financeiro/movimentos');
            }

        }

        $movimento = $this->db->row('SELECT * FROM movimentos WHERE id = ' . get('id'));
        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        if($movimento->recorrente == 1) {
            view('financeiro/confirmar_recorrente', [
                'movimento' => $movimento,
                'categorias' => $categorias,
                'bancos' => $bancos,
                'contabeis' => $contabeis,
                'formas' => $formas,
                'cf' => $cf
            ]);
        } else {
            view('financeiro/confirmar_pagamento', [
                'movimento' => $movimento,
                'categorias' => $categorias,
                'bancos' => $bancos,
                'contabeis' => $contabeis,
                'formas' => $formas,
                'cf' => $cf
            ]);
        }

    }

    public function confirmar_recorrente()
    {

        if (is_post()) {

            $this->val->name('data_pagamento')->value(post('data_pagamento'))->required();
            $this->val->name('valor_pago')->value(post('valor_pago'))->required();

            if ($this->val->isSuccess()) {

                    $mid = $this->db->insert('movimentos', copy_post());
                    
                    $update = [
                        'valor_pago' => moeda_dollar(post('valor_pago')),
                        'data_pagamento' => data_en(post('data_pagamento')),
                    ];

                    $this->db->update('movimentos', $update, ['id' => $mid]);
                    flash('success','Movimento alterado com sucesso');
                    return redirect('financeiro/movimentos');
            }

        }

        $movimento = $this->db->row('SELECT * FROM movimentos WHERE id = ' . get('id'));
        $categorias = $this->db->table("SELECT * FROM categorias_financeiras WHERE empresa  = " . session('empresa'));
        $bancos = $this->db->table("SELECT * FROM contas_bancarias WHERE empresa  = " . session('empresa'));
        $contabeis = $this->db->table("SELECT * FROM contas_contabeis WHERE empresa  = " . session('empresa'));
        $formas = $this->db->table("SELECT * FROM formas_pagamento WHERE empresa  = " . session('empresa'));
        $cf = $this->db->table("SELECT * FROM crm_empresas WHERE empresa  = " . session('empresa'));

        if($movimento->recorrente == 1) {
            view('financeiro/confirmar_recorrente', [
                'movimento' => $movimento,
                'categorias' => $categorias,
                'bancos' => $bancos,
                'contabeis' => $contabeis,
                'formas' => $formas,
                'cf' => $cf
            ]);
        } else {
            view('financeiro/confirmar_pagamento', [
                'movimento' => $movimento,
                'categorias' => $categorias,
                'bancos' => $bancos,
                'contabeis' => $contabeis,
                'formas' => $formas,
                'cf' => $cf
            ]);
        }

    }



    public function deletar_movimento()
    {
        $this->db->delete('movimentos', ['id' => get('id')]);
        flash('success', 'Movimento removido com sucesso!');
        return redirect('financeiro/movimentos');

    }
}
       
      
      
      
   
