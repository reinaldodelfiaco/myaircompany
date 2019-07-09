<?php

use Knp\Snappy\Pdf;


class tasks
{

    public function __construct()
    {

        $this->db = new db();
        $this->val = new validator();
    }

    public function avaliar()
    {
        $this->db->insert('tasks_avaliacoes', ['task' => get('id'), 'estrelas' => get('nota')]);
        flash('success', 'Obrigado por sua avaliação');
        return redirect('usuarios/login');
    }

    public function classificacoes()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('chave')->value(post('chave'))->required();
            $this->val->name('empresa')->value(post('empresa'))->required();
            $this->val->name('modulo')->value(post('modulo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->insert('selects', copy_post());
                redirect('tasks/classificacoes');
            }
        }

        $classificacoes = $this->db->table('SELECT * FROM selects WHERE empresa = ' . session('empresa') . ' AND modulo = "tasks" AND chave = "classificacoes"');

        view('tasks/classificacoes', [
            'classificacoes' => $classificacoes,
        ]);
    }

    public function deletar_categoria()
    {
        $this->db->delete('selects', ['id' => get(id)]);
        return redirect('tasks/classificacoes');
    }

    public function editar_classificacao()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();

            if ($this->val->isSuccess()) {
                $this->db->update('selects', copy_post(), ['id' => post('id')]);
                redirect('tasks/classificacoes');
            }
        }
        $classificacao = $this->db->row('SELECT * FROM selects WHERE id = ' . get('id'));
        view('tasks/editar_classificacao', ['classificacao' => $classificacao]);
    }

    public function tipos()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('chave')->value(post('chave'))->required();
            $this->val->name('empresa')->value(post('empresa'))->required();
            $this->val->name('modulo')->value(post('modulo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->insert('selects', copy_post());
                redirect('tasks/tipos');
            }
        }

        $tipos = $this->db->table('SELECT * FROM selects WHERE empresa = ' . session('empresa') . ' AND modulo = "tasks" AND chave = "tipos"');

        view('tasks/tipos', [
            'tipos' => $tipos,
        ]);
    }

    public function deletar_tipos()
    {
        $this->db->delete('selects', ['id' => get(id)]);
        return redirect('tasks/tipos');
    }

    public function deletar()
    {
        require_adm();
        $this->db->delete('tasks', ['id' => get(id)]);
        return redirect('tasks');
    }

    public function editar_tipos()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();

            if ($this->val->isSuccess()) {
                $this->db->update('selects', copy_post(), ['id' => post('id')]);
                redirect('tasks/tipos');
            }
        }
        $tipos = $this->db->row('SELECT * FROM selects WHERE id = ' . get('id'));
        view('tasks/editar_tipos', ['tipos' => $tipos]);
    }

    public function origens()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('chave')->value(post('chave'))->required();
            $this->val->name('empresa')->value(post('empresa'))->required();
            $this->val->name('modulo')->value(post('modulo'))->required();
            if ($this->val->isSuccess()) {
                $this->db->insert('selects', copy_post());
                redirect('tasks/origens');
            }
        }

        $origens = $this->db->table('SELECT * FROM selects WHERE empresa = ' . session('empresa') . ' AND modulo = "tasks" AND chave = "origens"');

        view('tasks/origens', [
            'origens' => $origens,
        ]);
    }

    public function deletar_origens()
    {
        $this->db->delete('selects', ['id' => get(id)]);
        return redirect('tasks/origens');
    }

    public function editar_origens()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();

            if ($this->val->isSuccess()) {
                $this->db->update('selects', copy_post(), ['id' => post('id')]);
                redirect('tasks/origens');
            }
        }
        $origens = $this->db->row('SELECT * FROM selects WHERE id = ' . get('id'));
        view('tasks/editar_origens', ['origens' => $origens]);
    }


    function index()
    {

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('descricao')->value(post('descricao'))->required();

            if ($this->val->isSuccess()) {


                $data = [
                    'titulo' => post('titulo'),
                    'status' => post('status'),
                    'data_previsao' => data_en(post('data_previsao')),
                    'departamento' => post('departamento'),
                    'origem' => post('origem'),
                    'tipo' => post('tipo'),
                    'classificacao' => post('classificacao'),
                    'empresa' => post('empresa'),
                    'descricao' => post('descricao'),
                    'usuario' => session('id'),

                ];

                $task_id = $this->db->insert('tasks', $data);


                if ($_FILES['documento']['name']) {
                    print_r($_FILES['documento']);
                    $path = "uploads/";
                    $documento = basename(sha1(date("H:i:s")) . "-" . $_FILES['documento']['name']);
                    $path = $path . $documento;


                    $documento_name = $_FILES['documento']['name'];
                    $tamanho = $_FILES['documento']['size'] / 1000;
                    $tamanho_usado = tamanho_usado(post('empresa'));
                    $tamanho_disponivel = tamanho_geral(post('empresa'));
                    
                        move_uploaded_file($_FILES['documento']['tmp_name'], $path);
                        $data = [
                            'nome' => $_FILES['documento']['name'],
                            'nome_atual' => $documento,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['documento']['size'],
                            'ext' => $_FILES['documento']['type'],
                            'modulo' => 'tasks',
                            'modulo_key' => $task_id,
                            'empresa' => post('empresa'),
                        ];

                        $this->db->insert('uploads', $data);
                }

                return redirect('tasks/detalhes?id=' . $task_id);
            }
        }
        
       
        $sql = '';
        

        if(get('filter') > 0) {
            if(get('ftipo') > 0) {
                $sql .= ' AND tipo = ' . get('ftipo');
            };
            
            if(get('fclassificacao') > 0) {
                $sql .= ' AND classificacao = ' . get('fclassificacao');
            };
            
            if(get('forigem') > 0) {
                $sql .= ' AND origem = ' . get('forigem');
            };
        }


        $tasks = $this->db->table('SELECT * FROM tasks  '. $sql . ' ORDER BY data_previsao, data_criacao');
       

        $empresas = $this->db->table('SELECT * FROM empresas');
        $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo="empresas" and chave="departamentos"  and empresa = ' . session('empresa'));
        $origens = $this->db->table('SELECT * FROM selects WHERE modulo="tasks" and chave="origens"  and empresa = ' . session('empresa'));
        $tipos = $this->db->table('SELECT * FROM selects WHERE modulo="tasks" and chave="tipos"  and empresa = ' . session('empresa'));
        $classificacoes = $this->db->table('SELECT * FROM selects WHERE modulo="tasks" and chave="classificacoes"  and empresa = ' . session('empresa'));

        view('tasks/index', [
            'tasks' => $tasks,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'origens' => $origens,
            'tipos' => $tipos,
            'classificacoes' => $classificacoes,
        ]);
    }

    function editar()
    {

        if (is_post()) {
            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('descricao')->value(post('descricao'))->required();

            if ($this->val->isSuccess()) {


                $data = [
                    'titulo' => post('titulo'),
                    'status' => post('status'),
                    'data_previsao' => data_en(post('data_previsao')),
                    'departamento' => post('departamento'),
                    'origem' => post('origem'),
                    'tipo' => post('tipo'),
                    'classificacao' => post('classificacao'),
                    'empresa' => post('empresa'),
                    'descricao' => post('descricao'),

                ];

                $this->db->update('tasks', $data, ['id' => get('id')]);

                return redirect('tasks');
            }
        }

        $task = $this->db->row('SELECT * FROM tasks where id = ' . get('id'));
        $empresas = $this->db->table('SELECT * FROM empresas');
        $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo="empresas" and chave="departamentos"  and empresa = ' . session('empresa'));
        $origens = $this->db->table('SELECT * FROM selects WHERE modulo="tasks" and chave="origens"  and empresa = ' . session('empresa'));
        $tipos = $this->db->table('SELECT * FROM selects WHERE modulo="tasks" and chave="tipos"  and empresa = ' . session('empresa'));
        $classificacoes = $this->db->table('SELECT * FROM selects WHERE modulo="tasks" and chave="classificacoes"  and empresa = ' . session('empresa'));

        view('tasks/editar_task', [
            'task' => $task,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'origens' => $origens,
            'tipos' => $tipos,
            'classificacoes' => $classificacoes,
        ]);
    }


    function detalhes()
    {
        $id = get('id');
        if (is_post()) {

            $this->db->update('tasks', copy_post(), ['id' => get('id')]);
            return redirect('tasks/detalhes?id=' . get('id'));

        }


        $task = $this->db->row('SELECT * FROM tasks	WHERE id = ' . get('id'));
        if(!$task)
        {
            return redirect('tasks');
        }

        $usuarios = $this->db->table("SELECT * FROM chefias	WHERE id NOT IN (SELECT usuario FROM tasks_analizadas WHERE task = $id)");
        $upload = $this->db->row('SELECT * FROM uploads	WHERE modulo_key = ' . get('id') . ' AND modulo = "tasks"');
        $responsaveis = $this->db->table('SELECT b.id, b.nome as nome_usuario, a.* FROM chefias b, tasks_analizadas a WHERE b.id = a.usuario AND task = ' . get('id') . ' GROUP BY b.id, b.nome');
        $pqs = $this->db->table("SELECT a.*, b.nome as nome_usuario FROM tasks_analise a, chefias b WHERE b.id = a.usuario AND  task = $id ORDER BY a.data");

        view('tasks/detalhes', [
            'task' => $task,
            'upload' => $upload,
            'usuarios' => $usuarios,
            'responsaveis' => $responsaveis,
            'pqs' => $pqs,
        ]);
    }


    function add_avaliador()
    {
        $usuario = $this->db->row('SELECT * FROM chefias WHERE id = ' . post('usuario'));
        $assunto = 'VOEAVA - Nova Task cadastrada #' . get('id');
        $msg = 'Olá, uma nova task #' . get('id') . ' foi registrada no dia: ' . date("d/m/Y") . ', no sistema VOEAVA em seu nome.<br>
			Clique <a href="' . BASE . 'tasks/detalhes?id=' . get('id') . '"> aqui </a> para acessar a task e checar esta solicitação.';

        envia_email($usuario->email, $assunto, $msg);

        $this->db->insert('tasks_analizadas', copy_post());
        return redirect('tasks/detalhes?id=' . get('id'));
    }

    function add_pq()
    {
        $this->db->insert('tasks_analise', copy_post());
        return redirect('tasks/detalhes?id=' . get('id'));
    }

    function remove_responsavel()
    {
        $task = $this->db->row('SELECT * FROM tasks_analizadas WHERE id = ' . get('id'));
        $this->db->delete('tasks_analizadas', ['id' => get('id')]);
        return redirect('tasks/detalhes?id=' . $task->task);
    }

    function remove_pq()
    {
        $task = $this->db->row('SELECT * FROM tasks_analise WHERE id = ' . get('id'));
        $this->db->delete('tasks_analise', ['id' => get('id')]);
        return redirect('tasks/detalhes?id=' . $task->task);
    }

    function reabrir()
    {

        $analises = $this->db->table('SELECT * FROM tasks_analizadas WHERE task = ' . get('id'));

        print_r($analises);

        foreach ($analises as $a) {
            $usuario = $this->db->row('SELECT * FROM chefias WHERE id = ' . $a->usuario);
            $assunto = 'VOEAVA - A task #' . get('id') . ' foi reaberta';
            $msg = 'A task #' . get('id') . ' foi reaberta dia ' . date('d/m/y às H:i') . ' e está aguardando para ser avaliada.
			Acesse o sistema para realizar a avaliação da mesma! <br><br>';
            envia_email($usuario->email, $assunto, $msg);
        }

        $this->db->update('tasks', ['status' => 'reaberta'], ['id' => get('id')]);
        return redirect('tasks/detalhes?id=' . get('id'));
    }

    function encerrar()
    {
        $informacoes = $this->db->row('SELECT * FROM chefias a, tasks b WHERE b.usuario = a.id AND b.id=' . get('id'));
        $assunto = 'VOEAVA - A task #' . get('id') . ' foi finalizada com sucesso';
        $msg = 'A task #' . get('id') . ' aberta por você foi finlizada no dia ' . date('d/m/y às H:i') . ' por nossa equipe e está aguardando para ser avaliada.<br>
			Clique na imagem abaixo para realizar a avaliação de eficácia da mesma! <br><br>
			<a href="' . BASE . 'tasks/avaliar?id=' . get('id') . '&nota=1"><img src="' . BASE . 'public/imagens/triste.png" width="50"></a>&nbsp;&nbsp;&nbsp;  
		    <a href="' . BASE . 'tasks/avaliar?id=' . get('id') . '&nota=2"><img src="' . BASE . 'public/imagens/neutro.png" width="50"></a> &nbsp;&nbsp;&nbsp; 			      
		    <a href="' . BASE . 'tasks/avaliar?id=' . get('id') . '&nota=3"><img src="' . BASE . 'public/imagens/feliz.png" width="50"></a>
';

        envia_email($informacoes->email, $assunto, $msg);


        $this->db->update('tasks', ['status' => 'fechada', 'data_conclusao' => date("Y-m-d")], ['id' => get('id')]);
        return redirect('tasks/detalhes?id=' . get('id'));
    }


    public function pdf2()
    {

        $task = $this->db->row('SELECT * FROM tasks	WHERE id = ' . get('id'));
        $usuarios = $this->db->table('SELECT * FROM chefias	WHERE empresa = ' . session('empresa'));
        $upload = $this->db->row('SELECT * FROM uploads	WHERE modulo_key = ' . get('id') . ' AND modulo = "tasks"');

        $responsaveis = $this->db->table('SELECT a.*, b.id, b.nome as nome_usuario FROM tasks_analizadas a, usuarios b WHERE b.id = a.usuario AND  task = ' . get('id') . ' GROUP BY b.id, b.nome');
        $pqs = $this->db->table('SELECT a.*, b.nome as nome_usuario FROM tasks_analise a, usuarios b WHERE b.id = a.usuario AND  task = ' . get('id') . ' ORDER BY a.data');

        view('tasks/detalhes_pdf', [
            'task' => $task,
            'upload' => $upload,
            'usuarios' => $usuarios,
            'responsaveis' => $responsaveis,
            'pqs' => $pqs,
        ], 'pdf');

        redirect('tasks');
    }

}
