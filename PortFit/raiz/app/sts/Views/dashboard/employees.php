<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(7) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(7) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Funcionários
        </div>
    </h1>
</div>

<div id="main-dash-employees" class="container">
    <nav class="add-and-employees">
        <!-- BTN ADD -->
        <a href="<?= URL ?>/dashboard/funcionarios/adicionar" class="btn-standard-add">
            + Adicionar funcionário
        </a>
    </nav>

    <!-- /////////////////////////// FUNCIONARIOS /////////////////////////// -->
    <div class="search-filter">
        <form action="<?= URL ?>/dashboard/funcionarios" method="GET">
            <input type="text" name="search" placeholder="Buscar funcionário ( Nome ou RG )">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <nav class="filter open">
            <button class="btn-open-filter">Filtrar <i class="fa-solid fa-chevron-up"></i></button>

            <ul>
                <!-- A-Z -->
                <li>
                    <a href="<?= URL ?>/dashboard/funcionarios?filter=A-Z">A-Z</a>
                </li>
                <!-- Z-A -->
                <li>
                    <a href="<?= URL ?>/dashboard/funcionarios?filter=Z-A">Z-A</a>
                </li>
                <!-- Ativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/funcionarios?filter=active">Ativos</a>
                </li>
                <!-- Inativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/funcionarios?filter=inactive">Inativos</a>
                </li>
                <!-- Limpar filtros -->
                <li>
                    <a href="<?= URL ?>/dashboard/funcionarios">Limpar</a>
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


    <!-- Lista de funcionarios -->
    <section id="employees">
        <!-- Paginacao -->
        <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>

        <?php foreach($this->data['employees'] as $employee): ?>
            <article>
                <div class="article <?= $employee['situation'] ?>">
                    <!-- Banner / nome -->
                    <div class="banner-name">
                        <?php if($employee['photo']): ?>
                            <div class="banner" style="background-image: url(<?= URL ?>/assets/img/employees/<?= $employee['photo'] ?>);"></div>
                        <?php else: ?>
                            <div class="banner" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
                        <?php endif ?>
            
                        <div class="name">
                            <h2><?= $employee['fullName'] ?></h2>

                            <p><?= $employee['position'] ?></p>
                        </div>
                    </div>

                    <!-- Botoes -->
                    <div class="btns-standard-alter">
                        <!-- Rascunho -->
                        <form action="#" method="POST">
                            <input type="hidden" name="situation-employee">
                            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                            <button class="btn-standard btn-sketch"><i class="fa-solid fa-paperclip"></i></button>
                        </form>

                        <!-- Alterar -->
                        <a class="btn-standard btn-alter" href="<?= URL ?>/dashboard/funcionarios/alterar?employee=<?= $employee['id'] ?>">
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
                        <h2>Deseja excluir <span><?= $employee['fullName'] ?>?</span></h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="#" method="POST">
                                <input type="hidden" name="delete-employee">
                                <input type="hidden" name="id" value="<?= $employee['id'] ?>">
    
                                <div class="mini-box">
                                    <!-- Foto -->
                                    <?php if($employee['photo']): ?>
                                        <div class="photo" style="background-image: url(<?= URL ?>/assets/img/employees/<?= $employee['photo'] ?>);"></div>
                                    <?php else: ?>
                                        <div class="photo" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
                                    <?php endif ?>

                                    <!-- Aviso -->
                                    <div class="warning">
                                        <p>
                                            Isso irá remover <span>PERMANENTEMENTE</span> o funcionário do sistema!
                                        </p>
                                        <p>
                                            Tamém irá remover todos os <b>posts do blog</b> criado por <small><?= $employee['fullName'] ?></small>.
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
</div><!-- Fim div #main-academy-employees -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/employees.js"></script>

<script>
    boxFilter('#main-dash-employees .search-filter .filter')
    deleteEmployee()
</script>