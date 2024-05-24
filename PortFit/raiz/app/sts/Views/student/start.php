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
            Meu <span>treino</span>
        </div>
    </h1>
</div>

<!-- CARDS -->
<?php if(!isset($this->data['training'])): ?>
    <div id="not-training-cards">
        <h2 class="title">
            <div>Não possuo <span>treino</span>!</div>
        </h2>
    </div>

<?php else: ?>
    <section id="page-start-cards" class="container">
        <?php foreach($this->data['training'] as $training): ?>
            <article>
                <!-- Dia da semana -->
                <button class="btn-card btn-overlay <?= $training['class'] ?>">
                    <h2>
                        <?= $training['week'] ?>
                    </h2>
        
                    <div class="p">
                        <?php for($i = 0; $i < count($training['category']); $i++): ?>
                            <p><?= $training['category'][$i] ?> <span>|</span></p>
                        <?php endfor ?>
                    </div>
                </button>
        
                <!-- Overlay -->
                <div class="overlay close-overlay overlay-training-students-start">
                    <div class="main-box close-box">
                        <h2><?= $training['week'] ?></h2>
        
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <div class="over-btns">
                                <?php for($i = 0; $i < count($training['category']); $i++): ?>
                                    <a href="<?= URL ?>/aluno/treino?day=<?= $training['day'] ?>&category=<?= $training['category_id'][$i] ?>">
                                        <?= $training['category'][$i] ?>
                                    </a>
                                <?php endfor ?>
                            </div>
                        </div>
                    </div>
                </div><!-- Fim div .overlay -->
            </article>
        <?php endforeach ?>
    </section>
<?php endif ?>

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/student/training.js"></script>

<script>
    overlayTraining()
</script>