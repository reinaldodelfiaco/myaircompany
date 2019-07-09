<?php

class empresas
{

    public $db;
    public $val;

    public function __construct()
    {
        $this->db = new db();
        $this->val = new validator();

    }
    
    public function departamentos()
	{	
		if(is_post())
		{
			$this->val->name('nome')->value(post('nome'))->required();
			$this->val->name('chave')->value(post('chave'))->required();
			$this->val->name('empresa')->value(post('empresa'))->required();
			$this->val->name('modulo')->value(post('modulo'))->required();

			if ($this->val->isSuccess()) {
				$this->db->insert('selects', copy_post());
				redirect('empresas/departamentos');
			}
		}


		$departamentos = $this->db->table('SELECT * FROM selects WHERE empresa = ' . session('empresa') . ' AND modulo = "empresas" AND chave = "departamentos"');

		view('empresas/departamentos', [
			'departamentos' => $departamentos,
		]);
	}

	public function deletar_departamento()
	{
		$this->db->delete('selects', ['id' => get(id)]);
		return redirect('empresas/departamentos');
	}

	public function deletar_funcao()
	{
    require_adm();
		$this->db->delete('selects', ['id' => get(id)]);
		return redirect('empresas/funcoes');
	}

	public function editar_departamento()
	{
		if(is_post())
		{
			$this->val->name('nome')->value(post('nome'))->required();

			if ($this->val->isSuccess()) {
				$this->db->update('selects', copy_post(), ['id' => get('id')]);
				redirect('empresas/departamentos');
			}
		}

		$departamento = $this->db->row('SELECT * FROM selects WHERE id = ' . get('id'));

		view('empresas/editar_departamento', ['departamento' => $departamento]);
    }
    
    // Altera informações da empresa, bem como logotipo e favicon;
    function informacoes()
    {

        //require_super();
        $empresa = $this->db->row('SELECT * FROM  empresas a  LEFT JOIN cnae On a.cnae = id AND a.id = ' . session('empresa') );

        if (is_post()) {

            $this->val->name('razao_social')->value(post('razao_social'))->required();
            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();
            $this->val->name('cnpj')->value(post('cnpj'))->required();
            $this->val->name('contato')->value(post('contato'))->required();
            $this->val->name('email')->value(post('email'))->pattern('email')->required();
            $this->val->name('telefone')->value(post('telefone'))->required();
            $this->val->name('cep')->value(post('cep'))->required();
            $this->val->name('estado')->value(post('estado'))->required();
            $this->val->name('cidade')->value(post('cidade'))->required();
            $this->val->name('bairro')->value(post('bairro'))->required();
            $this->val->name('endereco')->value(post('endereco'))->required();
            $this->val->name('numero')->value(post('numero'))->required();


            if ($this->val->isSuccess()) {


                $this->db->update('empresas', copy_post(), ['id' => session('empresa')]);

                if (!empty($_FILES['certificado_digital'])) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['certificado_digital']['name']);
                    $path = $path . $logo;
                    if (move_uploaded_file($_FILES['certificado_digital']['tmp_name'], $path)) {
                        $this->db->update('empresas', ['caminho_certificado_digital' => $path], ['id' => session('empresa')]);
                    }
                }


                if (!empty($_FILES['logo'])) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['logo']['name']);
                    $path = $path . $logo;
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['logo']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['logo']['size'],
                            'ext' => $_FILES['logo']['type'],
                            'modulo' => 'logo',
                            'modulo_key' => session('empresa'),
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('empresas', ['logo' => $uploaded_id], ['id' => session('empresa')]);
                    }


                }

                if (!empty($_FILES['admin_logo'])) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['admin_logo']['name']);
                    $path = $path . $logo;
                    if (move_uploaded_file($_FILES['admin_logo']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['admin_logo']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['admin_logo']['size'],
                            'ext' => $_FILES['admin_logo']['type'],
                            'modulo' => 'admin_logo',
                            'modulo_key' => session('empresa'),
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('empresas', ['admin_logo' => $uploaded_id], ['id' => session('empresa')]);
                    }
                }

                if (!empty($_FILES['favicon'])) {
                    $path = "uploads/";
                    $favicon = basename(sha1(date("H:i:s")) . "-" . $_FILES['favicon']['name']);
                    $path = $path . $favicon;
                    if (move_uploaded_file($_FILES['favicon']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['favicon']['name'],
                            'nome_atual' => $favicon,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['favicon']['size'],
                            'ext' => $_FILES['favicon']['type'],
                            'modulo' => 'favicon',
                            'modulo_key' => session('empresa'),
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('empresas', ['favicon' => $uploaded_id], ['id' => session('empresa')]);
                    }
                }

                flash('success', 'Cadastro adicionado com sucesso.');
                return redirect('empresas/informacoes');

            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }

        }

        return view('empresas/informacoes', [
            'empresa' => $empresa,
        ]);
    }


    function index()
    {

        //require_super();
        $empresas = $this->db->table('SELECT * FROM empresas');


        if (is_post()) {
            $this->val->name('razao_social')->value(post('razao_social'))->required();
            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();
            $this->val->name('cnpj')->value(post('cnpj'))->required();
            $this->val->name('contato')->value(post('contato'))->required();
            $this->val->name('email')->value(post('email'))->pattern('email')->required();
            $this->val->name('telefone')->value(post('telefone'))->required();
            $this->val->name('cep')->value(post('cep'))->required();
            $this->val->name('estado')->value(post('estado'))->required();
            $this->val->name('cidade')->value(post('cidade'))->required();
            $this->val->name('bairro')->value(post('bairro'))->required();
            $this->val->name('endereco')->value(post('endereco'))->required();
            $this->val->name('numero')->value(post('numero'))->required();


            if ($this->val->isSuccess()) {
                $this->db->insert('empresas', copy_post());
                flash('success', 'Cadastro adicionado com sucesso.');
                return redirect('informacoes');
            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }
        }
        view('empresas/index', ['empresas' => $empresas]);
    }

    function editar()
    {

        //require_super();
        $empresa = $this->db->row('SELECT * FROM empresas WHERE id=' . get('id'));


        if (is_post()) {

            $this->val->name('contato')->value(post('nome'))->required();
            $this->val->name('nome')->value(post('contato'))->required();
            $this->val->name('email')->value(post('email'))->pattern('email')->required();
            $this->val->name('telefone')->value(post('telefone'))->required();
            $this->val->name('cep')->value(post('cep'))->required();
            $this->val->name('estado')->value(post('estado'))->required();
            $this->val->name('cidade')->value(post('cidade'))->required();
            $this->val->name('bairro')->value(post('bairro'))->required();
            $this->val->name('endereco')->value(post('endereco'))->required();
            $this->val->name('numero')->value(post('numero'))->required();
           


            if ($this->val->isSuccess()) {

                $data = [
                    'nome' => post('nome'),
                    'contato' => post('contato'),
                    'email' => post('email'),
                    'telefone' => post('telefone'),
                    'cep' => post('cep'),
                    'estado' => post('estado'),
                    'cidade' => post('cidade'),
                    'bairro' => post('bairro'),
                    'endereco' => post('endereco'),
                    'numero' => post('numero'),
                    'complemento' => post('complemento'),
                    'limite_espaco' => post('limite_espaco'),
                    'limite_usuarios' => post('limite_usuarios'),
                    'status' => post('status'),

                ];
                $this->db->update('empresas', $data, ['id' => get('id')]);

                return redirect('empresas');
            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }
        }


        view('empresas/editar', ['empresa' => $empresa]);


    }

    public function select_cnae()
    {
        $search = (isset($_POST['searchTerm'])) ? $_POST['searchTerm'] : '';
        $ncms = $this->db->table("SELECT * FROM cnae WHERE desc_cnae like '%".$search."%' or codigo_cnae like '%".$search."%'  limit 5");
        foreach ($ncms as $n)
        {
            $data[] = array("id"=>$n->id_cnae, "text"=> $n->codigo_cnae . " - " . $n->desc_cnae);
        }
        echo json_encode($data);
    }


}
