<?php class cargos { 
    public $val;
    public $db; 

    public const NAMED_QUERY_SELECT_ALL = "SELECT * FROM cargos";
    public const NAMED_QUERY_SELECT_WITH_ID = "SELECT * FROM cargos WHERE id = ";
    public const NAMED_QUERY_SELECT_ORDERBY_ID = "SELECT * FROM cargos ORDER BY id ASC";
    public const NAMED_QUERY_SELECT_CARGOS_ADM = "SELECT * FROM cargos WHERE nome NOT IN ('comissário','motorista','mecânico', 'piloto')";
    public const NAMED_QUERY_SELECT_CARGOS_MOTORISTA = "SELECT * FROM cargos WHERE nome IN ('motorista')";
    public const NAMED_QUERY_SELECT_CARGOS_MECANICO = "SELECT * FROM cargos WHERE nome IN ('mecânico')";
    public const NAMED_QUERY_SELECT_CARGOS_COMISSARIO = "SELECT * FROM cargos WHERE nome IN ('comissário')";
    public const NAMED_QUERY_SELECT_CARGOS_PILOTO = "SELECT * FROM cargos WHERE nome IN ('piloto')";

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    public function deletar_cargos() 
    {
        $this->db->delete("cargos", [id=> get('id')]);
        flash("success", "cargo removido com sucesso.");
        return redirect("cargos/cargos"); 
    }

    public function editar_cargos() 
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
            
            if($this->val->isSuccess())
            {
                $this->db->update("cargos",copy_post(), ['id'=> get('id')]);
                flash("success", "cargo atualizado com sucesso.");
                return redirect("cargos/cargos"); 
            }
        }

        $cargos = $this->db->row(cargos::NAMED_QUERY_SELECT_WITH_ID . get('id')); 

        return view("cargos/editar_cargos", [
            'cargos' => $cargos,
        ]);
    }
    
    public function cargos()
    {
        if(is_post()) 
        {
            $this->val->name('nome')->value(post('nome'))->required();
           
 
            if($this->val->isSuccess())
            {
                $this->db->insert("cargos",copy_post());
                flash("success", "cargo adicionado com sucesso.");
                return redirect("cargos/cargos"); 
            }
        }

        $cargos = $this->db->table(cargos::NAMED_QUERY_SELECT_ALL);

        return view("cargos/cargos", [
            'cargos' => $cargos,
        ]);
    }    


    public function listaCargos($query) {
        $cargos = $this->db->table($query);
        $cargosSelect = array_map(function($cargo){
            $nome = $cargo->id . ' - ' . $cargo->nome;
            return  ['nome' => $nome, 'value' => $cargo->id];
        }, $cargos);

        return $cargosSelect;
    }
    
}