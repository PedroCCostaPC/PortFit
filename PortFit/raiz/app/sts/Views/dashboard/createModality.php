<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(2) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(2) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }

    /* Mini nav - marcacao da page */
    .mini-nav-dash ul li:nth-child(2) a {
        color: <?= SECONDARY_COLOR ?>;
        background: <?= PRIMARY_COLOR ?>;
        border-color: <?= PRIMARY_COLOR ?>;
    }

    .mini-nav-dash ul li:nth-child(2) a:hover {
        background: transparent;
        border-color: <?= SECONDARY_COLOR ?>;
    }
</style>


<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Adicionar <span>Modalidade</span>
        </div>
    </h1>
</div>

<div id="main-academy-modality" class="container create-modality">
    <!-- NAV DE OPCOES DA ACADEMIA -->
    <nav class="mini-nav-dash">
        <ul>
            <li>
                <a href="<?= URL ?>/dashboard/academia">Informações</a>
            </li>
            <li>
                <a href="<?= URL ?>/dashboard/modalidades">Modalidades</a>
            </li>
            <li>
                <a href="<?= URL ?>/dashboard/precos">Preços</a>
            </li>
        </ul>
    </nav>

    <!-- FORM DA MODALIDADE -->
    <section id="form-modality">
        <form class="form-standard" action="<?= URL ?>/dashboard/modalidades/adicionar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="create-modality">

            <!-- Nome -->
            <div class="row start-js">
                <label for="name">* Nome</label>
                <input type="text" id="name" name="name">
            </div>

            <!-- Banner -->
            <div class="banner">
                <div id="banner-modality" class="img">
                </div>

                <div class="btn-file">
                    <label for="banner">
                        <i class="fa-regular fa-image"></i> * Adicionar banner
                    </label>
                    <input id="banner" type="file" accept="image/*" name="banner">
                </div>
            </div>

            <!-- Resumo -->
            <div class="row start-js">
                <label for="summary">* Resumo</label>
                <textarea name="summary" id="summary" cols="100" rows="10"></textarea>
                <small class="max-character">Máximo 250 caracteres.</small>
            </div>

            <!-- Frase -->
            <div class="row start-js">
                <label for="phrase">* Frase</label>
                <input type="text" id="phrase" name="phrase">
                <small class="max-character">Máximo 100 caracteres.</small>
            </div>

            <!-- Como é a aula -->
            <h1 class="title">
                <div>
                    Como é uma aula?
                </div>
            </h1>

            <div class="row start-js">
                <label for="about">* Como são as aulas?</label>
                <textarea name="about" id="about" cols="100" rows="10"></textarea>
                <small class="max-character">Máximo 1500 caracteres.</small>
            </div>

            <!-- Por que fazer a aula -->
            <h1 class="title">
                <div>
                    Por que fazer a aula?
                </div>
            </h1>

            <div class="row start-js">
                <label for="whyte">* Por que fazer essa modalidade?</label>
                <textarea name="whyte" id="whyte" cols="100" rows="10"></textarea>
                <small class="max-character">Máximo 1500 caracteres.</small>
            </div>

            <!-- Imagem -->
            <div class="banner">
                <div id="image-modality" class="img">
                </div>

                <div class="btn-file">
                    <label for="image">
                        <i class="fa-regular fa-image"></i> * Adicionar imagem
                    </label>
                    <input id="image" type="file" accept="image/*" name="image">
                </div>
            </div>

            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>

</div><!-- Fim div #main-academy-modality -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/academyModality.js"></script>

<script>
    formLabelInput('#form-modality form')
    previewIMG('#banner', '#banner-modality')
    previewIMG('#image', '#image-modality')
    validateModality()
</script>