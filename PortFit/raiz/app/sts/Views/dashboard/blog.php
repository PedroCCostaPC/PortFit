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
            Blog
        </div>
    </h1>
</div>

<div id="main-dash-blog" class="container">
    <nav class="add-and-category">
        <!-- BTN ADD -->
        <a href="<?= URL ?>/dashboard/blog/adicionar" class="btn-standard-add">
            + Nova postagem
        </a>
    
        <!-- BTN CATEGORIAS -->
        <button class="btn-open-category">Categorias</button>
    </nav>

    <!-- /////////////////////////// CATEGORIAS /////////////////////////// -->
    <section id="categories" class="close">
        <button class="btn-close-overlay">
            Fechar
        </button>

        <div>
            <?php foreach($this->data['categories'] as $category): ?>
                <article>
                    <form action="#" method="POST">
                        <input type="hidden" name="update-category">
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
    
                        <input type="text" name="name" value="<?= $category['name'] ?>">
                        <button class="update">Alterar</button>
                    </form>
    
                    <?php if(!$category['using']): ?>
                        <form id="form-delete" action="#" method="POST">
                            <input type="hidden" name="delete-category">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
    
                            <button class="btn-standard btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    <?php endif ?>
                    <br><br>
                </article>
            <?php endforeach ?>
        </div>
    </section>

    <!-- /////////////////////////// BLOG /////////////////////////// -->
    <!-- Busca e filtros -->
    <div class="search-filter">
        <form action="<?= URL ?>/dashboard/blog" method="GET">
            <input type="text" name="search" placeholder="Buscar publicação">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <nav class="filter open">
            <button class="btn-open-filter">Filtrar <i class="fa-solid fa-chevron-up"></i></button>

            <ul>
                <!-- A-Z -->
                <li>
                    <a href="<?= URL ?>/dashboard/blog?filter=A-Z">A-Z</a>
                </li>
                <!-- Z-A -->
                <li>
                    <a href="<?= URL ?>/dashboard/blog?filter=Z-A">Z-A</a>
                </li>
                <!-- Ativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/blog?filter=active">Ativos</a>
                </li>
                <!-- Inativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/blog?filter=inactive">Inativos</a>
                </li>
                <!-- Limpar filtros -->
                <li>
                    <a href="<?= URL ?>/dashboard/blog">Limpar</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Resultado da busca -->
    <?php if(isset($this->data['count-search'])): ?>
        <div class="result-search">
            <p>Voce pesquisou por: <span><?= $_GET['search'] ?></span></p>
            <p><?= $this->data['count-search'] ?> resultados</p>
        </div>

        <!-- Caso nada encontrado -->
        <?php if($this->data['count-search'] === 0): ?>
            <h1 class="title title-search-result">
                <div>
                    Não encontramos nenhum resultado na sua busca!
                </div>
            </h1>
        <?php endif ?>
    <?php endif ?>


    <!-- LISTA DOS POSTS -->
    <section id="posts">
        <!-- Paginacao -->
        <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>

        <?php foreach($this->data['blog'] as $blog): ?>
            <article>
                <div class="article <?= $blog['class-situation'] ?>">
                    <!-- Banner / titulo / comentarios / data -->
                    <div class="banner-title-date">
                        <div class="banner" style="background-image: url(<?= URL ?>/assets/img/blog/<?= $blog['banner'] ?>);"></div>

                        <div class="title-date">
                            <h2><?= $blog['title'] ?></h2>

                            <p class="comments">Comentários: <b><?= $blog['comment'] ?></b></p>

                            <?php if($blog['situation']): ?>
                                <p class="published">Publicado - <span><?= $blog['published'] ?></span></p>
                            <?php else: ?>
                                <p class="published">Rascunho - <span><?= $blog['published'] ?></span></p>
                            <?php endif ?>
                        </div>
                    </div>

                    <!-- Autor / botoes -->
                    <div class="author-btns">
                        <!-- Autor -->
                        <div class="author">
                            <small><?= $blog['author'] ?></small>
                            <?php if($blog['photo']): ?>
                                <figure style="background-image: url(<?= URL ?>/assets/img/employees/<?= $blog['photo'] ?>);"></figure>
                            <?php else: ?>
                                <figure style="background-image: url(<?= URL ?>/assets/img/user.png);"></figure>
                            <?php endif ?>
                        </div>

                        <!-- Botoes -->
                        <div class="btns">
                            <!-- Rascunho -->
                            <form action="#" method="POST">
                                <input type="hidden" name="situation-blog">
                                <input type="hidden" name="id" value="<?= $blog['id'] ?>">
                                <button class="btn btn-sketch"><i class="fa-solid fa-paperclip"></i></button>
                            </form>

                            <!-- Email -->
                            <?php if($blog['send_email'] && $blog['situation']): ?>
                                <button class="btn btn-email">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            <?php endif ?>                            

                            <!-- Visualizar -->
                            <a class="btn btn-view" target="_blank" href="<?= URL ?>/blog/post?key=<?= $blog['id'] ?>">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <!-- Comentario -->
                            <a class="btn btn-comment" href="<?= URL ?>/dashboard/blog/comentarios?key=<?= $blog['id'] ?>">
                                <i class="fa-solid fa-comment"></i>
                            </a>

                            <!-- Alterar -->
                            <a class="btn btn-alter" href="<?= URL ?>/dashboard/blog/alterar?key=<?= $blog['id'] ?>">
                                <i class="fa-solid fa-pencil"></i>
                            </a>

                            <!-- Excluir -->
                            <button class="btn btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div><!-- Fim div .article -->

                <!-- Overlay de EXLUIR post -->
                <div class="overlay overlay-delete close-overlay">
                    <div class="main-box close-box">
                        <h2>Deseja excluir publicação?</h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="#" method="POST">
                                <input type="hidden" name="delete-blog">
                                <input type="hidden" name="id" value="<?= $blog['id'] ?>">
    
                                <div class="mini-box">
                                    <!-- Post -->
                                    <h3><?= $blog['title'] ?></h3>

                                    <!-- Banner -->
                                    <img src="<?= URL ?>/assets/img/blog/<?= $blog['banner'] ?>">
                                </div><!-- Fim div .mini-box -->
    
                                <button class="btn-standard-form">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div><!-- Fim div .overlay-delete -->

                <!-- Overlay de DISPARAR EMAIL -->
                <?php if($blog['send_email']): ?>
                    <div class="overlay overlay-send-email close-overlay">
                    <!-- <div class="overlay overlay-send-email"> -->
                        <div class="main-box close-box">
                        <!-- <div class="main-box"> -->
                            <h2>Deseja disparar e-mails?</h2>
                    
                            <div class="box">
                                <button class="btn-close-overlay">
                                    <i class="fa-solid fa-angle-left"></i> Voltar
                                </button>
        
                                <form action="#" method="POST">
                                    <input type="hidden" name="shoot-email">
                                    <input type="hidden" name="id" value="<?= $blog['id'] ?>">
        
                                    <div class="mini-box">
                                        <!-- Post -->
                                        <h3><?= $blog['title'] ?></h3>

                                        <!-- Banner -->
                                        <img src="<?= URL ?>/assets/img/blog/<?= $blog['banner'] ?>">

                                        <!-- Informacao -->
                                        <p>Isso irá disparar emais para os alunos sobre esse post!</p>
                                    </div><!-- Fim div .mini-box -->
        
                                    <button class="btn-standard-form">Disparar</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- Fim div .overlay-send-email -->
                <?php endif ?>
            </article>
        <?php endforeach ?>

        <!-- Paginacao -->
        <div class="pagenation-bottom">
            <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>
        </div>
    </section>
</div><!-- Fim div #main-dash-blog -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/blog.js"></script>

<script>
    boxFilter('#main-dash-blog .search-filter .filter')
    openCategories()
    deleteBlog()
    shootBlog()
</script>