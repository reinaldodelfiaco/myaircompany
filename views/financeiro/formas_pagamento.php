<?php
modal_link('Adicionar','add');

br();

ptable('Espécies');

datatable('formas_pagamento', ['Nome'], ['nome'], $formas_pagamento, ['editar' => 'financeiro/editar_formas_pagamento?id']);

cpanel();

omodal('Adicionar espécie','add');
form_open('financeiro/formas_pagamento');
form_text_input('Nome','nome','required');
hidden('empresa', session('empresa'));
submit('Salvar','btn btn-primary');
form_close();
cmodal();