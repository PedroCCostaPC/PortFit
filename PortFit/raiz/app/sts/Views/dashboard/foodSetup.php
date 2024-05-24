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
            Montar alimentação <?= $this->data['pronoun'] ?> <span><?= $this->data['student']['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-setup-food" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/alunos/alimentacao?student=<?= $_GET['student'] ?>" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>
    
        <?php require_once(dirname(__FILE__, 2) . '/layout/optionsStudent.php'); ?>
    </div>

    <!-- NAV DE OPCOES DA SEMANA -->
    <nav class="week-nav-dash">
        <ul>
            <!-- Segunda Feira -->
            <li>
                <a class="<?= $this->data['day-class'][1] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>">
                    Segunda-Feira (<?= $this->data['counterDay'][1] ?>)
                </a>
            </li>

            <!-- Treca Feira -->
            <li>
                <a class="<?= $this->data['day-class'][2] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>&day=2">
                    Terça-Feira (<?= $this->data['counterDay'][2] ?>)
                </a>
            </li>

            <!-- Quarta Feira -->
            <li>
                <a class="<?= $this->data['day-class'][3] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>&day=3">
                    Quarta-Feira (<?= $this->data['counterDay'][3] ?>)
                </a>
            </li>

            <!-- Quinta Feira -->
            <li>
                <a class="<?= $this->data['day-class'][4] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>&day=4">
                    Quinta-Feira (<?= $this->data['counterDay'][4] ?>)
                </a>
            </li>

            <!-- Sexta Feira -->
            <li>
                <a class="<?= $this->data['day-class'][5] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>&day=5">
                    Sexta-Feira (<?= $this->data['counterDay'][5] ?>)
                </a>
            </li>

            <!-- Sabado -->
            <li>
                <a class="<?= $this->data['day-class'][6] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>&day=6">
                    Sábado (<?= $this->data['counterDay'][6] ?>)
                </a>
            </li>

            <!-- Domingo -->
            <li>
                <a class="<?= $this->data['day-class'][0] ?>" href="<?= URL ?>/dashboard/alunos/alimentacao/montar?student=<?= $_GET['student'] ?>&day=0">
                    Domingo (<?= $this->data['counterDay'][0] ?>)
                </a>
            </li>
        </ul>
    </nav>

    <!-- Titulo do dia -->
    <h2 class="title-day">
        <?= $this->data['day'] ?>
    </h2>

    <div id="titles">
        <p class="time-title">Horário</p>
        <p class="food-title">Refeições</p>
    </div>

    <form action="#" method="POST">
        <input type="hidden" name="create-food">

        <!-- REFEICOES RETORNADAS -->
        <section id="previous-food">
            <?php foreach($this->data['all-food'] as $food): ?>
                <article class="box">
                    <input type="hidden" name="food-id[]" value="<?= $food['id'] ?>">

                    <!-- BTN-trash / Horario -->
                    <div class="trash-time">
                        <button type="button" class="btn-trash"><i class="fa-solid fa-trash"></i></button>

                        <input type="number" name="previous-hour[]" value="<?= $food['hour'] ?>" placeholder="H">
                        <span>:</span> 
                        <input type="number" name="previous-minute[]" value="<?= $food['minute'] ?>" placeholder="M">
                    </div>

                    <!-- Refeicao -->
                    <div class="food">
                        <textarea name="previous-food[]" cols="70" rows="10"><?= $food['food'] ?></textarea>
                    </div>
                </article>
            <?php endforeach ?>
        </section>

        <!-- NOVAS REFEICOES -->
        <div id="box-new-food">
            <section id="new-food"></section>
            <button type="button" class="add-food">+ Adicionar refeição</button>
            <button class="btn-standard-form">Salvar</button>
        </div>

        
    </form>
</div><!-- Fim div #main-dash-setup-food -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/dashboard/food.js"></script>

<script>
    boxFilter('#main-dash-setup-food #nav-top .filter')
    removeFood('#previous-food', '.box', '.btn-trash')
    createFood('#new-food', '#box-new-food .add-food', 'food')
</script>