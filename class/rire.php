<?php class rire { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_rire() 
    {
 
    
        $this->db->delete("rire", [id=> get('id')]);
        flash("success", "rire removido com sucesso.");
        return redirect("rire/rire"); 
    }

    public function editar_rire() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("rire",copy_post(), ['id'=> get('id')]);
                flash("success", "rire atualizado com sucesso.");
                return redirect("rire/rire"); 
            }
        }

        $rire = $this->db->row("SELECT * FROM rire WHERE id = " . get('id')); 

        return view("rire/editar_rire", [
            'rire' => $rire,
        ]);
    }
    
    public function rire()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("rire",copy_post());
                flash("success", "rire adicionado com sucesso.");
                return redirect("rire/rire"); 
            }
        }

        $rire = $this->db->table("SELECT * FROM rire");
        $aeronaves = $this->db->table("SELECT * FROM aeronaves");
        $contatos_emergencias = $this->db->table("SELECT * FROM contatos_emergencias");

        return view("rire/rire", [
            'rire' => $rire,
            'aeronaves' => $aeronaves,
            'contatos_emergencias' => $contatos_emergencias,
        ]);
    }
    
}