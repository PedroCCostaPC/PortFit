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
            Suplementação <?= $this->data['pronoun'] ?> <span><?= $this->data['student']['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-all-food" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/alunos/perfio?student=<?= $_GET['student'] ?>" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>

        <!-- BTN MONTAR SUPLEMENTACAO -->
        <?php if($this->data['hasSupplement']): ?>
            <a class="btn-assemble-food" href="<?= URL ?>/dashboard/alunos/suplementacao/montar?student=<?= $_GET['student'] ?>">Mudar suplementação</a>
        <?php endif ?>
    
        <?php require_once(dirname(__FILE__, 2) . '/layout/optionsStudent.php'); ?>
    </div>

    <!-- NAV DE OPCOES DA SEMANA -->
    <nav class="week-nav-dash">
        <ul>
            <!-- Segunda Feira -->
            <?php if($this->data['counterDay'][1] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][1] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>">
                        Segunda-Feira (<?= $this->data['counterDay'][1] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Treca Feira -->
            <?php if($this->data['counterDay'][2] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][2] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>&day=2">
                        Terça-Feira (<?= $this->data['counterDay'][2] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Quarta Feira -->
            <?php if($this->data['counterDay'][3] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][3] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>&day=3">
                        Quarta-Feira (<?= $this->data['counterDay'][3] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Quinta Feira -->
            <?php if($this->data['counterDay'][4] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][4] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>&day=4">
                        Quinta-Feira (<?= $this->data['counterDay'][4] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Sexta Feira -->
            <?php if($this->data['counterDay'][5] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][5] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>&day=5">
                        Sexta-Feira (<?= $this->data['counterDay'][5] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Sabado -->
            <?php if($this->data['counterDay'][6] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][6] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>&day=6">
                        Sábado (<?= $this->data['counterDay'][6] ?>)
                    </a>
                </li>
            <?php endif ?>

            <!-- Domingo -->
            <?php if($this->data['counterDay'][0] > 0): ?>
                <li>
                    <a class="<?= $this->data['day-class'][0] ?>" href="<?= URL ?>/dashboard/alunos/suplementacao?student=<?= $_GET['student'] ?>&day=0">
                        Domingo (<?= $this->data['counterDay'][0] ?>)
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>

    <!-- CASO NAO TENHA SUPLEMENTACAO MONTADO -->
    <?php if(!isset($this->data['hasSupplement'])): ?>
        <h2 class="title not-food">
            <div>
                <?= $this->data['student']['firstName'] ?> não possui <span>suplementação</span>
            </div>
        </h2>

        <div class="add-food">
            <a href="<?= URL ?>/dashboard/alunos/suplementacao/montar?student=<?= $_GET['student'] ?>">Montar suplementação</a>
        </div>

    <!-- CASO TENHA SUPLEMENTACAO MONTADO -->
    <?php else: ?>
        <h2 class="title-day">
            <?= $this->data['day'] ?>
        </h2>

        <!-- LISTA DAS SUPLEMENTACOES -->
        <section id="list-food">
            <?php foreach($this->data['supplement'] as $supplement): ?>
                <article>
                    <!-- HORARIO -->
                    <div class="col time">
                        <h3>Horário</h3>
                        <p><?= $supplement['time'] ?></p>
                    </div>

                    <!-- SUPLEMENTACAO -->
                    <div class="col food">
                        <h3>Suplementação</h3>
                        <p><?= $supplement['supplement'] ?></p>
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

                    <!-- Overlay de EXLUIR Suplementacao -->
                    <div class="overlay-delete overlay close-overlay">
                        <div class="main-box close-box">
                            <h2>Deseja remover suplementação?</h2>
                                        
                            <div class="box">
                                <button class="btn-close-overlay">
                                    <i class="fa-solid fa-angle-left"></i> Voltar
                                </button>
                            
                                <form action="#" method="POST">
                                    <input type="hidden" name="delete-supplement">
                                    <input type="hidden" name="id" value="<?= $supplement['id'] ?>">
                            
                                    <div class="mini-box">
                                        <!-- time -->
                                        <div class="time">
                                            <h6>Horário</h6>
                                            <p><?= $supplement['time'] ?></p>
                                        </div>
    
                                        <!-- Suplementacao -->
                                        <div>
                                            <h6>Suplementação</h6>
                                            <p><?= $supplement['supplement'] ?></p>
                                        </div>
                                    </div><!-- Fim div .mini-box -->
                            
                                    <button class="btn-standard-form">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- Fim div .overlay-delete -->

                    <!-- Overlay de ALTERAR Suplementacao -->
                    <div class="overlay-update overlay close-overlay">
                        <div class="main-box close-box">
                            <h2>Alterar suplementação</h2>
                                        
                            <div class="box">
                                <button class="btn-close-overlay">
                                    <i class="fa-solid fa-angle-left"></i> Voltar
                                </button>
                            
                                <form action="#" method="POST">
                                    <input type="hidden" name="update-supplement">
                                    <input type="hidden" name="id" value="<?= $supplement['id'] ?>">
                            
                                    <div class="mini-box">
                                        <!-- Time -->
                                        <div class="time">
                                            <input type="number" name="hour" value="<?= $supplement['hour'] ?>"> 
                                            <span>:</span> 
                                            <input type="number" name="minute" value="<?= $supplement['minute'] ?>">
                                        </div>
    
                                        <!-- Repeticoes -->
                                        <div class="food">
                                            <textarea name="supplement" cols="70" rows="10"><?= $supplement['supplement'] ?></textarea>
                                        </div>
                                    </div><!-- Fim div .mini-box -->
                            
                                    <button class="btn-standard-form">Alterar</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- Fim div .overlay-update -->
                </article>
            <?php endforeach ?>
        </section>
    <?php endif ?>
</div><!-- Fim div #main-dash-all-food -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/food.js"></script>

<script>
    boxFilter('#main-dash-all-food #nav-top .filter')
    deleteFood()
    updateFood()
</script>