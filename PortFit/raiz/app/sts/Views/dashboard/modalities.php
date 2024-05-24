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
        background: transparent;
    }
</style>


<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Academia <span>Modalidades</span>
        </div>
    </h1>
</div>


<div id="main-academy-modalities" class="container">
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


    <div id="cards-modalities">

        <a class="card btn-new-modality" href="<?= URL ?>/dashboard/modalidades/adicionar">
            + Adicionar
        </a>

        <?php foreach($this->data['modality'] as $modality): ?>
            <section class="card section <?= $modality['situation-class'] ?>" style="background-image: url(<?= URL ?>/assets/img/modalities/<?= $modality['banner'] ?>);">

                <div class="box-card">
                    <h2><?= $modality['name'] ?></h2>

                    <div class="btns-standard-alter">
                        <form action="<?= URL ?>/dashboard/modalidades" method="POST">
                            <input type="hidden" name="situation-modality">
                            <input type="hidden" name="id" value="<?= $modality['id'] ?>">
                            
                            <button class="btn-standard btn-sketch">
                                <i class="fa-solid fa-paperclip"></i>
                            </button>
                        </form>

                        <a class="btn-standard btn-alter" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $modality['id'] ?>&day=1">
                            <i class="fa-solid fa-pencil"></i>
                        </a>

                        <button class="btn-standard btn-delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div><!-- Fim div .box -->


                <!-- Overlay de EXLUIR Modalidade -->
                <div class="overlay close-overlay">
                    <div class="main-box close-box">
                        <h2>Deseja excluir <span><?= $modality['name'] ?>?</span></h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="<?= URL ?>/dashboard/modalidades" method="POST">
                                <input type="hidden" name="delete-modality">
                                <input type="hidden" name="id" value="<?= $modality['id'] ?>">
    
                                <div class="mini-box">
                                    <img src="<?= URL ?>/assets/img/modalities/<?= $modality['banner'] ?>">
                                </div>
    
                                <button class="btn-standard-form">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div><!-- Fim div .overlay -->
            </section>
        <?php endforeach ?>

    </div><!-- Fim div #cards-modalities -->
</div><!-- Fim div #main-academy-modalities -->



<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/academyModality.js"></script>

<script>
    deleteModality()
</script>
