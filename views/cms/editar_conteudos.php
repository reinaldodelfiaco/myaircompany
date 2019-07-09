<?php
    opanel('Editar conteúdo');
        form_open('cms/editar_conteudo?id=' . get('id'));

        $tipos = [['nome' => 'Página', 'value' => 'pagina'], ['nome' => 'Serviço', 'value' => 'servico']];
        $status = [['nome' => 'Ativo', 'value' => 'ativo'], ['nome' => 'Inativo', 'value' => 'Inativo']];

        row();
            col(4);
            form_select2_data('Tipo', 'tipo', $tipos, $conteudo->tipo);
            cdiv();
            col(8);
            form_text_input('Título', 'titulo', 'required', 'cms/valida_slug', '', $conteudo->titulo);
            cdiv();
        cdiv();
        form_select2_multiple('Categorias', 'categorias', $categorias, 'nome', $cat);
        form_textarea('Texto', 'texto', 'required', '', '', $conteudo->texto);

        row();
            col(4);
                form_select2_data('Status', 'tipo', $status, $conteudo->status);
            cdiv();
            col(4);
                form_text_input('Data de exibição', 'data_exibicao', 'required', '', '', data_br($conteudo->data_exibicao));
            cdiv();
            col(4);
             form_text_input('Tags', 'tags', 'required', '', '', $conteudo->tags);
            cdiv();
        cdiv();

        form_textarea('Meta', 'meta', '', '', '', $conteudo->meta);

        form_textarea('Resumo', 'resumo', 'required', '', '', $conteudo->resumo);

        submit('Salvar', 'btn btn-primary');

        form_close();
    cpanel();
?>

<script type="text/javascript">
    var config = {
        images: {
            upload: {
                url: '<?= BASE ?>cms/uploads',
                basePath: '<?= BASE ?>uploads'
            }
        }
    };

    var editor = textboxio.replace('#texto', config);
    $('#ephox_texto').css('height', '300px');
    $('#data_exibicao').datepicker({
        autoclose: true,
        todayHighlight: true
    });
</script>


