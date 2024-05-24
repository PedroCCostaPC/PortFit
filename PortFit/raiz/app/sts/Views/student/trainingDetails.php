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
            <?= $this->data['name'] ?>
        </div>
    </h1>
</div>

<div id="main-student-training-details" class="container">
    <!-- BTN Voltar -->
    <a href="<?= URL ?>/aluno/treino?day=<?= $this->data['day'] ?>&category=<?= $this->data['exCategory_id'] ?>" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>


    <!-- Treino -->
    <section>
        <!-- Banner -->
        <img src="<?= URL ?>/assets/img/exercises/<?= $this->data['banner'] ?>">

        <!-- Series e Repeticoes -->
        <div class="series-repetitions">
            <div>
                <small>Séries</small>
                <p><?= $this->data['series'] ?><span>x</span></p>
            </div>

            <div>
                <small>Repetições</small>
                <p>
                    <?= $this->data['min'] ?> <span>a</span> <?= $this->data['max'] ?>
                </p>
            </div>
        </div>

        <?php if($this->data['description']): ?>
            <!-- Descricao -->
            <div class="description">
                <h2>Descrição</h2>
    
                <p><?= $this->data['description'] ?></p>
            </div>
        <?php endif ?>


        <!-- Video -->
        <!-- Caso seja youtube -->
        <?php if($this->data['external']): ?>
            <div class="video-youtube">
                <?= $this->data['video'] ?>
            </div>

        <!-- Caso seja local -->
        <?php else: ?>
            <?php if($this->data["video"]): ?>
                <video class="video" controls>
                    <source src="<?= URL ?>/assets/video/exercises/<?= $this->data["video"] ?>" type="video/mp4">
                </video>
            <?php endif ?>
        <?php endif ?>
    </section>
</div><!-- Fim div #main-student-training-details -->
