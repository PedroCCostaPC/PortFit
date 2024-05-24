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
            Exercícios
        </div>
    </h1>
</div>

<div id="main-dash-exercises" class="container">
    <nav class="add-and-category">
        <!-- BTN ADD -->
        <a href="<?= URL ?>/dashboard/exercicios/adicionar" class="btn-standard-add">
            + Adicionar exercício
        </a>
    
        <!-- BTN CATEGORIAS -->
        <button class="btn-open-category">Categorias</button>
    </nav>

    <!-- /////////////////////////// CATEGORIAS /////////////////////////// -->
    <section id="categories" class="close">
        <button class="btn-close-overlay">
            Fechar
        </button>

        <div>
            <?php foreach($this->data['categories'] as $category): ?>
                <article>
                    <form action="#" method="POST">
                        <input type="hidden" name="update-category">
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
    
                        <input type="text" name="name" value="<?= $category['name'] ?>">
                        <button class="update">Alterar</button>
                    </form>
    
                    <?php if(!$category['using']): ?>
                        <form id="form-delete" action="#" method="POST">
                            <input type="hidden" name="delete-category">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
    
                            <button class="btn-standard btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    <?php endif ?>
                    <br><br>
                </article>
            <?php endforeach ?>
        </div>
    </section>

    <!-- /////////////////////////// EXERCICIOS /////////////////////////// -->
    <!-- Busca e filtros -->
    <div class="search-filter">
        <form action="<?= URL ?>/dashboard/exercicios" method="GET">
            <input type="text" name="search" placeholder="Buscar exercício">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <nav class="filter open">
            <button class="btn-open-filter">Filtrar <i class="fa-solid fa-chevron-up"></i></button>

            <ul>
                <!-- A-Z -->
                <li>
                    <a href="<?= URL ?>/dashboard/exercicios?filter=A-Z">A-Z</a>
                </li>
                <!-- Z-A -->
                <li>
                    <a href="<?= URL ?>/dashboard/exercicios?filter=Z-A">Z-A</a>
                </li>
                <!-- Ativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/exercicios?filter=active">Ativos</a>
                </li>
                <!-- Inativos -->
                <li>
                    <a href="<?= URL ?>/dashboard/exercicios?filter=inactive">Inativos</a>
                </li>
                <!-- Limpar filtros -->
                <li>
                    <a href="<?= URL ?>/dashboard/exercicios">Limpar</a>
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

    <!-- Lista de exercicios -->
    <section id="exercises">
        <!-- Paginacao -->
        <?php require(dirname(__FILE__, 2) . '/layout/pagination.php') ?>

        <?php foreach($this->data['exercise'] as $exercise): ?>
            <article>
                <div class="article <?= $exercise['class-situation'] ?>">
                    <!-- Banner / nome / categoria -->
                    <div class="banner-name-category">
                        <div class="banner" style="background-image: url(<?= URL ?>/assets/img/exercises/<?= $exercise['banner'] ?>);"></div>
        
                        <div class="name-category">
                            <h2><?= $exercise['name'] ?></h2>
        
                            <p>Categoria: <span><?= $exercise['category'] ?></span></p>
                        </div>
                    </div>
        
                    <!-- Botoes -->
                    <div class="btns-standard-alter">
                        <!-- Rascunho -->
                        <form action="#" method="POST">
                            <input type="hidden" name="situation-exercise">
                            <input type="hidden" name="id" value="<?= $exercise['id'] ?>">
                            <button class="btn-standard btn-sketch"><i class="fa-solid fa-paperclip"></i></button>
                        </form>

                        <!-- Alterar -->
                        <a class="btn-standard btn-alter" href="<?= URL ?>/dashboard/exercicios/alterar?key=<?= $exercise['id'] ?>">
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
                        <h2>Deseja excluir <span><?= $exercise['name'] ?>?</span></h2>
                
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>
    
                            <form action="#" method="POST">
                                <input type="hidden" name="delete-exercise">
                                <input type="hidden" name="id" value="<?= $exercise['id'] ?>">
    
                                <div class="mini-box">
                                    <!-- Banner -->
                                    <div class="price">
                                        <img src="<?= URL ?>/assets/img/exercises/<?= $exercise['banner'] ?>">
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

</div><!-- Fim div #main-dash-exercises -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/exercises.js"></script>

<script>
    boxFilter('#main-dash-exercises .search-filter .filter')
    deleteExercise()
    openCategories()
</script>
