<?php class escalas_aeronaves { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_escalas_aeronaves() 
    {
 
    
        $this->db->delete("escalas_aeronaves", [id=> get('id')]);
        flash("success", "escalas_aeronaves removido com sucesso.");
        return redirect("escalas_aeronaves/escalas_aeronaves"); 
    }

    public function editar_escalas_aeronaves() 
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->update("escalas_aeronaves",copy_post(), ['id'=> get('id')]);
                flash("success", "escalas_aeronaves atualizado com sucesso.");
                return redirect("escalas_aeronaves/escalas_aeronaves"); 
            }
        }

        $escalas_aeronaves = $this->db->row("SELECT * FROM escalas_aeronaves WHERE id = " . get('id')); 

        return view("escalas_aeronaves/editar_escalas_aeronaves", [
            'escalas_aeronaves' => $escalas_aeronaves,
        ]);
    }
    
    public function escalas_aeronaves()
    {
        if(is_post()) 
        {
             
            if($this->val->isSuccess())
            {
                $this->db->insert("escalas_aeronaves",copy_post());
                flash("success", "escalas_aeronaves adicionado com sucesso.");
                return redirect("escalas_aeronaves/escalas_aeronaves"); 
            }
        }

        $escalas_aeronaves = $this->db->table("SELECT * FROM escalas_aeronaves");

        return view("escalas_aeronaves/escalas_aeronaves", [
            'escalas_aeronaves' => $escalas_aeronaves,
        ]);
    }
    
}