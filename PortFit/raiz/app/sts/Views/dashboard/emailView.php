<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(6) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(6) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            E-Mail
        </div>
    </h1>
</div>

<div id="main-dash-email-views" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/email" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>
    </div>

    <section>
        <!-- DADOS DO REMETENTE -->
        <div id="sender">
            <div class="col">
                <p class="name"><?= $this->data['name'] ?></p>
                <p><?= $this->data['email'] ?></p>
            </div>
    
            <div class="col">
                <p><?= $this->data['date'] ?> - <?= $this->data['time'] ?></p>
            </div>
        </div>

        <!-- EMAIL -->
        <div id="email">
            <p>
                <?php if($this->data['ddd']): ?>
                    <strong>Telefone:</strong> (<?= $this->data['ddd'] ?>) <?= $this->data['phone'] ?>
                <?php else: ?>
                    <strong>Telefone:</strong> Não informado
                <?php endif ?>
            </p>

            <p>
                <strong>Aluno:</strong> <?= $this->data['student'] ?>
            </p>

            <p>
                <strong>Mensagem:</strong> <?= $this->data['message'] ?>
            </p>
        </div>
    </section>
</div><!-- Fim div #main-dash-email-views -->
