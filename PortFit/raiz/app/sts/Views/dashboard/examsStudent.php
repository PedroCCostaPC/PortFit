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
            Avaliações <?= $this->data['pronoun'] ?> <span><?= $this->data['student']['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-exams" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/alunos/perfio?student=<?= $_GET['student'] ?>" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>

        <!-- BTN ADICIONAR AVALIACAO -->
        <?php if(isset($this->data['last-exam'])): ?>
            <a class="btn-assemble-exam" href="<?= URL ?>/dashboard/alunos/avaliacao/adicionar?student=<?= $_GET['student'] ?>">+ Nova avaliação</a>
        <?php endif ?>
    
        <?php require_once(dirname(__FILE__, 2) . '/layout/optionsStudent.php'); ?>
    </div>

    <!-- CASO NAO TENHA EXAMES -->
    <?php if(!isset($this->data['last-exam'])): ?>
        <h2 class="title not-exam">
            <div>
                <?= $this->data['student']['firstName'] ?> não possui <span>avaliações</span>
            </div>
        </h2>

        <div class="add-exam">
            <a href="<?= URL ?>/dashboard/alunos/avaliacao/adicionar?student=<?= $_GET['student'] ?>">Adicionar avaliação</a>
        </div>

    <!-- ULTIMO EXAME -->
    <?php else: ?>
        <section id="last-exam">
            <!-- Titule / data -->
            <div class="title-date">
                <h2>Última avaliação</h2>
                <p><?= $this->data['last-exam']['dateExam'] ?></p>
            </div>

            <!-- Botoes -->
            <div class="exams-btns">
                <!-- Visualizar -->
                <a href="<?= URL ?>/dashboard/alunos/avaliacao?student=<?= $_GET['student'] ?>&exam=<?= $this->data['last-exam']['id'] ?>&lastExam=true" class="btn btn-view">
                    <i class="fa-solid fa-eye"></i> Visualizar
                </a>
                
                <!-- Alterar -->
                <a href="<?= URL ?>/dashboard/alunos/avaliacao/alterar?student=<?= $_GET['student'] ?>&exam=<?= $this->data['last-exam']['id'] ?>" class="btn btn-alter">
                    <i class="fa-solid fa-pencil"></i> Alterar
                </a>

                <!-- Deletar -->
                <button class="btn btn-delete"><i class="fa-solid fa-trash"></i> Excluir</button>
            </div>

            <!-- Overlay de EXLUIR exame -->
            <div class="overlay close-overlay">
                <div class="main-box close-box">
                    <h2>Deseja excluir avaliação?</h2>
                                        
                    <div class="box">
                        <button class="btn-close-overlay">
                            <i class="fa-solid fa-angle-left"></i> Voltar
                        </button>
                            
                        <form action="<?= URL ?>/dashboard/alunos/avaliacoes?student=<?= $_GET['student'] ?>" method="POST">
                            <input type="hidden" name="delete-exam">
                            <input type="hidden" name="id" value="<?= $this->data['last-exam']['id'] ?>">
                            
                            <div class="mini-box">
                                <!-- data -->
                                <div class="date">
                                    <h6>Data do exame</h6>
                                    <p><?= $this->data['last-exam']['dateExam'] ?></p>
                                </div>
                            </div><!-- Fim div .mini-box -->
                            
                            <button class="btn-standard-form">Excluir</button>
                        </form>
                    </div>
                </div>
            </div><!-- Fim div .overlay -->
        </section>
    <?php endif ?>

    <!-- TODOS OS EXAMES -->
    <?php if(isset($this->data['all-exam']) && $this->data['all-exam']): ?>
        <section id="all-exams">
            <h2 class="title">
                <div>
                    Todas <span>avaliações</span>
                </div>
            </h2>

            <div class="exams">
                <!-- Nav de ordenagem -->
                <nav class="order">
                    <div class="col">
                        <i class="fa-solid fa-angle-up"></i> <a href="<?= URL ?>/dashboard/alunos/avaliacoes?student=<?= $_GET['student'] ?>#all-exams">Mais novas</a>
                    </div>

                    <div class="col down">
                        <i class="fa-solid fa-angle-down"></i> <a href="<?= URL ?>/dashboard/alunos/avaliacoes?student=<?= $_GET['student'] ?>&order=old#all-exams">Mais antigas</a>
                    </div>
                </nav>


                <div class="list-exam">
                    <?php foreach($this->data['all-exam'] as $exam): ?>
                        <article>
                            <div class="exam">
                                <!-- Titulo -->
                                <h3><?= $exam['counter'] ?>° avaliação</h3>

                                <!-- Data -->
                                <p><?= $exam['dateExam'] ?></p>

                                <!-- Botoes -->
                                <div class="exams-btns">
                                    <!-- Visualizar -->
                                    <a href="<?= URL ?>/dashboard/alunos/avaliacao?student=<?= $_GET['student'] ?>&exam=<?= $exam['id'] ?>&counter=<?= $exam['counter'] ?>" class="btn btn-view">
                                        <i class="fa-solid fa-eye"></i> Visualizar
                                    </a>
                                    
                                    <!-- Alterar -->
                                    <a href="<?= URL ?>/dashboard/alunos/avaliacao/alterar?student=<?= $_GET['student'] ?>&exam=<?= $exam['id'] ?>" class="btn btn-alter">
                                        <i class="fa-solid fa-pencil"></i> Alterar
                                    </a>

                                    <!-- Deletar -->
                                    <button class="btn btn-delete"><i class="fa-solid fa-trash"></i> Excluir</button>
                                </div>
                            </div>

                            <!-- Overlay de EXLUIR exame -->
                            <div class="overlay close-overlay">
                                <div class="main-box close-box">
                                    <h2>Deseja excluir avaliação?</h2>
                                                        
                                    <div class="box">
                                        <button class="btn-close-overlay">
                                            <i class="fa-solid fa-angle-left"></i> Voltar
                                        </button>
                                            
                                        <form action="<?= URL ?>/dashboard/alunos/avaliacoes?student=<?= $_GET['student'] ?>" method="POST">
                                            <input type="hidden" name="delete-exam">
                                            <input type="hidden" name="id" value="<?= $exam['id'] ?>">
                                            
                                            <div class="mini-box">
                                                <!-- data -->
                                                <div class="date">
                                                    <h6>Data do exame</h6>
                                                    <p><?= $exam['dateExam'] ?></p>
                                                </div>
                                            </div><!-- Fim div .mini-box -->
                                            
                                            <button class="btn-standard-form">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- Fim div .overlay -->
                        </article>
                    <?php endforeach ?>
                </div><!-- Fim div .exams-box -->
            </div><!-- Fim div .exams -->
        </section>
    <?php endif ?>
</div><!-- Fim div #main-dash-exams -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/exam.js"></script>

<script>
    boxFilter('#main-dash-exams #nav-top .filter')
    deleteLastExam()
    deleteExam()
</script>