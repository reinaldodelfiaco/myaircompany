<?php

class tarefas {
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
                $p = $this->db->insert('tarefas', copy_post());
                $this->db->update('tarefas', ['data_inicial' => data_en(post('data_inicial')), 'data_final' => data_en(post('data_final'))], ['id' => $p]);
                flash('success', 'Tarefa criada com sucesso');
                return redirect('tarefas');
            }
        }

        $query = "";
        if(get('fprojeto')) {
            $query .= " AND projeto = " . get('fprojeto') . " ";
        }

        if(get('fstatus') == "fechada") {
            $tarefas = $this->db->table('SELECT * FROM tarefas WHERE status="fechada " AND empresa = ' . session('empresa') . $query .  ' ORDER BY data_final');
        } else {
            $tarefas = $this->db->table('SELECT * FROM tarefas WHERE status="aberta" AND empresa = ' . session('empresa') . $query . ' ORDER BY data_final');
        }


        $projetos = $this->db->table(   "SELECT * FROM projetos WHERE status='iniciado' AND empresa = " . session('empresa'));
        view('tarefas/index', ['tarefas' => $tarefas, 'projetos' => $projetos]);
    }


    public function concluir()
    {
        $this->db->update('tarefas', ['status' => 'fechada', 'data_conclusao' => date("Y-m-d")], ['id' => get('id')]);
        return redirect('tarefas');
    }


    public function editar()
    {
        if(is_post()){
            $this->val->name('titulo')->value('titulo')->required();
            if($this->val->isSuccess()) {
                $this->db->update('tarefas', copy_post(), ['id' => get('id')]);
                $this->db->update('tarefas', ['data_inicial' => data_en(post('data_inicial')), 'data_final' => data_en(post('data_final'))], ['id' => get('id')]);
                flash('success', 'Tarefa atualizada com sucesso');
                return redirect('tarefas');
            }
        }
        $tarefa = $this->db->row(   "SELECT * FROM tarefas WHERE id = " . get('id'));
        view('tarefas/editar', ['tarefa' => $tarefa]);
    }

}