<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav nav ul li:nth-child(4) a {
        color: <?= SECONDARY_COLOR ?>;
    }
</style>



<div id="main-blog" class="container">
    <!-- ///////////////////// POST ///////////////////// -->
    <section id="post-blog">
        <h1><?= $this->data['post']['title'] ?></h1>
        <figure>
            Publicado <?= $this->data['post']['published'] ?> | <?= $this->data['count-comment'] ?> Comentários
        </figure>

        <div class="banner">
            <img src="<?= URL ?>/assets/img/blog/<?= $this->data['post']['banner'] ?>">

            <div class="post">
                <?= $this->data['post']['post'] ?>
            </div>
        </div>



        <!-- ///////////////////// COMENTARIOS ///////////////////// -->
        <div id="comentary">
            <h2>Envia Comentário</h2>
            <p>O seu endereço de e-mail não será publicado. Campos obrigatórios são marcados com *</p>

            <form action="<?= URL ?>/blog/post?key=<?= $_GET['key'] ?>" method="POST">
                <input type="hidden" name="create-comment">

                <!-- Comentarios Form-->
                <div>
                    <textarea name="comment" cols="70" rows="10" placeholder="*Comentário"></textarea>
                </div>

                <!-- Nome -->
                <div class="name">
                    <input type="text" name="name" placeholder="* Nome">
                </div>

                <!-- Email -->
                <div class="email">
                    <input type="email" name="email" placeholder="* E-Mail">
                </div>

                <button>Enviar comentário</button>
            </form>


            <!-- Comentarios -->
            <div class="comentaries">
                <?php foreach($this->data['comments'] as $comment): ?>
                    <article>
                        <h3><?= $comment['name'] ?></h3>
                        <figure><?= $comment['date'] ?></figure>

                        <p><?= $comment['comment'] ?></p>
                    </article>
                <?php endforeach ?>
            </div>

        </div><!-- Fim div #comentary -->
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
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/blog.js"></script>

<script>
    comentary()
</script>

