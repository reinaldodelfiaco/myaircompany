<?php

class cms
{
    public $db;
    public $val;

    public function __construct()
    {

        $this->db = new db();
        $this->val = new validator();

    }

    public function public()
    {
        
    }

    public function uploads()
    {
        $path = "uploads/";
        $temp = current($_FILES);
        $filetowrite = $path . $temp['name'];
        move_uploaded_file($temp['tmp_name'], $filetowrite);
    }

    public function index()
    {
        view('cms/index', '', 'web');
    }


    public function contato()
    {
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('email')->value(post('email'))->required();
            $this->val->name('telefone')->value(post('telefone'))->required();
            $this->val->name('mensagem')->value(post('mensagem'))->required();

            if ($this->val->isSuccess()) {
                $assunto = 'CONT4 - Recebemos seu contato.';
                $msg = 'Olá, ' . post('nome');
                $msg .= '<p> Recebemos seu contato pelo nosso site, em breve alguém de nossa equipe entrará em contato </p>';
                $msg .= '<p> Att. <br> CONT4 - DESENVOLVIMENTO DE SISTEMAS <br> www.cont4.me - contato@cont4.me - + 55 51 991575864</p>';

                envia_email(post('email'), $assunto, $msg);


                $assunto = 'CONT4 - Contato pelo site';
                $msg = '<h3> ' . post('nome') . ' enviou uma mensagem: </h3>';
                $msg .= '<p>' . post('mensagem') . '</p>';
                $msg .= '<strong> Email: <strong>' . post('email');
                $msg .= '<br><strong> Telefone: <strong>' . post('telefone');
                envia_email('reichel@cont4.me', $assunto, $msg);

                flash('success', 'Mensagem enviado com sucesso, em breve entraremos em contato');
                return redirect('cms/contato');
            }

        }


        $empresa = $this->db->row('SELECT * FROM empresas WHERE id=1');
        view('cms/contato', [
            'empresa' => $empresa,
        ], 'web');
    }


    public function conteudos()
    {
        require_super();

        $conteudos = $this->db->table("SELECT * FROM conteudos WHERE empresa = " . session('empresa'));

        view('cms/conteudos', [
            'conteudos' => $conteudos,
        ]);
    }


    public function adicionar_conteudo()
    {
        require_super();

        if (is_post()) {

            $this->val->name('titulo')->value(post('titulo'))->required()->unique('titulo', 'conteudos');
            $this->val->name('texto')->value(post('texto'))->required();

            if ($this->val->isSuccess()) {
                $cid = $this->db->insert('conteudos', copy_post());

                $this->db->update('conteudos', ['seo' => $this->slugify(post('titulo')), 'data_exibicao' => data_en(post('data_exibicao'))], ['id' => $cid]);

                foreach (post('categorias') as $c) {
                    $this->db->insert('conteudos_categorias', ['conteudo' => $cid, 'categoria' => $c]);
                }
                flash('success', 'Conteúdo adicionado com sucesso');
                return redirect('cms/editar_conteudo?id=' . $cid);
            } else {
                flash('error', 'Por favor, verifique as informações e tente novamente.');
            }
        }

        $categorias = $this->db->table('SELECT * FROM selects WHERE  chave="categorias"  AND modulo = "cms" AND  empresa = ' . session('empresa'));
        view('cms/adicionar_conteudo', ['categorias' => $categorias]);
    }


    public function editar_conteudo()
    {
        require_super();

        if (is_post()) {
            $this->val->name('titulo')->value(post('titulo'))->required();
            $this->val->name('texto')->value(post('texto'))->required();

            if ($this->val->isSuccess()) {
                $this->db->update('conteudos', copy_post(), ['id' => get('id')]);
                $this->db->update('conteudos', ['seo' => $this->slugify(post('titulo')), 'data_exibicao' => data_en(post('data_exibicao'))], ['id' => get('id')]);

                $this->db->delete('conteudos_categorias', ['conteudo' => get('id')]);

                foreach (post('categorias') as $c) {
                    $this->db->insert('conteudos_categorias', ['conteudo' => get('id'), 'categoria' => $c]);
                }


                flash('success', 'Conteúdo adicionado com sucesso');
                return redirect('cms/editar_conteudo?id='.get('id'));
            } else {
                flash('error', 'Por favor, verifique as informações e tente novamente.');
            }
        }

        $conteudo = $this->db->row("SELECT * FROM conteudos WHERE id = " . get('id'));
        $categorias = $this->db->table('SELECT * FROM selects WHERE chave="categorias"  AND modulo = "cms" AND empresa = ' . session('empresa'));
        $cat = $this->db->table('SELECT * FROM conteudos_categorias WHERE conteudo  = ' . get('id'));
        view('cms/editar_conteudos', ['conteudo' => $conteudo, 'categorias' => $categorias, 'cat' => $cat]);
    }

    public function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public function valida_slug()
    {
        $response = array(
            'valid' => false,
            'message' => 'Título é obrigatório.'
        );

        if (!empty($_POST['titulo'])) {
            if(str_word_count($_POST['titulo']) < 2) {
                $response = array('valid' => false, 'message' => 'O título precisa de pelo menos duas palavras..');
            } else {
                $conteudo = $this->db->row('SELECT * FROM conteudos WHERE seo="' . $this->slugify($_POST['titulo']) . '" AND empresa = ' . session('empresa'));
                if ($conteudo) {
                    $response = array('valid' => false, 'message' => 'Esse título já foi utilizado.');
                } else {
                    $response = array('valid' => true);
                }
            }
        }
        echo json_encode($response);
    }


    public function categorias()
    {
        require_super();

        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('chave')->value(post('chave'))->required();
            $this->val->name('empresa')->value(post('empresa'))->required();
            $this->val->name('modulo')->value(post('modulo'))->required();

            if ($this->val->isSuccess()) {
                $this->db->insert('selects', copy_post());
                redirect('cms/categorias');
            }
        }
        $categorias = $this->db->table('SELECT * FROM selects WHERE empresa = ' . session('empresa') . ' AND modulo = "cms" AND chave = "categorias"');

        view('cms/categorias', [
            'categorias' => $categorias,
        ]);
    }

    public function deletar_categoria()
    {
        require_super();

        $this->db->delete('selects', ['id' => get(id)]);
        return redirect('cms/categorias');
    }

    public function editar_categoria()
    {
        require_super();

        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('selects', copy_post(), ['id' => post('id')]);
                redirect('cms/categorias');
            }
        }

        $categoria = $this->db->row('SELECT * FROM selects WHERE id = ' . get('id'));
        view('cms/editar_categoria', ['categoria' => $categoria]);
    }



    public function seo($seo)
    {
        $conteudo = $this->db->row("SELECT * FROM conteudos WHERE seo = '".$seo."'");

        if(empty($conteudo)) {
            return redirect('');
        }

        if($conteudo->tipo == 'post') {
            view('cms/post', ['conteudo' => $conteudo, 'tags' => $conteudo->tags, 'meta' => $conteudo->meta],'web');
        } else {
            view('cms/seo', ['conteudo' => $conteudo, 'tags' => $conteudo->tags, 'meta' => $conteudo->meta],'web');
        }
    }
}	
