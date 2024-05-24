<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

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
            Início
        </div>
    </h1>
</div>

<!-- CARDS -->
<section id="page-start-cards" class="container">
    <!-- Academia -->
    <button class="btn-card btn-overlay">
        <h2>
            <i class="fa-solid fa-building"></i> Academia
        </h2>

        <p>Alterar dados da academia</p>
        <p>Endereço | Horários | Modalidades | Preços</p>
    </button>

    <!-- Overlay do btn 'Academia' -->
    <div class="overlay close-overlay">
        <div class="main-box close-box">
            <h2>Academia</h2>

            <div class="box">
                <button class="btn-close-overlay">
                    <i class="fa-solid fa-angle-left"></i> Voltar
                </button>

                <a href="<?= URL ?>/dashboard/academia">Informações</a>
                <a href="<?= URL ?>/dashboard/modalidades">Modalidades</a>
                <a href="<?= URL ?>/dashboard/precos">Preços</a>
            </div>
        </div>
    </div><!-- Fim div .overlay -->


    <?php if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN): ?>
        <!-- Exercicios -->
        <a class="btn-card" href="<?= URL ?>/dashboard/exercicios">
            <h2>
                <i class="fa-solid fa-dumbbell"></i> Exercícios
            </h2>
            
            <p>Gerenciar exercícios</p>
            <p>Adicionar | Editar | Excluir</p>
        </a>

        <!-- Alunos -->
        <a class="btn-card" href="<?= URL ?>/dashboard/alunos">
            <h2>
                <i class="fa-solid fa-graduation-cap"></i> Alunos
            </h2>
            
            <p>Gerenciar Alunos</p>
            <p>Adicionar | Alterar | Excluir</p>
        </a>
    <?php endif ?>

    <!-- Blog -->
    <a class="btn-card" href="<?= URL ?>/dashboard/blog">
        <h2>
            <i class="fa-solid fa-pen-to-square"></i> Blog
        </h2>
        
        <p>Gerenciar Blog</p>
        <p>Criar | Editar | Excluir</p>
    </a>

    <?php if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN): ?>
        <!-- Email -->
        <a class="btn-card" href="<?= URL ?>/dashboard/email">
            <h2>
                <i class="fa-solid fa-envelope"></i> E-Mail
            </h2>
            
            <p>Gerenciar e-mail</p>
            
            <?php if($emailView > 0): ?>
                <small> Não lidos <span><?= $emailView ?></span></small>
            <?php endif ?>
        </a>

        <!-- Funcionarios -->
        <a class="btn-card" href="<?= URL ?>/dashboard/funcionarios">
            <h2>
                <i class="fa-solid fa-user-tie"></i> Funcionários
            </h2>
            
            <p>Gerenciar funcionários</p>
            <p>Adicionar | Alterar | Excluir</p>
        </a>
    <?php endif ?>

    <!-- Minha Conta -->
    <a class="btn-card" href="<?= URL ?>/dashboard/minhaConta">
        <h2>
            <i class="fa-solid fa-gear"></i> Minha Conta
        </h2>
            
        <p>Alterar meus dados</p>
    </a>
</section>


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/start.js"></script>

<script>
    overlayAcademy()
</script>