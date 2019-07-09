<?php class escalas_passageiros { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_escalas_passageiros() 
    {
 
    
        $this->db->delete("escalas_passageiros", [id=> get('id')]);
        flash("success", "escalas_passageiros removido com sucesso.");
        return redirect("escalas_passageiros/escalas_passageiros"); 
    }

    public function editar_escalas_passageiros() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("escalas_passageiros",copy_post(), ['id'=> get('id')]);
                flash("success", "escalas_passageiros atualizado com sucesso.");
                return redirect("escalas_passageiros/escalas_passageiros"); 
            }
        }

        $escalas_passageiros = $this->db->row("SELECT * FROM escalas_passageiros WHERE id = " . get('id')); 

        return view("escalas_passageiros/editar_escalas_passageiros", [
            'escalas_passageiros' => $escalas_passageiros,
        ]);
    }
    
    public function escalas_passageiros()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("escalas_passageiros",copy_post());
                flash("success", "escalas_passageiros adicionado com sucesso.");
                return redirect("escalas_passageiros/escalas_passageiros"); 
            }
        }

        $escalas_passageiros = $this->db->table("SELECT * FROM escalas_passageiros");

        return view("escalas_passageiros/escalas_passageiros", [
            'escalas_passageiros' => $escalas_passageiros,
        ]);
    }
    
}