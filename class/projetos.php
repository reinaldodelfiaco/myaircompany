<?php

    class projetos {
        public $db;
        public $val;

        public function __construct()
        {
            $this->db = new db();
            $this->val = new validator();
        }

        public function index()
        {
            if(is_post()){
                $this->val->name('titulo')->value('titulo')->required();

                if($this->val->isSuccess()) {

                    $p = $this->db->insert('projetos', copy_post());
                    $this->db->update('projetos', ['data_inicial' => data_en(post('data_inicial')), 'data_final' => data_en(post('data_final'))], ['id' => $p]);
                    flash('success', 'Projeto criado com sucesso');
                    return redirect('projetos');
                }
            }

            $clientes = $this->db->table("SELECT * FROM crm_empresas WHERE empresa = " . session('empresa'));
            $projetos = $this->db->table(   "SELECT * FROM crm_empresas b, projetos a WHERE a.status != 'finalizado' AND b.id = a.cliente AND a.empresa = " . session('empresa'));
            view('projetos/index', ['projetos' => $projetos, 'clientes' => $clientes]);
        }


        public function editar()
        {
            if(is_post()){
                $this->val->name('titulo')->value('titulo')->required();

                if($this->val->isSuccess()) {

                    $this->db->update('projetos', copy_post(), ['id' => get('id')]);
                    $this->db->update('projetos', ['data_inicial' => data_en(post('data_inicial')), 'data_final' => data_en(post('data_final'))], ['id' => get('id')]);
                    flash('success', 'Projeto atualizado com sucesso');
                    return redirect('projetos');
                }
            }

            $clientes = $this->db->table("SELECT * FROM crm_empresas WHERE empresa = " . session('empresa'));
            $projeto = $this->db->row(   "SELECT * FROM projetos WHERE id = " . get('id'));
            view('projetos/editar', ['projeto' => $projeto, 'clientes' => $clientes]);
        }

    }