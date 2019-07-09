<?php

class documentos
{

    public $db;
    public $val;

    public function __construct()
    {
        require_login();

        $this->db = new db();
        $this->val = new validator();
    }
    
    
    public function pendentes()
    {
        
        
        $documentos = $this->db->table("SELECT  b.id as idaprov, b.*, a.* FROM  documentos_aprovacoes b, documentos a  WHERE a.status <> 'inativo' AND b.documento = a.id AND a.empresa = " . session('empresa') . " AND (b.aprovado = 1 or b.revisado = 1 ) AND cancelado = 0 GROUP BY a.id ORDER BY data ASC");
        view('documentos/pendentes', ['documentos' => $documentos]);
    }

    public function categorias()
    {


        

        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('chave')->value(post('chave'))->required();
            $this->val->name('empresa')->value(post('empresa'))->required();
            $this->val->name('modulo')->value(post('modulo'))->required();

            if ($this->val->isSuccess()) {
                $this->db->insert('selects', copy_post());
                redirect('documentos/categorias');
            }
        }


        $categorias = $this->db->table('SELECT * FROM selects WHERE empresa = ' . session('empresa') . ' AND modulo = "documentos" AND chave = "categorias"');

        view('documentos/categorias', [
            'categorias' => $categorias,
            'title' => "[Documentos] - Categorias"
        ]);
    }

    public function deletar_categoria()
    {
        
        $this->db->delete('selects', ['id' => get(id)]);
        return redirect('documentos/categorias');
    }

    public function editar_categoria()
    {
        
        if (is_post()) {
            $this->val->name('nome')->value(post('nome'))->required();
            if ($this->val->isSuccess()) {
                $this->db->update('selects', copy_post(), ['id' => post('id')]);
                redirect('documentos/categorias');
            }
        }

        $categoria = $this->db->row('SELECT * FROM selects WHERE id = ' . get('id'));

        view('documentos/editar_categoria', ['title' => "[DOCUMENTOS] - Editar categoria", 'categoria' => $categoria]);
    }


    // DOCUMENTOS

    public function index()
    {

        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();

            if ($this->val->isSuccess() && !empty($_FILES['documento'])) {


                $path = "uploads/";
                $documento = basename(sha1(date("H:i:s")) . "-" . $_FILES['documento']['name']);
                $path = $path . $documento;

                $documento_name = $_FILES['documento']['name'];
                $tamanho = $_FILES['documento']['size'] / 1000000;
                $tamanho_usado = tamanho_usado(post('empresa'));
                $tamanho_disponivel = tamanho_geral(post('empresa'));

               
                    if (move_uploaded_file($_FILES['documento']['tmp_name'], $path)) {


                        $data = [
                            'nome' => post('nome'),
                            'status' => 'ativo',
                            'departamento' => post('departamento'),
                            'categoria' => post('categoria'),
                            'autor' => post('autor'),
                            'data_revisao' => data_en(post('data_revisao')),
                            'validade' => post('validade'),
                            'revisao' => post('revisao'),
                            'descricao' => post('descricao'),
                            'empresa' => post('empresa'),
                            'dono' => post('dono'),
                            'tipo' => post('tipo'),
                            'local' => post('local'),
                            'identificacao' => post('identificacao'),
                            'protecao' => post('protecao'),
                            'recuperacao' => post('recuperacao'),
                            'retencao_minima' => post('retencao_minima'),
                            'disposicao' => post('disposicao'),
                            
                        ];


                        $documento_id = $this->db->insert('documentos', $data);

                        $data = [
                            'nome' => $_FILES['documento']['name'],
                            'nome_atual' => $documento,
                            'link' => BASE . $path,
                            'path' => $path,
                            'size' => $_FILES['documento']['size'],
                            'ext' => $_FILES['documento']['type'],
                            'modulo' => 'documentos',
                            'modulo_key' => $documento_id,
                            'empresa' => post('empresa'),
                        ];


                        $this->db->insert('uploads', $data);
                        return redirect('documentos/detalhes?id=' . $documento_id);

                }

                #$this->db->insert('selects', copy_post());
                #redirect('documentos/categorias');
            } else {
                flash('error', 'Erro ao fazer upload do documento');
            }
        }

        if (super()) {
            $documentos = $this->db->table('SELECT d.*, c.nome as nome_categoria, u.link as link, u.path FROM documentos d, selects c, uploads u WHERE c.id = d.categoria AND u.modulo_key = d.id and u.modulo="documentos"  AND d.status = "ativo"');
            $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo = "empresas" AND chave="departamentos"');
            $categorias = $this->db->table('SELECT * FROM selects WHERE modulo = "documentos" AND chave="categorias"');
        } elseif (adm()) {
            $documentos = $this->db->table('SELECT d.*, c.nome as nome_categoria, u.link as link, u.path FROM documentos d, selects c, uploads u WHERE c.id = d.categoria AND u.modulo_key = d.id and u.modulo="documentos"  AND d.status = "ativo" AND d.empresa = ' . session('empresa'));
            $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo = "empresas" AND chave="departamentos" AND empresa=' . session('empresa'));
            $categorias = $this->db->table('SELECT * FROM selects WHERE modulo = "documentos" AND chave="categorias" AND  empresa = ' . session('empresa'));
        } else {
            $dep = $this->db->row('SELECT * FROM usuarios WHERE id=' . session('id'));
            $documentos = $this->db->table('SELECT d.*, c.nome as nome_categoria, u.link as link, u.path
                                      FROM documentos d, selects c, uploads u, documentos_departamentos_permissoes a, usuarios p 
                                      WHERE c.id = d.categoria 
                                      AND a.documento = d.id 
                                      AND d.id NOT IN (SELECT documento FROM documentos_aprovacoes WHERE aprovado = 1 OR revisado = 1)
                                      AND p.departamento = a.departamento
                                      AND u.modulo_key = d.id 
                                      AND u.modulo="documentos" 
                                      AND d.empresa = ' . session('empresa') . ' 
                                      AND d.status = "ativo"
                                      GROUP BY d.id');

            $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo = "empresas" AND chave="departamentos" AND empresa = ' . session('empresa'));
            $categorias = $this->db->table('SELECT * FROM selects WHERE modulo = "documentos" AND chave="categorias"  AND empresa = ' . session('empresa'));
        }

        $empresas = $this->db->table('SELECT * FROM empresas');
        view('documentos/index', [
            'documentos' => $documentos,
            'empresas' => $empresas,
            'categorias' => $categorias,
            'departamentos' => $departamentos
        ]);
    }


    public function editar()
    {


        if (is_post()) {

            $this->val->name('nome')->value(post('nome'))->required();
            $this->val->name('autor')->value(post('autor'))->required();
            $this->val->name('data_revisao')->value(post('data_revisao'))->required();
            $this->val->name('validade')->value(post('validade'))->required();
            $this->val->name('revisao')->value(post('revisao'))->required();
            $this->val->name('descricao')->value(post('descricao'))->required();

            if ($this->val->isSuccess()) {

                $data = [
                    'nome' => post('nome'),
                    'status' => 'ativo',
                    'departamento' => post('departamento'),
                    'categoria' => post('categoria'),
                    'autor' => post('autor'),
                    'data_revisao' => data_en(post('data_revisao')),
                    'validade' => post('validade'),
                    'revisao' => post('revisao'),
                    'descricao' => post('descricao'),
                    'empresa' => post('empresa'),
                    'tipo' => post('tipo'),
                    'local' => post('local'),
                    'identificacao' => post('identificacao'),
                    'protecao' => post('protecao'),
                    'recuperacao' => post('recuperacao'),
                    'retencao_minima' => post('retencao_minima'),
                    'disposicao' => post('disposicao'),
                ];


                $this->db->update('documentos', $data, ['id' => get('id')]);
                return redirect('documentos');


            } else {
                flash('error', 'Erro ao enviar documento');
            }

        }

        if (super()) {
            $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo = "empresas" AND chave="departamentos"');
            $categorias = $this->db->table('SELECT * FROM selects WHERE modulo = "documentos" AND chave="categorias"');
        } else {
            $departamentos = $this->db->table('SELECT * FROM selects WHERE modulo = "empresas" AND chave="departamentos" AND empresa = ' . session('empresa'));
            $categorias = $this->db->table('SELECT * FROM selects WHERE modulo = "documentos" AND chave="categorias"  AND empresa = ' . session('empresa'));
        }

        $documento = $this->db->row('SELECT * FROM documentos where id=' . get('id'));
        $empresas = $this->db->table('SELECT * FROM empresas');
        view('documentos/editar', [
            'documento' => $documento,
            'empresas' => $empresas,
            'categorias' => $categorias,
            'departamentos' => $departamentos
        ]);
    }


    public function detalhes()
    {

        $documento = $this->db->row('
										SELECT d.*, u.link as link, u.nome as nome_arquivo, u.ext as ext, e.razao_social as nome_empresa 
										FROM documentos d, uploads u, empresas e 
										WHERE d.id = ' . get('id') . '
										AND e.id = d.empresa 
                                        AND modulo = "documentos" AND u.modulo_key = ' . get('id'));
                          
        if(!$documento)
        {
            return redirect('documentos');
        }


        $usuarios = $this->db->table('SELECT * FROM usuarios WHERE empresa = ' . $documento->empresa .' AND id NOT IN ( SELECT usuario FROM documentos_aprovacoes WHERE documento = '.get('id').')');
        $departamentos = $this->db->table('SELECT * FROM selects WHERE chave="departamentos" AND modulo = "empresas" AND empresa = ' . session('empresa') . ' AND id NOT IN (SELECT departamento FROM documentos_departamentos_permissoes WHERE documento = '.get('id').')');

        $avaliadores = $this->db->table('SELECT documentos_aprovacoes.*, usuarios.nome as nome_usuario FROM documentos_aprovacoes, usuarios WHERE usuarios.id = documentos_aprovacoes.usuario AND documentos_aprovacoes.documento = ' . get('id'));

        $departamentos_liberados = $this->db->table('SELECT  a.*, b.nome as nome_departamento FROM documentos_departamentos_permissoes a, selects b WHERE a.departamento = b.id AND a.documento = ' . get('id'));

        view('documentos/detalhes', [
            'documento' => $documento,
            'usuarios' => $usuarios,
            'avaliadores' => $avaliadores,
            'departamentos' => $departamentos,
            'departamentos_liberados' => $departamentos_liberados,
        ]);
    }

    public function add_avaliador()
    {


        $usuario = $this->db->row('SELECT * FROM usuarios WHERE id= ' . post('usuario'));
        $assunto = 'West - Novo documento';
        $msg = 'Um novo documento foi adicionado para sua análise, acesse o sistema para mais informações.';

        envia_email($usuario->email, $assunto, $msg);

        $this->db->insert('documentos_aprovacoes', copy_post());
        return redirect('documentos/detalhes?id=' . post('documento'));
    }

    public function remove_avaliador()
    {
        

        $documento = $this->db->row('SELECT * FROM documentos_aprovacoes WHERE id = ' . get('id'));
        $this->db->delete('documentos_aprovacoes', ['id' => get('id')]);
        return redirect('documentos/detalhes?id=' . $documento->documento);
    }

    public function remove_departamento()
    {
        

        $documento = $this->db->row('SELECT * FROM 	documentos_departamentos_permissoes WHERE id = ' . get('id'));
        $this->db->delete('	documentos_departamentos_permissoes', ['id' => get('id')]);
        return redirect('documentos/detalhes?id=' . $documento->documento);
    }

    public function add_departamento()
    {
        $data = [
            'departamento' => post('departamento'),
            'documento' => post('documento'),
            'autorizado' => post('autorizado'),
        ];

        $this->db->insert('documentos_departamentos_permissoes', $data);
        return redirect('documentos/detalhes?id=' . post('documento'));
    }


    public function analise()
    {
        $documentos = $this->db->table("SELECT  b.id as idaprov, b.*, a.* FROM  documentos_aprovacoes b, documentos a  WHERE a.status <> 'inativo' AND b.documento = a.id AND b.usuario = " . session('id') . " AND (b.aprovado = 1 or b.revisado = 1 ) AND cancelado = 0 GROUP BY a.id ORDER BY data ASC");
        view('documentos/analise', ['documentos' => $documentos]);
    }

    public function revisar()
    {
        flash('success', 'Documento marcado como revisado!');
        $this->db->update('documentos_aprovacoes', ['revisado' => 2], ['documento' => get('id'), 'usuario' => session('id')]);
        return redirect('documentos/analise');
    }

    public function aprovar()
    {
        flash('success', 'Documento aprovado com sucesso!');
        $this->db->update('documentos_aprovacoes', ['aprovado' => 2], ['documento' => get('id'), 'usuario' => session('id')]);
        return redirect('documentos/analise');
    }

    public function cancelar()
    {
        flash('error', 'Documento cancelado!');
        $this->db->update('documentos_aprovacoes', ['cancelado' => 1], ['documento' => get('id'), 'usuario' => session('id')]);
        return redirect('documentos/analise');
    }


    public function inativar()
    {

        $this->db->update('documentos', ['status' => 'inativo'], ['id' => get('id')]);
        return redirect('documentos');
    }
}
