<?php


opanel('Mailing', 'add', 'modal-lg');
form_open('mailing/editar?id='. get('id'));
hidden('empresa', session('empresa'));
form_text_input('Título', 'titulo', 'required','','', $mailing->titulo);
form_textarea('Texto', 'texto', 'required','','', $mailing->texto);
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

