    <?php
        opanel('Adicionar novo conteúdo');
        form_open('cms/adicionar_conteudo');
        $tipos = [['nome' => 'Página', 'value' => 'pagina'], ['nome' => 'Serviço', 'value' => 'servico']];
        $status = [['nome' => 'Ativo', 'value' => 'ativo'], ['nome' => 'Inativo', 'value' => 'Inativo']];
        hidden('autor', session('id'));
        hidden('empresa', session('empresa'));
        row();
            col(4);
            form_select2_data('Tipo', 'tipo', $tipos);
            cdiv();
            col(8);
            form_text_input('Título','titulo', 'server', 'cms/valida_slug' );
            cdiv();
        cdiv();
        form_select2_multiple('Categorias', 'categorias', $categorias, 'nome');
        form_textarea('Texto', 'texto', 'required');
        row();
            col(4);
            form_select2_data('Status', 'status', $status);
            cdiv();
            col(4);
            form_text_input('Data de exibição', 'data_exibicao', 'required');
            cdiv();
            col(4);
            form_text_input('Tags', 'tags', 'required');
            cdiv();
        cdiv();
        form_textarea('Meta', 'meta', '');
        form_textarea('Resumo', 'resumo', 'required');

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
        })
    </script>


