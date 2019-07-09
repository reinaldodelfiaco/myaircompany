<?php

class crm
{

    public $db;
    public $val;

    public function __construct()
    {
        $this->db = new db();
        $this->val = new validator();
    }

    public function busca_empresa()
    {
        echo file_get_contents(get('cnpj'));
    }

    public function agencias()
    {
        if (is_post()) {

            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();

            if ($this->val->isSuccess()) {

                $empresa_id = $this->db->insert('crm_empresas', copy_post());

                if (!empty(filename('logo'))) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['logo']['name']);
                    $path = $path . $logo;
                    $logo_name = $_FILES['logo']['name'];
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['logo']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['logo']['size'],
                            'ext' => $_FILES['logo']['type'],
                            'modulo' => 'crm_empresas_logo',
                            'modulo_key' => $empresa_id,
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('crm_empresas', ['logo' => $uploaded_id], ['id' => $empresa_id]);
                    }
                }

                flash('success', 'Empresa cadastrada com sucesso');
                return redirect('crm/fornecedores');
            } else {
                flash('error', 'Erro ao salvar empresa');
            }
        }
        $empresas = $this->db->table('SELECT * FROM crm_empresas WHERE agencia = 1 AND status= "ativa" AND empresa = ' . session('empresa'));

        $t = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE fornecedor = 1 AND empresa = " . session('empresa'));
        $total_cadastros = retorna_total($t);

        $ta = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE status='ativa' AND fornecedor = 1 AND empresa = " . session('empresa'));
        $total_ativas = retorna_total($ta);

        $ti = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE status='inativa' AND fornecedor = 1 AND empresa = " . session('empresa'));
        $total_inativas = retorna_total($ti);


        view('crm/agencias', [
            'empresas' => $empresas,
            'gap' => 'fornecedor',
            'total_cadastros' => $total_cadastros,
            'total_ativas' => $total_ativas,
            'total_inativas' => $total_inativas,
        ]);
    }


    // LISTA DE EMPRESAS CRM
    public function fornecedores()
    {
        if (is_post()) {

            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();

            if ($this->val->isSuccess()) {

                $empresa_id = $this->db->insert('crm_empresas', copy_post());

                if (!empty(filename('logo'))) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['logo']['name']);
                    $path = $path . $logo;
                    $logo_name = $_FILES['logo']['name'];
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['logo']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['logo']['size'],
                            'ext' => $_FILES['logo']['type'],
                            'modulo' => 'crm_empresas_logo',
                            'modulo_key' => $empresa_id,
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('crm_empresas', ['logo' => $uploaded_id], ['id' => $empresa_id]);
                    }
                }

                flash('success', 'Empresa cadastrada com sucesso');
                return redirect('crm/fornecedores');
            } else {
                flash('error', 'Erro ao salvar empresa');
            }
        }
        $empresas = $this->db->table('SELECT * FROM crm_empresas WHERE fornecedor = 1 AND status= "ativa" AND empresa = ' . session('empresa'));

        $t = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE fornecedor = 1 AND empresa = " . session('empresa'));
        $total_cadastros = retorna_total($t);

        $ta = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE status='ativa' AND fornecedor = 1 AND empresa = " . session('empresa'));
        $total_ativas = retorna_total($ta);

        $ti = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE status='inativa' AND fornecedor = 1 AND empresa = " . session('empresa'));
        $total_inativas = retorna_total($ti);


        view('crm/fornecedores', [
            'empresas' => $empresas,
            'gap' => 'fornecedor',
            'total_cadastros' => $total_cadastros,
            'total_ativas' => $total_ativas,
            'total_inativas' => $total_inativas,
        ]);
    }

    // LISTA DE EMPRESAS CRM
    public function empresas()
    {
        if (is_post()) {

            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();
            if ($this->val->isSuccess()) {

                $empresa_id = $this->db->insert('crm_empresas', copy_post());

                if (!empty(filename('logo'))) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['logo']['name']);
                    $path = $path . $logo;
                    $logo_name = $_FILES['logo']['name'];
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['logo']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['logo']['size'],
                            'ext' => $_FILES['logo']['type'],
                            'modulo' => 'crm_empresas_logo',
                            'modulo_key' => $empresa_id,
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('crm_empresas', ['logo' => $uploaded_id], ['id' => $empresa_id]);
                    }
                }

                flash('success', 'Empresa cadastrada com sucesso');
                return redirect('crm/empresas');
            } else {
                flash('error', 'Erro ao salvar empresa');
            }
        }
        $empresas = $this->db->table('SELECT * FROM crm_empresas WHERE status= "ativa" AND cliente = 1 AND empresa = ' . session('empresa'));

        $t = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE cliente = 1 AND empresa = " . session('empresa'));
        $total_cadastros = retorna_total($t);

        $ta = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE status='ativa' AND cliente = 1 AND empresa = " . session('empresa'));
        $total_ativas = retorna_total($ta);

        $ti = $this->db->table("SELECT count(*) as total FROM crm_empresas WHERE status='inativa' AND cliente = 1 AND empresa = " . session('empresa'));
        $total_inativas = retorna_total($ti);

        view('crm/empresas', [
            'empresas' => $empresas,
            'gap' => 'cliente',
            'total_cadastros' => $total_cadastros,
            'total_ativas' => $total_ativas,
            'total_inativas' => $total_inativas,
        ]);
    }

    //EDITAR INFORMAÇÕES DA EMPRESA 
    public function editar_empresa()
    {
        if (is_post()) {
            $this->val->name('nome_fantasia')->value(post('nome_fantasia'))->required();
           
            if ($this->val->isSuccess()) {
                $this->db->update('crm_empresas', copy_post(), ['id' => get('id')]);
                if (!empty(filename('logo'))) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['logo']['name']);
                    $path = $path . $logo;
                    $logo_name = $_FILES['logo']['name'];
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['logo']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['logo']['size'],
                            'ext' => $_FILES['logo']['type'],
                            'modulo' => 'crm_empresas_logo',
                            'modulo_key' => get('id'),
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        $this->db->update('crm_empresas', ['logo' => $uploaded_id], ['id' => get('id')]);
                    }
                }
                flash('success', 'Empresa atualizada com sucesso');
                return redirect('crm/empresas');
            } else {
                flash('error', 'Erro ao salvar empresa');
            }
        }
        $empresa = $this->db->row('SELECT * FROM crm_empresas WHERE id= ' . get('id'));
        view('crm/editar_empresa', [
            'empresa' => $empresa,
        ]);


    }

    //INATIVAR EMPRESA
    public function inativar_empresa()
    {
        can_edit_by_id();

        $this->db->update('crm_empresas', ['status' => 'inativa'], ['id' => get('id')]);
        return redirect('crm/empresas');

    }


    public function pessoas()
    {
        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('cpf')->value(post('cpf'))->unique('crm_fisicas', 'cpf');

            if ($this->val->isSuccess()) {

                $id = $this->db->insert('crm_fisicas', copy_post());

                if (!empty(filename('foto'))) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['foto']['name']);
                    $path = $path . $logo;
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['foto']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['foto']['size'],
                            'ext' => $_FILES['foto']['type'],
                            'modulo' => 'crm_fisicas',
                            'modulo_key' => $id,
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        //$this->db->update('crm-pessoas', ['foto' => $uploaded_id], ['id' => $id]);
                    }
                }

                flash('success', 'Cliente PF cadastrado com sucesso');
                return redirect('crm/pessoas');
            } else {
                flash('error', 'Erro ao salvar cliente PF');
            }
        }
        $fisicas = $this->db->table('SELECT * FROM crm_fisicas WHERE status= "ativa" AND empresa = ' . session('empresa'));
        view('crm/pessoas', [
            'fisicas' => $fisicas,
        ]);
    }

    public function editar_pessoa()
    {
        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();

            if ($this->val->isSuccess()) {

                $id = $this->db->update('crm_fisicas', copy_post(), ['id' => get('id')]);

                if (!empty(filename('foto'))) {
                    $path = "uploads/";
                    $logo = basename(sha1(date("H:i:s")) . "-" . $_FILES['foto']['name']);
                    $path = $path . $logo;
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {
                        $data = [
                            'nome' => $_FILES['foto']['name'],
                            'nome_atual' => $logo,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['foto']['size'],
                            'ext' => $_FILES['foto']['type'],
                            'modulo' => 'crm_fisicas',
                            'modulo_key' => $id,
                            'empresa' => session('empresa'),
                        ];
                        $uploaded_id = $this->db->insert('uploads', $data);
                        //$this->db->update('crm-pessoas', ['foto' => $uploaded_id], ['id' => $id]);
                    }
                }

                flash('success', 'Cliente PF atualizado com sucesso');
                return redirect('crm/pessoas');
            } else {
                flash('error', 'Erro ao salvar cliente PF');
            }
        }
        $fisica = $this->db->row('SELECT * FROM crm_fisicas WHERE id = ' . get('id'));
        view('crm/editar_pessoa', [
            'fisica' => $fisica,
        ]);
    }

    public function inativar_pessoa()
    {
        can_edit_by_id();

        $this->db->update('crm_fisicas', ['status' => 'inativa'], ['id' => get('id')]);
        return redirect('crm/pessoas');

    }



    // LISTA  DE MODELOS DE CONTRATOS
    public function modelos_contratos()
    {
        require_adm();

        $contratos = $this->db->table('SELECT * FROM modelos_contratos where empresa = ' . session('empresa'));

        view('crm/modelos_contratos', ['contratos' => $contratos]);
    }


    // CADASTRO DE MODELOS DE CONTRATOS
    public function cadastrar_modelo_contrato()
    {

        if (is_post()) {
            $this->val->name('titulo')->value('titulo')->required();
            $this->val->name('texto')->value('texto')->required();

            if ($this->val->isSuccess()) {

                $this->db->insert('modelos_contratos', copy_post());
                flash('success', 'Modelo de Contrato adicionado com sucesso');
                return redirect('crm/modelos_contratos');
            } else {
                flash('error', 'Preencha todos os campos para concluir o modelo de contrato.');
            }
        }

        view('crm/cadastrar_modelo_contrato');
    }


    //VALIDAR CPF
    public function valida_documento()
    {
        $response = array(
            'valid' => true,
        );

        if (!empty($_POST['cnpj_cpf'])) {
            $user = $this->db->row('SELECT * FROM crm_empresas WHERE cnpj_cpf="' . $_POST['cnpj_cpf'] . '" AND empresa = "'.session('empresa').'"');
            if ($user) {
                $response = array('valid' => false, 'message' => 'CNPJ/CPF já utilizado.');
            } else {
                $response = array('valid' => true);
            }
        }

        echo json_encode($response);

    }

    public function municipios()
    {
        $search = (isset($_POST['searchTerm'])) ? $_POST['searchTerm'] : '';
        $ncms = $this->db->table("SELECT * FROM municipio WHERE Nome like '%".$search."%' limit 5");
        foreach ($ncms as $n)
        {
            $data[] = array("id"=>$n->Nome, "text"=> $n->Nome);
        }
        echo json_encode($data);
    }

    public function uf()
    {
        $search = (isset($_POST['searchTerm'])) ? $_POST['searchTerm'] : '';
        $ncms = $this->db->table("SELECT * FROM estado WHERE Uf like '%".$search."%' limit 5");
        foreach ($ncms as $n)
        {
            $data[] = array("id"=>$n->Uf, "text"=> $n->Uf);
        }
        echo json_encode($data);
    }

}
