<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav nav ul li:nth-child(3) a {
        color: <?= SECONDARY_COLOR ?>;
    }
</style>


<!-- ///////////////////// GALRERIA E CONTATO ///////////////////// -->
<section id="address-common" class="container page-contact">
    <?php if(isset($academy['state']) && isset($academy['uf'])): ?>
        <h1>
            Academia <br>
            <span>
                <?= $academy['state'] ?>, <?= $academy['uf'] ?>
            </span>
        </h1>
    <?php endif ?>


    <div class="row">
        <!-- FOTOS DA ACADEMIA -->
        <div id="wowslider-container1">
            <?php if($this->data['photos']): ?>
                <div class="ws_images">
                    <ul>
        
                        <li>
                            <img src="<?= URL ?>/assets/img/academy/<?= $academy["banner"] ?>">
                        </li>
                        <?php foreach($this->data['photos'] as $photo): ?>
                            <li>
                                <img src="<?= URL ?>/assets/img/academy/<?= $photo["name"] ?>">
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                        
                <div class="ws_thumbs">
                    <div>
                        <a href="#" style="background-image: url(<?= URL ?>/assets/img/academy/<?= $academy["banner"] ?>);">
                        </a>
                        <?php foreach($this->data['photos'] as $photo): ?>
                            <a href="#" style="background-image: url(<?= URL ?>/assets/img/academy/<?= $photo['name'] ?>);">
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </div> <!-- Fim div #wowslider-container1 -->

        <!-- INFORMACOES DA ACADEMIA -->
        <div class="address">
            <!-- HORARIOS -->
            <div class="row-1">
                <div class="col">
                    <i class="fa-regular fa-clock"></i>
                </div>
    
                <div class="col">
                    <h2>Horário de funcionamento</h2>
    
                    <div class="time">
                        <div class="col-1">
                            <p>Seg a Sex</p>
                            <p>Feriado</p>
                            <p>Sábado</p>
                            <p>Domingo</p>
                        </div>
    
                        <div class="col-1">
                            <?php if(isset($academy['timeWeek']) && isset($academy['timeHoliday']) && isset($academy['timeSaturday']) && isset($academy['timeSunday'])): ?>
                                <p><?= $academy['timeWeek'] ?></p>
                                <p><?= $academy['timeHoliday'] ?></p>
                                <p><?= $academy['timeSaturday'] ?></p>
                                <p><?= $academy['timeSunday'] ?></p>
                                <?php else: ?>
                            <p>Não informado</p>
                            <p>Não informado</p>
                            <p>Não informado</p>
                            <p>Não informado</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONATTO -->
            <div class="row-1">
                <div class="col">
                    <i class="fa-solid fa-address-book"></i>
                </div>

                <div class="col">
                    <h2>Contato</h2>

                    <div class="col-1">
                        <?php if(isset($academy['contact'][0])): ?>
                            <p>Telefone: <?= $academy['contact'][0]['phone'] ?></p>
                            <p>WhatsApp: <?= $academy['contact'][0]['whatsapp'] ?></p>
                            <p>E-Mail: <?= $academy['contact'][0]['email'] ?></p>
                        <?php else: ?>
                            <p>Não informado</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- ENDERECO -->
            <div class="row-1">
                <div class="col">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="col">
                    <h2>Endereço</h2>

                    <div class="col-1">
                        <p>
                            <?php if(isset($academy['address']) && isset($academy['road']) && isset($academy['number']) && isset($academy['state']) && isset($academy['uf'])): ?>
                                <?= $academy['address'] ?>, <?= $academy['road'] ?>, <?= $academy['number'] ?> - <?= $academy['state'] ?> - <?= $academy['uf'] ?>
                            <?php else: ?>
                                Não informado
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>

        </div><!-- Fim div .address -->
    </div><!-- Fim div .row -->
</section>


<!-- ///////////////////// GOOGLE MAP ///////////////////// -->
<?php if(isset($academy["map"])): ?>
    <section id="google-map" class="container">
        <?= $academy["map"] ?>
    </section>
<?php endif ?>


<!-- ///////////////////// FORMULARIO DE CONTATO ///////////////////// -->
<section id="contact" class="container">

    <h1 class="title">
        <div>
            Entre em <span>contato</span> conosco
        </div>
    </h1>

    <form action="<?= URL ?>/contato" method="POST">
        <input type="hidden" name="create-contact">
        
        <!-- Nome -->
        <div class="row">
            <input class="name" type="text" name="name" placeholder="*Nome">
        </div>

        <!-- Email -->
        <div class="row">
            <input class="email" type="email" name="email" placeholder="*E-Mail">
        </div>

        <!-- ALUNO -->
        <div class="radio">
            <div class="col">
                <div class="col-2">
                    <label for="not-student">
                        <input type="radio" id="not-student" name="student" value="0" checked>

                        <div class="custom-radio">
                            <span></span>
                        </div>
                        <span>Não sou aluno</span>
                    </label>
                </div>

                <div class="col-2">
                    <label for="yes-student">
                        <input type="radio" id="yes-student" name="student" value="1">

                        <div class="custom-radio">
                            <span></span>
                        </div>
                        <span>Sou aluno</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- TELEFONE -->
        <div class="row main-phone">
            <div class="ddd">
                <input type="number" name="ddd" placeholder="DDD">
            </div>

            <div class="phone">
                <input type="number" name="phone" placeholder="Telefone">
            </div>
        </div>

        <!-- MENSAGEM -->
        <div class="row">
            <label class="message-label">*Mensagem</label>
            <textarea class="message" name="message"></textarea>
        </div>


        <button>Enviar</button>

    </form>
</section>


<!-- SCRIPTS -->
<script type="text/javascript" src="<?= URL ?>/assets/lib/wow/wowslider.js"></script>
<script type="text/javascript" src="<?= URL ?>/assets/lib/wow/script.js"></script>

<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/contact.js"></script>