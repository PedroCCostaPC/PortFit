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
            Nova avaliação - <span><?= $this->data['student']['fullName'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-exam-form" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/dashboard/alunos/avaliacoes?student=<?= $_GET['student'] ?>" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>
    
        <?php require_once(dirname(__FILE__, 2) . '/layout/optionsStudent.php'); ?>
    </div>

    <!-- Perfio basico do aluno -->
    <section id="student-evolution">
        <!-- Inicio -->
        <article class="start">
            <!-- Foto -->
            <?php if($this->data['student']['photo']): ?>
                <div class="photo" style="background-image: url(<?= URL ?>/assets/img/students/<?= $this->data['student']['photo'] ?>);"></div>
            <?php else: ?>
                <div class="photo" style="background-image: url(<?= URL ?>/assets/img/user.png);"></div>
            <?php endif ?>
                
            <!-- Nome -->
            <div class="profile-base">
                <h5>Nome completo</h5>
                <p><?= $this->data['student']['fullName'] ?></p>
            </div>
    
            <div class="row-3">
                <!-- Idade -->
                <div class="profile-base">
                    <h5>Idade</h5>
                    <p><?= $this->data['student']['age'] ?></p>
                </div>
    
                <!-- RG -->
                <div class="profile-base">
                    <h5>RG</h5>
                    <p><?= $this->data['student']['rg'] ?></p>
                </div>
    
                <!-- Sexo -->
                <div class="profile-base">
                    <h5>Sexo</h5>
                    <p><?= $this->data['student']['sex'] ?></p>
                </div>
            </div>
        </article>
    </section>

    <!-- FORMULARIO -->
    <section id="form">
        <form class="form-standard" action="<?= URL ?>/dashboard/alunos/avaliacao/adicionar?student=<?= $_GET['student'] ?>" method="POST">
            <input type="hidden" name="create-exam">

            <!-- Altura -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="height">* Altura</label>
                    <input type="number" id="height" name="height" value="<?= $this->data['exam']['height'] ?>">
                </div>
            </div>

            <!-- Peso -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="weight">* Peso</label>
                    <input type="number" id="weight" name="weight">
                </div>

                <div class="col start-js">
                    <label for="weight-ideal">* Peso ideal</label>
                    <input type="number" id="weight-ideal" name="weight-ideal" value="<?= $this->data['exam']['idealWeight'] ?>">
                </div>
            </div>

            <!-- Massa magra -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="lean-mass">* Massa magra</label>
                    <input type="number" id="lean-mass" name="lean-mass">
                </div>

                <div class="col start-js">
                    <label for="lean-mass-ideal">* Massa magra ideal</label>
                    <input type="number" id="lean-mass-ideal" name="lean-mass-ideal" value="<?= $this->data['exam']['idealLeanMass'] ?>">
                </div>
            </div>

            <!-- Massa gorda -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="fat-mass">* Massa gorda</label>
                    <input type="number" id="fat-mass" name="fat-mass">
                </div>

                <div class="col start-js">
                    <label for="fat-mass-ideal">* Massa gorda ideal</label>
                    <input type="number" id="fat-mass-ideal" name="fat-mass-ideal" value="<?= $this->data['exam']['idealFatMass'] ?>">
                </div>
            </div>

            <!-- Agua Total (TBW) -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="tbw">* Água total (TBW)</label>
                    <input type="number" id="tbw" name="tbw">
                </div>

                <div class="col start-js">
                    <label for="tbw-ideal">* TBW ideal</label>
                    <input type="number" id="tbw-ideal" name="tbw-ideal" value="<?= $this->data['exam']['idealTbw'] ?>">
                </div>
            </div>

            <!-- Agua extracelular (ECW) -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="ecw">* Água extracelular (ECW)</label>
                    <input type="number" id="ecw" name="ecw">
                </div>

                <div class="col start-js">
                    <label for="ecw-ideal">* ECW ideal</label>
                    <input type="number" id="ecw-ideal" name="ecw-ideal" value="<?= $this->data['exam']['idealEcw'] ?>">
                </div>
            </div>

            <!-- Agua intracelular (ICW) -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="icw">* Água intracelular (ICW)</label>
                    <input type="number" id="icw" name="icw">
                </div>

                <div class="col start-js">
                    <label for="icw-ideal">* ICW ideal</label>
                    <input type="number" id="icw-ideal" name="icw-ideal" value="<?= $this->data['exam']['idealIcw'] ?>">
                </div>
            </div>

            <!-- Pressao arterial -->
            <div class="row row-inputs">
                <div class="col start-js">
                    <label for="systolic">* Pressão arterial sistólica</label>
                    <input type="number" id="systolic" name="systolic">
                </div>

                <div class="col start-js">
                    <label for="diastolic">* Pressão arterial diastólica</label>
                    <input type="number" id="diastolic" name="diastolic">
                </div>
            </div>

            <!-- Fuma -->
            <div class="radio">
                <p>* Fuma</p>
                <div class="col">
                    <div class="col-2">
                        <label for="smoke-not">
                            <input type="radio" id="smoke-not" name="smoke" value="Não">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Não</span>
                        </label>
                    </div>

                    <div class="col-2">
                        <label for="smoke-yes">
                            <input type="radio" id="smoke-yes" name="smoke" value="Sim">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Sim</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Benida Alcoolica -->
            <div class="radio">
                <p>* Bebida Alcoólica</p>
                <div class="col">
                    <div class="col-2">
                        <label for="drinks-not">
                            <input type="radio" id="drinks-not" name="alcoholic" value="Não">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Não</span>
                        </label>
                    </div>

                    <div class="col-2">
                        <label for="drinks-little">
                            <input type="radio" id="drinks-little" name="alcoholic" value="Pouco">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Pouco</span>
                        </label>
                    </div>

                    <div class="col-2">
                        <label for="drinks-yes">
                            <input type="radio" id="drinks-yes" name="alcoholic" value="Muito">

                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Muito</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Lesoes -->
            <div class="row start-js">
                <label for="injuries">Lesões</label>
                <textarea name="injuries" id="injuries" cols="100" rows="10"><?= $this->data['exam']['injuries'] ?></textarea>
            </div>

            <!-- Alergia -->
            <div class="row start-js">
                <label for="allergy">Alergia alimentar</label>
                <textarea name="allergy" id="allergy" cols="100" rows="10"><?= $this->data['exam']['allergy'] ?></textarea>
            </div>

            <!-- Deficiencias -->
            <div class="row start-js">
                <label for="deficiency">Deficiências</label>
                <textarea name="deficiency" id="deficiency" cols="100" rows="10"><?= $this->data['exam']['deficiency'] ?></textarea>
            </div>

            <!-- Cirurgias -->
            <div class="row start-js">
                <label for="surgeries">Cirurgias</label>
                <textarea name="surgeries" id="surgeries" cols="100" rows="10"><?= $this->data['exam']['surgeries'] ?></textarea>
            </div>

            <!-- Dores -->
            <div class="row start-js">
                <label for="pains">Dores</label>
                <textarea name="pains" id="pains" cols="100" rows="10"><?= $this->data['exam']['pains'] ?></textarea>
            </div>

            <!-- Data do exame -->
            <div class="row date-exam">
                <label>Adicionar data (Opcional)</label>

                <div class="col">
                    <input id="day" type="number" name="day" placeholder="Dia">
                    <input id="month" type="number" name="month" placeholder="Mês">
                    <input id="year" type="number" name="year" placeholder="Ano">
                </div>
            </div>

            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>
</div><!-- Fim div #main-dash-exam-form -->

<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/exam.js"></script>

<script>
    boxFilter('#main-dash-exam-form #nav-top .filter')
    formLabelInput('#main-dash-exam-form form')
    validateExam()
    alterColorForm()
</script>