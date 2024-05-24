<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav nav ul li:nth-child(4) a {
        color: <?= SECONDARY_COLOR ?>;
    }
</style>

<section id="blog-title" class="container">
    <h1 class="title">
        <div>
            Blog <span><?= ACADEMY ?></span>
        </div>
    </h1>
</section>

<!-- ///////////////////// SLIDE ///////////////////// -->
<?php if(isset($this->data['slide'])): ?>
    <section id="slide-blog" class="container">
        <ul>
            <?php foreach($this->data['slide'] as $slide): ?>
                <li style="background-image: url(<?= URL ?>/assets/img/blog/<?= $slide['banner'] ?>);">
                    <div class="box">
                        <h2>
                            <a href="<?= URL ?>/blog/post?key=<?= $slide['id'] ?>">
                                <?= $slide['title'] ?>
                            </a>
                        </h2>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </section>
<?php endif ?>


<!-- ///////////////////// POSTS ///////////////////// -->
<div id="main-blog" class="container">
    <section>
        <!-- Caso tenha busca por pesquisa -->
        <?php if(isset($_GET['search'])): ?>
            <div class="search">
                <p>Você pesquisou por: <strong><?= $_GET['search'] ?></strong></p>
                <p class="count-result"><?= $this->data['count-search'] ?> resultados</p>
            </div>

            <?php if($this->data['count-search'] === 0): ?>
                <div class="not-found">
                    <h3 class="title">
                        <div>
                            Não encontramos nenhum resultado na sua busca!
                        </div>
                    </h3>
                </div>
            <?php endif ?>
        <?php endif ?>

        <!-- Caso tenha filtro de categoria -->
        <?php if(isset($_GET['category'])): ?>
            <div class="search">
                <p>Categoria: <strong><?= $this->data['filter'] ?></strong></p>
            </div>
        <?php endif ?>


        <!-- PAGINACAO -->
        <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>

        <?php foreach($this->data['blog'] as $blog): ?>
            <article>
                <h2><?= $blog['title'] ?></h2>

                <figure>
                    <i class="fa-solid fa-calendar-days"></i> <?= $blog['published'] ?>
                </figure>

                <div class="row">
                    <div class="banner" style="background-image: url(<?= URL ?>/assets/img/blog/<?= $blog['banner'] ?>);"></div>

                    <div class="text">
                        <p><?= $blog['summary'] ?></p>
                        <a href="<?= URL ?>/blog/post?key=<?= $blog['id'] ?>">Ler Mais</a>
                    </div>
                </div>
            </article>
        <?php endforeach ?>

        <!-- PAGINACAO -->
        <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>
    </section>



    <!-- ///////////////////// LATERAL ///////////////////// -->
    <aside>

        <!-- Redes sociais -->
        <nav>
            <h2>Redes Sociais</h2>

            <ul class="social">
                <?php if($social): ?>
                    <?php foreach($social as $soci): ?>
                        <li>
                            <a target="_blank" href="<?= $soci['link'] ?>">
                                <img src="<?= URL ?>/assets/img/social/<?= $soci['icon'] ?>" alt="<?= $soci['name'] ?>">
                            </a>
                        </li>
                    <?php endforeach ?>
                <?php endif ?>
            </ul>
        </nav>

        
        <!-- Categorias -->
        <nav class="category">
            <h2>Categorias</h2>

            <?php if(isset($this->data['categories'])): ?>
                <ul>
                    <!-- Colocar 'Todos' caso algum filtro ou categoria setado -->
                    <?php if(isset($_GET['search']) || isset($_GET['category'])): ?>
                        <li>
                            <a href="<?= URL ?>/blog">
                                <i class="fa-solid fa-circle"></i> Todos
                            </a>
                        </li>
                    <?php endif ?>
    
                    <?php foreach($this->data['categories'] as $category): ?>
                        <li>
                            <!-- Colocar classe para destacar caso categoria selecionada -->
                            <?php if(isset($_GET['category']) && $_GET['category'] == $category['id']): ?>
                                <a class="isset" href="<?= URL ?>/blog?category=<?= $category['id'] ?>">
                                    <i class="fa-solid fa-circle"></i> <?= $category['name'] ?>
                                </a>
                            <?php else: ?>
                                <a href="<?= URL ?>/blog?category=<?= $category['id'] ?>">
                                    <i class="fa-solid fa-circle"></i> <?= $category['name'] ?>
                                </a>
                            <?php endif ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </nav>

        <!-- Mais Vistos -->
        <nav class="more-views">
            <h2>Mais Vistos</h2>

            <ul>
                <?php foreach($this->data['most-views'] as $views): ?>
                    <li>
                        <a href="<?= URL ?>/blog/post?key=<?= $views['id'] ?>">
                            <div class="banner" style="background-image: url(<?= URL ?>/assets/img/blog/<?= $views['banner'] ?>);">
                                <div class="shadow"></div>
                            </div>

                            <p><?= $views['title'] ?></p>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>

        </nav>
    </aside>

</div><!-- Fim div #main-blog -->



<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/blog.js"></script>

<script>
    slide()
</script>