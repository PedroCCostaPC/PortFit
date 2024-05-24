<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navStudent.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav-dashboard .menu li:nth-child(2) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(2) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Minha <span>alimentação</span>
        </div>
    </h1>
</div>

<?php if(!$this->data['exist']): ?>
    <!-- Caso aluno nao possua alimentacao montada -->
    <div id="not-food">
        <h2 class="title">
            <div>Não possuo <span>alimentação</span>!</div>
        </h2>
    </div>
<?php else: ?>
    <!-- Caso aluno possua alimentacao montada -->
    <div id="main-student-food" class="container">
        <!-- NAV DIA / SEMANA -->
        <nav>
            <a class="page" href="<?= URL ?>/aluno/alimentacao">Hoje</a>
            <a href="<?= URL ?>/aluno/alimentacao/semana">Semana</a>
        </nav>

        <section>
            <?php if(!$this->data['food']): ?>
            <!-- Caso NAO tenha suplementacao no dia -->
                <div class="free-food">
                    <i class="fa-solid fa-burger"></i>

                    <h2>UHUUU Hoje é livre! <i class="fa-solid fa-face-laugh-wink"></i></h2>
                </div>
            <?php else: ?>
            <!-- Caso TENHA suplementacao no dia -->
                <?php foreach($this->data['food'] as $food): ?>
                    <article class="<?= $food['class'] ?>">
                        <h2><?= $food['time'] ?></h2>
                        <p><?= $food['food'] ?></p>
                    </article>
                <?php endforeach ?>
            <?php endif ?>
        </section>
    </div><!-- Fim div #main-student-food -->
<?php endif ?>
