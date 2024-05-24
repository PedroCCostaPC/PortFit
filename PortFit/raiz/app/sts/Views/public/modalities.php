<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav nav ul li:nth-child(2) a {
        color: <?= SECONDARY_COLOR ?>;
    }
</style>


<section id="modalities" class="container">
    <h1 class="title">
        <div>
            Modalidades <span><?= ACADEMY ?></span>
        </div>
    </h1>

    <div class="main-modalities">

        <?php foreach($this->data as $modality): ?>
            <article>
                <div class="banner" style="background-image: url(<?= URL ?>/assets/img/modalities/<?= $modality['banner'] ?>);"></div>

                <div class="box">
                    <h2><?= $modality['name'] ?></h2>

                    <p>
                        <?= $modality['summary'] ?>
                    </p>
                </div>
                
                <a href="<?= URL ?>/modalidade?key=<?= $modality['id'] ?>">Saiba Mais</a>
            </article>
        <?php endforeach ?>

    </div><!-- Fim div .main-modalities -->
</section>
