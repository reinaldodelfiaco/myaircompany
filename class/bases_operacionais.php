<?php class bases_operacionais { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    
    public function deletar_bases_operacionais() 
    {
        $this->db->delete("bases_operacionais", [id=> get('id')]);
        flash("success", "bases_operacionais removido com sucesso.");
        return redirect("bases_operacionais/bases_operacionais"); 
    }

    public function editar_bases_operacionais() 
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("bases_operacionais",copy_post(), ['id'=> get('id')]);
                flash("success", "bases_operacionais atualizado com sucesso.");
                return redirect("bases_operacionais/bases_operacionais"); 
            }
        }

        $bases_operacionais = $this->db->row("SELECT * FROM bases_operacionais WHERE id = " . get('id')); 

        return view("bases_operacionais/editar_bases_operacionais", [
            'bases_operacionais' => $bases_operacionais,
        ]);
    }
    
    public function bases_operacionais()
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->insert("bases_operacionais",copy_post());
                flash("success", "bases_operacionais adicionado com sucesso.");
                return redirect("bases_operacionais/bases_operacionais"); 
            }
        }

        $bases_operacionais = $this->db->table("SELECT * FROM bases_operacionais");

        return view("bases_operacionais/bases_operacionais", [
            'bases_operacionais' => $bases_operacionais,
        ]);
    }
    
}