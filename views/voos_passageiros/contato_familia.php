<?php

    br();
    ptable('voos_passageiros');
    datatable('voos_passageiros', ['Voo', 'Nome', 'Sobrenome', 'Contato Emergência', 'Numero de Contato'], ['id_voo', 'nome_passageiro', 'sobrenome_passageiro', 'nome_contato_emergencia', 'numero_contato_emergencia']);
    cpanel();

?>