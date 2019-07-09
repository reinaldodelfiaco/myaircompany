<div class="row">
    <div class="col-sm-4">
        <div class="portlet portlet-boxed">
            <div class="portlet-body">
                <div class="well text-center">
                    <p><i class="fa fa-file fa-5x text-muted"></i></p>
                    <h5><?= $documento->ext ?></h5>
                    <p><?= $documento->nome ?></p>
                    <a href="<?= $documento->link ?>" target="_blank" class="btn btn-secondary">Baixar documento</a>
                </div>
                <br>
                <h5>INFORMAÇÕES:</h5>
                <div class="list-group">
                    <li class="list-group-item"><strong>AUTOR: </strong>
                        <spam class="pull-right"><?= $documento->autor ?></spam>
                    </li>
                    <li class="list-group-item"><strong>CATEGORIA: </strong>
                        <spam class="pull-right"><?= nome_select('documentos', 'categorias', $documento->categoria) ?></spam>
                    </li>
                    <li class="list-group-item"><strong>DEPARTAMENTO: </strong>
                        <spam class="pull-right"><?= nome_select('empresas', 'departamentos', $documento->departamento) ?></spam>
                    </li>
                    <li class="list-group-item"><strong>DATA A REVISAR: </strong>
                        <spam class="pull-right"> <?= data_br($documento->data_revisao) ?></spam>
                    </li>
                    <li class="list-group-item"><strong>VALIDADE: </strong>
                        <spam class="pull-right"><?= $documento->validade ?> meses</spam>
                    </li>
                    <li class="list-group-item"><strong>DATA DE ENVIO: </strong>
                        <spam class="pull-right"><?= data_br($documento->data_envio) ?></spam>
                    </li>
                    <li class="list-group-item"><strong>EMPRESA: </strong>
                        <spam class="pull-right"><?= $documento->nome_empresa ?></spam>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <div id="faq-questions" class="col-sm-8">
        <div class="portlet portlet-boxed">
            <div class="portlet-body">
                <h5> DESCRIÇÃO DO DOCUMENTO</h5>
                <div class="panel-group accordion-simple">
                    <?= $documento->descricao ?>
                </div>
                <br class="xs-20">

            </div>
        </div>
        <div class="portlet portlet-boxed">
            <div class="portlet-body">
                <h5> AVALIADORES </h5>
                <div class="panel-group accordion-simple">

                    <?= (!$avaliadores) ? '<div class="alert alert-danger">Você precisa adicionar pelo menos um avaliador para confirmar seu documento!</div>' : '' ?>
                    <?php
                    if (adm()) {
                        form_open('documentos/add_avaliador');
                        row();
                        col(6);
                        form_select2('Adicionar avaliador', 'usuario', $usuarios, 'nome');
                        cdiv();
                        col(2);
                        form_checkbox('Revisar?', 'revisado', 1);
                        cdiv();
                        col(2);
                        form_checkbox('Aprovar?', 'aprovado', 1);
                        cdiv();
                        hidden('documento', $documento->id);
                        hidden('cancelado', 0);

                        col(2);
                        submit('Adicionar', 'btn btn-primary', 25);
                        cdiv();
                        cdiv();
                        form_close();

                    }

                    ptable('Avaliação');
                    table('categorias', ['Nome', 'Revisado?', 'Aprovado?'], ['nome_usuario', 'revisado', 'aprovado'], $avaliadores, (adm()) ? ['deletar' => 'documentos/remove_avaliador?id'] : '');
                    cpanel();
                    ?>
                </div>
            </div>
        </div>

        <div class="portlet portlet-boxed">
            <div class="portlet-body">
                <h5> DEPARTAMENTOS COM PERMISSÕES </h5>
                <div class="panel-group accordion-simple">
                </div>
                <?= (!$departamentos_liberados) ? '<div class="alert alert-danger">Este documento ainda não está liberado para nenhum departamento!</div>' : '' ?>
                <?php
                if (adm()) {
                    form_open('documentos/add_departamento');
                    row();
                    col(10);
                    form_select2('Liberar departamento', 'departamento', $departamentos, 'nome');
                    hidden('documento', $documento->id);
                    hidden('autorizado', 1);
                    hidden('cancelado', 0);
                    cdiv();
                    col(2);
                    submit('Adicionar', 'btn btn-primary', 25);
                    cdiv();
                    cdiv();
                    form_close();
                }

                ptable('PERMISSÕES');
                    table('categorias', ['Departamento', 'Autorizado'], ['nome_departamento', 'autorizado'], $departamentos_liberados, (adm()) ? ['deletar' => 'documentos/remove_departamento?id'] : '');
                    cpanel();
                ?>
            </div>
        </div>
    </div>
