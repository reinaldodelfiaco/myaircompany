<?php
    //DASHBOARDS PERSONALIZADOS

    function voos_diarios()
    {
        $db = new db();
        $data = date("Y-m-d");
        $voos = $db->table("SELECT * FROM voos WHERE data = '$data' ORDER BY hora_partida");

        ptable('Voos do dia');
            table('voos_diarios', ['Origem', 'Destino', 'Hora'], ['origem', 'destino', 'hora_partida'], $voos, []);
        cpanel();
    }


    



