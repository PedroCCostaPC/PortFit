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
            Treino <?= $this->data['pronoun'] ?> <span><?= $this->data['student']['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-all-training" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/alunos/perfio?student=<?= $_GET['student'] ?>" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>

        <!-- BTN MONTAR TREINO -->
        <?php if(isset($this->data['category'])): ?>
            <a class="btn-assemble-training" href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>">Mudar treino</a>
        <?php endif ?>
    
        <?php require_once(dirname(__FILE__, 2) . '/layout/optionsStudent.php'); ?>
    </div>

    <!-- NAV DE OPCOES DA SEMANA -->
    <nav class="week-nav-dash">
        <ul>
            <!-- Segunda Feira -->
            <?php if($this->data['counterDay'][1] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][1] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>">
                        Segunda-Feira (<?= $this->data['counterDay'][1] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Treca Feira -->
            <?php if($this->data['counterDay'][2] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][2] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>&day=2">
                        Terça-Feira (<?= $this->data['counterDay'][2] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Quarta Feira -->
            <?php if($this->data['counterDay'][3] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][3] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>&day=3">
                        Quarta-Feira (<?= $this->data['counterDay'][3] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Quinta Feira -->
            <?php if($this->data['counterDay'][4] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][4] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>&day=4">
                        Quinta-Feira (<?= $this->data['counterDay'][4] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Sexta Feira -->
            <?php if($this->data['counterDay'][5] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][5] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>&day=5">
                        Sexta-Feira (<?= $this->data['counterDay'][5] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Sabado -->
            <?php if($this->data['counterDay'][6] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][6] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>&day=6">
                        Sábado (<?= $this->data['counterDay'][6] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Domingo -->
            <?php if($this->data['counterDay'][0] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][0] ?>" href="<?= URL ?>/dashboard/alunos/treino?student=<?= $_GET['student'] ?>&day=0">
                        Domingo (<?= $this->data['counterDay'][0] ?>)
                    </a>
                </li>
            <?php endif ?>

        </ul>
    </nav>


    <!-- CASO NAO TENHA TREINO MONTADO -->
    <?php if(!isset($this->data['category'])): ?>
        <h2 class="title not-training">
            <div>
                <?= $this->data['student']['firstName'] ?> não possui <span>treino</span>
            </div>
        </h2>

        <div class="add-training">
            <a href="<?= URL ?>/dashboard/alunos/treino/montar?student=<?= $_GET['student'] ?>">Montar treino</a>
        </div>

    <!-- CASO TENHA TREINO MONTADO -->
    <?php else: ?>
        <h2 class="title-day">
            <?= $this->data['day'] ?>
        </h2>
    
        <!-- LISTA DOS TREINOS -->
        <div id="list-training">
    
            <?php foreach($this->data['category'] as $category): ?>
                <section>
                    <h3><?= $category ?></h3>
    
                    <ul>
                        <?php foreach($this->data['training'] as $training): ?>
                            <?php foreach($training as $exercise): ?>
                                <?php if($exercise['category'] === $category): ?>
                                    <li>
                                        <!-- Nome -->
                                        <div class="col name">
                                            <h4>Nome</h4>
                                            <p><?= $exercise['exercise'] ?></p>
                                        </div>
    
                                        <!-- Series e repeticoes -->
                                        <div class="col series-repetitions">
                                            <div class="series">
                                                <h4>Series</h4>
                                                <p><?= $exercise['series'] ?>x</p>
                                            </div>
    
                                            <div class="repetitions">
                                                <h4>Repetições</h4>
                                                <p><?= $exercise['min'] ?> a <?= $exercise['max'] ?></p>
                                            </div>
                                        </div>
    
                                        <!-- Botoes -->
                                        <div class="col btns-standard-alter">
                                            <!-- Alterar -->
                                            <button class="btn-standard btn-alter">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
    
                                            <!-- Apagar -->
                                            <button class="btn-standard btn-delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
    
                                        <!-- Overlay de EXLUIR Treino -->
                                        <div class="overlay-delete overlay close-overlay">
                                            <div class="main-box close-box">
                                                <h2>Deseja Remover <span><?= $exercise['exercise'] ?>?</span></h2>
                                        
                                                <div class="box">
                                                    <button class="btn-close-overlay">
                                                        <i class="fa-solid fa-angle-left"></i> Voltar
                                                    </button>
                            
                                                    <form action="#" method="POST">
                                                        <input type="hidden" name="delete-training">
                                                        <input type="hidden" name="id" value="<?= $exercise['id'] ?>">
                            
                                                        <div class="mini-box">
                                                            <!-- Series -->
                                                            <div class="series">
                                                                <h6>Series</h6>
                                                                <p><?= $exercise['series'] ?>x</p>
                                                            </div>
    
                                                            <!-- Repeticoes -->
                                                            <div class="repetitions">
                                                                <h6>Repetições</h6>
                                                                <p><?= $exercise['min'] ?> a <?= $exercise['max'] ?></p>
                                                            </div>
                                                        </div><!-- Fim div .mini-box -->
                            
                                                        <button class="btn-standard-form">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- Fim div .overlay-delete -->
    
                                        <!-- Overlay de ALTERAR Treino -->
                                        <div class="overlay-update overlay close-overlay">
                                            <div class="main-box close-box">
                                                <h2><?= $exercise['exercise'] ?></h2>
                                        
                                                <div class="box">
                                                    <button class="btn-close-overlay">
                                                        <i class="fa-solid fa-angle-left"></i> Voltar
                                                    </button>
                            
                                                    <form action="#" method="POST">
                                                        <input type="hidden" name="update-training">
                                                        <input type="hidden" name="id" value="<?= $exercise['id'] ?>">
                            
                                                        <div class="mini-box">
                                                            <!-- Series -->
                                                            <div>
                                                                <label><b>Séries:</b> </label>
                                                                <div>
                                                                    <input type="number" name="series" value="<?= $exercise['series'] ?>" placeholder="Série">
                                                                </div>
                                                            </div>
    
                                                            <!-- Repeticoes -->
                                                            <div class="alter-repetitions">
                                                                <label><b>Repetições:</b></label>
                                                                <div>
                                                                    <input type="number" name="min" value="<?= $exercise['min'] ?>" placeholder="Min">
                                                                    <input type="number" name="max" value="<?= $exercise['max'] ?>" placeholder="Max">
                                                                </div>
                                                            </div>
                                                        </div><!-- Fim div .mini-box -->
                            
                                                        <button class="btn-standard-form">Alterar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- Fim div .overlay-update -->
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    </ul>
                </section>
            <?php endforeach ?>
        </div><!-- Fim div #list-training -->
    <?php endif ?>

</div><!-- Fim div #main-dash-all-training -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/training.js"></script>

<script>
    boxFilter('#main-dash-all-training #nav-top .filter')
    deleteTraining()
    updateTraining()
</script>