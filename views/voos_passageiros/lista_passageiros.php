<?php

    br();
    ptable('voos_passageiros');
    datatable('voos_passageiros', ['Voo', 'Nome', 'Sobrenome', 'Telefone', 'Documento', 'Tipo Documento', 'Número Documento'], ['id_voo', 'nome_passageiro', 'sobrenome_passageiro', 'telefone_passageiro', 'tipo_documento_passageiro', 'documento_passageiro']);
    cpanel();

?>