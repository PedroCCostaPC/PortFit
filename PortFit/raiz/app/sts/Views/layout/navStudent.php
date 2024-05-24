<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<div id="main-nav" class="open">
    <!-- BTN OPEN -->
    <button class="btn-open"><i class="fa-solid fa-angle-right"></i></button>

    
    <nav id="nav-dashboard">
        <div class="profile">
            <?php if($_SESSION['student']['photo']): ?>
                <div class="my-photo" style="background-image: url(<?= URL ?>/assets/img/students/<?= $_SESSION['student']['photo'] ?>);"></div>
            <?php else: ?>
                <div class="my-photo" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
            <?php endif ?>
    
            <h2><?= $_SESSION['student']['first_name'] ?> <?= $_SESSION['student']['last_name'] ?></h2>
            <small><?= $_SESSION['student']['position'] ?></small>
        </div>
    
        <ul class="menu">
            <!-- Inicio / Treino -->
            <li>
                <a href="<?= URL ?>/aluno">
                    <i class="fa-solid fa-dumbbell"></i> Treino
                </a>
            </li>

            <!-- Alimentacao -->
            <li>
                <a href="<?= URL ?>/aluno/alimentacao">
                    <i class="fa-solid fa-utensils"></i> Alimentação
                </a>
            </li>

            <!-- Suplementacao -->
            <li>
                <a href="<?= URL ?>/aluno/suplementacao">
                    <i class="fa-solid fa-spoon"></i> Suplementação
                </a>
            </li>

            <!-- Evolucao -->
            <li>
                <a href="<?= URL ?>/aluno/evolucao">
                    <i class="fa-solid fa-arrow-trend-up"></i> Evolução
                </a>
            </li>

            <!-- Avaliacoes -->
            <li>
                <a href="<?= URL ?>/aluno/avaliacoes">
                    <i class="fa-solid fa-stethoscope"></i> Avaliações
                </a>
            </li>

            <!-- Minha conta -->
            <li>
                <a href="<?= URL ?>/aluno/minhaConta">
                    <i class="fa-solid fa-gear"></i> Minha Conta
                </a>
            </li>
        </ul>
    
    </nav>
</div><!-- Fim div #main-nav -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard.js"></script>

<script>
    openNavDash()
</script>