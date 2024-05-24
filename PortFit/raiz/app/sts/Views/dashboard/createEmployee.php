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
        Cadastrar <span>funcionário</span>
        </div>
    </h1>
</div>

<div id="main-dash-employee" class="container">
    <!-- BTN Voltar -->
    <a href="<?= URL ?>/dashboard/funcionarios" class="btn-return-dash">
        <i class="fa-solid fa-angle-left"></i> Voltar
    </a>

    <!-- FORMULARIO -->
    <section id="form-employee">
        <form class="form-standard" action="<?= URL ?>/dashboard/funcionarios/adicionar" method="POST">
            <input type="hidden" name="create-employee">

            <!-- Nome -->
            <div class="row start-js">
                <label for="first-name">* Nome</label>
                <input type="text" id="first-name" name="first-name">
            </div>

            <!-- Sobrenome -->
            <div class="row start-js">
                <label for="last-name">* Sobrenome</label>
                <input type="text" id="last-name" name="last-name">
            </div>

            <!-- Data de Nascimento -->
            <div class="row birth">
                <label>* data de nascimento</label>

                <div class="col">
                    <input id="day" type="number" name="day" placeholder="Dia">
                    <input id="month" type="number" name="month" placeholder="Mês">
                    <input id="year" type="number" name="year" placeholder="Ano">
                </div>
            </div>

            <!-- Sexo -->
            <div class="radio sex">
                <p>* Sexo</p>

                <div class="col">
                    <div class="col-2">
                        <label for="feminine">
                            <input type="radio" id="feminine" name="sex" value="0">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Feminino</span>
                        </label>
                    </div>

                    <div class="col-2">
                        <label for="masculine">
                            <input type="radio" id="masculine" name="sex" value="1">

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
                <input type="text" id="rg" name="rg">
            </div>

            <!-- E-Mail -->
            <div class="row start-js">
                <label for="email">* E-Mail</label>
                <input type="email" id="email" name="email">
            </div>

            <!-- Telefone -->
            <div class="row phone">
                <div class="ddd start-js">
                    <label for="ddd">DDD</label>
                    <input id="ddd" type="text" name="ddd">
                </div>

                <div class="number start-js">
                    <label for="phone">Telefone</label>
                    <input id="phone" type="text" name="phone">
                </div>
            </div>

            <!-- Cargos -->
            <div class="row positions">
                <!-- Selecionar categoria -->
                <div class="input-select close">
                    <input id="position" type="hidden" name="position">
                    <button type="button">* Cargo <i class="fa-solid fa-angle-up"></i></button>

                    <ul>
                        <?php foreach($this->data['positions'] as $position): ?>
                            <li>
                                <p><?= $position['name'] ?></p>
                                <input type="hidden" value="<?= $position['id'] ?>">
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div><!-- Fim div .input-select -->
            </div><!-- Fim div .positions -->

            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>
</div><!-- Fim div #main-academy-employee -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/employees.js"></script>

<script>
    formLabelInput('#form-employee form')
    inputSelect('#main-dash-employee form .input-select')
    validateEmployee()
</script>