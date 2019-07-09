<?php

class usuarios
{

    public $val;
    public $db;

    public function __construct()
    {
        $this->val = new validator();
        $this->db = new db();

    }

    public function recuperar()
    {
        if (is_post()) {
            $this->val->name('email')->value(post('email'))->pattern('email')->required();
            if ($this->val->isSuccess()) {

                $this->db->update('chefias', copy_post(), ['email' => post('email')]);

                $assunto = "VOEAVA - Recupere sua senha";
                $msg = " Essa é uma mensagem automática do sistema Agragar. <br>Caso a solicitação não tenha sido feita por você por favor desconsiderar esse e-mail";
                $msg .= " <br> Clique no link abaixo para resetar sua senha:";
                $msg .= "<br><br><a href='" . BASE . "usuarios/resetar?token=" . post('token') . "'>RESETAR SUA SENHA!</a>";
                $msg .= "<br><br>Att. Equipe VOEAVA";

                envia_email(post('email'), $assunto, $msg);
                flash('success', 'Recuperação de senha enviada para seu e-mail, por favor, verificar a caixa de spam.');
                return redirect('usuarios/login');
            } else {
                flash('error', 'Erro ao enviar a solicitação de senha, por favor, entrar em contato.');
                return redirect('usuarios/recuperar');
            }
        }
        view('usuarios/recuperar', '', 'auth');
    }

    public function resetar()
    {

        $check = $this->db->row("SELECT * FROM chefias WHERE token = '" . get('token') . "'");

        if (!$check) {
            flash('error', 'Tokan inválido!');
            return redirect('usuarios/login');

        }

        if (is_post()) {
            $this->val->name('senha')->value(post('senha'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('chefias', ['senha' => sha1(post('senha'))], ['id' => $check->id]);
                flash('success', 'Senha alterada com sucesso.');
                return redirect('usuarios/login');
            } else {
                flash('error', 'Erro ao resetar sua senha.');
                return redirect('usuarios/resetar');
            }
        }
        view('usuarios/resetar', '', 'auth');
    }

    public function cancelar()
    {
        require_adm();
        $this->db->update('chefias', ['status' => 'cancelado'], ['id' => get('id')]);
        flash('success', 'Usuário excluído com sucesso');
        return redirect('usuarios');
    }

    public function senha()
    {
        require_adm();
        if (is_post()) {
            $this->val->name('senha')->value(post('senha'))->required();

            $data = [
                'senha' => sha1(post('senha')),
            ];

            $this->db->update('chefias', $data, ['id' => get('id')]);
            flash('success', 'Senha do usuário alterada com sucesso');
            return redirect('usuarios');
        }

        view('usuarios/senha');
    }

    public function msenha()
    {
        if (is_post()) {
            $this->val->name('senha')->value(post('senha'))->required();

            $data = [
                'senha' => sha1(post('senha')),
            ];

            $this->db->update('chefias', $data, ['id' => session('id')]);
            flash('success', 'Senha do usuário alterada com sucesso');
            return redirect('usuarios/msenha');
        }

        view('usuarios/msenha');
    }

    public function valida_email()
    {
        $response = array(
            'valid' => false,
            'message' => 'E-mail é obrigatório.'
        );

        if (!empty($_POST['email'])) {
            $user = $this->db->row('SELECT * FROM chefias WHERE email="' . $_POST['email'] . '"');
            if ($user) {
                $response = array('valid' => false, 'message' => 'E-mail já utilizado.');
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $response = array('valid' => false, 'message' => 'E-mail inválido.');
            } else {
                $response = array('valid' => true);
            }
        }

        echo json_encode($response);

    }

    public function index()
    {

        //require_adm();


        $usuarios = $this->db->table('SELECT * FROM chefias WHERE  status != "cancelado"');

        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('email')->value(post('email'))->pattern('email')->required()->unique('chefias', 'email');
            $this->val->name('senha')->value(post('senha'))->required();

            if ($this->val->isSuccess()) {

                $usuario_id = $this->db->insert('chefias', copy_post());
                $data = [
                    'senha' => sha1(post('senha')),
                ];
                $this->db->update('chefias', $data, ['id' => $usuario_id]);

                flash('success', 'Usuário cadastrado com sucesso');
                return redirect('usuarios');
            }
        }


        view('usuarios/index', [
            'usuarios' => $usuarios,
        ]);

    }

    public function editar()
    {
        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();

            if ($this->val->isSuccess()) {

                $this->db->update('chefias', copy_post(), ['id' => get('id')]);
                flash('success', 'Cadastro editado com sucesso');
                return redirect('usuarios');
            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }

        }


        $usuario = $this->db->row('SELECT * FROM chefias WHERE id=' . get('id'));

        view('usuarios/editar', ['usuario' => $usuario]);

    }

    public function profile()
    {
        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('chefias', copy_post(), ['id' => session('id')]);
                if (!empty($_FILES['foto'])) {

                    $path = "uploads/";
                    $documento = basename(sha1(date("H:i:s")) . "-" . $_FILES['foto']['name']);
                    $path = $path . $documento;
                    $documento_name = $_FILES['foto']['name'];
                    move_uploaded_file($_FILES['foto']['tmp_name'], $path);
                    $data = [
                        'nome' => $_FILES['foto']['name'],
                        'nome_atual' => $documento,
                        'link' => BASE . $path,
                        'path' => $path,
                        'size' => $_FILES['foto']['size'],
                        'ext' => $_FILES['foto']['type'],
                        'modulo' => 'usuarios',
                        'modulo_key' => session('id'),
                        'empresa' => session('empresa'),
                    ];

                    $this->db->insert('uploads', $data);
                }
                flash('success', 'Cadastro editado com sucesso');
                return redirect('usuarios/profile');
            } else {
                echo "Validation error!";
                var_dump($this->val->getErrors());
            }

        }

        $usuario = $this->db->row('SELECT * FROM chefias WHERE id=' . session('id'));
        view('usuarios/profile', ['usuario' => $usuario,]);

    }

    public function dashboard()
    {   


        require_login();


        /*$recebendo_hoje = $this->db->table("SELECT sum(valor) as total FROM movimentos WHERE tipo = 'receita' AND data_vencimento = '".date("Y-m-d")."' and empresa = ". session('empresa'));
        $recebendo_atraso = $this->db->table("SELECT sum(valor) as total FROM movimentos WHERE status='aberto' AND  tipo = 'receita' AND data_vencimento < '".date("Y-m-d")."' and empresa = ". session('empresa'));
        $pagando_hoje = $this->db->table("SELECT sum(valor) as total FROM movimentos WHERE tipo = 'despesa' AND data_vencimento = '".date("Y-m-d")."' and empresa = ". session('empresa'));
        $pagando_atraso = $this->db->table("SELECT sum(valor) as total FROM movimentos WHERE tipo = 'despesa' and status = 'aberto' AND data_vencimento < '".date("Y-m-d")."' and empresa = ". session('empresa'));

        foreach($recebendo_hoje as $rh)
        {
            $valor_receita_hoje = $rh->total;
        }

        foreach($recebendo_atraso as $ra)
        {
            $valor_receita_atrasada = $ra->total;
        }

        foreach($pagando_hoje as $ph)
        {
            $valor_despesa_hoje = $ph->total;
        }

        foreach($pagando_atraso as $pa)
        {
            $valor_despesa_atraso = $pa->total;
        }*/
        
        
        view('usuarios/dashboard', [
            #'valor_receita_hoje' => moeda_real($valor_receita_hoje),
           # 'valor_receita_atrasada' => moeda_real($valor_receita_atrasada),
            #'valor_despesa_hoje' => moeda_real($valor_despesa_hoje),
           # 'valor_despesa_atrasada' => moeda_real($valor_despesa_atraso),

        ]);


    }


    public function login()
    {
        if (!empty($_SESSION['id'])) {
            redirect('usuarios/dashboard');
        }

        if (is_post()) {
            $this->val->name('email')->value(post('email'))->pattern('email')->required();
            $this->val->name('senha')->value(post('senha'))->required();
            if ($this->val->isSuccess()) {
                $usuario = $this->db->row("SELECT * FROM chefias WHERE email = '" . post('email') . "' AND status='ativo'");
                if ($usuario && $usuario->senha == sha1(post('senha'))) {
                    session_set('id', $usuario->id);
                    session_set('email', $usuario->email);
                    session_set('nome', $usuario->nome);
                    session_set('regra', $usuario->regra);
                    session_set('empresa', 1);

                    redirect('chefias/dashboard');
                } else {
                    flash('error', 'Usuário ou senha inválidos.');
                }

            } else {
                var_dump($this->val->getErrors());
            }
        }

        view('usuarios/login', '', 'auth');
    }


    public function registro()
    {

    }

    public function logout()
    {
        session_finish();
        redirect(PAGE_LOGOUT);
    }

    function treinamentos()
    {
        require_login();
        if (is_post()) {
            $data = [
                'usuario' => get('id'),
                'treinamento' => post('treinamento'),
            ];

            if (post('data')) {
                $data += ['data' => data_en(post('data'))];
            }

            $this->db->insert('usuarios_treinamentos', $data);

            flash('success', 'Treinamento adicionado com sucesso');
            return redirect('usuarios/treinamentos?id=' . get('id'));
        }


        $treinamentos = $this->db->table('SELECT b.id, a.nome as nome_treinamento, b.data, a.validade, c.link FROM usuarios_treinamentos b LEFT JOIN uploads c ON c.id = b.certificado, treinamentos a  WHERE a.id = b.treinamento and usuario = ' . get('id'));
        $treinamentos_form = $this->db->table('SELECT * FROM treinamentos WHERE empresa = ' . session('empresa'));
        view('usuarios/treinamentos', ['treinamentos' => $treinamentos, 'treinamentos_form' => $treinamentos_form]);
    }

    function editar_treinamento()
    {
        require_adm();
        if (is_post()) {

            $data = [
                'data' => data_en(post('data')),
            ];

            if (!empty(filename('certificado'))) {
                $path = "uploads/";
                $documento = basename(sha1(date("H:i:s")) . "-" . $_FILES['certificado']['name']);
                $path = $path . $documento;
                $documento_name = $_FILES['certificado']['name'];
                $data_certificado = [
                    'nome' => $_FILES['certificado']['name'],
                    'nome_atual' => $documento,
                    'link' => BASE . $path,
                    'path' => $path,
                    'size' => $_FILES['certificado']['size'],
                    'ext' => $_FILES['certificado']['type'],
                    'modulo' => 'treinamentos',
                    'modulo_key' => get('id'),
                    'empresa' => session('empresa'),
                ];

                move_uploaded_file($_FILES['certificado']['tmp_name'], $path);
                $id_upload = $this->db->insert('uploads', $data_certificado);

                $data += ['certificado' => $id_upload];
            }


            $this->db->update('usuarios_treinamentos', $data, ['id' => get('id')]);
            $usuario = $this->db->row('SELECT * FROM usuarios_treinamentos WHERE id=' . get('id'));
            flash('success', 'Treinamento atualizado com sucesso');
            return redirect('usuarios/treinamentos?id=' . $usuario->usuario);
        }


        $treinamento = $this->db->row('SELECT * FROM usuarios_treinamentos b, treinamentos a  WHERE a.id = b.treinamento AND  b.id= ' . get('id'));

        $treinamentos_form = $this->db->table('SELECT * FROM treinamentos WHERE empresa = ' . session('empresa'));
        view('usuarios/editar_treinamentos', ['treinamento' => $treinamento, 'treinamentos_form' => $treinamentos_form]);
    }

    function deletar_treinamento()
    {
        require_adm();
        $usuario = $this->db->row('SELECT * FROM usuarios_treinamentos WHERE id = ' . get('id'));
        $this->db->delete('usuarios_treinamentos', ['id' => get('id')]);
        flash('success', 'Treinamento excluído com sucesso.');
        return redirect('usuarios/treinamentos?id=' . $usuario->usuario);

    }

    public function teste_email()
    {
        envia_email('jonasvreichel@gmail.com', 'SMTP TESTE', 'Email de teste');
    }
}
