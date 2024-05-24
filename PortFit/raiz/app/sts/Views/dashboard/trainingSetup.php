<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(4) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(4) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Montar treino <?= $this->data['pronoun'] ?> <span><?= $this->data['student']['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-setup-training" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>
    
        <?php require_once(dirname(__FILE__, 2) . '/layout/optionsStudent.php'); ?>
    </div>

    <!-- NAV DE OPCOES DA SEMANA -->
    <nav class="week-nav-dash">
        <ul>
            <!-- Segunda Feira -->
            <li>
                <a class="<?= $this->data['day-class'][1] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>">
                    Segunda-Feira (<?= $this->data['counterDay'][1] ?>)
                </a>
            </li>

            <!-- Treca Feira -->
            <li>
                <a class="<?= $this->data['day-class'][2] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>&day=2">
                    Terça-Feira (<?= $this->data['counterDay'][2] ?>)
                </a>
            </li>

            <!-- Quarta Feira -->
            <li>
                <a class="<?= $this->data['day-class'][3] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>&day=3">
                    Quarta-Feira (<?= $this->data['counterDay'][3] ?>)
                </a>
            </li>

            <!-- Quinta Feira -->
            <li>
                <a class="<?= $this->data['day-class'][4] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>&day=4">
                    Quinta-Feira (<?= $this->data['counterDay'][4] ?>)
                </a>
            </li>

            <!-- Sexta Feira -->
            <li>
                <a class="<?= $this->data['day-class'][5] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>&day=5">
                    Sexta-Feira (<?= $this->data['counterDay'][5] ?>)
                </a>
            </li>

            <!-- Sabado -->
            <li>
                <a class="<?= $this->data['day-class'][6] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>&day=6">
                    Sábado (<?= $this->data['counterDay'][6] ?>)
                </a>
            </li>

            <!-- Domingo -->
            <li>
                <a class="<?= $this->data['day-class'][0] ?>" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>&day=0">
                    Domingo (<?= $this->data['counterDay'][0] ?>)
                </a>
            </li>
        </ul>
    </nav>

    <!-- Titulo do dia -->
    <h2 class="title-day">
        <?= $this->data['day'] ?>
    </h2>

    <!-- //////////// FOMR //////////// -->
    <form action="#" method="POST">
        <input type="hidden" name="create-training">

        <!-- BOTOES DAS CATEGORIAS -->
        <div id="categories">
            <?php foreach($this->data['exercises'] as $exercises): ?>
                <section class="category">

                    <!-- BTN Para abrir exercicios da categoria -->
                    <?php if(isset($exercises['checked'])): ?>
                        <button type="button" class="btn-open-category btn-category-using">
                            <?= $exercises['name'] ?>
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn-open-category">
                            <?= $exercises['name'] ?>
                        </button>
                    <?php endif ?>

                    <!-- Overlay dos exercicios -->
                    <article class="open-category">
                        <div class="box open-box">
                            <!-- BTN Fechar -->
                            <button type="button" class="btn-close-category">
                                <i class="fa-solid fa-angle-left"></i> Fechar
                            </button>

                            <!-- TITULO DOS INPUTS -->
                            <div class="title-inputs">
                                <p class="title-select">
                                    Exercício
                                </p>
    
                                <div class="title-series-repetitions">
                                    <p class="title-series">
                                        Series
                                    </p>
    
                                    <p class="title-repetitions">
                                        Repetições
                                    </p>
                                </div>
                            </div>
    
                            <?php foreach($exercises['exercises'] as $exer): ?>
                                <!-- EXERCICIOS QUE JA ESTAO NO TREINO -->
                                <?php if(isset($exer['training-id'])): ?>
                                    <div class="previous-training exercise">
                                        <input class="id-training" type="hidden" name="id-training[]" value="<?= $exer['training-id'] ?>">
    
                                        <!-- Select e nome -->
                                        <div class="select">
                                            <input class="previous-checkbox" type="checkbox" id="id-<?= $exer['id'] ?>" checked>
                                            <label for="id-<?= $exer['id'] ?>">
                                                <p class="btn-select" type="button">
                                                    <i class="fa-solid fa-check"></i>
                                                </p>
                                                <?= $exer['name'] ?>
                                            </label>
                                        </div>
    
                                        <!-- Series E Repeticoes -->
                                        <div class="series-repetitions">
                                            <div class="series">
                                                <label class="mobile">Series</label>
                                                <input class="previous-series" type="number" name="previous-series[]" value="<?= $exer['series'] ?>" placeholder="x">
                                            </div>
    
                                            <div class="repetitions">
                                                <label class="mobile">Repetições</label>

                                                <div class="repetitions-inputs">
                                                    <div class="div-min">
                                                        <input class="previous-min" type="number" name="previous-min[]" value="<?= $exer['min'] ?>" placeholder="Min">
                                                    </div>
                                    
                                                    <div>
                                                        <input class="previous-max" type="number" name="previous-max[]" value="<?= $exer['max'] ?>" placeholder="Max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                <!-- EXERCICIOS QUE NAO ESTAO NO TREINO -->
                                <?php else: ?>
                                    <div class="new-training exercise">
                                        <!-- Select e nome -->
                                        <div class="select">
                                            <input class="new-checkbox" type="checkbox" id="id-<?= $exer['id'] ?>" name="new-exercise-id[]" value="<?= $exer['id'] ?>">
                                            <label for="id-<?= $exer['id'] ?>">
                                                <p class="btn-select" type="button">
                                                    <i class="fa-solid fa-check"></i>
                                                </p>
                                                <?= $exer['name'] ?>
                                            </label>
                                        </div>
    
                                        <!-- Series E Repeticoes -->
                                        <div class="series-repetitions">
                                            <div class="series">
                                                <label class="mobile">Series</label>
                                                <input class="new-series" type="number" placeholder="x">
                                            </div>
    
                                            <div class="repetitions">
                                                <label class="mobile">Repetições</label>

                                                <div class="repetitions-inputs">
                                                    <div class="div-min">
                                                        <input class="new-min" type="number" placeholder="Min">
                                                    </div>
                                    
                                                    <div>
                                                        <input class="new-max" type="number" placeholder="Max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div><!-- Fim div .box -->
                    </article>

                </section>
            <?php endforeach ?>
        </div><!-- Fim div #categories -->

        <button class="btn-standard-form">Salvar</button>
    </form>
</div><!-- Fim div #main-dash-setup-training -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/training.js"></script>

<script>
    boxFilter('#main-dash-setup-training #nav-top .filter')
    inputSelect()
    training('#categories', '.previous-training', '.previous-checkbox', '.previous-series', '.previous-min', '.previous-max', '.id-training')
    training('#categories', '.new-training', '.new-checkbox', '.new-series', '.new-min', '.new-max')
    openCategory()
</script>