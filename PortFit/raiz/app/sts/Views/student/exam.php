<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navStudent.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(5) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(5) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            <?= $this->data['exam']['title'] ?> - <span><?= $this->data['exam']['dateExam'] ?></span>
        </div>
    </h1>
</div>

<div id="main-dash-exam-view" class="container">
    <div id="nav-top">
        <!-- BTN Voltar -->
        <a href="<?= URL ?>/aluno/avaliacoes" class="btn-return-dash">
            <i class="fa-solid fa-angle-left"></i> Voltar
        </a>
    </div>

    <!-- Perfio basico do aluno -->
    <section id="student-evolution">
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
    
            <div class="row-2">
                <!-- RG -->
                <div class="profile-base rg">
                    <h5>RG</h5>
                    <p><?= $this->data['student']['rg'] ?></p>
                </div>
    
                <!-- Sexo -->
                <div class="profile-base sex">
                    <h5>Sexo</h5>
                    <p><?= $this->data['student']['sex'] ?></p>
                </div>
            </div>

            <!-- IDADE -->
            <div class="row-2">
                <!-- Idade atual -->
                <div class="profile-base">
                    <h5>Idade atual</h5>
                    <p><?= $this->data['student']['age'] ?> anos</p>
                </div>
    
                <!-- Idade avaliacao -->
                <div class="profile-base">
                    <h5>Idade avaliação</h5>
                    <p><?= $this->data['student']['age-exam'] ?> anos</p>
                </div>
            </div>

            <!-- ALTURA / PESO -->
            <div class="row-2">
                <!-- Altura -->
                <div class="profile-base">
                    <h5>Altura</h5>
                    <p><?= $this->data['exam']['height'] ?> m</p>
                </div>
    
                <!-- Peso -->
                <div class="profile-base">
                    <h5>Peso</h5>
                    <p><?= $this->data['exam']['weight'] ?> Kg</p>
                </div>
            </div>

            <!-- MASSA CORPORAL -->
            <div class="row-2">
                <!-- Magra -->
                <div class="profile-base">
                    <h5>Massa magra</h5>
                    <p><?= $this->data['exam']['leanMass'] ?>%</p>
                </div>
    
                <!-- Gorda -->
                <div class="profile-base">
                    <h5>Massa gorda</h5>
                    <p><?= $this->data['exam']['fatMass'] ?>%</p>
                </div>
            </div>

            <!-- AGUA CORPORAL -->
            <div class="row-3">
                <!-- Agua total -->
                <div class="profile-base">
                    <h5>Água total (TBW)</h5>
                    <p><?= $this->data['exam']['tbw'] ?>%</p>
                </div>
    
                <!-- Agua extracelular -->
                <div class="profile-base">
                    <h5>Água extracelular (ECW)</h5>
                    <p><?= $this->data['exam']['ecw'] ?>%</p>
                </div>

                <!-- Agua intracelular -->
                <div class="profile-base">
                    <h5>Água intracelular (ICW)</h5>
                    <p><?= $this->data['exam']['icw'] ?>%</p>
                </div>
            </div>

            <!-- PRESSAO ARTERIAL -->
            <div class="row-2">
                <!-- Sistolica -->
                <div class="profile-base">
                    <h5>Pressão arterial sistólica</h5>
                    <p><?= $this->data['exam']['systolic'] ?></p>
                </div>
    
                <!-- Diastolica -->
                <div class="profile-base">
                    <h5>Pressão arterial diastólica</h5>
                    <p><?= $this->data['exam']['diastolic'] ?></p>
                </div>
            </div>

            <!-- LESOES -->
            <div class="profile-base">
                <h5>Lesões</h5>
                <p><?= $this->data['exam']['injuries'] ?></p>
            </div>

            <!-- ALERGIA ALIMENTAR -->
            <div class="profile-base">
                <h5>Alergia alimentar</h5>
                <p><?= $this->data['exam']['allergy'] ?></p>
            </div>

            <!-- DEFICIENCIAS -->
            <div class="profile-base">
                <h5>Deficiências</h5>
                <p><?= $this->data['exam']['deficiency'] ?></p>
            </div>
            <!-- CIRURGIAS -->
            <div class="profile-base">
                <h5>Cirurgias</h5>
                <p><?= $this->data['exam']['surgeries'] ?></p>
            </div>
            <!-- DORES -->
            <div class="profile-base">
                <h5>Dores</h5>
                <p><?= $this->data['exam']['pains'] ?></p>
            </div>

            <!-- FUMA / ALCOOL -->
            <div class="row-2">
                <!-- Fuma -->
                <div class="profile-base">
                    <h5>Fuma</h5>
                    <p><?= $this->data['exam']['smoke'] ?></p>
                </div>
    
                <!-- Alcool -->
                <div class="profile-base">
                    <h5>Bebida Alcoólica</h5>
                    <p><?= $this->data['exam']['alcoholic'] ?></p>
                </div>
            </div>
        </article>
    </section>
</div><!-- Fim div #main-dash-exam-view -->
