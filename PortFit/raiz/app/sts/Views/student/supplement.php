<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navStudent.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav-dashboard .menu li:nth-child(3) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(3) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Minha <span>suplementação</span>
        </div>
    </h1>
</div>

<?php if(!$this->data['exist']): ?>
    <!-- Caso aluno nao possua suplementacao montada -->
    <div id="not-food">
        <h2 class="title">
            <div>Não possuo <span>suplementação</span>!</div>
        </h2>
    </div>
<?php else: ?>
    <!-- Caso aluno possua suplementacao montada -->
    <div id="main-student-food" class="container">
        <!-- NAV DIA / SEMANA -->
        <nav>
            <a class="page" href="<?= URL ?>/aluno/suplementacao">Hoje</a>
            <a href="<?= URL ?>/aluno/suplementacao/semana">Semana</a>
        </nav>
        
        <section>
            <?php if(!$this->data['supplement']): ?>
            <!-- Caso NAO tenha suplementacao no dia -->
                <div class="free-supplement">
                    <h2 class="title">
                        <div>Hoje não possuo <span>suplementação</span>!</div>
                    </h2>
                </div>
            <?php else: ?>
            <!-- Caso TENHA suplementacao no dia -->
                <?php foreach($this->data['supplement'] as $supplement): ?>
                    <article class="<?= $supplement['class'] ?>">
                        <h2><?= $supplement['time'] ?></h2>
                        <p><?= $supplement['supplement'] ?></p>
                    </article>
                <?php endforeach ?>
            <?php endif ?>
        </section>
    </div><!-- Fim div #main-student-food -->
<?php endif ?>
