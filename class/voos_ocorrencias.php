<?php class voos_ocorrencias { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_voos_ocorrencias() 
    {
 
    
        $this->db->delete("voos_ocorrencias", [id=> get('id')]);
        flash("success", "voos_ocorrencias removido com sucesso.");
        return redirect("voos_ocoreencias/voos_ocorrencias"); 
    }

    public function editar_voos_ocorrencias() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("voos_ocorrencias",copy_post(), ['id'=> get('id')]);
                flash("success", "voos_ocorrencias atualizado com sucesso.");
                return redirect("voos_ocoreencias/voos_ocorrencias"); 
            }
        }

        $voos_ocorrencias = $this->db->row("SELECT * FROM voos_ocorrencias WHERE id = " . get('id')); 

        return view("voos_ocoreencias/editar_voos_ocorrencias", [
            'voos_ocorrencias' => $voos_ocorrencias,
        ]);
    }
    
    public function voos_ocorrencias()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("voos_ocorrencias",copy_post());
                flash("success", "voos_ocorrencias adicionado com sucesso.");
                return redirect("voos_ocoreencias/voos_ocorrencias"); 
            }
        }

        $voos_ocorrencias = $this->db->table("SELECT * FROM voos_ocorrencias");

        return view("voos_ocoreencias/voos_ocorrencias", [
            'voos_ocorrencias' => $voos_ocorrencias,
        ]);
    }
    
}