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
        background: transparent;
    }
</style>


<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Academia <span>Preços</span>
        </div>
    </h1>
</div>

<div id="main-academy-prices" class="container">
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

    <!-- BTN ADD -->
    <a href="<?= URL ?>/dashboard/precos/adicionar" class="btn-standard-add">
        + Adicionar preço
    </a>


    <!-- LISTA DOS PRECOS -->
    <section>
        <!-- PRECO DESTACADO -->
        <?php foreach($this->data['prices'] as $price): ?>
            <?php if($price['emphasis']): ?>
                <article class="emphasis">
                    <div class="article <?= $price['situation-class'] ?>">
                        <div class="emphasis-title">
                            <p>Preço em destaque</p>
                        </div>
        
                        <!-- Icon e nome -->
                        <div class="name">
                            <div class="price-icon <?= $price['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $price['icon'] ?>);">
                                <?php if($price['month']): ?>
                                    <p><?= $price['time'] ?>M</p>
                                <?php else: ?>
                                    <p><?= $price['time'] ?></p>
                                <?php endif ?>
                            </div>
    
                            <h2><?= $price['name'] ?></h2>
                        </div>
        
                        <!-- Valor -->
                        <div class="price">
                            <p>
                                R$ <span><?= $price['real'] ?></span>,<?= $price['penny'] ?>
                            </p>
                        </div>
        
                        <!-- Botoes -->
                        <div class="btns-standard-alter">
                            <!-- Descatar -->
                            <form action="<?= URL ?>/dashboard/precos" method="POST">
                                <input type="hidden" name="emphasis-price">
                                <input type="hidden" name="id" value="<?= $price["id"] ?>">
                                <button class="btn-standard btn-emphasis"><i class="fa-solid fa-star"></i></button>
                            </form>
    
                            <!-- Rascunho -->
                            <form action="<?= URL ?>/dashboard/precos" method="POST">
                                <input type="hidden" name="situation-price">
                                <input type="hidden" name="id" value="<?= $price["id"] ?>">
                                <button class="btn-standard btn-sketch"><i class="fa-solid fa-paperclip"></i></button>
                            </form>
    
                            <!-- Alterar -->
                            <a class="btn-standard btn-alter" href="<?= URL ?>/dashboard/precos/alterar?key=<?= $price['id'] ?>">
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
                            <h2>Deseja excluir Preço?</h2>
                    
                            <div class="box">
                                <button class="btn-close-overlay">
                                    <i class="fa-solid fa-angle-left"></i> Voltar
                                </button>
        
                                <form action="<?= URL ?>/dashboard/precos" method="POST">
                                    <input type="hidden" name="delete-price">
                                    <input type="hidden" name="id" value="<?= $price["id"] ?>">
        
                                    <div class="mini-box">
                                        <!-- Nome -->
                                        <div class="name">
                                            <div class="price-icon <?= $price['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $price['icon'] ?>);">
                                                <?php if($price['month']): ?>
                                                    <p><?= $price['time'] ?>M</p>
                                                <?php else: ?>
                                                    <p><?= $price['time'] ?></p>
                                                <?php endif ?>
                                            </div>

                                            <h2><?= $price['name'] ?></h2>
                                        </div>

                                        <!-- Valor -->
                                        <div class="price">
                                            <p>
                                                R$ <span><?= $price['real'] ?></span>,<?= $price['penny'] ?>
                                            </p>
                                        </div>
                                    </div><!-- Fim div .mini-box -->
        
                                    <button class="btn-standard-form">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- Fim div .overlay -->
    
                </article>
            <?php endif ?>
        <?php endforeach ?>

        <!-- PRECOS NORMAIS -->
        <?php foreach($this->data['prices'] as $price): ?>
            <?php if(!$price['emphasis']): ?>
                <article>
                    <div class="article <?= $price['situation-class'] ?>">
                        <!-- Icon e nome -->
                        <div class="name">
                            <div class="price-icon <?= $price['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $price['icon'] ?>);">
                                <?php if($price['month']): ?>
                                    <p><?= $price['time'] ?>M</p>
                                <?php else: ?>
                                    <p><?= $price['time'] ?></p>
                                <?php endif ?>
                            </div>
    
                            <h2><?= $price['name'] ?></h2>
                        </div>
        
                        <!-- Valor -->
                        <div class="price">
                            <p>
                                R$ <span><?= $price['real'] ?></span>,<?= $price['penny'] ?>
                            </p>
                        </div>
        
                        <!-- Botoes -->
                        <div class="btns-standard-alter">
                            <!-- Descatar -->
                            <form action="<?= URL ?>/dashboard/precos" method="POST">
                                <input type="hidden" name="emphasis-price">
                                <input type="hidden" name="id" value="<?= $price["id"] ?>">
                                <button class="btn-standard btn-emphasis"><i class="fa-solid fa-star"></i></button>
                            </form>
    
                            <!-- Rascunho -->
                            <form action="<?= URL ?>/dashboard/precos" method="POST">
                                <input type="hidden" name="situation-price">
                                <input type="hidden" name="id" value="<?= $price["id"] ?>">
                                <button class="btn-standard btn-sketch"><i class="fa-solid fa-paperclip"></i></button>
                            </form>
    
                            <!-- Alterar -->
                            <a class="btn-standard btn-alter" href="<?= URL ?>/dashboard/precos/alterar?key=<?= $price['id'] ?>">
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
                            <h2>Deseja excluir Preço?</h2>
                    
                            <div class="box">
                                <button class="btn-close-overlay">
                                    <i class="fa-solid fa-angle-left"></i> Voltar
                                </button>
        
                                <form action="<?= URL ?>/dashboard/precos" method="POST">
                                    <input type="hidden" name="delete-price">
                                    <input type="hidden" name="id" value="<?= $price["id"] ?>">
        
                                    <div class="mini-box">
                                        <!-- Nome -->
                                        <div class="name">
                                            <div class="price-icon <?= $price['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $price['icon'] ?>);">
                                                <?php if($price['month']): ?>
                                                    <p><?= $price['time'] ?>M</p>
                                                <?php else: ?>
                                                    <p><?= $price['time'] ?></p>
                                                <?php endif ?>
                                            </div>

                                            <h2><?= $price['name'] ?></h2>
                                        </div>

                                        <!-- Valor -->
                                        <div class="price">
                                            <p>
                                                R$ <span><?= $price['real'] ?></span>,<?= $price['penny'] ?>
                                            </p>
                                        </div>
                                    </div><!-- Fim div .mini-box -->
        
                                    <button class="btn-standard-form">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- Fim div .overlay -->
                </article>
            <?php endif ?>
        <?php endforeach ?>
    </section>
</div><!-- Dim div #main-academy-prices -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/academyPrice.js"></script>

<script>
    deletePrice()
</script>
