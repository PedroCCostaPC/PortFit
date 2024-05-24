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

<div id="main-dash-email" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <div class="count-email-unread">
            <p>Não lidos</p>

            <small><?= $this->data['email-unread'] ?></small>
        </div>

        <!-- FILTRO -->
        <nav class="filter open">
            <button class="btn-open-filter"><?= $this->data['text-filter'] ?> <i class="fa-solid fa-chevron-up"></i></button>

            <ul>
                <li>
                    <a href="<?= URL ?>/dashboard/email?filter=unread">Não lidos (<?= $this->data['email-unread'] ?>)</a>
                </li>

                <li>
                    <a href="<?= URL ?>/dashboard/email?filter=read">Lidos (<?= $this->data['email-read'] ?>)</a>
                </li>

                <li>
                    <a href="<?= URL ?>/dashboard/email">Limpar</a>
                </li>
            </ul>
        </nav>
    </div>


    <!-- LISTA DOS EMAILS -->
    <section>
        <div class="title-emails">

            <div class="not-btn">
                <!-- Nome -->
                <div class="name">
                    <h2>Nome</h2>
                </div>
    
                <!-- E-Mail -->
                <div class="email">
                    <h2>E-Mail</h2>
                </div>
    
                <!-- Data -->
                <div class="date">
                    <h2>Recebido</h2>
                </div>
            </div>

            <!-- BTNS -->
            <div class="btns"></div>
        </div>

        <?php foreach($this->data['email'] as $email): ?>
            <article>
                <div class="article">
                    <div class="article-box <?= $email['class-view'] ?>">

                        <a href="<?= URL ?>/dashboard/email/visualizar?key=<?= $email['id'] ?>">
                            <!-- Nome -->
                            <div class="name">
                                <p><?= $email['name'] ?></p>
                            </div>
        
                            <!-- E-Mail -->
                            <div class="email">
                                <p><?= $email['email'] ?></p>
                            </div>
        
                            <!-- Data -->
                            <div class="date">
                                <p><?= $email['date'] ?></p>
                            </div>
                        </a>
        
                        <!-- BTNS -->
                        <div class="btns">
                            <!-- Lido / Nao lido -->
                            <form class="form-read" action="#" method="POST">
                                <input type="hidden" name="view-email">
                                <input type="hidden" name="id" value="<?= $email['id'] ?>">
                                <input type="hidden" name="view" value="<?= $email['view'] ?>">
        
                                <?php if($email['view']): ?>
                                    <button>
                                        <i class="fa-solid fa-envelope-open"></i>
                                    </button>
                                <?php else: ?>
                                    <button>
                                        <i class="fa-solid fa-envelope"></i>
                                    </button>
                                <?php endif ?>
                            </form>
        
                            <!-- Deletar -->
                            <button class="btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div><!-- Fim div .article-box -->
                </div><!-- Fim div .article -->

                <!-- Overlay de EXLUIR post -->
                <div class="overlay overlay close-overlay">
                    <div class="main-box close-box">
                        <h2>Deseja excluir email?</h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="#" method="POST">
                                <input type="hidden" name="delete-email">
                                <input type="hidden" name="id" value="<?= $email['id'] ?>">
    
                                <div class="mini-box">
                                    <!-- Post -->
                                    <h3>Tem ceteza que deseja excluir esse email?</h3>
                                    <p>Ao <span>excluir</span>, não será mais possível recuperar o email!</p>

                                </div><!-- Fim div .mini-box -->
    
                                <button class="btn-standard-form">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div><!-- Fim div .overlay -->
            </article>
        <?php endforeach ?>
    </section>

    <!-- PAGINACAO -->
    <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>
</div><!-- Fim div #main-dash-email -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/email.js"></script>

<script>
    boxFilter('#main-dash-email #nav-top .filter')
    deleteEmail()
</script>