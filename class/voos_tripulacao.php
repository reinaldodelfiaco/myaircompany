<?php class voos_tripulacao { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_voos_tripulacao() 
    {   
        $voos_tripulacao = $this->db->row("SELECT * FROM voos_tripulacao WHERE id = " . get('id')); 
        $this->db->delete("voos_tripulacao", [id=> get('id')]);
        flash("success", "Tripulante removido com sucesso.");
        return redirect("voos_tripulacao/voos_tripulacao?id=" . $voos_tripulacao->voo); 
    }

    public function editar_voos_tripulacao() 
    {   
        $voos_tripulacao = $this->db->row("SELECT * FROM voos_tripulacao WHERE id = " . get('id')); 

       
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("voos_tripulacao",copy_post(), ['id'=> get('id')]);
                flash("success", "Tripulante atualizado com sucesso.");
                return redirect("voos_tripulacao/voos_tripulacao?id=" . $voos_tripulacao->voo); 
            }
        }


        return view("voos_tripulacao/editar_voos_tripulacao", [
            'voos_tripulacao' => $voos_tripulacao,
            'chefias' => $this->db->table("SELECT *, concat(cargos.nome, ' >> ', chefias.nome) as funcao FROM chefias LEFT JOIN cargos ON chefias.cargo = cargos.id WHERE (cargos.id = 7 OR cargos.id = 5 OR cargos.id = 6)")
        ]);
    }
    
    public function voos_tripulacao()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("voos_tripulacao", copy_post());
                flash("success", "Tripulante adicionado com sucesso.");
                return redirect("voos_tripulacao/voos_tripulacao?id=" . post('voo')); 
            }
        }

        $voos_tripulacao = $this->db->table("SELECT voos_tripulacao.id as id, voos_tripulacao.*, chefias.nome,  voos_tripulacao.cargo as ncargo, voos_tripulacao.status as nstatus FROM voos_tripulacao LEFT JOIN voos ON voos.id = voos_tripulacao.voo LEFT JOIN chefias ON chefias.id = voos_tripulacao.chefia WHERE voo = " . get('id'));
        
        return view("voos_tripulacao/voos_tripulacao", [
            'voos_tripulacao' => $voos_tripulacao,
            'chefias' => $this->db->table("SELECT *, concat(cargos.nome, ' >> ', chefias.nome) as funcao FROM chefias LEFT JOIN cargos ON chefias.cargo = cargos.id WHERE (cargos.id = 7 OR cargos.id = 5 OR cargos.id = 6)")
        ]);
    }
    
}