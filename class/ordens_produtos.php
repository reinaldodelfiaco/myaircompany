<?php class ordens_produtos { public $val;
              public $db; 
                public function __construct() 
                { 
                    require_adm();
                    $this->val = new validator();
                    $this->db = new db();
                }
    public function deletar_ordens_produtos() 
    {
 
    
        $this->db->delete("ordens_produtos", [id=> get('id')]);
        flash("success", "ordens_produtos removido com sucesso.");
        return redirect("ordens_produtos/ordens_produtos"); 
    }


               public function editar_ordens_produtos() 
               {
                if(is_post()) 
                {
                     
                    if($this->val->isSuccess())
                    {
                        $this->db->update("ordens_produtos",copy_post(), ['id'=> get('id')]);
                        flash("success", "ordens_produtos atualizado com sucesso.");
                        return redirect("ordens_produtos/ordens_produtos"); 
                    }
                }

                $ordens_produtos = $this->db->row("SELECT * FROM ordens_produtos WHERE id = " . get('id')); 

                return view("ordens_produtos/editar_ordens_produtos", [
                    'ordens_produtos' => $ordens_produtos,
                ]);
               }
    
               public function ordens_produtos()
               {
                if(is_post()) 
                {
                     
                    if($this->val->isSuccess())
                    {
                        $this->db->insert("ordens_produtos",copy_post());
                        flash("success", "ordens_produtos adicionado com sucesso.");
                        return redirect("ordens_produtos/ordens_produtos"); 
                    }
                }

                $ordens_produtos = $this->db->table("SELECT * FROM ordens_produtos WHERE empresa = " . session('empresa'));

                return view("ordens_produtos/ordens_produtos", [
                    'ordens_produtos' => $ordens_produtos,
                ]);
               }
    
}