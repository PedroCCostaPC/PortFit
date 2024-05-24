<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>


<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav nav ul li:nth-child(2) a {
        color: <?= SECONDARY_COLOR ?>;
    }
</style>


<section id="modality">

    <!-- Resumo -->
    <article id="summary" style="background-image: url(<?= URL ?>/assets/img/modalities/<?= $this->data['modality']['banner'] ?>);">
        <div class="main-summary">
            <h1><?= $this->data['modality']['name'] ?></h1>


            <div class="main-box">
                <div class="box">
                    <p><?= $this->data['modality']['summary'] ?></p>
        
                    <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia! gostaria de saber mais sobre as aulas de <?= $this->data['modality']["name"] ?>.*">
                        <i class="fa-brands fa-whatsapp"></i> WHATSAPP
                    </a>
                </div>
            </div>
    
        </div>
    </article>


    <!-- Como sao as aulas -->
    <article id="about" class="container">
        <h2 class="title">
            <div >
                Como são as aulas de <span><?= $this->data['modality']['name'] ?></span>
            </div>
        </h2>

        <div class="box">
            <p><?= $this->data['modality']['about'] ?></p>
        </div>
    </article>


    <!-- Porque fazer as aulas -->
    <article id="whyte" class="container">

        <!-- Banner -->
        <div class="col">
            <div class="banner" style="background-image: url(<?= URL ?>/assets/img/modalities/<?= $this->data['modality']['image'] ?>);"></div>
        </div>

        <!-- Texto -->
        <div class="col">
            <h2 class="title">
                <div>
                    Por que fazer <span><?= $this->data['modality']['name'] ?></span>
                </div>
            </h2>

            <div class="box">
                <p><?= $this->data['modality']['whyte'] ?></p>
            </div>
        </div>
    </article>


    <?php if(isset($this->data['time'])): ?>
        <!-- Horarios -->
        <article id="time" class="container">
            <h2 class="title">
                <div>
                    Horário das <span>aulas</span>
                </div>
            </h2>
    
            <div class="main-time">
                <?php foreach($this->data['time'] as $day): ?>
    
                    <div class="day">
                        <h3><?= $day['day'] ?></h3>
    
                        <ul>
                            <?php foreach($day['time'] as $time): ?>
                                <li><?= $time['open'] ?> - <?= $time['close'] ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
    
                <?php endforeach ?>
            </div>
        </article>
    <?php endif ?>

</section>
