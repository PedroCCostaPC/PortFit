<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<link rel="stylesheet" href="<?= URL ?>/assets/lib/dist/ui/trumbowyg.min.css">

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
            Alterar <span><?= $this->data['blog']['title'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-blog-form" class="container">
    <!-- BTN Voltar -->
    <a href="<?= URL ?>/dashboard/blog" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>

    <!-- /////////////////////////// FORMULARIO /////////////////////////// -->
    <form class="form-standard" action="<?= URL ?>/dashboard/blog/alterar?key=<?= $_GET['key'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="update-blog">

        <!-- Titulo -->
        <div class="row start-js">
            <label for="title">* Titulo</label>
            <input type="text" id="title" name="title" value="<?= $this->data['blog']['title'] ?>">
        </div>

        <!-- Banner -->
        <div class="banner">
            <div id="banner-blog" class="img">
                <img src="<?= URL ?>/assets/img/blog/<?= $this->data['blog']['banner'] ?>">
            </div>

            <div class="btn-file">
                <label for="banner">
                    <i class="fa-regular fa-image"></i> Alterar banner
                </label>
                <input id="banner" type="file" accept="image/*" name="blog">
            </div>
        </div>

        <!-- Categorias -->
        <div class="row categories">
            <!-- Selecionar categoria -->
            <div class="input-select close">
                <input type="hidden" name="category" value="<?= $this->data['blog']['category_id'] ?>">
                <button type="button">* <?= $this->data['blog']['category'] ?> <i class="fa-solid fa-angle-up"></i></button>

                <ul>
                    <?php foreach($this->data['category'] as $category): ?>
                        <li>
                            <p><?= $category['name'] ?></p>
                            <input type="hidden" value="<?= $category['id'] ?>">
                        </li>
                    <?php endforeach ?>
                </ul>
            </div><!-- Fim div .input-select -->

            <!-- Adicionar categoria -->
            <div class="new-category row start-js">
                <label for="new-category">Adicionar nova categoria</label>
                <input id="new-category" type="text" name="new-category">
            </div>
        </div><!-- Fim div .categories -->

        <!-- POST -->
        <div class="row-1 standard-label">
            <textarea id="post" name="post"><?= $this->data['blog']['post'] ?></textarea>
        </div>

        <button class="btn-standard-form">Alterar</button>
    </form>
</div><!-- Fim div ##main-dash-blog-form -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/lib/dist/trumbowyg.min.js"></script>
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/blog.js"></script>

<script>
    formLabelInput('#main-dash-blog-form form')
    previewIMG('#banner', '#banner-blog')
    inputSelect('#main-dash-blog-form form .input-select')
    textareaBlog()
</script>