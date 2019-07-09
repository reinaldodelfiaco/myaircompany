<?php
    
    
    class api {

        public const API_URL_AVIATION_EDGE = "https://aviation-edge.com/v2/public";
        public const API_URL_AISWEB = "http://www.aisweb.aer.mil.br/api";
        public const API_URL_REDEMET = "http://www.redemet.aer.mil.br/api";

        public function index()
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://aviation-edge.com/v2/public/airportDatabase?key=dc7c9b-c9934e&codeIcao=SBPA",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            echo $response;

            curl_close($curl);
        }



        /*
            Procura informacoes de um aerodromo de uma cidade pelo nome da cidade
        */
        public function av_edge_autocomplete() {            
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_AVIATION_EDGE . "/cityDatabase?key=dc7c9b-c9934e&city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            echo $response;

            curl_close($curl);
        }

        /**
         * Este serviço retorna a lista dos aeródromos cadastrados no ROTAER com base nos parâmetros especificados.
         * 
         */
        public function aisweb_rotaer() {

            $curl = curl_init();

            $city = "";
            if (get('city') != null) {
                $city = "&" . get('city');
            }

            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_AISWEB . "/?apiKey=1214781644&apiPass=f8ac8a81-6b76-11e9-9f40-00505680c1b4&area=rotaer&type=AD&rowend=5000" . $city,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            header('Content-type: application/xml');
            $response = curl_exec($curl);
            $err = curl_error($curl);
            echo $response;

            curl_close($curl);
        }

        /**
         * Este serviço retorna a lista dos aeródromos cadastrados no ROTAER com base nos parâmetros especificados.
         * 
         */
        public function aisweb_routesp() {

            $curl = curl_init();

            $adep = "";
            $ades = "";
            if (get('adep') != null) {
                $adep = trim("&adep=" . get('adep'));
            }
            if (get('ades') != null) {
                $ades = trim("&ades=" . get('ades'));
            }

            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_AISWEB . "/?apiKey=1214781644&apiPass=f8ac8a81-6b76-11e9-9f40-00505680c1b4&area=routesp" . $adep .  $ades,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            header('Content-type: application/xml');
            $response = curl_exec($curl);
            $err = curl_error($curl);
            echo $response;

            curl_close($curl);
        }

        /**
         * Este serviço retorna os dados os NOTAM de acordo com a localidade desejada.
         * 
         */
        public function aisweb_notam() {
            $icao = get("icao");
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_AISWEB . "/?apiKey=1214781644&apiPass=f8ac8a81-6b76-11e9-9f40-00505680c1b4&area=notam&icaocode=" . $icao,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            header('Content-type: application/xml');
            $response = curl_exec($curl);
            $err = curl_error($curl);

            echo $response;

            curl_close($curl);
        }

        /**
         * Este serviço retorna as informações de nascer e pôr do sol para a localidade informada.
         */
        function aisweb_sol() {
            $icao = get("icao");
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_AISWEB . "/?apiKey=1214781644&apiPass=f8ac8a81-6b76-11e9-9f40-00505680c1b4&area=sol&icaoCode=" . $icao,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            header('Content-type: application/xml');
            $response = curl_exec($curl);
            $err = curl_error($curl);

            echo $response;

            curl_close($curl);
        }

        function aisweb_cartas() {
            $icao = get("icao");
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_AISWEB . "/?apiKey=1214781644&apiPass=f8ac8a81-6b76-11e9-9f40-00505680c1b4&area=cartas&icaoCode=" . $icao,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            header('Content-type: application/xml');
            $response = curl_exec($curl);
            $err = curl_error($curl);

            echo $response;

            curl_close($curl);
        }


        public function redemet_meteor() {
            $dataPesquisa = get("dataPesquisa");
            $icao = get("icao");
            $curl = curl_init();

            //mensagem METAR
            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_REDEMET . "/consulta_automatica/index.php?local=" . trim($icao[0]) . "&msg=metar&data_ini=" . $dataPesquisa . "&data_fim=". $dataPesquisa ,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $curl = curl_init();

            //mensagem TAF
            curl_setopt_array($curl, array(
            CURLOPT_URL => api::API_URL_REDEMET . "/consulta_automatica/index.php?local=" . trim($icao[0]) . "&msg=taf&data_ini=". $dataPesquisa . "&data_fim=". $dataPesquisa,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));

            $response = $response . " %% " . curl_exec($curl);
            $err = curl_error($curl);

            echo $response;
            curl_close($curl);
        }


        
    }
