<?php class clientes { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_clientes() 
    {
 
    
        $this->db->delete("clientes", [id=> get('id')]);
        flash("success", "clientes removido com sucesso.");
        return redirect("clientes/clientes"); 
    }

    public function editar_clientes() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("clientes",copy_post(), ['id'=> get('id')]);
                flash("success", "clientes atualizado com sucesso.");
                return redirect("clientes/clientes"); 
            }
        }

        $clientes = $this->db->row("SELECT * FROM clientes WHERE id = " . get('id')); 

        return view("clientes/editar_clientes", [
            'clientes' => $clientes,
        ]);
    }
    
    public function clientes()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("clientes",copy_post());
                flash("success", "clientes adicionado com sucesso.");
                return redirect("clientes/clientes"); 
            }
        }

        $clientes = $this->db->table("SELECT * FROM clientes");

        return view("clientes/clientes", [
            'clientes' => $clientes,
        ]);
    }
    
}