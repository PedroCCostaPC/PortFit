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
            Alunos
        </div>
    </h1>
</div>

<div id="main-dash-students" class="container">
    <nav class="add-and-students">
        <!-- BTN ADD -->
        <a href="<?= URL ?>/dashboard/alunos/adicionar" class="btn-standard-add">
            + Adicionar aluno
        </a>
    </nav>


    <!-- /////////////////////////// ALUNOS /////////////////////////// -->
    <div class="search-filter">
        <form action="<?= URL ?>/dashboard/alunos" method="GET">
            <input type="text" name="search" placeholder="Buscar aluno ( Nome ou RG )">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <nav class="filter open">
            <button class="btn-open-filter">Filtrar <i class="fa-solid fa-chevron-up"></i></button>

            <ul>
                <!-- A-Z -->
                <li>
                    <a href="<?= URL ?>/dashboard/alunos?filter=A-Z">A-Z</a>
                </li>
                <!-- Z-A -->
                <li>
                    <a href="<?= URL ?>/dashboard/alunos?filter=Z-A">Z-A</a>
                </li>
                <!-- Ativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/alunos?filter=active">Ativos</a>
                </li>
                <!-- Inativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/alunos?filter=inactive">Inativos</a>
                </li>
                <!-- Limpar filtros -->
                <li>
                    <a href="<?= URL ?>/dashboard/alunos">Limpar</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Resultado da busca -->
    <?php if(isset($this->data['count-search'])): ?>
        <div class="result-search">
            <p>Voce pesquisou por: <span><?= $_GET['search'] ?></span></p>
            <p><?= $this->data['count-search'] ?> resultados</p>
        </div>

        <!-- Caso nada encontrado -->
        <?php if($this->data['count-search'] === 0): ?>
            <h1 class="title title-search-result">
                <div>
                    Não encontramos nenhum resultado na sua busca!
                </div>
            </h1>
        <?php endif ?>
    <?php endif ?>

    <!-- Lista de alunos -->
    <section id="students">
        <!-- Paginacao -->
        <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>

        <?php foreach($this->data['students'] as $student): ?>
            <article>
                <div class="article <?= $student['situation'] ?>">
                    <!-- Banner / nome -->
                    <div class="banner-name">
                        <?php if($student['photo']): ?>
                            <div class="banner" style="background-image: url(<?= URL ?>/assets/img/students/<?= $student['photo'] ?>);"></div>
                        <?php else: ?>
                            <div class="banner" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
                        <?php endif ?>
            
                        <div class="name">
                            <h2><?= $student['fullName'] ?></h2>
                        </div>
                    </div>

                    <!-- Botoes -->
                    <div class="btns-standard-alter">
                        <!-- Rascunho -->
                        <form action="#" method="POST">
                            <input type="hidden" name="situation-student">
                            <input type="hidden" name="id" value="<?= $student['id'] ?>">
                            <button class="btn-standard btn-sketch"><i class="fa-solid fa-paperclip"></i></button>
                        </form>

                        <!-- Perfio -->
                        <a class="btn-standard btn-profile" href="<?= URL ?>/dashboard/alunos/perfio?student=<?= $student['id'] ?>">
                            <i class="fa-solid fa-user"></i>
                        </a>

                        <!-- Alterar -->
                        <a class="btn-standard btn-alter" href="<?= URL ?>/dashboard/alunos/alterar?student=<?= $student['id'] ?>">
                            <i class="fa-solid fa-pencil"></i>
                        </a>

                        <!-- Apagar -->
                        <button class="btn-standard btn-delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>

                </div><!-- Fim div .article -->
                
                <!-- Overlay de EXLUIR preco -->
                <div class="overlay close-overlay">
                    <div class="main-box close-box">
                        <h2>Deseja excluir <span><?= $student['fullName'] ?>?</span></h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="#" method="POST">
                                <input type="hidden" name="delete-student">
                                <input type="hidden" name="id" value="<?= $student['id'] ?>">
    
                                <div class="mini-box">
                                    <!-- Foto -->
                                    <?php if($student['photo']): ?>
                                        <div class="photo" style="background-image: url(<?= URL ?>/assets/img/students/<?= $student['photo'] ?>);"></div>
                                    <?php else: ?>
                                        <div class="photo" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
                                    <?php endif ?>

                                    <!-- Aviso -->
                                    <div class="warning">
                                        <p>
                                            Isso irá remover <span>PERMANENTEMENTE</span> o aluno do sistema!
                                        </p>
                                        <p>
                                            Tamém irá remover todos os <b>treinos</b>, <b>exames</b>, <b>alimentação</b>, e <b>suplementação</b> de <small><?= $student['fullName'] ?></small>.
                                        </p>
                                    </div>
                                </div><!-- Fim div .mini-box -->
    
                                <button class="btn-standard-form">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div><!-- Fim div .overlay -->
            </article>
        <?php endforeach ?>

        <!-- Paginacao -->
        <div class="pagenation-bottom">
            <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>
        </div>
    </section>
</div><!-- Fim div #main-academy-students -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/students.js"></script>

<script>
    boxFilter('#main-dash-students .search-filter .filter')
    deleteStudent()
</script>