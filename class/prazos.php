<?php class prazos { public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    
    public function deletar_prazos() 
    {
 
    
        $this->db->delete("prazos", [id=> get('id')]);
        flash("success", "prazos removido com sucesso.");
        return redirect("prazos/prazos"); 
    }


    public function editar_prazos() 
    {
    if(is_post()) 
    {
            
        if($this->val->isSuccess())
        {
            $this->db->update("prazos",copy_post(), ['id'=> get('id')]);
            flash("success", "prazos atualizado com sucesso.");
            return redirect("prazos/prazos"); 
        }
    }

    $prazos = $this->db->row("SELECT * FROM prazos WHERE id = " . get('id')); 

    return view("prazos/editar_prazos", [
        'prazos' => $prazos,
    ]);
    }

    public function prazos()
    {
    if(is_post()) 
    {
            
        if($this->val->isSuccess())
        {
            $this->db->insert("prazos",copy_post());
            flash("success", "prazos adicionado com sucesso.");
            return redirect("prazos/prazos"); 
        }
    }

    $prazos = $this->db->table("SELECT * FROM prazos WHERE empresa = " . session('empresa'));

    return view("prazos/prazos", [
        'prazos' => $prazos,
    ]);
    }
    
}