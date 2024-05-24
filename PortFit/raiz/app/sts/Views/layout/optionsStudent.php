<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<nav class="filter open">
    <button class="btn-open-filter">Opções <i class="fa-solid fa-chevron-up"></i></button>

    <ul>
        <li>
            <a href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>">Treino</a>
        </li>

        <li>
            <a href="<?= URL ?>/dashboard/alunos/alimentacao?student=<?= $_GET['student'] ?>">Alimentação</a>
        </li>

        <li>
            <a href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>">Suplementação</a>
        </li>

        <li>
            <a href="<?= URL ?>/dashboard/alunos/avaliacoes?student=<?= $_GET['student'] ?>">Avaliações</a>
        </li>

        <li>
            <a href="<?= URL ?>/dashboard/alunos/avaliacao/adicionar?student=<?= $_GET['student'] ?>">+ Avaliação</a>
        </li>
    </ul>
</nav>