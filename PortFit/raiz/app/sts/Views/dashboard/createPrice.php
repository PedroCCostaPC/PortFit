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
    .mini-nav-dash ul li:last-child a {
        color: <?= SECONDARY_COLOR ?>;
        background: <?= PRIMARY_COLOR ?>;
        border-color: <?= PRIMARY_COLOR ?>;
    }

    .mini-nav-dash ul li:last-child a:hover {
        background: transparent;
        border-color: <?= SECONDARY_COLOR ?>;
    }
</style>


<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Adicionar <span>Preço</span>
        </div>
    </h1>
</div>


<div id="main-academy-price" class="container">
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


    <!-- FORMUALRIO -->
    <section>
        <form class="form-standard" action="<?= URL ?>/dashboard/precos/adicionar" method="POST">
            <input type="hidden" name="create-price">

            <!-- Nome -->
            <div class="row start-js">
                <label for="name">* Nome do plano</label>
                <input type="text" id="name" name="name">
            </div>
    
            <!-- Tempo e Preco -->
            <div class="row time-price">
                <div class="time start-js">
                    <label for="time">* Tempo</label>
                    <input type="number" id="time" name="time">
                </div>
    
                <div class="price start-js">
                    <label for="price">* Preço</label>
                    <input type="number" id="price" name="price" step="0.01">
                </div>
            </div>

            <!-- MES OU ANO -->
            <div class="radio">
                <div class="col">
                    <div class="col-2">
                        <label for="month">
                            <input type="radio" id="month" name="month" value="1" checked>

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Mês</span>
                        </label>
                    </div>

                    <div class="col-2">
                        <label for="year">
                            <input type="radio" id="year" name="month" value="0">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Ano</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Produtos -->
            <div id="products">
                <div class="prod-row">
                    <button type="button" class="btn-delete-product">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <input class="scheme-js" type="text" name="scheme[]">
                </div>
            </div>

            <button type="button" id="btn-add-product">
                <span>+</span> <small>Adicionar itens</small>
            </button>


            <button class="btn-standard-form btn-send-js">Salvar</button>
        </form>
    </section>
</div><!-- Fim div #main-academy-price -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/academyPrice.js"></script>

<script>
    formLabelInput('#main-academy-price section form')
    deleteScheme()
    addScheme()
    validatePrice()
</script>