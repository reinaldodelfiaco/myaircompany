<?php class relprev { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_relprev() 
    {
        $this->db->delete("relprev", [id=> get('id')]);
        flash("success", "relprev removido com sucesso.");
        return redirect("relprev/relprev"); 
    }

    public function editar_relprev() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("relprev",copy_post(), ['id'=> get('id')]);
                flash("success", "relprev atualizado com sucesso.");
                return redirect("relprev/relprev"); 
            }
        }

        $relprev = $this->db->row("SELECT * FROM relprev WHERE id = " . get('id')); 

        return view("relprev/editar_relprev", [
            'relprev' => $relprev,
        ]);
    }
    
    public function relprev()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("relprev",copy_post());
                flash("success", "relprev adicionado com sucesso.");
                return redirect("relprev/relprev"); 
            }
        }

        $relprev = $this->db->table("SELECT * FROM relprev");
        $aeronaves = $this->db->table("SELECT * FROM aeronaves");
        $voos = $this->db->table("SELECT * FROM voos");

        return view("relprev/relprev", [
            'relprev' => $relprev,
            'aeronaves' => $aeronaves,
            'voos' => $voos,
        ]);
    }
 
    

}