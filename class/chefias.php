<?php 
include './class/cargos.php';

class chefias { 
    
    public $val;
    public $db; 
    public $cargos;


    public const NAMED_QUERY_SELECT_ALL = 'SELECT * FROM chefias';
    public const NAMED_QUERY_SELECT_ALL_FUNCIONARIOS = 'SELECT * FROM chefias WHERE cargo NOT IN (SELECT id FROM cargos WHERE nome IN ("Motorista","Mecânico","Comissário","Piloto"))';
    public const NAMED_QUERY_SELECT_ALL_MOTORISTAS = 'SELECT * FROM chefias WHERE cargo IN (SELECT id FROM cargos WHERE nome = "Motorista")';
    public const NAMED_QUERY_SELECT_ALL_MECANICOS = 'SELECT * FROM chefias WHERE cargo IN (SELECT id FROM cargos WHERE nome = "Mecânico")';
    public const NAMED_QUERY_SELECT_ALL_COMISSARIOS = 'SELECT * FROM chefias WHERE cargo IN (SELECT id FROM cargos WHERE nome = "Comissário")';
    public const NAMED_QUERY_SELECT_ALL_PILOTOS = 'SELECT * FROM chefias WHERE cargo IN (SELECT id FROM cargos WHERE nome = "Piloto")';
    public const NAMED_QUERY_SELECT_PILOTOS_ATIVOS = 'SELECT * FROM chefias WHERE cargo IN (SELECT id FROM cargos WHERE nome = "Piloto") AND status = "ativo"';
    public const NAMED_QUERY_SELECT_WITH_ID = 'SELECT * FROM chefias WHERE id = ';
    public const NAMED_QUERY_SELECT_HABILITACAO_PILOTO = 'SELECT id, tipo_icao, DATE_FORMAT(data_validade, "%d/%m/%Y") as data_validade, ativo  FROM piloto_acft_tipo WHERE id_chefias = ';
    public const NAMED_QUERY_SELECT_HABILITACAO_MECANICO = 'SELECT mecanico_tipo.id, mecanico_carteira.tipo as nome, DATE_FORMAT(validade_tipo, "%d/%m/%Y") as validade_tipo, ativo  FROM mecanico_tipo 
                                                            INNER JOIN  mecanico_carteira ON mecanico_tipo.tipo =  mecanico_carteira.id WHERE id_mecanico = ';
    public const NAMED_QUERY_SELECT_HABILITACAO_COMISSARIO = 'SELECT id, tipo AS tipo_carteira, DATE_FORMAT(validade_tipo, "%d/%m/%Y") as validade_tipo, ativo  FROM comissario_tipo WHERE id_comissario = ';                                                            

    public const NAMED_QUERY_SELECT_MECANICO_CARTEIRA_TIPOS = 'SELECT * FROM mecanico_carteira';

    public const ICAO_OPT = [              
        ['nome' => '4', 'value' => '4'],
        ['nome' => '5', 'value' => '5'],
        ['nome' => '6', 'value' => '6'],
    ];

    public const CMA_OPT = [
        ['nome' => '1', 'value' => '1'],
        ['nome' => '2', 'value' => '2'],
        ['nome' => '3', 'value' => '3'],
        ['nome' => '4', 'value' => '4'],
        ['nome' => '5', 'value' => '5'],
    ];

    public const TIPO_DOCUMENTO = [
        ['nome' => 'RG', 'value' => 'RG'],
        ['nome' => 'CPF', 'value' => 'CPF'],
        ['nome' => 'Passaport', 'value' => 'Passaport'],
    ];


    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();      
        $this->cargos = new cargos();  
    }
    
    public function deletar_habilitacao() 
    { 
        $fields = [
            'ativo' => 0
        ];       

        flash("success", "habilitação inativada com sucesso.");
        if (!is_null(get('piloto'))) {
            $this->db->update("piloto_acft_tipo",$fields, ['id'=> get('id')]);
            return redirect("chefias/adicionar_carteira_piloto?id=" . get('piloto')); 

        } else if (!is_null(get('mecanico'))) {
            $this->db->update("mecanico_tipo",$fields, ['id'=> get('id')]);
            return redirect("chefias/adicionar_carteira_mecanico?id=" . get('mecanico'));  

        } else if (!is_null(get('comissario'))) {
            $this->db->update("comissario_tipo",$fields, ['id'=> get('id')]);
            return redirect("chefias/adicionar_carteira_comissario?id=" . get('comissario'));   

        }             
    }


    public function deletar_chefias($id) 
    { 
        $fields = [
            status => 'inativo'
        ];       
        $this->db->update("chefias",$fields, ['id'=> $id]);
        return;
    }
    

    public function deletar_pilotos() 
    {     
        $this->deletar_chefias(get('id'));
        flash("success", "chefias (piloto) inativado com sucesso.");
        return redirect("chefias/pilotos"); 
    }


    public function deletar_comissarios() 
    {     
        $this->deletar_chefias(get('id'));
        flash("success", "chefias (comissário) inativado com sucesso.");
        return redirect("chefias/comissarios"); 
    }

    public function deletar_mecanicos() 
    {     
        $this->deletar_chefias(get('id'));
        flash("success", "chefias (mecânico) inativado com sucesso.");
        return redirect("chefias/mecanicos"); 
    }

    public function deletar_motoristas() 
    {     
        $this->deletar_chefias(get('id'));
        flash("success", "chefias (motorista) inativado com sucesso.");
        return redirect("chefias/motoristas"); 
    }

    public function deletar_funcionarios() 
    {     
        $this->deletar_chefias(get('id'));
        flash("success", "chefias (funcionário) inativado com sucesso.");
        return redirect("chefias/funcionarios"); 
    }

    public function editar_chefias() 
    {
        if(is_post()) 
        {
            $this->validateFields(['nome','email']);
           
            if($this->val->isSuccess())
            {

                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                
                $this->db->update("chefias",$fields, ['id'=> get('id')]);
                flash("success", "chefias atualizado com sucesso.");
                return redirect("chefias/chefias"); 
            }
        }

        $chefias = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id'));
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_ADM);
 
        return view("chefias/editar_chefias", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'docTipo' => chefias::TIPO_DOCUMENTO,
        ]);
    }
    
    public function chefias()
    {

        if(is_post()) 
        {
            $this->validateFields(['nome','email','senha']);

            if($this->val->isSuccess())
            {
                $this->db->insert("chefias",copy_post());
                flash("success", "chefias adicionado com sucesso.");
                return redirect("chefias/chefias"); 
            }
        }

        $chefias = $this->db->table(chefias::NAMED_QUERY_SELECT_ALL);

        return view("chefias/chefias", [
            'chefias' => $chefias,
        ]);
    }

    public function funcionarios()
    {

        if(is_post()) 
        {
            $this->validateFields(['nome','email','senha']);

            if(post('senha') != post('senha_confirma')) {
                flash("error", "Houve um erro na confirmação da senha. A senha digitada não confere.");
                return redirect("chefias/funcionarios"); 
            }

            if($this->val->isSuccess())
            {
                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['senha']) {
                    $fields['senha'] = sha1($fields['senha']);
                } 
                unset($fields['senha_confirma']);

                $id = $this->db->insert("chefias",$fields);
                flash("success", "chefias adicionado com sucesso. ID = " . $id);
                return redirect("chefias/funcionarios"); 
            }
        }

        $chefias = $this->db->table(chefias::NAMED_QUERY_SELECT_ALL_FUNCIONARIOS);
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_ADM);        
        
        return view("chefias/funcionarios", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'docTipo' => chefias::TIPO_DOCUMENTO,
        ]);
    }

    public function editar_chefias_motoristas() 
    {
        if(is_post()) 
        {
            $this->validateFields(['nome','email']);
           
            if($this->val->isSuccess())
            {

                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['validade_cnh']) {
                    $fields['validade_cnh'] = data_en($fields['validade_cnh']);
                }

                $this->db->update("chefias",$fields, ['id'=> get('id')]);
                flash("success", "chefias (motorista) atualizado com sucesso.");
                return redirect("chefias/motoristas"); 
            }
        }

        $chefias = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id')); 
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_MOTORISTA);
 

        return view("chefias/editar_chefias_motoristas", [
            'chefias' => $chefias,
            'docTipo' => chefias::TIPO_DOCUMENTO,
            'cargosSelect' => $cargosSelect,
        ]);
    }

    public function motoristas()
    {

        if(is_post()) 
        {
            $this->validateFields(['nome','email','senha']);

            if(post('senha') != post('senha_confirma')) {
                flash("error", "Houve um erro na confirmação da senha. A senha digitada não confere.");
                return redirect("chefias/funcionarios"); 
            }

            if($this->val->isSuccess())
            {
                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['validade_cnh']) {
                    $fields['validade_cnh'] = data_en($fields['validade_cnh']);
                }
                if ($fields['senha']) {
                    $fields['senha'] = sha1($fields['senha']);
                } 
                unset($fields['senha_confirma']);

                $id = $this->db->insert("chefias",$fields);
                flash("success", "chefias (motorista) adicionado com sucesso. ID = " . $id);
                return redirect("chefias/motoristas"); 
            }
        }

        $chefias = $this->db->table(chefias::NAMED_QUERY_SELECT_ALL_MOTORISTAS);
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_MOTORISTA);

        return view("chefias/motoristas", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'docTipo' => chefias::TIPO_DOCUMENTO,
        ]);
    }

    public function editar_chefias_mecanicos() 
    {
        if(is_post()) 
        {
            $this->validateFields(['nome','email']);
           
            if($this->val->isSuccess())
            {

                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['cma_validade']) {
                    $fields['cma_validade'] = data_en($fields['cma_validade']);
                }

                $this->db->update("chefias",$fields, ['id'=> get('id')]);
                flash("success", "chefias (mecânico) atualizado com sucesso.");
                return redirect("chefias/mecanicos"); 
            }
        }

        $chefias = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id')); 
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_MECANICO);
 
        return view("chefias/editar_chefias_mecanicos", [
            'chefias' => $chefias,
            'docTipo' => chefias::TIPO_DOCUMENTO,
            'cmaOpt' => chefias::CMA_OPT,
            'cargosSelect' => $cargosSelect,
        ]);
    }

    public function adicionar_carteira_mecanico() 
    {
        if(is_post()) 
        {
            
            $fields = copy_post(); 
            if ($fields['validade_tipo']) {
                $fields['validade_tipo'] = data_en($fields['validade_tipo']);
            }                        
            $fields['ativo'] = 1;
                           
            $reg = new stdClass;
            $reg->id = $this->db->insert("mecanico_tipo",$fields);      
            //flash("success", "habilitação adicionada com sucesso.");      
            echo json_encode($reg);
            return;
        }

        $habilitacoes = $this->db->table(chefias::NAMED_QUERY_SELECT_HABILITACAO_MECANICO . get('id')); 
        $mecanico = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id'));        
        $tipos = $this->db->table(chefias::NAMED_QUERY_SELECT_MECANICO_CARTEIRA_TIPOS);
        $tiposSelect = array_map(function($tipo){
            $nome = $tipo->id . ' - ' . $tipo->tipo;
            return  ['nome' => $nome, 'value' => $tipo->id];
        }, $tipos);

        return view("chefias/adicionar_carteira_mecanico", [
            'habilitacoes' => $habilitacoes,
            'mecanico' => $mecanico,
            'tipos' => $tiposSelect,
        ]);
    }

    public function mecanicos()
    {

        if(is_post()) 
        {
            $this->validateFields(['nome','email','senha']);
            
            if(post('senha') != post('senha_confirma')) {
                flash("error", "Houve um erro na confirmação da senha. A senha digitada não confere.");
                return redirect("chefias/funcionarios"); 
            }

            if($this->val->isSuccess())
            {
                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['cma_validade']) {
                    $fields['cma_validade'] = data_en($fields['cma_validade']);
                }
                if ($fields['senha']) {
                    $fields['senha'] = sha1($fields['senha']);
                } 
                unset($fields['senha_confirma']);

                $id = $this->db->insert("chefias",$fields);
                flash("success", "chefias (mecânico) adicionado com sucesso. ID = " . $id);
                return redirect("chefias/mecanicos"); 
            }
        }

        $chefias = $this->db->table(chefias::NAMED_QUERY_SELECT_ALL_MECANICOS);
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_MECANICO);

        return view("chefias/mecanicos", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'docTipo' => chefias::TIPO_DOCUMENTO,
            'cmaOpt' => chefias::CMA_OPT,
        ]);
        
    }

    public function editar_chefias_comissarios() 
    {
        if(is_post()) 
        {
            $this->validateFields(['nome','email']);
           
            if($this->val->isSuccess())
            {

                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['cma_validade']) {
                    $fields['cma_validade'] = data_en($fields['cma_validade']);
                }

                $this->db->update("chefias",$fields, ['id'=> get('id')]);
                flash("success", "chefias (comissário) atualizado com sucesso.");
                return redirect("chefias/comissarios"); 
            }
        }

        $chefias = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id')); 
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_COMISSARIO);
 
        return view("chefias/editar_chefias_comissarios", [
            'chefias' => $chefias,
            'docTipo' => chefias::TIPO_DOCUMENTO,
            'cmaOpt' => chefias::CMA_OPT,
            'icaoOpt' => chefias::ICAO_OPT,
            'cargosSelect' => $cargosSelect,
        ]);
    }

    public function adicionar_carteira_comissario() 
    {
        if(is_post()) 
        {
            
            $fields = copy_post(); 
            if ($fields['validade_tipo']) {
                $fields['validade_tipo'] = data_en($fields['validade_tipo']);
            }                        
            $fields['ativo'] = 1;
                           
            $reg = new stdClass;
            $reg->id = $this->db->insert("comissario_tipo",$fields);       
            //flash("success", "habilitação adicionada com sucesso.");          
            echo json_encode($reg);
            return;
        }

        $habilitacoes = $this->db->table(chefias::NAMED_QUERY_SELECT_HABILITACAO_COMISSARIO . get('id')); 
        $comissario = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id')); 

        return view("chefias/adicionar_carteira_comissario", [
            'habilitacoes' => $habilitacoes,
            'comissario' => $comissario
        ]);
    }

    public function comissarios()
    {

        if(is_post()) 
        {
            $this->validateFields(['nome','email','senha']);
            
            if(post('senha') != post('senha_confirma')) {
                flash("error", "Houve um erro na confirmação da senha. A senha digitada não confere.");
                return redirect("chefias/funcionarios"); 
            }

            if($this->val->isSuccess())
            {
                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['cma_validade']) {
                    $fields['cma_validade'] = data_en($fields['cma_validade']);
                }
                if ($fields['senha']) {
                    $fields['senha'] = sha1($fields['senha']);
                } 
                unset($fields['senha_confirma']);

                $id = $this->db->insert("chefias",$fields);
                flash("success", "chefias (comissário) adicionado com sucesso. ID = " . $id);
                return redirect("chefias/comissarios"); 
            }
        }

        $chefias = $this->db->table(chefias::NAMED_QUERY_SELECT_ALL_COMISSARIOS);
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_COMISSARIO);
        

        return view("chefias/comissarios", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'docTipo' => chefias::TIPO_DOCUMENTO,
            'cmaOpt' => chefias::CMA_OPT,
            'icaoOpt' => chefias::ICAO_OPT,
        ]);

    }
    
    public function editar_chefias_pilotos() 
    {
        if(is_post()) 
        {
            $this->validateFields(['nome','email']);
           
            if($this->val->isSuccess())
            {

                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['cma_validade']) {
                    $fields['cma_validade'] = data_en($fields['cma_validade']);
                }
                if ($fields['validade_mono']) {
                    $fields['validade_mono'] = data_en($fields['validade_mono']);
                }
                if ($fields['validade_multi']) {
                    $fields['validade_multi'] = data_en($fields['validade_multi']);
                }
                if ($fields['validade_ifr']) {
                    $fields['validade_ifr'] = data_en($fields['validade_ifr']);
                }
                if ($fields['validade_inva']) {
                    $fields['validade_inva'] = data_en($fields['validade_inva']);
                }

                $this->db->update("chefias",$fields, ['id'=> get('id')]);
                flash("success", "chefias (piloto) atualizado com sucesso.");
                return redirect("chefias/pilotos"); 
            }
        }

        $chefias = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id')); 
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_PILOTO);
         
        return view("chefias/editar_chefias_pilotos", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'docTipo' => chefias::TIPO_DOCUMENTO,
            'cmaOpt' => chefias::CMA_OPT,
            'icaoOpt' => chefias::ICAO_OPT,
        ]);

    }

    public function adicionar_carteira_piloto() 
    {
        if(is_post()) 
        {
            
            $fields = copy_post(); 
            if ($fields['data_validade']) {
                $fields['data_validade'] = data_en($fields['data_validade']);
            }            
            $fields['update_obs'] = "Registro inserido";
            $fields['ativo'] = 1;
                           
            $reg = new stdClass;
            $reg->id = $this->db->insert("piloto_acft_tipo",$fields);       
            //flash("success", "habilitação adicionada com sucesso.");          
            echo json_encode($reg);
            return;
        }

        $habilitacoes = $this->db->table(chefias::NAMED_QUERY_SELECT_HABILITACAO_PILOTO . get('id')); 
        $piloto = $this->db->row(chefias::NAMED_QUERY_SELECT_WITH_ID . get('id')); 

        return view("chefias/adicionar_carteira_piloto", [
            'habilitacoes' => $habilitacoes,
            'piloto' => $piloto
        ]);
    }
    
    public function pilotos()
    {

        if(is_post()) 
        {
            $this->validateFields(['nome','email','senha']);
            
            if(post('senha') != post('senha_confirma')) {
                flash("error", "Houve um erro na confirmação da senha. A senha digitada não confere.");
                return redirect("chefias/funcionarios"); 
            }

            if($this->val->isSuccess())
            {
                $fields = copy_post();
                if ($fields['data_nascimento']) {
                    $fields['data_nascimento'] = data_en($fields['data_nascimento']);
                } 
                if ($fields['cma_validade']) {
                    $fields['cma_validade'] = data_en($fields['cma_validade']);
                }
                if ($fields['validade_mono']) {
                    $fields['validade_mono'] = data_en($fields['validade_mono']);
                }
                if ($fields['validade_multi']) {
                    $fields['validade_multi'] = data_en($fields['validade_multi']);
                }
                if ($fields['validade_ifr']) {
                    $fields['validade_ifr'] = data_en($fields['validade_ifr']);
                }
                if ($fields['validade_inva']) {
                    $fields['validade_inva'] = data_en($fields['validade_inva']);
                }

                if ($fields['senha']) {
                    $fields['senha'] = sha1($fields['senha']);
                } 
                unset($fields['senha_confirma']);

                $id = $this->db->insert("chefias",$fields);
                flash("success", "chefias (piloto) adicionado com sucesso. ID = " . $id);
                return redirect("chefias/pilotos"); 
            }
        }

        $chefias = $this->db->table(chefias::NAMED_QUERY_SELECT_ALL_PILOTOS);        
        $cargosSelect = $this->cargos->listaCargos(cargos::NAMED_QUERY_SELECT_CARGOS_PILOTO);
        
        return view("chefias/pilotos", [
            'chefias' => $chefias,
            'cargosSelect' => $cargosSelect,
            'icaoOpt' => chefias::ICAO_OPT,
            'cmaOpt' => chefias::CMA_OPT,
            'docTipo' => chefias::TIPO_DOCUMENTO,
        ]);

        
    }

    public function index()
    {
        return redirect ('usuarios/login');
    }

    public function validateFields($fieldsName) {

        foreach ($fieldsName as $value) {
            $this->val->name($value)->value(post($value))->required();
        }
       
    }

    public function listaPilotosAtivos() {
        $pilotos = $this->db->table(chefias::NAMED_QUERY_SELECT_PILOTOS_ATIVOS);
        $pilotosSelect = array_map(function($piloto){
            $nome = $piloto->id . ' - ' . $piloto->nome;
            return  ['nome' => $nome, 'value' => $piloto->id];
        }, $pilotos);

        return $pilotosSelect;
    }

    function dashboard()
    {
	
	    view('chefias/dashboard');
    }
    
}
