<div class="row">
    <div class="col-sm-4">
        <div class="portlet portlet-boxed">
            <div class="portlet-body"  style="padding: 14px;">
                <div class="well text-center">
                    <p><i class="fa fa-file fa-5x text-muted"></i></p>
                    <h5>CÓDIGO: #<?= $task->id ?></h5>
                    <p><?= retorna_task_status($task->status) ?></p>
                    <?php if($upload && file_exists($upload->path)) { ?>
                        <a href="<?= $upload->link ?>" target="_blank" class="btn btn-secondary">Baixar Anexo</a>
                    <?php } ?>
                </div>
                <?php
                if ($task->status != 'fechada' && responsavel($task->id, session('id'))) {
                    echo "<a class='btn btn-primary btn-sm btn-block' href='" . BASE . "tasks/encerrar?id=" . $task->id . "'> ENCERRAR TAREFA </a> ";
                }
                if ($task->status == 'fechada' && $task->usuario == session('id')) {
                    echo "<a class='btn btn-danger btn-sm btn-block' href='" . BASE . "tasks/reabrir?id=" . $task->id . "'> REABRIR TAREFA </a> ";
                    echo '<hr><h5>AVALIAÇÃO DE EFICÁCIA:</h5>';
                    br();
                    div('text-center');
                    retorna_avaliacao($task->id);
                    cdiv();
                }
                ?>
                <br><br>
                <h5>INFORMAÇÕES:</h5>
                <div class="list-group">
                    <li class="list-group-item"><strong>AUTOR: </strong>
                        <span class="pull-right"><?= retorna_nome_usuario($task->usuario) ?></span>
                    </li>
                    <li class="list-group-item"><strong>ORIGEM: </strong>
                        <span class="pull-right"><?= nome_select('tasks', 'origens', $task->origem) ?></span>
                    </li>
                    <li class="list-group-item"><strong>CLASSIFICAÇÃO: </strong>
                        <span class="pull-right"><?= nome_select('tasks', 'classificacoes', $task->classificacao) ?></span>
                    </li>
                    <li class="list-group-item"><strong>TIPO: </strong>
                        <span class="pull-right"><?= nome_select('tasks', 'tipos', $task->tipo) ?></span>
                    </li>
                    <li class="list-group-item"><strong>DATA DE PREVISÃO: </strong>
                        <span class="pull-right"> <?= data_br($task->data_previsao) ?></span>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <div id="faq-questions" class="col-sm-8">
        <div class="portlet portlet-boxed">
            <div class="portlet-body"  style="padding: 14px;">
                <h5> <?= $task->titulo ?></h5>
                <div class="panel-group accordion-simple">
                    <?= $task->descricao ?>
                </div>
                <br class="xs-20">

            </div>
        </div>
        <div class="portlet portlet-boxed">
            <div class="portlet-body"  style="padding: 14px;">
                <h5> AVALIADORES </h5>
                <div class="panel-group accordion-simple">
                    <?= (!$responsaveis) ? '<div class="alert alert-danger">Você precisa adicionar pelo menos um avaliador para confirmar sua task!</div>' : '' ?>
                    <?php
                    form_open('tasks/add_avaliador?id=' . get('id'));
                    row();
                    col(10);
                    form_select2('Adicionar avaliador', 'usuario', $usuarios, 'nome');
                    hidden('task', $task->id);
                    hidden('analizado', 0);
                    cdiv();
                    col(2);
                    submit('Adicionar', 'btn btn-primary', 25);
                    cdiv();
                    cdiv();
                    form_close();
                    ptable('Responsáveis');
                    table('categorias', ['Nome', 'Analisado?', 'Data'], ['nome_usuario', 'analizado', 'data'], $responsaveis, (adm()) ? ['deletar' => 'tasks/remove_responsavel?id'] : '');
                    cpanel();
                    ?>
                </div>
            </div>
        </div>

        <div class="portlet portlet-boxed">
            <div class="portlet-body"  style="padding: 14px;">
                <h5> ANÁLISE DE CAUSA RAÍZ (PARA TRATAMENTO DE NÃO CONFORMIDADE)</h5>
                <div class="panel-group accordion-simple">
                    <?php
                    modal_link('ADICIONAR ANÁLISE', 'add_analise');


                    if (!empty($pqs)) {
                        br();
                        ptable('ANÁLISE DOS 5 PORQUÊS (PARA TRATAMENTO DE NÃO CONFORMIDADE)');
                        table('categorias', ['Responsável', 'Por que?', 'Resposta?', 'Data'], ['nome_usuario', 'porque', 'resposta', 'data'], $pqs,['deletar' => 'tasks/remove_pq?id']);
                        cpanel();
                    }
                    ?>
                    <hr>
                    <?php
                    form_open('tasks/detalhes?id=' . get('id'));
                    row();
                    col(8);
                    form_text_input('Ação imediata ou bloqueio', 'acao_imediata', '', '', '', $task->acao_imediata);
                    cdiv();
                    col(4);
                    form_text_input('Data', 'data_acao_imediata', '', '', '', $task->data_acao_imediata);
                    cdiv();
                    cdiv();
                    row();
                    col(8);
                    form_text_input('Ação corretiva', 'acao_corretiva', '', '', '', $task->acao_corretiva);
                    cdiv();
                    col(4);
                    form_text_input('Data', 'data_acao_corretiva', '', '', '', $task->data_acao_corretiva);
                    cdiv();
                    cdiv();
                    row();
                    col(12);
                    form_textarea('RESULTADO DA CAUSA RAIZ - RESOLUÇÃO DO PROBLEMA', 'resultado_causa_raiz', '', '', '', $task->resultado_causa_raiz);
                    cdiv();
                    cdiv();
                    submit('ATUALIZAR', 'btn btn-primary', 25);
                    form_close();
                    ?>
                </div>
            </div>
        </div>
        <?php
        omodal('ADICIONAR ANÁLISE DE CAUSA RAIZ', 'add_analise', 'modal-lg');
        form_open('tasks/add_pq?id=' . get('id'));
        row();
        col(12);
        form_text_input('Por que?', 'porque', 'required');
        cdiv();
        col(12);
        form_text_input('Resposta', 'resposta', 'required');
        cdiv();
        col(2);
        submit('Adicionar', 'btn btn-primary', 25);
        cdiv();
        hidden('task', $task->id);
        hidden('usuario', session('id'));
        cdiv();
        form_close();
        cmodal();

        ?>
        <script>
            $('#data_acao_corretiva').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            $('#data_acao_imediata').datepicker({
                autoclose: true,
                todayHighlight: true
            })
        </script>
