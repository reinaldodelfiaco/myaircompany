<div id="pdf">

    <header>
        <img src="<?= PUBLIC_URL ?>imagens/logo.png" width="150">

    </header>
    <table>
        <tr>
            <td>Título</td>
        </tr>
        <tr>
            <td>
                <?= $task->titulo ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Descrição</td>
        </tr>
        <tr>
            <td>
                <?= $task->descricao ?>
            </td>
        </tr>
    </table>


    <h5>Informações Gerais</h5>
    <table class="table">
        <tr>
            <td>CÓDIGO</td>
            <td> #<?= $task->id ?> </td>
        </tr>
        <tr>
            <td>STATUS:</td>
            <td><?= retorna_task_status_pdf($task->status) ?></td>
        </tr>
        <tr>
            <td>AUTOR:</td>
            <td><?= retorna_nome_usuario($task->usuario) ?></td>
        </tr>
        <tr>
            <td>ORIGEM:</td>
            <td><?= nome_select('tasks', 'origens', $task->origem) ?></td>
        </tr>
        <tr>
            <td>CLASSIFICAÇÃO:</td>
            <td><?= nome_select('tasks', 'classificacoes', $task->classificacao) ?></td>
        </tr>
        <tr>
            <td>TIPO:</td>
            <td><?= nome_select('tasks', 'tipos', $task->tipo) ?></td>
        </tr>
        <tr>
            <td>DATA DE PREVISÃO:</td>
            <td><?= data_br($task->data_previsao) ?></td>
        </tr>
    </table>
    <h5>Analistas</h5>
    <?php
    table('categorias', ['Nome', 'Analisado?', 'Data'], ['nome_usuario', 'analizado', 'data'], $responsaveis, ([]));
    ?>
    <?php if (!empty($pqs)) { ?>
        <h5>Análise de causa raiz</h5>
        <?php table('categorias', ['Responsável', 'Por que?', 'Resposta?', 'Data'], ['nome_usuario', 'porque', 'resposta', 'data'], $pqs, (adm()) ? ['deletar' => 'tasks/remove_pq?id'] : ''); ?>
    <?php } ?>

    <h5>Resultados</h5>
    <table>
        <tr>
            <td>AÇÃO</td>
            <td>RESOLUÇÃO</td>
            <td>DATA</td>
        </tr>
        <tr>
            <td>Imediata / Bloqueio</td>
            <td><?= $task->acao_imediata ?></td>
            <td><?= $task->data_acao_imediata ?></td>
        </tr>
        <tr>
            <td>Corretiva</td>
            <td><?= $task->acao_corretiva ?></td>
            <td><?= $task->data_acao_corretiva ?></td>

        </tr>
        <tr>
            <td>Resolução</td>
            <td><?= $task->resultado_causa_raiz ?></td>
            <td></td>
        </tr>
    </table>
    <h5>Avaliação de Eficácia</h5>
    <?php

    if ($task->status == 'fechada' && $task->usuario == session('id')) {
        br();
        div('text-center');
        retorna_avaliacao($task->id);
        br();
        br();
        cdiv();
    }

    ?>

    <footer>
        <div style='text-align:center;'>Página <span class="pageCounter"></span>/<span class="totalPages"></span></div>
    </footer>
</div>

<script>
    $(document).ready(function () {
        var codigoHTML = document.querySelector('#pdf');

        var doc = new jsPDF('portrait', 'pt', 'a4'),
            data = new Date();
        margins = {
            top: 10,
            bottom: 60,
            left: 40,
            width: 1000
        };
        doc.fromHTML(codigoHTML,
            margins.left, // x coord
            margins.top, {pagesplit: true},
            function (dispose) {
                doc.save("Task #<?= $task->id ?> - " + data.getDate() + "/" + data.getMonth() + "/" + data.getFullYear() + ".pdf");
            });
        window.location = '<?= BASE ?>tasks';

    });
</script>