<?php

    opanel('ALTERAR VÍNCULO DO PRODUTO');
    form_open('ordens/vincular?id='.get('id').'&p='.get('p').'&c='.get('c'));
    form_select2('SELECIONE O PRODUTO DA VINCULAÇÃO', 'produto', $produtos,'nome');
    form_checkbox('Exluir produto anterior', 'exluir', 1);
    br();
    submit('ENVIAR', 'btn btn-success');
    form_close();
    cpanel();   