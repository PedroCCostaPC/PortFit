<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navStudent.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
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
            Minha <span>evolução</span>
        </div>
    </h1>
</div>

<div id="main-dash-student-profile" class="container">
    <!-- CASO ALUNO NAO POSSUA AVALIACOES -->
    <?php if(!isset($this->data['exam'])): ?>
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

            <h2 class="title not-exam">
                <div>
                    Não possuo <span>avaliações</span>
                </div>
            </h2>
            
        </section>
    <?php else: ?>
        <!-- EVOLUCAO DO ALUNO -->
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
                <div class="profile-base name">
                    <h5>Nome completo</h5>
                    <p><?= $this->data['student']['fullName'] ?></p>
                </div>
    
                <div class="row-3">
                    <!-- Idade -->
                    <div class="profile-base age">
                        <h5>Idade</h5>
                        <p><?= $this->data['student']['age'] ?></p>
                    </div>
    
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
            </article>

            <!-- ////////////////////// ALTURA ////////////////////// -->
            <article id="student-height" class="article">
                <h2>Altura</h2>
    
                <div class="row">
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p>
                            <?= $this->data['exam']['height']['last'] ?>
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['height']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['height']['penultimate'] ?>
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['height']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['height']['first'] ?>
                            </p>
                        </div>
                    <?php endif ?>
                </div>
            </article>

            <!-- ////////////////////// PESO ////////////////////// -->
            <article id="student-weight" class="article-standard">
                <h2>Peso</h2>
    
                <!-- Ultima avaliacao -->
                <div class="row">
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['weight']['class'] ?>">
                            <?= $this->data['exam']['weight']['last'] ?> Kg
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['weight']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['weight']['penultimate'] ?> Kg
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['weight']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['weight']['result-last'] ?> Kg
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['weight']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['weight']['first'] ?> Kg
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['weight']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['weight']['result-first'] ?> Kg
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- Ideal -->
                <div class="ideal">
                    <p class="<?= $this->data['exam']['weight']['class'] ?>">
                        Ideal
                    </p>
    
                    <p class="<?= $this->data['exam']['weight']['class'] ?>">
                        <?= $this->data['exam']['weight']['ideal-min'] ?> Kg a <?= $this->data['exam']['weight']['ideal-max'] ?> Kg
                    </p>
                </div>
            </article>
    
            <!-- ////////////////////// Massa Magra ////////////////////// -->
            <article id="student-leanMass" class="article-standard">
                <h2>Masssa Magra</h2>
    
                <!-- Ultima avaliacao -->
                <div class="row">
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['leanMass']['class'] ?>">
                            <?= $this->data['exam']['leanMass']['last'] ?>%
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['leanMass']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['leanMass']['penultimate'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['leanMass']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['leanMass']['result-last'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['leanMass']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['leanMass']['first'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['leanMass']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['leanMass']['result-first'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- Ideal -->
                <div class="ideal">
                    <p class="<?= $this->data['exam']['leanMass']['class'] ?>">
                        Ideal
                    </p>
    
                    <p class="<?= $this->data['exam']['leanMass']['class'] ?>">
                        <?= $this->data['exam']['leanMass']['ideal-min'] ?>% a <?= $this->data['exam']['leanMass']['ideal-max'] ?>%
                    </p>
                </div>
            </article>
    
            <!-- ////////////////////// Massa Gorda ////////////////////// -->
            <article id="student-fatMass" class="article-standard">
                <h2>Masssa Gorda</h2>
    
                <!-- Ultima avaliacao -->
                <div class="row">
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['fatMass']['class'] ?>">
                            <?= $this->data['exam']['fatMass']['last'] ?>%
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['fatMass']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['fatMass']['penultimate'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['fatMass']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['fatMass']['result-last'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['fatMass']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['fatMass']['first'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['fatMass']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['fatMass']['result-first'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- Ideal -->
                <div class="ideal">
                    <p class="<?= $this->data['exam']['fatMass']['class'] ?>">
                        Ideal
                    </p>
    
                    <p class="<?= $this->data['exam']['fatMass']['class'] ?>">
                        <?= $this->data['exam']['fatMass']['ideal-min'] ?>% a <?= $this->data['exam']['fatMass']['ideal-max'] ?>%
                    </p>
                </div>
            </article>
    
            <!-- ////////////////////// Agua Corporal ////////////////////// -->
            <article id="student-body-water" class="article-standard">
                <h2>Água Corporal</h2>
    
                <!-- TBW -->
                <!-- Ultima avaliacao -->
                <div class="row">
                    <!-- TIPO AGUA -->
                    <div class="col">
                        <p class="exam-title">
                        </p>
    
                        <p class="water">
                            Total (TBW)
                        </p>
                    </div>
    
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['tbw']['class'] ?>">
                            <?= $this->data['exam']['tbw']['last'] ?>%
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['tbw']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['tbw']['penultimate'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['tbw']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['tbw']['result-last'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['tbw']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['tbw']['first'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['tbw']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['tbw']['result-first'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- ECW -->
                <!-- Ultima avaliacao -->
                <div class="row">
                    <!-- TIPO AGUA -->
                    <div class="col">
                        <p class="exam-title">
                        </p>
    
                        <p class="water">
                            Extracelular (ECW)
                        </p>
                    </div>
    
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['ecw']['class'] ?>">
                            <?= $this->data['exam']['ecw']['last'] ?>%
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['ecw']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['ecw']['penultimate'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['ecw']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['ecw']['result-last'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['ecw']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['ecw']['first'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['ecw']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['ecw']['result-first'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- ICW -->
                <!-- Ultima avaliacao -->
                <div class="row row-icw">
                    <!-- TIPO AGUA -->
                    <div class="col">
                        <p class="exam-title">
                        </p>
    
                        <p class="water">
                            Intracelular (ICW)
                        </p>
                    </div>
    
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['icw']['class'] ?>">
                            <?= $this->data['exam']['icw']['last'] ?>%
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['icw']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['icw']['penultimate'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['icw']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['icw']['result-last'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['icw']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['icw']['first'] ?>%
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['icw']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['icw']['result-first'] ?>%
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- Ideal -->
                <div class="ideal">
                    <p class="ideal-walter-title">
                        Ideal
                    </p>
                    
                    <div class="ideal-walter">
                        <!-- TBW -->
                        <div class="col">
                            <p class="<?= $this->data['exam']['tbw']['class'] ?>">
                                TBW
                            </p>
                            <p class="<?= $this->data['exam']['tbw']['class'] ?>">
                                <?= $this->data['exam']['tbw']['ideal-min'] ?>% a <?= $this->data['exam']['tbw']['ideal-max'] ?>%
                            </p>
                        </div>
    
                        <!-- ECW -->
                        <div class="col">
                            <p class="<?= $this->data['exam']['ecw']['class'] ?>">
                                ECW
                            </p>
                            <p class="<?= $this->data['exam']['ecw']['class'] ?>">
                                <?= $this->data['exam']['ecw']['ideal-min'] ?>% a <?= $this->data['exam']['ecw']['ideal-max'] ?>%
                            </p>
                        </div>
    
                        <!-- ICW -->
                        <div class="col">
                            <p class="<?= $this->data['exam']['icw']['class'] ?>">
                                ICW
                            </p>
                            <p class="<?= $this->data['exam']['icw']['class'] ?>">
                                <?= $this->data['exam']['icw']['ideal-min'] ?>% a <?= $this->data['exam']['icw']['ideal-max'] ?>%
                            </p>
                        </div>
                    </div><!-- Fim div .col -->
                </div>
            </article>
    
    
            <!-- ////////////////////// Pressao arterial ////////////////////// -->
            <article id="student-body-pressure" class="article-standard">
                <h2>Pressão Arterial</h2>
    
                <!-- Sistolica -->
                <!-- Ultima avaliacao -->
                <div class="row">
                    <!-- TIPO AGUA -->
                    <div class="col">
                        <p class="exam-title">
                        </p>
    
                        <p class="pressure">
                            Sistólica (mm Hg)
                        </p>
                    </div>
    
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                            <?= $this->data['exam']['systolic']['last'] ?>
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['systolic']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['systolic']['penultimate'] ?>
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['systolic']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['systolic']['result-last'] ?>
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['systolic']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['systolic']['first'] ?>
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['systolic']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['systolic']['result-first'] ?>
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- Diastolica -->
                <!-- Ultima avaliacao -->
                <div class="row row-diastolic">
                    <!-- TIPO AGUA -->
                    <div class="col">
                        <p class="exam-title">
                        </p>
    
                        <p class="pressure">
                            Diastólica (mm Hg)
                        </p>
                    </div>
    
                    <!-- Ultima avaliacao -->
                    <div class="col">
                        <p class="exam-title">
                            Última Avaliação
                        </p>
    
                        <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                            <?= $this->data['exam']['diastolic']['last'] ?>
                        </p>
                    </div>
    
                    <!-- Penultima avaliacao -->
                    <?php if(isset($this->data['exam']['diastolic']['penultimate'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Penúltima Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['diastolic']['penultimate'] ?>
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['diastolic']['result-last-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['diastolic']['result-last'] ?>
                            </p>
                        </div>
                    <?php endif ?>
    
                    <!-- Primeira avaliacao -->
                    <?php if(isset($this->data['exam']['diastolic']['first'])): ?>
                        <div class="col">
                            <p class="exam-title">
                                Primeira Avaliação
                            </p>
        
                            <p>
                                <?= $this->data['exam']['diastolic']['first'] ?>
                            </p>
                        </div>
    
                        <div class="col">
                            <p class="gain">
                                <?= $this->data['exam']['diastolic']['result-first-title'] ?>
                            </p>
    
                            <p class="gain">
                                <?= $this->data['exam']['diastolic']['result-first'] ?>
                            </p>
                        </div>
                    <?php endif ?>
                </div><!-- Fim div .row -->
    
                <!-- Ideal -->
                <div class="ideal">
                    <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                        <?= $this->data['exam']['idealPressure']['message'] ?>
                    </p>
    
                    <p class="ideal-pressure-title">
                        Ideal
                    </p>
                    
                    <div class="ideal-pressure">
                        <!-- Sistolica -->
                        <div class="col">
                            <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                                Sistólica
                            </p>
                            <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                                Menor que 120
                            </p>
                        </div>
    
                        <!-- Diastolica -->
                        <div class="col">
                            <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                                Diastólica
                            </p>
                            <p class="<?= $this->data['exam']['idealPressure']['class'] ?>">
                                Menor que 80
                            </p>
                        </div>
                    </div><!-- Fim div .col -->
                </div>
            </article>
    <?php endif ?>
</div><!-- Fim div #main-academy-student-profile -->
