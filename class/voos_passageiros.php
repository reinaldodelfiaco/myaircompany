<?php class voos_passageiros { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    public function deletar_voos_passageiros() 
    {   
        $voos_passageiros = $this->db->row("SELECT * FROM voos_passageiros WHERE id = " . get('id')); 
        $this->db->delete("voos_passageiros", [id=> get('id')]);
        flash("success", "voos_passageiros removido com sucesso.");
        return redirect("voos_passageiros/voos_passageiros?id = " . $voos_passageiros->id_voo); 
    }

    public function editar_voos_passageiros() 
    {   
        $voos_passageiros = $this->db->row("SELECT * FROM voos_passageiros WHERE id = " . get('id')); 


        if(is_post()) 
        {
            $this->val->name('nome_passageiro')->value(post('nome_passageiro'))->required();
            $this->val->name('sobrenome_passageiro')->value(post('sobrenome_passageiro'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("voos_passageiros",copy_post(), ['id'=> get('id')]);
                flash("success", "voos_passageiros atualizado com sucesso.");
                return redirect("voos_passageiros/voos_passageiros?id=$voos_passageiros->id_voo"); 
            }
        }

        $clientes = $this->db->table("SELECT * FROM crm_empresas WHERE cliente  = 1");
        $vendedores = $this->db->table("SELECT * FROM chefias WHERE regra  = 'Comercial'");
        $agencias = $this->db->table("SELECT * FROM crm_empresas WHERE agencia  = 1");

        $formas_pagamentos = $this->db->table('SELECT * FROM formas_pagamento');
        $moedas = $this->db->table("SELECT * FROM unidades WHERE tipo='moeda'");
        

        return view("voos_passageiros/editar_voos_passageiros", [
            'voos_passageiros' => $voos_passageiros,
            'clientes' => $clientes,
            'agencias' => $agencias,
            'vendedores' => $vendedores,
            'formas_pagamentos' => $formas_pagamentos,
            'moedas' => $moedas,
        ]);
    }
    
    public function voos_passageiros()
    {   
        $id = get('id');
        $total_cadastrados_analise = $this->db->table("SELECT COUNT(*) as total FROM voos_passageiros WHERE id_voo = " . get('id'));
        $tca = retorna_total($total_cadastrados_analise);

        if(is_post()) 
        {
            $this->val->name('nome_passageiro')->value(post('nome_passageiro'))->required();
            $this->val->name('sobrenome_passageiro')->value(post('sobrenome_passageiro'))->required();

            if($this->val->isSuccess())
            {   
                //VERIFICA SE HÁ PASSAGENS DISPONÍVEIS
                $voo = $this->db->row("SELECT * FROM voos WHERE id = " . post('id_voo'));
                $total_cadastrados = $this->db->table("SELECT COUNT(*) as total FROM voos_passageiros WHERE id_voo = " . post('id_voo'));
                $tc = retorna_total($total_cadastrados);

                #if(($tc + 1)  > $voo->lugares) {
                    #flash('error', 'Não há mais espaço para esse voo');
                    #return redirect("voos_passageiros/voos_passageiros?id=" . post('id_voo')); 
                #}


                $this->db->insert("voos_passageiros", copy_post());
                flash("success", "voos_passageiros adicionado com sucesso.");
                return redirect("voos_passageiros/voos_passageiros?id=" . post('id_voo')); 
            }
        }

        $voos_passageiros = $this->db->table("SELECT * FROM voos_passageiros WHERE id_voo = $id");
        $clientes = $this->db->table("SELECT * FROM crm_empresas WHERE cliente  = 1");
        $vendedores = $this->db->table("SELECT * FROM chefias WHERE regra  = 'Comercial'");
        $agencias = $this->db->table("SELECT * FROM crm_empresas WHERE agencia  = 1");

        $formas_pagamentos = $this->db->table('SELECT * FROM formas_pagamento');
        $moedas = $this->db->table("SELECT * FROM unidades WHERE tipo='moeda'");

        return view("voos_passageiros/voos_passageiros", [
            'voos_passageiros' => $voos_passageiros,
            'clientes' => $clientes,
            'agencias' => $agencias,
            'vendedores' => $vendedores,
            'formas_pagamentos' => $formas_pagamentos,
            'moedas' => $moedas,
            'tca' => $tca,
            'voo' => $this->db->row("SELECT * FROM voos WHERE id = " . get('id'))
        ]);
    }
    

    public function lista_passageiros()
    {   
     
        $voos_passageiros = $this->db->table("SELECT * FROM voos_passageiros left join voos on voos.id = voos_passageiros.id_voo");

        return view("voos_passageiros/lista_passageiros", [
            'voos_passageiros' => $voos_passageiros,
        ]);
    }

    public function contato_familia()
    {   
     
        $voos_passageiros = $this->db->table("SELECT * FROM voos_passageiros left join voos on voos.id = voos_passageiros.id_voo");

        return view("voos_passageiros/contato_familia", [
            'voos_passageiros' => $voos_passageiros,
        ]);
    }
}