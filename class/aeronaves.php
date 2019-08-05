<?php 

class aeronaves { 
    
    public $val;
    public $db; 

    public const NAMED_QUERY_SELECT_ALL = "SELECT * FROM aeronaves";
    public const NAMED_QUERY_SELECT_BY_ID = "SELECT * FROM aeronaves WHERE id = ";

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }

    public function deletar_aeronaves() 
    {
        $this->db->delete("aeronaves", [id=> get('id')]);
        flash("success", "aeronaves removido com sucesso.");
        return redirect("aeronaves/aeronaves"); 
    }
    

    public function editar_aeronaves() 
    {
        if(is_post()) 
        {

            if($this->val->isSuccess())
            {
                $this->db->update("aeronaves",copy_post(), ['id'=> get('id')]);
                $this->db->update('aeronaves',[
                    'extintor' => data_en(post('extintor')),
                    'seguro' => data_en(post('seguro')),
                    'certificado_aeronavegabilidade' => data_en(post('certificado_aeronavegabilidade')),
                    'certificado_matricula' => data_en(post('certificado_matricula')),
                    'inspecao_anual_manutencao' => data_en(post('inspecao_anual_manutencao')),
                    'estacao_radio' => data_en(post('estacao_radio')),
                ], ['id'=> get('id')]);
                flash("success", "aeronaves atualizado com sucesso.");
                return redirect("aeronaves/aeronaves"); 
            }
        }

        $aeronaves = $this->db->row("SELECT * FROM aeronaves WHERE id = " . get('id')); 

        return view("aeronaves/editar_aeronaves", [
            'aeronaves' => $aeronaves,
            'modelos' => $this->db->table("SELECT * FROM modelos_aeronaves")
        ]);
    }
    
    public function aeronaves()
    {
        if(is_post()) 
        {
            if($this->val->isSuccess())
            {
                $id = $this->db->insert("aeronaves",copy_post());
                $this->db->update('aeronaves',[
                    'extintor' => data_en(post('extintor')),
                    'seguro' => data_en(post('seguro')),
                    'certificado_aeronavegabilidade' => data_en(post('certificado_aeronavegabilidade')),
                    'certificado_matricula' => data_en(post('certificado_matricula')),
                    'inspecao_anual_manutencao' => data_en(post('inspecao_anual_manutencao')),
                    'estacao_radio' => data_en(post('estacao_radio')),
                ], ['id' => $id]);

                flash("success", "aeronaves adicionado com sucesso.");
                return redirect("aeronaves/aeronaves"); 
            }
        }

        $aeronaves = $this->db->table("SELECT * FROM aeronaves");

        return view("aeronaves/aeronaves", [
            'aeronaves' => $aeronaves,
            'modelos' => $this->db->table("SELECT * FROM modelos_aeronaves")
        ]);
    }


    public function listaAeronaves() {
        $aeronaves = $this->db->table(aeronaves::NAMED_QUERY_SELECT_ALL);
        $aeronavesSelect = array_map(function($aeronave){
            $nome = $aeronave->id . ' - Nr ' . $aeronave->numero . ' / Modelo ' . $aeronave->modelo;
            return  ['nome' => $nome, 'value' => $aeronave->id];
        }, $aeronaves);

        return $aeronavesSelect;
    }

    public function recupera_dados_aeronave() {
        $idAeronave = get('id');
        $aeronave = $this->db->row(aeronaves::NAMED_QUERY_SELECT_BY_ID . $idAeronave );

        echo json_encode($aeronave);
        return;
    }


    public function check_aeronave_lugares()
    {
        $response = array(
            'valid' => false,
            'message' => 'Lugares disponíveis obrigatório.'
        );

        if (!empty($_POST['aeronave'])) {
           
            $user = $this->db->row('SELECT * FROM aeronaves WHERE id="' . $_POST['aeronave'] . '"');

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
    
}
