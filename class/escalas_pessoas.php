<?php class escalas_pessoas { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_escalas_pessoas() 
    {
 
    
        $this->db->delete("escalas_pessoas", [id=> get('id')]);
        flash("success", "escalas_pessoas removido com sucesso.");
        return redirect("escalas_pessoas/escalas_pessoas"); 
    }

    public function editar_escalas_pessoas() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("escalas_pessoas",copy_post(), ['id'=> get('id')]);
                flash("success", "escalas_pessoas atualizado com sucesso.");
                return redirect("escalas_pessoas/escalas_pessoas"); 
            }
        }

        $escalas_pessoas = $this->db->row("SELECT * FROM escalas_pessoas WHERE id = " . get('id')); 

        return view("escalas_pessoas/editar_escalas_pessoas", [
            'escalas_pessoas' => $escalas_pessoas,
        ]);
    }
    
    public function escalas_pessoas()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("escalas_pessoas",copy_post());
                flash("success", "escalas_pessoas adicionado com sucesso.");
                return redirect("escalas_pessoas/escalas_pessoas"); 
            }
        }

        $escalas_pessoas = $this->db->table("SELECT * FROM escalas_pessoas");

        return view("escalas_pessoas/escalas_pessoas", [
            'escalas_pessoas' => $escalas_pessoas,
        ]);
    }
    
}