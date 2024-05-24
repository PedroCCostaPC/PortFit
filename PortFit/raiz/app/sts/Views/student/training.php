<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navStudent.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav-dashboard .menu li:first-child a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:first-child a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Meu treino <span><?= $this->data['day'] ?></span>
        </div>
    </h1>
</div>

<div id="main-student-training" class="container">
    <!-- BTN Voltar -->
    <a href="<?= URL ?>/aluno" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>

    <!-- Categoria -->
    <div id="category">
        <?php foreach($this->data['category'] as $category): ?>
            <a class="category <?= $category['class'] ?>" href="<?= URL ?>/aluno/treino?day=<?= $_GET['day'] ?>&category=<?= $category['id'] ?>">
                <?= $category['name'] ?>
            </a>
        <?php endforeach ?>
    </div>

    <!-- Exercicios -->
    <section>
        <?php foreach($this->data['training'] as $training): ?>
            <article>
                <div class="banner" style="background-image: url(<?= URL ?>/assets/img/exercises/<?= $training['banner'] ?>);"></div>
                
                <div class="box">
                    <h2><?= $training['name'] ?></h2>

                    <div class="series-repetitions">
                        <div>
                            <small>Séries</small>
                            <p><?= $training['series'] ?><span>x</span></p>
                        </div>

                        <div>
                            <small>Repetições</small>
                            <p>
                                <?= $training['min'] ?> <span>a</span> <?= $training['max'] ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="link">
                    <a href="<?= URL ?>/aluno/treino/detalhes?training=<?= $training['training_id'] ?>">
                        Ver detalhes
                    </a>
                </div>
            </article>
        <?php endforeach ?>
    </section>
</div><!-- Fim div #main-student-training -->
