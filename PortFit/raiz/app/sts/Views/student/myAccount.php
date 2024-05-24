<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navStudent.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:last-child a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:last-child a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Minha <span>conta</span>
        </div>
    </h1>
</div>

<div id="main-dash-my-account" class="container">
    <!-- FORMULARIO -->
    <section id="form-my-account">
        <form class="form-standard" action="<?= URL ?>/aluno/minhaConta" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="update-account">

            <!-- Foto -->
            <div id="photo" class="row">
                <input id="remove-photo" type="hidden" name="remove-photo" value="0">

                <div class="photo">
                    <?php if($this->data['photo']): ?>
                        <img src="<?= URL ?>/assets/img/students/<?= $this->data['photo'] ?>">
                    <?php else: ?>
                        <img src="<?= URL ?>/assets/img/user.png">
                    <?php endif ?>
                </div>

                <!-- btn Alterar foto -->
                <div class="btn-file">
                    <label for="banner">
                        <i class="fa-regular fa-image"></i> Alterar foto
                    </label>
                    <input id="banner" type="file" accept="image/*" name="photo">
                </div>

                <?php if($this->data['photo']): ?>
                    <!-- btn remover foto -->
                    <button type="button">
                        <i class="fa-solid fa-trash"></i> Remover foto
                    </button>
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

    <!-- /////////////////////////// ALTERAR SENHA /////////////////////////// -->
    <section id="form-my-password">
        <h2 class="title">
            <div>
                Alterar <span>senha</span>
            </div>
        </h2>

        <form class="form-standard" action="<?= URL ?>/aluno/minhaConta" method="POST">
            <input type="hidden" name="update-password">

            <!-- Nova Senha -->
            <div class="row start-js">
                <input id="password" type="password" name="password" placeholder="Nova senha">
            </div>

            <!-- Confirmar Senha -->
            <div class="row start-js">
                <input id="confirm-password" type="password" name="confirm-password" placeholder="Confirmar senha">
            </div>

            <button class="btn-standard-form">Alterar</button>
        </form>
    </section>
</div><!-- Fim div #main-academy-my-account -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/myAccount.js"></script>

<script>
    formLabelInput('#form-my-account form')
    previewIMG('#photo', '.photo')
    deleteMyPhoto('#form-my-account #photo')
    validateMyAccount()
    validateFormPassword()
</script>
