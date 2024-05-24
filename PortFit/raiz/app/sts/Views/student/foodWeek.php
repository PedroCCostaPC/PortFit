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
            Alimentação da <span>semana</span>
        </div>
    </h1>
</div>

<div id="main-student-food-week" class="container">
    <!-- NAV DIA / SEMANA -->
    <nav>
        <a href="<?= URL ?>/aluno/alimentacao">Hoje</a>
        <a class="page" href="<?= URL ?>/aluno/alimentacao/semana">Semana</a>
    </nav>

    <section>
        <?php foreach($this->data['food'] as $week): ?>
            <article>
                <button class="card <?= $week['class'] ?>">
                    <?= $week['day'] ?>

                    <?php if($week['class']): ?>
                        <p>Livre</p>
                    <?php endif ?>
                </button>

                <?php if(!$week['class']): ?>
                    <div class="overlay-food close-overlay">
                        <div class="box-food close-box">
                            <button class="btn-close"><i class="fa-solid fa-angle-left"></i> Fechar</button>

                            <?php foreach($week['food'] as $food): ?>
                                <div class="row">
                                    <div class="time">
                                        <h4>Horário</h4>
                                        <p><?= $food['time'] ?></p>
                                    </div>

                                    <div class="food">
                                        <h4>Refeição</h4>
                                        <p><?= $food['food'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div><!-- Fim div .overlay-food -->
                <?php endif ?>
            </article>
        <?php endforeach ?>
    </section>
</div><!-- Fim div #main-student-food-week -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/student/food.js"></script>

<script>
    openFood()
</script>