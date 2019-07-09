<?php

opanel('Cadastro de modelo de Contrato');
form_open('crm/cadastrar_modelo_contrato');
hidden('empresa', session('empresa'));
form_text_input('Título', 'titulo', 'required');
form_textarea('Contrato', 'texto', 'required','','documento');
p('#razao_social - #nome_fantasia - #contato - #email - #telefone');
submit('SALVAR', 'btn btn-success');
form_close();
cpanel();

?>

<script type="text/javascript">
    var editor = textboxio.replace('#texto');
    $('#ephox_texto').css('height', '300px');
</script>

