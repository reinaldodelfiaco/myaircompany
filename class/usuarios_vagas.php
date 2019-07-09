<?php class usuarios_vagas { public $val;
              public $db; 
                public function __construct() 
                { 
                    require_adm();
                    $this->val = new validator();
                    $this->db = new db();
                }
    public function deletar_usuarios_vagas() 
    {
 
    
        $this->db->delete("usuarios_vagas", [id=> get('id')]);
        flash("success", "usuarios_vagas removido com sucesso.");
        return redirect("usuario,vaga,status/usuarios_vagas"); 
    }


               public function editar_usuarios_vagas() 
               {
                if(is_post()) 
                {
                     
                    if($this->val->isSuccess())
                    {
                        $this->db->update("usuarios_vagas",copy_post(), ['id'=> get('id')]);
                        flash("success", "usuarios_vagas atualizado com sucesso.");
                        return redirect("usuario,vaga,status/usuarios_vagas"); 
                    }
                }

                $usuarios_vagas = $this->db->row("SELECT * FROM usuarios_vagas WHERE id = " . get('id')); 

                return view("usuario,vaga,status/editar_usuarios_vagas", [
                    'usuarios_vagas' => $usuarios_vagas,
                ]);
               }
    
               public function usuarios_vagas()
               {
                if(is_post()) 
                {
                     
                    if($this->val->isSuccess())
                    {
                        $this->db->insert("usuarios_vagas",copy_post());
                        flash("success", "usuarios_vagas adicionado com sucesso.");
                        return redirect("usuario,vaga,status/usuarios_vagas"); 
                    }
                }

                $usuarios_vagas = $this->db->table("SELECT * FROM usuarios_vagas WHERE empresa = " . session('empresa'));

                return view("usuario,vaga,status/usuarios_vagas", [
                    'usuarios_vagas' => $usuarios_vagas,
                ]);
               }
    
}