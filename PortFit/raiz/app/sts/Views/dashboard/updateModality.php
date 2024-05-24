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
        background: <?= PRIMARY_COLOR ?>;
        border-color: <?= PRIMARY_COLOR ?>;
    }

    .mini-nav-dash ul li:nth-child(2) a:hover {
        background: transparent;
        border-color: <?= SECONDARY_COLOR ?>;
    }


    /* Mini nav (dia da semana) - marcacao da page */
    .mini-nav-dash-week ul li .page {
        color: <?= PRIMARY_COLOR ?> !important;
        text-decoration: underline;
    }
</style>


<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Alterar <span><?= $this->data['name'] ?></span>
        </div>
    </h1>
</div>


<div id="main-academy-modality" class="container">
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


    <!-- FORM DA MODALIDADE -->
    <section id="form-modality">
        <form class="form-standard" action="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=1" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="update-modality">

            <!-- Nome -->
            <div class="row start-js">
                <label for="name">* Nome</label>
                <input type="text" id="name" name="name" value="<?= $this->data['name'] ?>">
            </div>

            <!-- Banner -->
            <div class="banner">
                <div id="banner-modality" class="img">
                    <img src="<?= URL ?>/assets/img/modalities/<?= $this->data['banner'] ?>">
                </div>

                <div class="btn-file">
                    <label for="banner">
                        <i class="fa-regular fa-image"></i> Alterar Banner
                    </label>
                    <input id="banner" type="file" accept="image/*" name="banner">
                </div>
            </div>

            <!-- Resumo -->
            <div class="row start-js">
                <label for="summary">* Resumo</label>
                <textarea name="summary" id="summary" cols="100" rows="10"><?= $this->data['summary'] ?></textarea>
                <small class="max-character">Máximo 250 caracteres.</small>
            </div>
            
            <!-- Frase -->
            <div class="row start-js">
                <label for="phrase">* Frase</label>
                <input type="text" id="phrase" name="phrase" value="<?= $this->data['phrase'] ?>">
                <small class="max-character">Máximo 100 caracteres.</small>
            </div>

            <!-- Como é a aula -->
            <h1 class="title">
                <div>
                    Como é uma aula?
                </div>
            </h1>

            <div class="row start-js">
                <label for="about">* Como são as aulas?</label>
                <textarea name="about" id="about" cols="100" rows="10"><?= $this->data['about'] ?></textarea>
                <small class="max-character">Máximo 1500 caracteres.</small>
            </div>

            <!-- Por que fazer a aula -->
            <h1 class="title">
                <div>
                    Por que fazer a aula?
                </div>
            </h1>

            <div class="row start-js">
                <label for="whyte">* Por que fazer essa modalidade?</label>
                <textarea name="whyte" id="whyte" cols="100" rows="10"><?= $this->data['whyte'] ?></textarea>
                <small class="max-character">Máximo 1500 caracteres.</small>
            </div>

            <!-- Imagem -->
            <div class="banner">
                <div id="image-modality" class="img">
                    <img src="<?= URL ?>/assets/img/modalities/<?= $this->data['image'] ?>">
                </div>

                <div class="btn-file">
                    <label for="image">
                        <i class="fa-regular fa-image"></i> Alterar imagem
                    </label>
                    <input id="image" type="file" accept="image/*" name="image">
                </div>
            </div>

            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>


    <!-- HORARIOS DA MODALIDADE -->
    <section id="time-modality">
        <h2 class="h2-academy-information">Horários - <span>opcional</span></h2>

        <!-- NAV DE OPCOES DA SEMANA -->
        <nav class="mini-nav-dash-week">
            <ul>
                <!-- Segunda -->
                <li>
                    <?php if($_GET['day'] == 1): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=1#time-modality">Segunda-Feira 
                            <?php if($this->data['count-monday']): ?>
                                (<?= $this->data['count-monday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=1#time-modality">Segunda-Feira 
                            <?php if($this->data['count-monday']): ?>
                                (<?= $this->data['count-monday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>

                <li class="bar">|</li>

                <!-- Terca -->
                <li>
                    <?php if($_GET['day'] == 2): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=2#time-modality">Terça-Feira 
                            <?php if($this->data['count-tuesday']): ?>
                                (<?= $this->data['count-tuesday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=2#time-modality">Terça-Feira 
                            <?php if($this->data['count-tuesday']): ?>
                                (<?= $this->data['count-tuesday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>

                <li class="bar">|</li>

                <!-- Quarta -->
                <li>
                    <?php if($_GET['day'] == 3): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=3#time-modality">Quarta-Feira 
                            <?php if($this->data['count-wednesday']): ?>
                                (<?= $this->data['count-wednesday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=3#time-modality">Quarta-Feira 
                            <?php if($this->data['count-wednesday']): ?>
                                (<?= $this->data['count-wednesday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>

                <li class="bar">|</li>

                <!-- Quinta -->
                <li>
                    <?php if($_GET['day'] == 4): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=4#time-modality">Quinta-Feira 
                            <?php if($this->data['count-thursday']): ?>
                                (<?= $this->data['count-thursday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=4#time-modality">Quinta-Feira 
                            <?php if($this->data['count-thursday']): ?>
                                (<?= $this->data['count-thursday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>

                <li class="bar">|</li>

                <!-- Sexta -->
                <li>
                    <?php if($_GET['day'] == 5): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=5#time-modality">Sexta-Feira 
                            <?php if($this->data['count-friday']): ?>
                                (<?= $this->data['count-friday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=5#time-modality">Sexta-Feira 
                            <?php if($this->data['count-friday']): ?>
                                (<?= $this->data['count-friday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>

                <li class="bar">|</li>

                <!-- Sabado -->
                <li>
                    <?php if($_GET['day'] == 6): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=6#time-modality">Sábado 
                            <?php if($this->data['count-saturday']): ?>
                                (<?= $this->data['count-saturday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=6#time-modality">Sábado 
                            <?php if($this->data['count-saturday']): ?>
                                (<?= $this->data['count-saturday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>

                <li class="bar">|</li>

                <!-- Domingo -->
                <li>
                    <?php if($_GET['day'] == 0): ?>
                        <a class="page" href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=0#time-modality">Domingo 
                            <?php if($this->data['count-sunday']): ?>
                                (<?= $this->data['count-sunday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=0#time-modality">Domingo 
                            <?php if($this->data['count-sunday']): ?>
                                (<?= $this->data['count-sunday'] ?>)
                            <?php endif ?>
                        </a>
                    <?php endif ?>
                </li>
            </ul>
        </nav>


        <!-- ///////////////// FORM ///////////////// -->
        <form action="<?= URL ?>/dashboard/modalidades/alterar?key=<?= $this->data['id'] ?>&day=<?= $_GET['day'] ?>#time-modality" method="POST">
            <input type="hidden" name="update-time">

            <!-- DIA -->
            <div class="row">
                
                <div class="day-add">
                    <label><?= $this->data['day-format'] ?></label>
                    <button class="btn-add" type="button">+</button>
                </div>
                
                <?php if($this->data['time']): ?>
                    <?php foreach($this->data['time'] as $time): ?>
                        <article>
                            <input type="hidden" name="id[]" value="<?= $time['id'] ?>">

                            <button type="button">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <input type="number" name="open-hour[]" value="<?= $time['open-hour'] ?>" placeholder="Hora"> : 
                            <input type="number" name="open-minute[]" value="<?= $time['open-minute'] ?>" placeholder="Min">
        
                            <span>-</span>
                            
                            <input type="number" name="close-hour[]" value="<?= $time['close-hour'] ?>" placeholder="Hora"> : 
                            <input type="number" name="close-minute[]" value="<?= $time['close-minute'] ?>" placeholder="Min">
                        </article><!-- Fim article .time -->
                    <?php endforeach ?>
                <?php else: ?>
                    <article>
                        <button type="button">
                            <i class="fa-solid fa-trash"></i>
                        </button>
    
                        <input type="number" name="open-hour[]" placeholder="Hora"> : 
                        <input type="number" name="open-minute[]" placeholder="Min">
        
                        <span>-</span>
                            
                        <input type="number" name="close-hour[]" placeholder="Hora"> : 
                        <input type="number" name="close-minute[]" placeholder="Min">
                    </article><!-- Fim article .time -->
                <?php endif ?>
            </div><!-- Fim div .row -->


            <button class="btn-standard-form">Salvar</button>
        </form>

    </section>

</div><!-- Fim div #main-academy-modality -->



<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/academyModality.js"></script>

<script>
    formLabelInput('#form-modality form')
    previewIMG('#banner', '#banner-modality')
    previewIMG('#image', '#image-modality')
    validateModality()
    addTime()
    deleteTime()
</script>