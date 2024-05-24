<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(3) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(3) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Adicionar <span>exercício</span>
        </div>
    </h1>
</div>

<div id="main-dash-exercise" class="container">

    <!-- BTN ADD -->
    <a href="<?= URL ?>/dashboard/exercicios" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>

    <!-- FORMULARIO -->
    <section id="form-exercise">
        <form class="form-standard" action="<?= URL ?>/dashboard/exercicios/adicionar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="create-exercise">

            <!-- Banner -->
            <div class="banner">
                <div id="banner-exercise" class="img">
                </div>

                <div class="btn-file">
                    <label for="banner">
                        <i class="fa-regular fa-image"></i> * Adicionar banner
                    </label>
                    <input id="banner" type="file" accept="image/*" name="banner">
                </div>
            </div>

            <!-- Nome -->
            <div class="row start-js">
                <label for="name">* Nome</label>
                <input type="text" id="name" name="name">
            </div>

            <!-- Categorias -->
            <div class="row categories">
                <!-- Selecionar categoria -->
                <div class="input-select close">
                    <input type="hidden" name="category">
                    <button type="button">* Categoria <i class="fa-solid fa-angle-up"></i></button>

                    <ul>
                        <?php foreach($this->data['categories'] as $category): ?>
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


            <!-- Descricao -->
            <div class="row start-js">
                <label for="description">Descrição (Opcional)</label>
                <textarea name="description" id="description" cols="100" rows="10"></textarea>
            </div>

            <!-- Adicionar video -->
            <div class="row">
                <label for="video">Adicionar video (Opicional)</label>
                <input type="text" id="video" name="video" placeholder="Color tag">
            </div>

            <!-- Fazer Upload de video -->
            <div class="video">
                <p>Ou fazer upload (Opicional)</p>

                <div id="video-exercise" class="img">
                </div>

                <div class="btn-file">
                    <label for="video-upload">
                        <i class="fa-solid fa-video"></i>Adicionar vídeo
                    </label>
                    <input id="video-upload" type="file" accept="video/*" name="video-upload">
                </div>

                <p>Máximo <b>30 MB</b></p>
            </div>

            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>

</div><!-- Fim div #main-academy-exercise -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/exercises.js"></script>

<script>
    formLabelInput('#form-exercise form')
    previewIMG('#banner', '#banner-exercise')
    inputSelect('#form-exercise .input-select')
    previewVideo('#video-upload', '#video-exercise')
</script>