<?php class ocorrencias { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_ocorrencias() 
    {
 
    
        $this->db->delete("ocorrencias", [id=> get('id')]);
        flash("success", "ocorrencias removido com sucesso.");
        return redirect("ocoreencias/ocorrencias"); 
    }

    public function editar_ocorrencias() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("ocorrencias",copy_post(), ['id'=> get('id')]);
                flash("success", "ocorrencias atualizado com sucesso.");
                return redirect("ocoreencias/ocorrencias"); 
            }
        }

        $ocorrencias = $this->db->row("SELECT * FROM ocorrencias WHERE id = " . get('id')); 

        return view("ocoreencias/editar_ocorrencias", [
            'ocorrencias' => $ocorrencias,
        ]);
    }
    
    public function ocorrencias()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("ocorrencias",copy_post());
                flash("success", "ocorrencias adicionado com sucesso.");
                return redirect("ocoreencias/ocorrencias"); 
            }
        }

        $ocorrencias = $this->db->table("SELECT * FROM ocorrencias");

        return view("ocoreencias/ocorrencias", [
            'ocorrencias' => $ocorrencias,
        ]);
    }
    
}