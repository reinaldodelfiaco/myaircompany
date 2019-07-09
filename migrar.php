<?php
    require('functions/db_antigo.php');
    require('functions/db_online.php');

    function pre($pre)
    {
        echo "<pre>";
        print_r($pre);
        echo "</pre>";
    }


    $dbo = new dbo;
    $dba =  new dba;



    $d = $dba->table("SELECT nome as nome_fantasia, email, fone_a as telefone FROM fornecedores GROUP BY nome");

    

    foreach($d as $a)
    {   
        $data = get_object_vars($a);
        $data += ['tipop' => 'Jurídica'];
        $data += ['empresa' => '1'];
        $data += ['fornecedor' => '1'];
        $dbo->insert('crm_empresas', $data);
        echo  " CLIENTE  " . $a->nome_fantasia . " IMPORTADO(A) \n";
    }
