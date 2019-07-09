<?php class passageiros { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_passageiros() 
    {
 
    
        $this->db->delete("passageiros", [id=> get('id')]);
        flash("success", "passageiros removido com sucesso.");
        return redirect("passageiros/passageiros"); 
    }

    public function editar_passageiros() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("passageiros",copy_post(), ['id'=> get('id')]);
                flash("success", "passageiros atualizado com sucesso.");
                return redirect("passageiros/passageiros"); 
            }
        }

        $passageiros = $this->db->row("SELECT * FROM passageiros WHERE id = " . get('id')); 

        return view("passageiros/editar_passageiros", [
            'passageiros' => $passageiros,
        ]);
    }
    
    public function passageiros()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("passageiros",copy_post());
                flash("success", "passageiros adicionado com sucesso.");
                return redirect("passageiros/passageiros"); 
            }
        }

        $passageiros = $this->db->table("SELECT * FROM passageiros");

        return view("passageiros/passageiros", [
            'passageiros' => $passageiros,
        ]);
    }
    
}