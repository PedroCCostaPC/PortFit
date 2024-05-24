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
            Alterar <span><?= $this->data['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-student" class="container">
    <!-- BTN Voltar -->
    <a href="<?= URL ?>/dashboard/alunos" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>

    <!-- FORMULARIO -->
    <section id="form-student">
        <form class="form-standard" action="<?= URL ?>/dashboard/alunos/alterar?student=<?= $_GET['student'] ?>" method="POST">
            <input type="hidden" name="update-student">

            <!-- Foto -->
            <div id="photo" class="row">
                <?php if($this->data['photo']): ?>
                    <input id="remove-photo" type="hidden" name="remove-photo" value="0">

                    <div class="photo" style="background-image: url(<?= URL ?>/assets/img/students/<?= $this->data['photo'] ?>);"></div>

                    <button type="button">
                        <i class="fa-solid fa-trash"></i> Remover foto
                    </button>
                <?php else: ?>
                    <div class="photo" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
                <?php endif ?>
            </div>

            <!-- Nome -->
            <div class="row start-js">
                <label for="first-name">* Nome</label>
                <input type="text" id="first-name" name="first-name" value="<?= $this->data['firstName'] ?>">
            </div>

            <!-- Sobrenome -->
            <div class="row start-js">
                <label for="last-name">* Sobrenome</label>
                <input type="text" id="last-name" name="last-name" value="<?= $this->data['lastName'] ?>">
            </div>

            <!-- Data de Nascimento -->
            <div class="row birth">
                <label>* data de nascimento</label>

                <div class="col">
                    <input id="day" type="number" name="day" placeholder="Dia" value="<?= $this->data['day'] ?>">
                    <input id="month" type="number" name="month" placeholder="Mês" value="<?= $this->data['month'] ?>">
                    <input id="year" type="number" name="year" placeholder="Ano" value="<?= $this->data['year'] ?>">
                </div>
            </div>

            <!-- Sexo -->
            <div class="radio sex">
                <p>* Sexo</p>

                <div class="col">
                    <div class="col-2">
                        <label for="feminine">
                            <?php if(!$this->data['sex']): ?>
                                <input type="radio" id="feminine" name="sex" value="0" checked>
                            <?php else: ?>
                                <input type="radio" id="feminine" name="sex" value="0">
                            <?php endif ?>

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Feminino</span>
                        </label>
                    </div>

                    <div class="col-2">
                        <label for="masculine">
                            <?php if($this->data['sex']): ?>
                                <input type="radio" id="masculine" name="sex" value="1" checked>
                            <?php else: ?>
                                <input type="radio" id="masculine" name="sex" value="1">
                            <?php endif ?>

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Masculino</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- RG -->
            <div class="row start-js">
                <label for="rg">* RG</label>
                <input type="text" id="rg" name="rg" value="<?= $this->data['rg'] ?>">
            </div>

            <!-- E-Mail -->
            <div class="row start-js">
                <label for="email">* E-Mail</label>
                <input type="email" id="email" name="email" value="<?= $this->data['email'] ?>">
            </div>

            <!-- Telefone -->
            <div class="row phone">
                <div class="ddd start-js">
                    <label for="ddd">DDD</label>
                    <input id="ddd" type="text" name="ddd" value="<?= $this->data['ddd'] ?>">
                </div>

                <div class="number start-js">
                    <label for="phone">Telefone</label>
                    <input id="phone" type="text" name="phone" value="<?= $this->data['phone'] ?>">
                </div>
            </div>

            <button class="btn-standard-form">Alterar</button>
        </form>
    </section>
</div><!-- Fim div #main-academy-student -->


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/students.js"></script>

<script>
    formLabelInput('#form-student form')
    deletePhoto('#form-student #photo')
    validateStudent()
</script>