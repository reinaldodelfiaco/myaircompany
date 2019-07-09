<?php class unidades { 
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    public function deletar_unidades() 
    {
        $this->db->delete("unidades", [id=> get('id')]);
        flash("success", "unidades removido com sucesso.");
        return redirect("unidades/unidades"); 
    }

    public function editar_unidades() 
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('sigla')->value(post('sigla'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("unidades",copy_post(), ['id'=> get('id')]);
                flash("success", "unidades atualizado com sucesso.");
                return redirect("unidades/unidades"); 
            }
        }

        $unidades = $this->db->row("SELECT * FROM unidades WHERE id = " . get('id')); 

        return view("unidades/editar_unidades", [
            'unidades' => $unidades,
        ]);
    }
    
    public function unidades()
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('sigla')->value(post('sigla'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->insert("unidades",copy_post());
                flash("success", "unidades adicionado com sucesso.");
                return redirect("unidades/unidades"); 
            }
        }

        $unidades = $this->db->table("SELECT * FROM unidades");

        return view("unidades/unidades", [
            'unidades' => $unidades,
        ]);
    }
    
}