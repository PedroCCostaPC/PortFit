<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 3) . '/Controllers/AllPages/Email.php'); ?>

<div id="main-nav" class="open">
    <!-- BTN OPEN -->
    <button class="btn-open"><i class="fa-solid fa-angle-right"></i></button>

    
    <nav id="nav-dashboard">
        <div class="profile">
            <?php if($_SESSION['employee']['photo']): ?>
                <div class="my-photo" style="background-image: url(<?= URL ?>/assets/img/employees/<?= $_SESSION['employee']['photo'] ?>);"></div>
            <?php else: ?>
                <div class="my-photo" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
            <?php endif ?>
    
            <h2><?= $_SESSION['employee']['first_name'] ?> <?= $_SESSION['employee']['last_name'] ?></h2>
            <small><?= $_SESSION['employee']['position'] ?></small>
        </div>
    
        <ul class="menu">
            <!-- Inicio -->
            <li>
                <a href="<?= URL ?>/dashboard">
                    <i class="fa-solid fa-house"></i> Início
                </a>
            </li>
    
            <!-- Academia -->
            <li>
                <a href="<?= URL ?>/dashboard/academia">
                    <i class="fa-solid fa-building"></i> Academia
                </a>
            </li>
    
            <?php if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN): ?>
                <!-- Exercicio -->
                <li>
                    <a href="<?= URL ?>/dashboard/exercicios">
                        <i class="fa-solid fa-dumbbell"></i> Exercícios
                    </a>
                </li>
        
                <!-- Alunos -->
                <li>
                    <a href="<?= URL ?>/dashboard/alunos">
                        <i class="fa-solid fa-graduation-cap"></i> Alunos
                    </a>
                </li>
            <?php endif ?>
    
            <!-- Blog -->
            <li>
                <a href="<?= URL ?>/dashboard/blog">
                    <i class="fa-solid fa-pen-to-square"></i> Blog
                </a>
            </li>
    
            <?php if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN): ?>
                <!-- Email -->
                <li>
                    <a href="<?= URL ?>/dashboard/email">
                        <i class="fa-solid fa-envelope"></i> E-Mail 
                        <?php if($emailView > 0): ?>
                            <span><?= $emailView ?></span>
                        <?php endif ?>
                    </a>
                </li>
        
                <!-- Funcionarios -->
                <li>
                    <a href="<?= URL ?>/dashboard/funcionarios">
                        <i class="fa-solid fa-user-tie"></i> Funcionários
                    </a>
                </li>
            <?php endif ?>
    
            <!-- Minha conta -->
            <li>
                <a href="<?= URL ?>/dashboard/minhaConta">
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