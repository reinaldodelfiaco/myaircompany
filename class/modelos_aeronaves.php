<?php class modelos_aeronaves { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_modelos_aeronaves() 
    {
    
        $this->db->delete("modelos_aeronaves", [id=> get('id')]);
        flash("success", "Modelo removido com sucesso.");
        return redirect("modelos_aeronaves/modelos_aeronaves"); 
    }

    public function editar_modelos_aeronaves() 
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("modelos_aeronaves",copy_post(), ['id'=> get('id')]);
                flash("success", "Modelo atualizado com sucesso.");
                return redirect("modelos_aeronaves/modelos_aeronaves"); 
            }
        }

        $modelos_aeronaves = $this->db->row("SELECT * FROM modelos_aeronaves WHERE id = " . get('id')); 

        return view("modelos_aeronaves/editar_modelos_aeronaves", [
            'modelos_aeronaves' => $modelos_aeronaves,
        ]);
    }
    
    public function modelos_aeronaves()
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->insert("modelos_aeronaves",copy_post());
                flash("success", "Modelo adicionado com sucesso.");
                return redirect("modelos_aeronaves/modelos_aeronaves"); 
            }
        }

        $modelos_aeronaves = $this->db->table("SELECT * FROM modelos_aeronaves");

        return view("modelos_aeronaves/modelos_aeronaves", [
            'modelos_aeronaves' => $modelos_aeronaves,
        ]);
    }
    

    public function draw()
    {
        if(is_post()) 
        {
            $this->val->name('s')->value(post('s'))->required();
            $this->val->name('x')->value(post('x'))->required();
            $this->val->name('y')->value(post('y'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->insert("modelo_peso_balanceamento",copy_post());
                flash("success", "Parâmetro adicionado com sucesso.");
                return redirect("modelos_aeronaves/draw?id=" . get('id')); 
            }
        }

        $draw = $this->db->table("SELECT * FROM modelo_peso_balanceamento WHERE modelo = " . get('id'));

        return view("modelos_aeronaves/draw", [
            'draw' => $draw,
        ]);
    }


    function deletar_draw()
    {
        $draw = $this->db->row("SELECT * FROM modelo_peso_balanceamento WHERE id = " . get('id'));
        $this->db->delete('modelo_peso_balanceamento', ['id' => $draw->id]);
        return redirect('modelos_aeronaves/draw?id=' . $draw->modelo);

    }
    
}