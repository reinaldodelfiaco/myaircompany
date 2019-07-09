<?php class contato_midia { 
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }
    public function deletar_contato_midia() 
    {
 
        $this->db->delete("contato_midia", [id=> get('id')]);
        flash("success", "contato_midia removido com sucesso.");
        return redirect("contato_midia/contato_midia"); 
    }

    public function editar_contato_midia() 
    {
        if(is_post()) 
        {
            $this->val->name('veiculo')->value(post('veiculo'))->required();
$this->val->name('nome_produtor')->value(post('nome_produtor'))->required();
$this->val->name('numero_produtor')->value(post('numero_produtor'))->required();
$this->val->name('email_produtor')->value(post('email_produtor'))->required();
$this->val->name('solicitacao')->value(post('solicitacao'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("contato_midia",copy_post(), ['id'=> get('id')]);
                flash("success", "contato_midia atualizado com sucesso.");
                return redirect("contato_midia/contato_midia"); 
            }
        }

        $contato_midia = $this->db->row("SELECT * FROM contato_midia WHERE id = " . get('id')); 

        return view("contato_midia/editar_contato_midia", [
            'contato_midia' => $contato_midia,
        ]);
    }
    
    public function contato_midia()
    {
        if(is_post()) 
        {
            $this->val->name('veiculo')->value(post('veiculo'))->required();
$this->val->name('nome_produtor')->value(post('nome_produtor'))->required();
$this->val->name('numero_produtor')->value(post('numero_produtor'))->required();
$this->val->name('email_produtor')->value(post('email_produtor'))->required();
$this->val->name('solicitacao')->value(post('solicitacao'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->insert("contato_midia",copy_post());
                flash("success", "contato_midia adicionado com sucesso.");
                return redirect("contato_midia/contato_midia"); 
            }
        }

        $contato_midia = $this->db->table("SELECT * FROM contato_midia");
        $voos = $this->db->table("SELECT * FROM voos");

        return view("contato_midia/contato_midia", [
            'contato_midia' => $contato_midia,
            'voos' => $voos,

        ]);
    }
    
}