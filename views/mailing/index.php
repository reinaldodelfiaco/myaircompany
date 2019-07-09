<?php

modal_link('Adicionar', 'add');

br();

ptable('Mailings');
datatable('mailings', ['Titulo'], ['titulo'], $mailings, ['editar' => 'mailing/editar?id']);
cpanel();

omodal('Mailing', 'add', 'modal-lg');
form_open('mailing');
hidden('empresa', session('empresa'));
form_text_input('Título', 'titulo', 'required');
form_textarea('Texto', 'texto', 'required');
submit('Salvar', 'btn btn-primary');
form_close();
cmodal();

?>


<script>
    var config = {
        images: {
            upload: {
                url: '<?= BASE ?>cms/uploads',
                basePath: '<?= BASE ?>uploads'
            }
        }
    };

    var editor = textboxio.replace('#texto', config);
    $('#ephox_texto').css('height', '400px');
</script>

