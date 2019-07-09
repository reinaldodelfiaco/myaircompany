<?php class contatos_emergencias { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_contatos_emergencias() 
    {
 
    
        $this->db->delete("contatos_emergencias", [id=> get('id')]);
        flash("success", "contatos_emergencias removido com sucesso.");
        return redirect("contatos_emergencias/contatos_emergencias"); 
    }

    public function editar_contatos_emergencias() 
    {
        if(is_post()) 
        {
            $this->val->name('data_cad')->value(post('data_cad'))->required();
$this->val->name('instituicao')->value(post('instituicao'))->required();
$this->val->name('nome_contato_responsavel')->value(post('nome_contato_responsavel'))->required();
$this->val->name('cargo_responsavel')->value(post('cargo_responsavel'))->required();
$this->val->name('telefone_responsavel')->value(post('telefone_responsavel'))->required();
$this->val->name('email_responsavel')->value(post('email_responsavel'))->required();
$this->val->name('nome_contato_imediato')->value(post('nome_contato_imediato'))->required();
$this->val->name('email_imediato')->value(post('email_imediato'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("contatos_emergencias",copy_post(), ['id'=> get('id')]);
                flash("success", "contatos_emergencias atualizado com sucesso.");
                return redirect("contatos_emergencias/contatos_emergencias"); 
            }
        }

        $contatos_emergencias = $this->db->row("SELECT * FROM contatos_emergencias WHERE id = " . get('id')); 

        return view("contatos_emergencias/editar_contatos_emergencias", [
            'contatos_emergencias' => $contatos_emergencias,
        ]);
    }
    
    public function contatos_emergencias()
    {
        if(is_post()) 
        {
            $this->val->name('data_cad')->value(post('data_cad'))->required();
$this->val->name('instituicao')->value(post('instituicao'))->required();
$this->val->name('nome_contato_responsavel')->value(post('nome_contato_responsavel'))->required();
$this->val->name('cargo_responsavel')->value(post('cargo_responsavel'))->required();
$this->val->name('telefone_responsavel')->value(post('telefone_responsavel'))->required();
$this->val->name('email_responsavel')->value(post('email_responsavel'))->required();
$this->val->name('nome_contato_imediato')->value(post('nome_contato_imediato'))->required();
$this->val->name('email_imediato')->value(post('email_imediato'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->insert("contatos_emergencias",copy_post());
                flash("success", "contatos_emergencias adicionado com sucesso.");
                return redirect("contatos_emergencias/contatos_emergencias"); 
            }
        }

        $contatos_emergencias = $this->db->table("SELECT * FROM contatos_emergencias");

        return view("contatos_emergencias/contatos_emergencias", [
            'contatos_emergencias' => $contatos_emergencias,
        ]);
    }
    
}