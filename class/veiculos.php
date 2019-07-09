<?php class veiculos { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_veiculos() 
    {
 
    
        $this->db->delete("veiculos", [id=> get('id')]);
        flash("success", "veiculos removido com sucesso.");
        return redirect("veiculos/veiculos"); 
    }

    public function editar_veiculos() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("veiculos",copy_post(), ['id'=> get('id')]);
                flash("success", "veiculos atualizado com sucesso.");
                return redirect("veiculos/veiculos"); 
            }
        }

        $veiculos = $this->db->row("SELECT * FROM veiculos WHERE id = " . get('id')); 

        return view("veiculos/editar_veiculos", [
            'veiculos' => $veiculos,
        ]);
    }
    
    public function veiculos()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("veiculos",copy_post());
                flash("success", "veiculos adicionado com sucesso.");
                return redirect("veiculos/veiculos"); 
            }
        }

        $veiculos = $this->db->table("SELECT * FROM veiculos");

        return view("veiculos/veiculos", [
            'veiculos' => $veiculos,
        ]);
    }
    
}