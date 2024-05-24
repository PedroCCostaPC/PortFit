<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(<?= $this->data['user-position'] ?>) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(<?= $this->data['user-position'] ?>) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Comentários (<span><?= $this->data['commentCount'] ?></span>)
        </div>
    </h1>
</div>

<div id="main-dash-blog-comment" class="container">
    <!-- BTN Voltar -->
    <a href="<?= URL ?>/dashboard/blog" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>

    <!-- Titulo -->
    <h1 class="title">
        <div>
            <?= $this->data['blog']['title'] ?>
        </div>
    </h1>

    <!-- Banner -->
    <div class="banner">
        <img src="<?= URL ?>/assets/img/blog/<?= $this->data['blog']['banner'] ?>">
    </div>

    <!-- COMENTARIOS -->
    <section>
        <?php foreach($this->data['comments'] as $comment): ?>
            <article>
                <div class="information">
                    <div class="sender">
                        <!-- Nome -->
                        <h2><?= $comment['name'] ?></h2>

                        <!-- Data -->
                        <small><?= $comment['date'] ?></small>

                        <!-- Email -->
                        <p><?= $comment['email'] ?></p>
                    </div>

                    <!-- Botoes -->
                    <div class="btns-standard-alter">
                        <!-- Apagar -->
                        <button class="btn-standard btn-delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="comment">
                    <p>
                        <?= $comment['comment'] ?>
                    </p>
                </div>

                <!-- Overlay de EXLUIR comentario -->
                <div class="overlay overlay close-overlay">
                    <div class="main-box close-box">
                        <h2>Deseja excluir comentário?</h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="<?= URL ?>/dashboard/blog/comentarios?key=<?= $_GET['key'] ?>" method="POST">
                                <input type="hidden" name="delete-comment">
                                <input type="hidden" name="id" value="<?= $comment['id'] ?>">
    
                                <div class="mini-box">
                                    <!-- Post -->
                                    <h3>Tem ceteza que deseja excluir esse comentário?</h3>
                                    <p>Ao <span>excluir</span>, não será mais possível recuperar o comentário!</p>

                                </div><!-- Fim div .mini-box -->
    
                                <button class="btn-standard-form">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div><!-- Fim div .overlay-delete -->
            </article>
        <?php endforeach ?>
    </section>
</div><!-- Fim div ##main-dash-blog-comment -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/blog.js"></script>

<script>
    deleteComment()
</script>