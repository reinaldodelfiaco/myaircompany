<?php

    class mailing {

        private $db;
        private $val;

        public function __construct()
        {
            $this->db = new db();
            $this->val = new validator();
        }

        function send()
        {
            $mailing = $this->db->row("SELECT * FROM mailings WHERE id = 1");
            $subs = $this->db->table("SELECT * FROM usuarios_subscribers");

            foreach ($subs as $s)
            {
                envia_email($s->email, $mailing->titulo, $mailing->texto);
                echo "E-mail enviado para " . $s->email . "<hr>";
            }


            echo "Todos os e-mails foram enviados";

        }

        function index()
        {

            if(is_post())
            {
                $this->val->name('titulo')->value(post('titulo'))->required();
                $this->val->name('texto')->value(post('texto'))->required();

                if($this->val->isSuccess())
                {
                    $this->db->insert('mailings', copy_post());
                    flash('success', 'Mailing adicionado com sucesso');

                    return redirect('mailing/index');
                }
            }

            $mailings  = $this->db->table("SELECT * FROM mailings WHERE empresa = " . session('empresa'));
            view('mailing/index', ['mailings' => $mailings]);
        }


        function editar()
        {

            if(is_post())
            {
                $this->val->name('titulo')->value(post('titulo'))->required();
                $this->val->name('texto')->value(post('texto'))->required();

                if($this->val->isSuccess())
                {
                    $this->db->update('mailings', copy_post(), ['id' => get('id')]);
                    flash('success', 'Mailing editardo com sucesso');

                    return redirect('mailing/editar?id=' . get('id'));
                }
            }

            $mailing  = $this->db->row("SELECT * FROM mailings WHERE id = " . get('id'));
            view('mailing/editar', ['mailing' => $mailing]);
        }

    }