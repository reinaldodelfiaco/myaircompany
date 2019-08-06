<?php 
include_once('./class/aeronaves.php');
include_once('./class/chefias.php');
include_once('./model/PlanoVoo.class.php');

class voos { 
    
    public $val;
    public $db; 
    public $aeronaves;
    public $pilotos;

    public const NAMED_QUERY_SELECT_ALL_PLANOS = "SELECT  plano_voo.id_voo, plano_voo.id, CONCAT(aeronaves.numero, ' - ', aeronaves.modelo) AS nome_aeronave, plano_voo.aerodromo_partida,
                                                plano_voo.aerodromo_destino, plano_voo.pessoas_bordo
                                                FROM plano_voo INNER JOIN aeronaves ON plano_voo.id_aeronave = aeronaves.id ORDER BY plano_voo.id";

    public const NAMED_QUERY_SELECT_VOO_BY_ID = "SELECT * FROM voos WHERE id = ";
    public const NAMED_QUERY_SELECT_PLANO_VOO_BY_ID = "SELECT * FROM plano_voo WHERE id = ";
    

    public const ACAO_EDITAR = 'editar';
    public const ACAO_INSERIR = 'inserir';

    public const REGRA_VOO_OPTS = [              
        ['nome' => 'V - VFR', 'value' => 'V'],
        ['nome' => 'I - IFR', 'value' => 'I'],
        ['nome' => 'Z - VFR/IGR', 'value' => 'Z'],
        ['nome' => 'Y - IFR/VFR', 'value' => 'Y'],
    ];

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
        $this->aeronaves = new aeronaves();
        $this->pilotos = new chefias();
    }

    public function deletar_voos() 
    {
        $this->db->delete("voos", [id=> get('id')]);
        flash("success", "voos removido com sucesso.");
        return redirect("voos/voos"); 
    }

    public function editar_voos() 
    {
        if(is_post()) 
        {
            $this->val->name('aeronave')->value(post('aeronave'))->required();
            $this->val->name('lugares')->value(post('lugares'))->required();
            $this->val->name('origem')->value(post('origem'))->required();
            $this->val->name('destino')->value(post('destino'))->required();
            $this->val->name('data')->value(post('data'))->required();
            $this->val->name('hora_partida')->value(post('hora_partida'))->required();
            $this->val->name('hora_chegada')->value(post('hora_chegada'))->required();
 
            if($this->val->isSuccess())
            {
                $this->db->update("voos",copy_post(), ['id'=> get('id')]);
                flash("success", "voos atualizado com sucesso.");
                return redirect("voos/voos"); 
            }
        }

        $voos = $this->db->row("SELECT * FROM voos WHERE id = " . get('id')); 
        $aeronaves = $this->db->table("SELECT * FROM aeronaves");

        return view("voos/editar_voos", [
            'voos' => $voos,
            'aeronaves' => $aeronaves,
        ]);
    }
    
    public function voos()
    {
        if(is_post()) 
        {
            $this->val->name('aeronave')->value(post('aeronave'))->required();
            $this->val->name('lugares')->value(post('lugares'))->required();
            $this->val->name('origem')->value(post('origem'))->required();
            $this->val->name('destino')->value(post('destino'))->required();
            $this->val->name('data')->value(post('data'))->required();
            $this->val->name('hora_partida')->value(post('hora_partida'))->required();
            $this->val->name('hora_chegada')->value(post('hora_chegada'))->required();
 
            if($this->val->isSuccess())
            {   
                
                $fields = copy_post();

                
                $id = $this->db->insert("voos",$fields);
                $this->db->update("voos", ['lugares_disponiveis' => post('lugares'), ['id' => $id]]);



                if ($id) {
                    flash("success", "voos adicionado com sucesso.");
                } else {
                    flash("error", "não foi possível adicionar o registro.");
                }
                return redirect("voos/voos"); 
            }
        }

        $voos = $this->db->table("SELECT voos.*, aeronaves.matricula FROM voos LEFT JOIN aeronaves ON voos.aeronave = aeronaves.id");
        $aeronaves = $this->db->table("SELECT * FROM aeronaves");

        return view("voos/voos", [
            'voos' => $voos,
            'aeronaves' => $aeronaves,
        ]);
    }

    

    public function flight_schedule()
    {	    

            $aeronaves = $this->db->table("SELECT * FROM aeronaves");
            $values = "";
            foreach($aeronaves as $a) 
            {       
                $voos = $this->db->table("SELECT * FROM voos WHERE aeronave = $a->id AND data = '" . date("Y-m-d") . "'");
                foreach($voos as $v) {
                    $ano = date("Y", strtotime($v->data));
                    $mes = date("m", strtotime($v->data));
                    $dia = date("d", strtotime($v->data));
                    $horai = date("H", strtotime($v->hora_partida));
                    $horac = date("H", strtotime($v->hora_chegada));
                    $mini = date("i", strtotime($v->hora_partida));
                    $minc = date("i", strtotime($v->hora_chegada));

                    $info = '' . substr($v->origem, 0,4) . ':  ' . $v->hora_partida . '  |   ' . substr($v->destino, 0,4) . ': ' . $v->hora_chegada;

                    $values .= "['".$a->matricula."', '".$info."', new Date(".$ano.",".$mes.",".$dia.",".$horai.",".$mini.",0),  new Date(".$ano.",".$mes.",".$dia.",".$horac.",".$minc.",0) ],";
                }
            }
            view('voos/flight_schedule', [
                'values' => $values
            ]);

    }

    public function plano_de_voo()
    {	
        if(is_post()) 
        {
            $fields = copy_post();

            //controla se acao e de inserção ou edição de registro
            $acaoFormulario = $fields['acao'];
            $idPlanoVoo = array_key_exists('id_plano_voo', $fields) ?  $fields['id_plano_voo'] : '';

            $notamSelecionadas = [];
            $cartasSelecionadas = [];

            if (array_key_exists('notam_selecionadas', $fields)) {
                $notamSelecionadas = json_decode($fields['notam_selecionadas']);
                unset($fields['notam_selecionadas']);
            }

            if (array_key_exists('cartas_selecionadas', $fields)) {
                $cartasSelecionadas = json_decode($fields['cartas_selecionadas']);
                unset($fields['cartas_selecionadas']);
            }

            //remove o nome da aeronave
            $fields['id_aeronave'] = intval(trim(explode("-",$fields['id_aeronave'])[0]));

            //remove os campos hidden
            unset($fields['hora_partida_calculada']);
            unset($fields['hr_calculada']);
            unset($fields['opt_partida']);
            unset($fields['origem_voo']);
            unset($fields['destino_voo']);
            unset($fields['data_voo']);
            unset($fields['partida_voo']);
            unset($fields['chegada_voo']);
            unset($fields['numero']);
            unset($fields['tipo_aeronave']);
            unset($fields['acao']);
            unset($fields['id_plano_voo']);
         
            $msg_metar_partida =  "";
            if (array_key_exists('met1_msg_metar', $fields)) {
                $msg_metar_partida = $fields['met1_msg_metar'];
                $msg_taf_partida = $fields['met1_msg_taf'];
                unset($fields['met1_msg_metar']);
                unset($fields['met1_msg_taf']);
            }

            $msg_metar_destino = "";
            if (array_key_exists('met2_msg_metar', $fields)) {
                $msg_metar_destino = $fields['met2_msg_metar'];
                $msg_taf_destino = $fields['met2_msg_taf'];
                unset($fields['met2_msg_metar']);
                unset($fields['met2_msg_taf']);
            }

            $tab1_nsprSol_info = "";
            if (array_key_exists('tabNsPrSol1_msg', $fields)) {
                $tab1_nsprSol_info = explode("#", $fields['tabNsPrSol1_msg']) ;
                unset($fields['tabNsPrSol1_msg']);
            }

            $tab2_nsprSol_info = "";
            if (array_key_exists('tabNsPrSol2_msg', $fields)) {
                $tab2_nsprSol_info = explode("#", $fields['tabNsPrSol2_msg']) ;           
                unset($fields['tabNsPrSol2_msg']);
            }

            if ($acaoFormulario === voos::ACAO_INSERIR ) {
                $id = $this->db->insert("plano_voo",$fields);
            } else {
                $id = $this->db->update("plano_voo",$fields, ['id'=> $idPlanoVoo]);
            }

            if ($id) {

                if ($acaoFormulario === voos::ACAO_INSERIR ) {
                    $idPlanoVoo = $id;
                } 
                
                $idsNotam = [];
                foreach ($notamSelecionadas as $notam ) {
                    $idsNotam[] = [ "cod_notam" => $notam->cod, "icao" => $notam->loc, "id_plano_voo" => intval($idPlanoVoo) ];
                }

                if (count($notamSelecionadas) > 0 && $acaoFormulario === voos::ACAO_EDITAR) 
                    $this->db->delete("plano_voo_notam",  ['id_plano_voo'=> $idPlanoVoo]);                

                if (count($idsNotam) > 0)
                    $this->db->insert_multiple("plano_voo_notam",$idsNotam);

                $idsCartas = [];
                foreach ($cartasSelecionadas as $carta ) {
                    $idsCartas[] = [ "nome_carta" => $carta->nome, "icao" => $carta->IcaoCode, "id_plano_voo" => intval($idPlanoVoo) ];
                }

                if (count($cartasSelecionadas) > 0 && $acaoFormulario === voos::ACAO_EDITAR) 
                    $this->db->delete("plano_voo_cartas",  ['id_plano_voo'=> $idPlanoVoo]);                

                if (count($idsCartas) > 0)
                    $this->db->insert_multiple("plano_voo_cartas",$idsCartas);


                $meteorologiaInfo = [];
                if ($msg_metar_partida != "" )                    
                    $meteorologiaInfo[] = [ "msg_metar" => $msg_metar_partida, "msg_taf" => $msg_taf_partida, "icao" =>  trim(explode("-", $fields['aerodromo_partida'])[0]) , "id_plano_voo" => intval($idPlanoVoo) ];
                
                if ($msg_metar_destino != "" ) 
                    $meteorologiaInfo[] = [ "msg_metar" => $msg_metar_destino, "msg_taf" => $msg_taf_destino, "icao" =>  trim(explode("-", $fields['aerodromo_destino'])[0]) , "id_plano_voo" => intval($idPlanoVoo) ];
                
                if (($msg_metar_partida != "" ||  $msg_metar_destino != "") && $acaoFormulario === voos::ACAO_EDITAR) 
                    $this->db->delete("plano_voo_meteorologia",  ['id_plano_voo'=> $idPlanoVoo]);                

                if (count($meteorologiaInfo) > 0)
                    $this->db->insert_multiple("plano_voo_meteorologia",$meteorologiaInfo);


                $tabNsPorSol = [];
                if (is_array($tab1_nsprSol_info))
                    $tabNsPorSol[] = [ "data" => $tab1_nsprSol_info[0], "sunrise" => $tab1_nsprSol_info[1], "sunset" => $tab1_nsprSol_info[2], "icao" =>  trim(explode("-", $fields['aerodromo_partida'])[0]) , "id_plano_voo" => intval($idPlanoVoo) ];
                
                if (is_array($tab2_nsprSol_info))
                    $tabNsPorSol[] = [ "data" => $tab2_nsprSol_info[0], "sunrise" => $tab2_nsprSol_info[1], "sunset" => $tab2_nsprSol_info[2], "icao" =>  trim(explode("-", $fields['aerodromo_destino'])[0]) , "id_plano_voo" => intval($idPlanoVoo) ];
                 
                if (count($tabNsPorSol) > 0 && $acaoFormulario === voos::ACAO_EDITAR) 
                    $this->db->delete("plano_voo_nascer_por_sol",  ['id_plano_voo'=> $idPlanoVoo]);                

                if (count($tabNsPorSol) > 0)
                    $this->db->insert_multiple("plano_voo_nascer_por_sol",$tabNsPorSol);
            }

            if ($id) {
                flash("success", "plano de voo cadastrado com sucesso.");
            }  else {
                flash("error", "Não foi possível realizar o cadastro.");
            }
            return redirect("voos/plano_de_voo"); 

        }

        $voo = null;

        $aeronave =  null;
        if (get('id') != "") {
            $idVoo = get('id');
            $voo =  $this->db->row(voos::NAMED_QUERY_SELECT_VOO_BY_ID . $idVoo);
            $aeronave = $this->db->row("select * from aeronaves where id=$voo->aeronave");
        }



        $plano = new PlanoVoo();
        $planos = $this->db->table(voos::NAMED_QUERY_SELECT_ALL_PLANOS);
        $pilotos = $this->pilotos->listaPilotosAtivos();
        
        return view("voos/plano_de_voo", [
            'aeronave' => $aeronave,
            'planos' => $planos,
            'pilotos' => $pilotos,
            'regraVooOpts' => voos::REGRA_VOO_OPTS,
            'vooSelected' => $voo,
            'planoVooSelected' => $plano,
            'acao' => 'inserir',
        ]);

    }

    function editar_plano_voo() {

        $plano_voo = null;
        if (get('id') != "") {
            $plano_voo = get('id');
            $plano =  $this->db->row(voos::NAMED_QUERY_SELECT_PLANO_VOO_BY_ID . $plano_voo);
            $voo =  $this->db->row(voos::NAMED_QUERY_SELECT_VOO_BY_ID . $plano->id_voo);
        }

        $planos = $this->db->table(voos::NAMED_QUERY_SELECT_ALL_PLANOS);
        $pilotos = $this->pilotos->listaPilotosAtivos();
                
        return view("voos/plano_de_voo", [
            'planos' => $planos,
            'pilotos' => $pilotos,
            'regraVooOpts' => voos::REGRA_VOO_OPTS,
            'vooSelected' => $voo,
            'planoVooSelected' => $plano,
            'acao' => 'editar',
        ]);

    }

    function deletar_plano_voo() {

        if (get('id') != "") {   
            $this->db->delete("plano_voo_notam",  ['id_plano_voo'=> get('id')]);        
            $this->db->delete("plano_voo_cartas",  ['id_plano_voo'=> get('id')]); 
            $this->db->delete("plano_voo_meteorologia",  ['id_plano_voo'=> get('id')]);  
            $this->db->delete("plano_voo_nascer_por_sol",  ['id_plano_voo'=> get('id')]); 
            $this->db->delete("plano_voo",  ['id'=> get('id')]);       
            
            flash("success", "plano de voo deletado com sucesso.");
        }

        $plano = new PlanoVoo();
        $voo = null;
        $planos = $this->db->table(voos::NAMED_QUERY_SELECT_ALL_PLANOS);
        $pilotos = $this->pilotos->listaPilotosAtivos();
        
        return view("voos/plano_de_voo", [
            'planos' => $planos,
            'pilotos' => $pilotos,
            'regraVooOpts' => voos::REGRA_VOO_OPTS,
            'vooSelected' => $voo,
            'planoVooSelected' => $plano,
            'acao' => 'inserir',
        ]);
    }

    public function total_assentos()
    {
        $response = array(
            'valid' => false,
            'message' => 'Lugares é obrigatório.'
        );

        if (!empty($_POST['lugares'])) {

            $aeronave = $this->db->row('SELECT * FROM aeronaves WHERE id= ' . get('aeronave'));

            if ($aeronave->passageiros_max < post('lugares')) {
                $response = array('valid' => false, 'message' => 'Capacidade da aeronave não permitida.');
            } else {
                $response = array('valid' => true);
            }
        }

        echo json_encode($response);
    }
    
}